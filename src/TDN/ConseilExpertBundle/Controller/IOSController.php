<?php

namespace TDN\ConseilExpertBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;

use TDN\CoreBundle\Entity\Journal;
use TDN\CoreBundle\Controller\IOSController as IOSMainController;

use TDN\ConseilExpertBundle\Entity\ConseilExpert;
use TDN\ConseilExpertBundle\Form\Type\ConseilExpertSoumissionType;

use TDN\DocumentBundle\Form\Type\selecteurRubriquesType;
use TDN\DocumentBundle\Entity\DocumentRubrique;
use TDN\DocumentBundle\Form\Model\Thematique;
use TDN\DocumentBundle\Form\Type\ThematiquePrincipaleType as ThematiqueType;

use TDN\NanaBundle\Entity\Nana;

use TDN\ImageBundle\Entity\Image;

class IOSController extends IOSMainController {

    private $_entite = array('entite' => 'TDN\ConseilExpertBundle\Entity\ConseilExpert', 'route' => 'ConseilExpert_conseil');

    /**
    *
    * iOSConseilAction
    *
    * Contrôleur traitant la requête d'envoi d'un conseil pour l'application iPhone
    *
    * @return Response $response
    *
    **/
    public function iOSConseilAction ($id) {

        return $this->_getOneContenu($this->_entite, $id);
    }

    /**
    *
    * iOSDerniersConseilsAction
    *
    * Contrôleur traitant l'envoi des derniers conseils parus vers l'application iPhone
    *
    * @return Response
    *
    **/
    public function iOSDerniersConseilsAction () {

        return $this->_iOSDerniersContenus($this->_entite);
    }

    /**
    *
    * conseilDemandeAction
    *
    * Contrôleur traitant la réception d'une demande de conseil
    *
    * @return Response
    *
    **/
	public function conseilDemandeAction () {

		$request = $this->get('request');
	    $em = $this->get('doctrine.orm.entity_manager');      
        $rep_nanas = $em->getRepository('TDN\NanaBundle\Entity\Nana');

		$usr= $rep_nanas->find($request->request->get('userID'));

		if (!($usr instanceof Nana)) {
			$ack = "ERRAUTH";
		} elseif ($usr->getBlacklist() || ($usr->getActive() == 0)) {
			$ack = "ERRALLOW";
		} else {
			$_TDNDocument = new ConseilExpert;
			$form = $this->createForm(new ConseilExpertSoumissionType, $_TDNDocument);
			$_rubrique =  new Thematique;
			$formRubrique = $this->createForm(new ThematiqueType, $_rubrique);

			if ($request->getMethod() == "POST") {
				$form->bind($request);
				if ($form->isValid()) {
					$_TDNDocument->setTitre("");
					$_TDNDocument->setSlug("");
					$_TDNDocument->setLikes(0);
					$_TDNDocument->setHits(0);
					$_TDNDocument->setAuteur(0);
					$_TDNDocument->setReponse('');
					$_TDNDocument->setStatut('CONSEIL_ENREGISTRE');
					$_TDNDocument->setVersion("1.0");
					$_TDNDocument->setTags("");
					$_TDNDocument->setDateSoumission(new \DateTime);
					$_TDNDocument->setDatePublication(new \DateTime);
					$_TDNDocument->setDateModification(new \DateTime);
					$_TDNDocument->setCommentThread(new \Doctrine\Common\Collections\ArrayCollection());

					$_TDNDocument->setLnAuteur($usr);
									
					$imageNana = $_TDNDocument->getLnImage();
					if ($imageNana instanceof Image) {
						$now = new \DateTime;
						$dossier = '/public/'.$now->format('Y').'/'.$now->format('m').'/n_/'.$usr->getIdNana();
						$imageNana->init($dossier, $usr);
					}	

					// Gestion du rubriquage des contenus
					$formRubrique->bindRequest($request);
					$_TDNDocument->addRubrique($_rubrique->getRubrique());

					$em = $this->get('doctrine.orm.entity_manager');
					// $em->persist($_TDNDocument);
					// $em->flush();

					// Post-traitement de l'image
					$imageNana = $_TDNDocument->getLnImage();
					if ($imageNana instanceof Image) {
						$imageProcessor = $this->get('tdn.image_processor');
				        $fichierImage = $imageNana->getFichier();
				        $source = '/'.$this->container->getParameter('media_root').$dossier.$fichierImage;
				        $err = $imageProcessor->square($source, 300, 'sqr_');
				        $err = $imageProcessor->downScale($source, 700, 'height');
					}

					// Notification
					$admins = $this->container->getParameter('admin_notifications');
					$expediteurs = $this->container->getParameter('mail_expediteur');				
					$message = \Swift_Message::newInstance();
					$corps['expediteur'] = "Administrateur";
					$corps['role'] = "Système";
					$corps['destinataire'] = "Justine";
					$corps['dateEnvoi'] = date(' d m Y - H:i:s');
					$corps['pseudo'] = $usr->getUsername();
					$corps['question'] = $_TDNDocument->getQuestion();

					$message->setSubject('[TDN] Demande de conseil')
							->setContentType('text/html')
		        			->setFrom($expediteurs['admin'])
	  	        			->setBody(
		            			$this->renderView('ConseilExpertBundle:Mail:demandeConseil.html.twig', $corps),
		            			'text/html'
		            		);
					foreach($admins['redaction'] as $destinataire) {
						$message->addTo($destinataire);
					}
				    $this->get('mailer')->send($message);

				    $ack = "ACK";
				} else {
				    $ack = "ERRFORM";
				}
			}
		}

        $reponse = new Response;
        $reponse->setContent(json_encode(array('reponse' => $ack)));
		$reponse->headers->set('Content-Type', 'application/json');
		return $reponse;
	}

    /**
    *
    * _extractDocumentTypeData
    *
    * Prépare les données propres aux conseils d'experts
    *
    * @param Article $doc Article à envoyer
    * @return array $items
    *
    **/
    protected function _extractDocumentTypeData ($doc) {
        $items = array();
        $items['question'] = $this->safeString($doc->getQuestion()); 
        $items['reponse'] = $this->safeString($doc->getReponse()); 
        $_expert = $doc->getLnExpert();
        $items['expert'] = $_expert->getPrenom()." ".$_expert->getNom();
        // $items['domaine'] = $_expert->getDomaine();
		$now = new \DateTime;
		$items['ageAuteur'] = $doc->getLnAuteur()->getDateNaissance()->diff($now)->format('%y');

        return $items;
    }

}