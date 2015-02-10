<?php

namespace TDN\ConseilExpertBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;

use TDN\ConseilExpertBundle\Entity\ConseilExpert;
use TDN\ConseilExpertBundle\Form\Type\ConseilExpertSoumissionType;

use TDN\DocumentBundle\Form\Type\selecteurRubriquesType;
use TDN\DocumentBundle\Entity\DocumentRubrique;
use TDN\DocumentBundle\Form\Model\Thematique;
use TDN\DocumentBundle\Form\Type\ThematiquePrincipaleType as ThematiqueType;

use TDN\NanaBundle\Entity\Nana;

use TDN\ImageBundle\Entity\Image;

class PublicationController extends Controller {
	
	public function conseilDemandeAction () {

		$variables['rubrique'] = 'tdn';

		$request = $this->get('request');
	    // Récupération de l'entity manager qui va nous permettre de gérer les entités.
	    $em = $this->get('doctrine.orm.entity_manager');      

		// Instanciation du formulaire
		$_TDNDocument = new ConseilExpert;
		$form = $this->createForm(new ConseilExpertSoumissionType, $_TDNDocument);

		// Menu déroulant pour la rubrique
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

				$usr= $this->get('security.context')->getToken()->getUser();
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
				$em->persist($_TDNDocument);
				$em->flush();

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

				$this->get('session')->getFlashBag()->add('success', 'Merci. Ta question va être envoyée à un de nos experts qui te répondra au plus vite');
				return $this->redirect($this->generateURL('Core_home'));
			} else {

			}

		}

		$variables['form'] = $form->createView();
		$variables['formRubrique'] = $formRubrique->createView();

		// Affichage de la page
		return $this->render('ConseilExpertBundle:Page:conseilDemandeForm.html.twig', $variables);
	}

	public function conseilAction ($rubrique, $id, $slug = NULL) {
	/* Tableau qui va stocker toutes les données à remplacer dans le template twig */
	    $variables = array();  

	    // Récupération de l'entity manager qui va nous permettre de gérer les entités.
	    $em = $this->get('doctrine.orm.entity_manager');      
		$rep_conseils = $em->getRepository('TDN\ConseilExpertBundle\Entity\ConseilExpert');
		$variables['conseil'] = $rep_conseils->find($id);

		if ($variables['conseil'] instanceof ConseilExpert) {
			$rubriques = $variables['conseil']->getRubriques();
			$variables['rubrique'] = $rubriques[0]->getSuperSlug();

			$variables['auteur'] = $variables['conseil']->getLnAuteur();
			$variables['expert'] = $variables['conseil']->getLnExpert();

			$variables['dateDemande'] = "10/10/2012";
			
			$variables['conseil']->updateHits();
			$em->flush();
				
			$variables['canonical'] = $this->generateURL('ConseilExpert_conseil', 
				array('id' => $variables['conseil']->getIdDocument(),
					  'slug' => $variables['conseil']->getSlug(),
					  'rubrique' => $rubriques[0]->getSlug())
				);
			$variables['meta_description'] = strip_tags($variables['conseil']->getAbstract());
			
			// Documents proches (pour aller plus loin)
		    $rep_tags = $em->getRepository('TDN\DocumentBundle\Entity\Tag');
		    $sims = $rep_tags->findSimilars($id);

		    $rep_docs = $em->getRepository('TDN\DocumentBundle\Entity\Document');
		    $variables['similaires'] = array();
		    foreach($sims as $s) {
		    	$variables['similaires'][] = $rep_docs->find($s['id']);
		    }

		    $variables['paths'] = array(
		    	'Article' => 'RedactionBundle_article',
		    	'ConseilExpert' => 'ConseilExpert_conseil',
		    	'Question' => 'CauseuseBundle_conversation',
		    	'Video' => 'VideoBundle_video',
		    	'Dossier' => 'DossierRedaction_dossier'
		    	);

			// Affichage de la page
			return $this->render('ConseilExpertBundle:Page:conseil.html.twig', $variables);			
		} else {
	        $response = $this->render('CoreBundle:Errors:410-gone.html.twig', array('rubrique' => 'tdn'));
            return new Response($response, 410);
		}
	}

	public function filPersoAction ($id) {

		$variables['rubrique'] = 'tdn';
	    $em = $this->get('doctrine.orm.entity_manager');      
		$whoami= $this->get('security.context')->getToken()->getUser();
		// Récupération des demandes de conseil
		$criteres = array('lnAuteur' => $id);
		if (!(($whoami instanceof Nana) && ($id == $whoami->getIdNana()))) {
			$criteres['statut'] = 'CONSEIL_PUBLIE';
			$rep = $em->getRepository('TDN\NanaBundle\Entity\Nana');
			$variables['nana'] = $rep->find($id);
		} else {
			$variables['nana'] = $whoami;
		}
		$rep = $em->getRepository('TDN\ConseilExpertBundle\Entity\ConseilExpert');
		$variables['conseilsList'] = $rep->findBy($criteres, array('dateSoumission' => 'DESC'));

		// Préparation de la page
		$variables['labelStatut'] = array(
			'CONSEIL_ENREGISTRE' => array('Enregistré', 'enregistre'), 
			'CONSEIL_TRANSMIS' => array('Transmis à l’expert', 'transmis'), 
			'CONSEIL_REPONDU' => array('En relecture', 'relecture'), 
			'CONSEIL_PUBLIE' => array('Publié', 'publie')
		);

		// Affichage de la page
		return $this->render('ConseilExpertBundle:Bloc:filPerso.html.twig', $variables);

	}
}
