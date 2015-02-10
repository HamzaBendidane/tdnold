<?php

namespace TDN\CauseuseBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TDN\CauseuseBundle\Entity\Question;
use TDN\CauseuseBundle\Form\Type\CauseuseSoumissionType;
use TDN\CauseuseBundle\Entity\Reponse;
use TDN\CauseuseBundle\Form\Type\CauseuseReponseType;

use TDN\CoreBundle\Entity\Journal;
use TDN\CoreBundle\Controller\IOSController as IOSMainController;

use TDN\DocumentBundle\Controller\PublicController as DocumentController;
use TDN\DocumentBundle\Entity\DocumentRubrique;
use TDN\DocumentBundle\Form\Model\Thematique;
use TDN\DocumentBundle\Form\Type\ThematiquePrincipaleType;

use TDN\NanaBundle\Entity\Nana;

use TDN\ImageBundle\Entity\Image;


class IOSController extends IOSMainController {
	
    private $_entite = array('entite' => 'TDN\CauseuseBundle\Entity\Question', 'route' => 'CauseuseBundle_conversation');

    /**
    *
    * iOSQuestionAction
    *
    * Contrôleur traitant la requête d'envoi d'une question de nana pour l'application iPhone
    *
    * @return Response $response
    *
    **/
    public function iOSQuestionAction ($id) {

        return $this->_getOneContenu($this->_entite, $id);
    }

    /**
    *
    * iOSDerniersConseilsAction
    *
    * Contrôleur traitant l'envoi des dernières questions de nanas parus vers l'application iPhone
    *
    * @return Response
    *
    **/
    public function iOSDernieresQuestionsAction () {

        return $this->_iOSDerniersContenus($this->_entite);
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
	public function _extractDocumentTypeData ($doc) {

	    $items = array();  
		$reponses = $doc->getFilReponses();
		$items['question'] = strip_tags($doc->getQuestion());
		$items['nbReponses'] = (empty($reponses)) ? 0 : $reponses->count();
		$items['totalVotes'] = 0;
		$items['acceptee'] = $doc->getReponseAcceptee();
		foreach ($reponses as $r) {
			$i = $r->getIdDocument();
			$items['totalVotes'] += $r->getLikes();
			$items['reponses'][$i]['votes'] = $r->getLikes();
			$items['reponses'][$i]['reponse'] = $r->getReponse();
			$items['reponses'][$i]['publication'] = $r->getDatePublication()->format('Y-m-d H:i:s');
			$items['reponses'][$i]['auteur'] = $r->getLnAuteur()->getUsername();
		}

		$now = new \DateTime;
		$items['ageAuteur'] = $doc->getLnAuteur()->getDateNaissance()->diff($now)->format('%y');

	    return $items;
	}


    /**
    *
    * questionDemandeAction
    *
    * Poser une question à la communauté
    *
    * @return Response $response
    *
    **/
	public function questionDemandeAction () {

		$request = $this->get('request');
		$URLmanager = $this->get('tdn.document.url');
	    $em = $this->get('doctrine.orm.entity_manager');      
        $rep_nanas = $em->getRepository('TDN\NanaBundle\Entity\Nana');

		$usr= $rep_nanas->find($request->request->get('userID'));

		if (!($usr instanceof Nana)) {
			$ack = "ERRAUTH";
		} elseif ($usr->getBlacklist() || ($usr->getActive() == 0)) {
			$ack = "ERRALLOW";
		} else {
			$variables['id'] = $usr->getidNana();
			$variables['pseudo'] = $usr->getUsername();
			$roles = $usr->getRoles();
			$rp = $roles[0];
			$variables['statut'] = $rp->getName();

			// Instanciation du formulaire
			$_TDNDocument = new Question;
			$form = $this->createForm(new CauseuseSoumissionType, $_TDNDocument);

			// Menu déroulant pour la rubrique
			$_rubrique =  new Thematique;
			$formRubrique = $this->createForm(new ThematiquePrincipaleType, $_rubrique);

			if ($request->getMethod() == "POST") {
				$form->bind($request);
				$now = new \DateTime;
		
				$_TDNDocument->setLnAuteur($usr);
				$_TDNDocument->setTitre("");
				$_TDNDocument->setSlug("");
				$_TDNDocument->setLikes(0);
				$_TDNDocument->setHits(0);
				$_TDNDocument->setStatut('QUESTION_POSEE');
				$_TDNDocument->setVersion("1.0");
				$_TDNDocument->setTags("");
				$_TDNDocument->setDateSoumission(new \DateTime);
				$_TDNDocument->setDatePublication(new \DateTime);
				$_TDNDocument->setDateModification(new \DateTime);
				// Initianlisation des commentaires
				$_TDNDocument->setCommentThread(new \Doctrine\Common\Collections\ArrayCollection());
				// Pas de promotion automatique en page d'accueil (Slider)
				$_TDNDocument->setLnPromu(NULL);
				// Association des rubriques
				$formRubrique->bindRequest($request);
				$_TDNDocument->addRubrique($_rubrique->getRubrique());

				// Modification de l'illustration de la question
				$imageNana = $_TDNDocument->getLnIllustration();
				if ($_TDNDocument->getLnIllustration() instanceof Image) {
					$legende = $imageNana->getTitre();
					if (empty($legende)) $imageNana->setTitre('image postée par '.$usr->getUsername());
					$dossier = '/'.$this->container->getParameter('tdn_media').$now->format('Y').'/'.$now->format('m').'/n_/'.$usr->getidNana();
					$imageNana->init($dossier, $usr);
					$em->persist($imageNana);
				}	

				// $em->persist($_TDNDocument);
				// $em->flush();

				// Post-traitement de l'image
				if ($_TDNDocument->getLnIllustration() instanceof Image) {
					$imageProcessor = $this->get('tdn.image_processor');
					$rep_nana = $em->getRepository('TDN\NanaBundle\Entity\Nana');
					$fichierImage = $_TDNDocument->getLnIllustration()->getFichier();
		            $source = $this->container->getParameter('media_root').$dossier.$fichierImage;
		            $err = $imageProcessor->square($source, 300, 'sqr_');
		            $err = $imageProcessor->downScale($source, 700, 'height');
				}


				// Envoir d'un message de notification à la rédaction en chef
				$message = \Swift_Message::newInstance();
				$corps['expediteur'] = "Administrateur";
				$corps['role'] = "Système";
				$corps['destinataire'] = "Justine";
				$corps['dateEnvoi'] = date(' d m Y - H:i:s');
				$corps['pseudo'] = $usr->getUsername();
				$corps['question'] = $_TDNDocument->getQuestion();

				$message->setSubject('[TDN] Soumission de question aux nanas')
						->setContentType('text/html')
	        			->setFrom('postmaster@trucdenana.com')
	        			->addTo('michel.cadennes@sens-commun.fr')
	        			->addTo('justine@trucdenana.com')
	        			->setBody(
	            			$this->renderView('CauseuseBundle:Mail:soumissionQuestion.html.twig', $corps),
	            			'text/html'
	            		);
			    $this->get('mailer')->send($message);

			    $ack = "ACK";

			}
		}

        $reponse = new Response;
        $reponse->setContent(json_encode(array('reponse' => $ack)));
		$reponse->headers->set('Content-Type', 'application/json');
		return $reponse;
	}

    /**
    *
    * reponseVoterAction
    *
    * Permet aux utilisateurs de voter pour une réponse à une question
    *
    * @param Reponse $id — L'identifiant de la réponse à approuver
    * @return Response $response
    *
    **/
	public function reponsePosterAction () {

		$request = $this->get('request');
	    $em = $this->get('doctrine.orm.entity_manager');      
		$URLmanager = $this->get('tdn.document.url');
        $rep_nanas = $em->getRepository('TDN\NanaBundle\Entity\Nana');

		$usr= $rep_nanas->find($request->request->get('userID'));

		if (!($usr instanceof Nana)) {
			$ack = "ERRAUTH";
		} elseif ($usr->getBlacklist()) {
			$ack = "ERRALLOW";
		} else {
			// Instanciation du formulaire
			$_TDNReponse = new Reponse;
			$form = $this->createForm(new CauseuseReponseType, $_TDNReponse);

			// Instanciation du Repository
			$rep = $em->getRepository('TDN\CauseuseBundle\Entity\Question');
			$idQuestion = $request->get('idQuestion');
			$_TDNDocument = $rep->find($idQuestion);

			if ($request->getMethod() == "POST") {
				$form->bind($request);
				$_TDNReponse->setTitre("");
				$_TDNReponse->setSlug("");
				$_TDNReponse->setLikes(0);
				$_TDNReponse->setHits(0);
				$_TDNReponse->setStatut('REPONSE_PUBLIEE');
				$_TDNReponse->setVersion("1.0");
				$_TDNReponse->setTags("");
				$_TDNReponse->setDatePublication(new \DateTime);
				$_TDNReponse->setDateModification(new \DateTime);
				$_TDNReponse->setLnConversation($_TDNDocument);

				$shortener = $this->get('tdn.core.urlshortener');
				$_reponse = $_TDNReponse->getReponse();
				$err = preg_match_all('#(http://[^\s]+)#', $_reponse, $links, PREG_OFFSET_CAPTURE);
				foreach($links[1] as $l) {
					$source = $l[0];
					$debut = $source[1];
					$fin = $debut + strlen($source);
					$short = $shortener->url_shortener($source);
					$url = "<em>(<a target='_blank' href='$short'>Voir cette page</a>)</em>";
					$_reponse = str_replace($source, $url, $_reponse);
				}
				$_TDNReponse->setReponse($_reponse);
				$_TDNReponse->setLnAuteur($usr);

				// Initianlisation des commentaires
				$_TDNReponse->setCommentThread(new \Doctrine\Common\Collections\ArrayCollection());
				// Pas de promotion automatique en page d'accueil (Slider)
				$_TDNReponse->setLnPromu(NULL);
					
				$imageNana = $_TDNReponse->getLnIllustration();

				if ($imageNana instanceof Image) {
					$now = new \DateTime;
					$dossier = '/public/'.$now->format('Y').'/'.$now->format('m').'/n_/'.$usr->getIdNana().'/';
					$imageNana->init($dossier);
					// Post-traitement de l'image
					$imageProcessor = $this->get('tdn.image_processor');
					$rep_nana = $em->getRepository('TDN\NanaBundle\Entity\Nana');
					$fichierImage = $_TDNReponse->getLnIllustration()->getFichier();
		            $source = $this->container->getParameter('media_root').$dossier.$fichierImage;
		            $err = $imageProcessor->square($source, 300, 'sqr_');
		            $err = $imageProcessor->downScale($source, 700, 'height');
				}

				// $em->persist($_TDNReponse);

				// Notification
				$admins = $this->container->getParameter('admin_notifications');
				$expediteurs = $this->container->getParameter('mail_expediteur');				
				$message = \Swift_Message::newInstance();
				$corps['expediteur'] = "Athanase";
				$corps['role'] = "Modérateur";
				$corps['destinataire'] = $_TDNDocument->getLnAuteur()->getUsername();
				$corps['dateEnvoi'] = date(' d m Y - H:i:s');
				$corps['pseudo'] = $usr->getUsername();
				$corps['question'] = $_TDNDocument->getTitre();
				$corps['reponse'] = $_TDNReponse->getReponse();
				$params['slug'] = $_TDNDocument->getSlug();
				$params['id'] = $_TDNDocument->getIdDocument();
				$_r = $_TDNDocument->getRubriques();
				$params['rubrique'] = $_r[0]->getSlug();
	 			$corps['url'] = 'http://www.trucsdenana.com'.$this->generateURL('CauseuseBundle_conversation', $params);

				$message->setSubject('[TDN] '.$usr->getUsername().' a répondu à une de tes questions aux nanas')
						->setContentType('text/html')
	        			->setFrom($expediteurs['redaction'])
	        			->addTo($_TDNDocument->getLnAuteur()->getEmail())
	         			->setBody(
	            			$this->renderView('CauseuseBundle:Mail:notificationReponse.html.twig', $corps),
	            			'text/html'
	            		);
				foreach($admins['redaction'] as $destinataire) {
					$message->addBcc($destinataire);
				}
			    $this->get('mailer')->send($message);

				// Signaler dans le journal
				$entree = new Journal;
				if ($usr instanceof Nana) $entree->setLnActeur($usr);
				$entree->setAction('REPONSE');
				list($route, $rubrique, $params) = $_TDNDocument->getURLElements();
				$entree->setURL($this->generateURL($route, $params)."#rep_".$_TDNReponse->getIdDocument());
				$entree->setTexte('a répondu à');
				$entree->setTitre($_TDNDocument->getTitre());
				$entree->setLnVeilleur($_TDNDocument->getLnAuteur());
				$entree->setSupport('');
				$entree->setLnRubrique($rubrique);
				$entree->setDateEntree($_TDNReponse->getDatePublication());
				// $em->persist($entree);

				if ($usr instanceof Nana) {
					$err = $this->upgradePopularite('reponse_nanas', $usr);
		        }

				// $em->flush();

				$ack = "ACK";
			}
		}

        $reponse = new Response;
        $reponse->setContent(json_encode(array('reponse' => $ack)));
		$reponse->headers->set('Content-Type', 'application/json');
		return $reponse;
	}

    /**
    *
    * reponseVoterAction
    *
    * Permet aux utilisateurs de voter pour une réponse à une question
    *
    * @param Reponse $id — L'identifiant de la réponse à approuver
    * @return Response $response
    *
    **/
	public function reponseVoterAction ($id) {

		$request = $this->get('request');

       	$botList = $this->container->getParameter('bots');

        $agent = $_SERVER['HTTP_USER_AGENT'];
        $isBot = false;
		$ack = "NOACK";
        foreach ($botList as $_b) {
            $isBot = $isBot || strpos($agent, $_b);
        }
        if ($isBot === false) {
		    // Récupération de l'entity manager qui va nous permettre de gérer les entités.
		    $em = $this->get('doctrine.orm.entity_manager');      
			// Instanciation du Repository
			$rep = $em->getRepository('TDN\CauseuseBundle\Entity\Reponse');
			$reponse = $rep->find($id);

			if ($reponse instanceof Reponse) {
				$reponse->setLikes($reponse->getLikes() + 1);

	        	$points = $this->container->getParameter('action_points');
	        	$reponse->getLnAuteur()->updatePopularite($points['reponse_nanas_votee']);		
				$em->flush();

				$ack = "ACK";		
			}
		}

        $reponse = new Response;
        $reponse->setContent(json_encode(array('reponse' => $ack)));
		$reponse->headers->set('Content-Type', 'application/json');
		return $reponse;
	}

    /**
    *
    * reponseAccepterAction
    *
    * Permet aux utilisateurs de voter pour une réponse à une question
    *
    * @param int $idQuestion — L'identifiant de la question
    * @param int $idReponse — L'identifiant de la réponse acceptée
    * @return Response $response
    *
    **/
	public function reponseAccepterAction ($idQuestion, $idReponse) {

		$request = $this->get('request');
	    $em = $this->get('doctrine.orm.entity_manager');      

		$idNana = $request->query->get('userID');
		$rep = $em->getRepository('TDN\NanaBundle\Entity\Nana');
		$nana = $rep->find($idNana);

		if ($nana instanceof Nana) {
		    // Récupération de l'entity manager qui va nous permettre de gérer les entités.
		    $em = $this->get('doctrine.orm.entity_manager');      
			// Instanciation du Repository
			$rep = $em->getRepository('TDN\CauseuseBundle\Entity\Question');
			$question = $rep->find($idQuestion);
			if ($question instanceof Question) {
				$idAuteur = $question->getLnAuteur()->getIdNana();
				if ($idAuteur == $idNana) {
					$rep = $em->getRepository('TDN\CauseuseBundle\Entity\Reponse');
					$reponse = $rep->find($idReponse);
					if ($reponse instanceof Reponse) {
						$question->setReponseAcceptee($reponse);
					
				       	$points = $this->container->getParameter('action_points');
				       	$reponse->getLnAuteur()->updatePopularite($points['reponse_choisie']);
						$em->flush();				

						$ack = "ACK";									
					} else {
						$ack = "ERRREPONSE";
					}
				} else {
					$ack = "ERROWN";
				}
			} else {
				$ack = "ERRQUESTION";
			}
		} else {
			$ack = "ERRAUTH";
		}

        $reponse = new Response;
        $reponse->setContent(json_encode(array('reponse' => $ack)));
		$reponse->headers->set('Content-Type', 'application/json');
		return $reponse;
	}
}