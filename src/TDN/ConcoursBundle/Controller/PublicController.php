<?php

namespace TDN\ConcoursBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TDN\ConcoursBundle\Entity\Concours;
use TDN\ConcoursBundle\Entity\ConcoursParticipant;
use TDN\ConcoursBundle\Form\Type\ConcoursParticipationType;
use TDN\ConcoursBundle\Form\Model\Invitations;
use TDN\ConcoursBundle\Form\Type\InvitationType;
use TDN\NanaBundle\Entity\Nana;

class PublicController extends Controller
{
    public function concoursSommaireAction()
    {
	    $variables['rubrique'] = 'tdn';
	    // Récupération de l'entity manager qui va nous permettre de gérer les entités.
	    $em = $this->get('doctrine.orm.entity_manager');      

		// Instanciation du Repository
		$repository = $em->getRepository('TDN\ConcoursBundle\Entity\Concours');
		$variables['ouverts'] = $repository->findAllActive();
		$variables['fermes'] = $repository->findStopped();

		$repository = $em->getRepository('TDN\DocumentBundle\Entity\DocumentRubrique');
	    $variables['r'] = $repository->findOneBySlug('beaute');
	    $variables['typesJeu'] = array('TOS' => 'Tirage au sort', 'Q&R' => 'Question/Réponse', 'QCM' => 'QCM');

        return $this->render('ConcoursBundle:Page:concoursSommaire.html.twig', $variables);
    }

    public function concoursShowAction ($id, $slug) {

		/* Tableau qui va stocker toutes les données à remplacer dans le template twig */
	    $variables = array();  

	    $variables['rubrique'] = 'tdn';

	    // Récupération de l'entity manager qui va nous permettre de gérer les entités.
	    $em = $this->get('doctrine.orm.entity_manager');      

		// Instanciation du Repository
		$repository = $em->getRepository('TDN\ConcoursBundle\Entity\Concours');
		$rep_part = $em->getRepository('TDN\ConcoursBundle\Entity\ConcoursParticipant');
		$variables['concours'] = $repository->find($id);
		$typeJeu = $variables['concours']->getTypeJeuConcours();
		switch ($variables['concours']->getTypeJeuConcours()) {
			case 'Q&R' :
				$question = $variables['concours']->getQuestions();	
				foreach($question as $q) {
					$variables['questionnaire'][] = 
						array('question' => $q->getQuestion());
					
				}
				break;

			case 'QCM' :
				$question = $variables['concours']->getQuestions();	
				foreach($question as $q) {
					$variables['questionnaire'][] = 
						array('question' => $q->getQuestion());
					
				}
				break;

			case 'TOS' :
			default:
				$variables['questionnaire'] = array();
		}

		// Instanciation du formulaire de participation
		$document = new ConcoursParticipant;
		$form = $this->createForm(new ConcoursParticipationType, $document);
		$variables['form'] = $form->createView();

		// Instanciation du formulaire pour les invitations
		$formInvite = $this->createForm(new InvitationType, new Invitations);
		$variables['formInvite'] = $formInvite->createView();

		// $rubriques = $variables['concours']->getRubriques();
		// $variables['rubrique'] = $rubriques[0]->getSlug();

		$variables['auteur'] = $variables['concours']->getLnAuteur();

		if ($variables['concours']->getStatut() == 'CONCOURS_ACHEVE') {
			$variables['gagnants'] = $rep_part->findGagnants($id);
		}
		// var_dump($auteur);die;
		
		// récupération des commentaires
		// $rep_comms = $em->getRepository('TDN\CommentaireBundle\Entity\Commentaire');
		// $variables['commentaires'] = $rep_comms->findAllThreaded();
		// $variables['nbCommentaires'] = count($variables['commentaires']);
		$variables['commentaires'] = array();
		$variables['nbCommentaires'] = 0;
		$variables['isOuvert'] = ($variables['concours'] < new \DateTime);

		// Contenus connexes au thème du concours
	    $rep_tags = $em->getRepository('TDN\DocumentBundle\Entity\Tag');
	    $rep_docs = $em->getRepository('TDN\DocumentBundle\Entity\Document');
	    $sims = $rep_tags->findSimilars($id);
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
		return $this->render('ConcoursBundle:Page:concoursShow_'.strtolower($typeJeu).'.html.twig', $variables);

    }

    public function concoursParticiperAction ($id) {

	    $variables['rubrique'] = 'tdn';

		$request = $this->get('request');
	    // Récupération de l'entity manager qui va nous permettre de gérer les entités.
	    $em = $this->get('doctrine.orm.entity_manager');      
		$usr = $this->get('security.context')->getToken()->getUser();

		// Instanciation du formulaire de participation
		$participation = new ConcoursParticipant;
		$form = $this->createForm(new ConcoursParticipationType, $participation);

		// Instanciation du formulaire pour les invitations
		$invitations = new Invitations;
		$formInvite = $this->createForm(new InvitationType, $invitations);

		if ($request->isMethod('POST')) {
			$form->bindRequest($request);
			if ($form->isValid() || true) {
				$rep_part = $em->getRepository('TDN\ConcoursBundle\Entity\ConcoursParticipant');
				if ($usr instanceof Nana) {
					$done = $rep_part->findOneBy(array('lnParticipant' => $usr->getIdNana(), 'lnConcours' => $id));
				} else {
					$done = $rep_part->findOneBy(array('mailParticipant' => $participation->getMailParticipant(), 'lnConcours' => $id));
				}

			    $variables['rubrique'] = 'tdn';
				// Contenus connexes au thème du concours
			    $rep_tags = $em->getRepository('TDN\DocumentBundle\Entity\Tag');
			    $rep_docs = $em->getRepository('TDN\DocumentBundle\Entity\Document');
			    $sims = $rep_tags->findSimilars($id);
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

				if ($done instanceof ConcoursParticipant) {
					// $this->get('session')->getFlashBag()->add('fail', 'Vous avez déjà participé à ce concours');
					return $this->render('ConcoursBundle:Page:concoursErrDouble.html.twig', $variables);
				} else {
					$participantValide = true;
					// Instanciation du Repository
					$repository = $em->getRepository('TDN\ConcoursBundle\Entity\Concours');
					$concours = $repository->find($id);
					$typeJeu = $concours->getTypeJeuconcours();

					$participation->setDateParticipation(new \DateTime);
					$participation->setLnConcours($concours);
					if ($usr instanceof Nana) {
						$participation->setLnParticipant($usr);
					} else {
						if ($participation->getMailParticipant() == '') {
							$participantValide = false;
						}
					}

					// Si le concours est un QCM, on doit fusionner les réponses
					// et si c'est un tirage au sort, il n'y a pas de réponse
					if ($typeJeu == "QCM") {
						$reponses = $request->get('qcm_reponse');
						$participation->setReponse(json_encode($reponses));
					} elseif ($typeJeu == "Q&R") {
						// $participation->setReponse("none");
					} else {}

					// Les mails des invités sont fusionnés dans un champ unique
					$formInvite->bindRequest($request);
					$participation->setInvitations(json_encode($invitations->getEmails()));
					$participation->setPoids(0);
					$participation->setGagnant(0);

					$em->persist($participation);
					$em->flush();

					$buzzer = $this->get('tdn.concours.participants');
					$err = $buzzer->forwardConcours($participation);

					$destinataire = ($usr instanceof Nana) ? $usr->getEmail() : $participation->getMailParticipant();
					// Notifier le participant
					$message = \Swift_Message::newInstance();
					$corps['expediteur'] = "Justine";
					$corps['role'] = "Rédaction";
					$corps['destinataire'] = "";
					$corps['dateEnvoi'] = date(' d m Y - H:i:s');
					$corps['titre'] = $concours->getTitre();
					$corps['rebonds'] = $variables['similaires'];
					$corps['paths'] = $variables['paths'];

					$message->setSubject('[Trucdenana.com] Jeu-concours : '.$concours->getTitre())
	       					->setContentType('text/html')
	 						->setFrom('postmaster@trucdenana.com')
	        				->setTo($destinataire)
	        				// ->setTo('michel.cadennes@sens-commun.fr') 
	        				->setBody($this->renderView('ConcoursBundle:Mail:participation.html.twig', $corps));
	    			// $this->get('mailer')->send($message);

					// $this->get('session')->getFlashBag()->add('success', 'Merci d’avoir participé à ce jeu-concours');
					return $this->render('ConcoursBundle:Page:concoursAck.html.twig', $variables);
				}
			} else {
				// Message d'erreur : formulaire non valide
			}
		}

		return $this->redirect($this->generateURL('Concours_sommaire'));
    }

    public function concoursVoterAction ($participant)
    {
    	$variables['rubrique'] = 'tdn';
		$request = $this->get('request');
	    $em = $this->get('doctrine.orm.entity_manager');      
	    $URLmanager = $this->get('tdn.document.url');

		$repository = $em->getRepository('TDN\ConcoursBundle\Entity\ConcoursParticipant');
		$reponse = $repository->find($participant);

		$reponse->setVotes( 1+ (integer)$reponse->getVotes());

		$em->flush();

		$this->get('session')->getFlashBag()->add('success', 'Ton vote a bien été enregistré');

		return $this->redirect($URLmanager->refererURL($request->headers->get('referer')));
    }
}
