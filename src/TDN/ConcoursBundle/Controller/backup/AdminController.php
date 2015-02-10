<?php

namespace TDN\ConcoursBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TDN\ConcoursBundle\Entity\Concours;
use TDN\ConcoursBundle\Form\Type\ConcoursType;
use TDN\ConcoursBundle\Form\Type\ConcoursReviewType;
use TDN\ConcoursBundle\Form\Type\ConcoursNewType;

use TDN\DocumentBundle\Controller\AdminController as DocumentController;
use TDN\DocumentBundle\Entity\DocumentRubrique;
use TDN\DocumentBundle\Entity\Slider;
use TDN\DocumentBundle\Form\Type\SlideType;
use TDN\DocumentBundle\Form\Model\Thematique;
use TDN\DocumentBundle\Form\Model\ThematiqueCollection;
use TDN\DocumentBundle\Form\Type\ThematiqueCollectionType;
use TDN\ImageBundle\Entity\Image;
use TDN\NanaBundle\Entity\Nana;
use TDN\DocumentBundle\Form\Model\IndexCollection;
use TDN\DocumentBundle\Form\Type\IndexCollectionType;

class AdminController extends DocumentController {
	
	private function getErrorMessages(\Symfony\Component\Form\Form $form) {      
	    $errors = array();

	    if ($form->hasChildren()) {
	        foreach ($form->getChildren() as $child) {
	            if (!$child->isValid()) {
	                $errors[$child->getName()] = $this->getErrorMessages($child);
	            }
	        }
	    } else {
	        foreach ($form->getErrors() as $key => $error) {
	            $errors[] = $error->getMessage();
	        }   
	    }

	    return $errors;
	}

	protected function determineType($_TDNDocument)
	{
		$nb_questions = 0;
		$nb_reponses = 0;
		foreach ($_TDNDocument->getQuestions() as $q) {
			$nb_reponses = 0;
			$nb_questions += 1;
			$q->setLnConcours($_TDNDocument);
			foreach ($q->getFilReponses() as $r) {
				$r->setLnQuestion($q);
			}
		}

		if ($nb_questions === 0) {
			$_TDNDocument->setTypeJeuConcours('TOS');
		} else if ($nb_questions > 1) {
			$_TDNDocument->setTypeJeuConcours('QCM');
		} else {
			$_TDNDocument->setTypeJeuConcours('Q&R');
		}
		return $_TDNDocument->getTypeJeuConcours();
	}


	protected function updateIllustration($_TDNDocument, $dossierIllustration)
	{
		$em = $this->get('doctrine.orm.entity_manager');
		$usr= $this->get('security.context')->getToken()->getUser();				
		$imageNana = $_TDNDocument->getLnIllustration();
		if ($imageNana instanceof Image && $imageNana->isUpdated()) {
			$legende = $imageNana->getTitre();
			if (empty($legende)) $imageNana->setTitre('Sans titre');
			$imageNana->init($dossierIllustration, $usr, $_TDNDocument->getLnAuteur());
			$em->persist($imageNana);
			return true;
		}
		return false;
	}

	protected function updateSlider($_TDNDocument, $miseEnAvant, Slider $slider, $isUpdate = false)
	{
		$em = $this->get('doctrine.orm.entity_manager');
		$usr= $this->get('security.context')->getToken()->getUser();				
		if (!($miseEnAvant == 1)) {
			$em->remove($slider);
			$_TDNDocument->setLnPromu(NULL);
			return false;
		} else {
			$imageCover = $slider->getLnCover();
			if (!$isUpdate) {
				$slider->setup($_TDNDocument->getLnAuteur());
				$slider->setLnSource($_TDNDocument);
				$_m = $imageCover->getDatePublication()->format('m');
				$_y = $imageCover->getDatePublication()->format('Y');
				$dossierSlider = '/public/'.$_y.'/'.$_m.'/';
				$em->persist($slider);
				$em->persist($imageCover);
				return true;
			} else {
				if ($slider->getLnCover()->isUpdated()) {
					$_m = $imageCover->getDatePublication()->format('m');
					$_y = $imageCover->getDatePublication()->format('Y');
					$dossierSlider = '/public/'.$_y.'/'.$_m.'/';
					$imageCover->init($dossierSlider, $usr, $imageCover->getLnAuteur());
					$em->persist($imageCover);
					return true;
				}
			}
		}
		return false;
	}

	protected function updateRubriques ($_TDNDocument, $listeRubriques)
	{
		$_TDNDocument->resetRubriques();
		if (!empty($listeRubriques)) {
			foreach($listeRubriques as $r) {
				$rubrique = $r->getRubrique();
				$_TDNDocument->addRubrique($rubrique);
			}
		}
		return $_TDNDocument->getRubriques();
	}

	public function concoursIndexAction () {
		

		$variables['bundleName'] = "ConcoursBundle";
		$variables['titreListe'] = "Index des jeux-concours"; 
		$variables['colonnesList'] = array('Titre', 'Participants', 'Statut');
		$variables['actionsList'] = array('Tirer', '(Dé)Publier');
		$variables['actionsRoutesList'] = array('Concours_tirageGagnants', 'ConcoursBundle_publier');
		$variables['selectList'] = array(
			array('value' => 'titre', 'texte' => 'Titre'),
			array('value' => 'sponsor', 'texte' => 'Sponsor'),
			array('value' => 'statut', 'texte' => 'Statut')
			);
		$variables['Liste'] = array();

		$em = $this->get('doctrine.orm.entity_manager');

		$request = $this->get('request');
		if ($request->isMethod('POST')) {
			$valeur = "%".$request->get('selectValeur')."%";
			$variables['isSelectedField'] = $request->get('selectField');
			$variables['isSelectedValeur'] = $request->get('selectValeur');
			$where = array($request->get('selectField') => $request->get('selectValeur'));
			$variables['Liste'] = $em->getRepository('TDN\ConcoursBundle\Entity\Concours')->findBy($where);
		} else {
			$variables['isSelectedField'] = "";
			$variables['isSelectedValeur'] = "";
			$variables['Liste'] = $em->getRepository('TDN\ConcoursBundle\Entity\Concours')->findDigest();
		}

		return $this->render('ConcoursBundle:Admin:concoursIndex.html.twig', $variables);
	}
	
	public function addAction () {
		
		$request = $this->get('request');

	    // Récupération de l'entity manager qui va nous permettre de gérer les entités.
	    $em = $this->get('doctrine.orm.entity_manager');      

		// Instanciation du formulaire
		$_TDNDocument = new Concours;
		$form = $this->createForm(new ConcoursNewType, $_TDNDocument);
		$variables['form'] = $form->createView();

		// Instanciation du formulaire des rubriques
		$themes = new ThematiqueCollection;
		$formThematiques = $this->createForm(new ThematiqueCollectionType, $themes);
		$variables['formThematiques'] = $formThematiques->createView();

		// Instanciation du formulaire du Slider
		$slider = new Slider;
		$formSlider = $this->createForm(new SlideType, $slider);
		$variables['formSlider'] = $formSlider->createView();

		// Indexation du document
		$indexCollection = new IndexCollection;
		$formIndex = $this->createForm(new IndexCollectionType, $indexCollection);
		$variables['formIndex'] = $formIndex->createView();

		
		if ($request->getMethod() === 'POST') {
			$form->bindRequest($request);
			if ($form->isValid()) {

				$usr= $this->get('security.context')->getToken()->getUser();
				$_TDNDocument->setLnAuteur($usr);

				// $q = $document->getQuestions();
				// $q1 = $q[0];
				// $r = $q1->getFilReponses();
				// print_r($q); die;

				$nb_questions = 0;
				$nb_reponses = 0;
				foreach ($_TDNDocument->getQuestions() as $q) {
					$nb_reponses = 0;
					$nb_questions += 1;
					$q->setLnConcours($_TDNDocument);
					foreach ($q->getFilReponses() as $r) {
						$r->setLnQuestion($q);
					}
				}

				if ($nb_questions === 0) {
					$_TDNDocument->setTypeJeuConcours('TOS');
				} elseif ($nb_questions > 1) {
					$_TDNDocument->setTypeJeuConcours('QCM');
				} else {
					$_TDNDocument->setTypeJeuConcours('Q&R');
				}

				$slug = $_TDNDocument->makeSlug();
				$_TDNDocument->setLikes(0);
				$_TDNDocument->setHits(0);
				$_TDNDocument->setVersion(1);
				$_TDNDocument->setDatePublication(new \DateTime);
				$_TDNDocument->setDateModification(new \DateTime);
				$_TDNDocument->setCommentThread(new \Doctrine\Common\Collections\ArrayCollection());

				// Modification de l'illustration de la question

				$reuse = (integer)$request->get('reuseIllustration');
				if ($reuse !== 0) {
					$_TDNDocument->setLnIllustration($this->reuseImageIllustration($reuse));
				} else {
					$ill = $_TDNDocument->getLnIllustration();
					if ($ill instanceof Image) {
						$file = $ill->getFichier();
						// print_r($ill->getFichier()); die;
						if (is_null($file) && $file == '') {
							$ill->setFichier('beautiful_stranger.jpg');
						}
					}
					$this->processImageIllustration($_TDNDocument->getLnIllustration(), $usr);
				}

				// Intégration en une du site
				$miseEnAvant = $request->get('miseEnAvant');
				if (!($miseEnAvant == 1)) {
					$_TDNDocument->setLnPromu(NULL);
				} else {
					$formSlider->bindRequest($request);
					$slider->setup($_TDNDocument->getLnAuteur());
					$slider->setLnSource($_TDNDocument);
					if (is_null($slider->getStatut())) $slider->setStatut(0);
					$em->persist($slider);
				}

				// Gestion du rubriquage des contenus
				$formThematiques->bindRequest($request);
				$listeRubriques = $themes->getRubriques();
				$_TDNDocument->resetRubriques();
				if (!empty($listeRubriques)) {
					foreach($listeRubriques as $r) {
						$rubrique = $r->getRubrique();
						$_TDNDocument->addRubrique($rubrique);
					}
				}

				// Traitement des mots-clefs
				$formIndex->bindRequest($request);
				$semTagger = $this->get('tdn.tag.manager');
				$tags = $semTagger->tag($_TDNDocument, $indexCollection->getIndex());

				if (is_null($_TDNDocument->getStatut())) $_TDNDocument->setStatut('CONCOURS_BROUILLON');

				$em->persist($_TDNDocument);
				$em->flush();

				$destinataire = $usr->getEmail();
				// Notifier l'auteur
				$admins = $this->container->getParameter('admin_notifications');
				$expediteurs = $this->container->getParameter('mail_expediteur');				
				$message = \Swift_Message::newInstance();
				$corps['expediteur'] = "Administrateur";
				$corps['role'] = "Système";
				$corps['destinataire'] = "Justine";
				$corps['dateEnvoi'] = date(' d m Y - H:i:s');
				$corps['pseudo'] = $usr->getUsername();
				$corps['titre'] = $_TDNDocument->getTitre();

				$message->setSubject('[TDN] Nouveau jeu-concours : '.$_TDNDocument->getTitre())
						->setContentType('text/html')
        				->setFrom($expediteurs['admin'])
        				->setTo($destinataire)
         				->setBody(
            				$this->renderView('ConcoursBundle:Mail:creation.html.twig', $corps),
            				'text/html'
	        			);
				foreach($admins['redaction'] as $destinataire) {
					$message->addTo($destinataire);
				}
    			$this->get('mailer')->send($message);

				return $this->redirect($this->generateURL('ConcoursBundle_index'));
			} else {
				$errors = $this->getErrorMessages($form);
				print_r($errors);
				die;
			}
		}
		
		$variables['titreDetail'] = "Nouveau jeu-concours";
		$variables['formCallback'] = "ConcoursBundle_add";

		return $this->render('ConcoursBundle:Admin:concoursAdd.html.twig', $variables);//array('form' => $form->createView())
	}

	public function reviserAction ($id) {
		
		$request = $this->get('request');
		$usr= $this->get('security.context')->getToken()->getUser();

	    // Récupération de l'entity manager qui va nous permettre de gérer les entités.
	    $em = $this->get('doctrine.orm.entity_manager');
	    $rep = $em->getRepository('TDN\ConcoursBundle\Entity\Concours');

		// Instanciation du formulaire
		$variables['concours'] = $rep->find($id);
		$_TDNDocument = $rep->find($id);
		$form = $this->createForm(new ConcoursReviewType, $_TDNDocument);
		$variables['form'] = $form->createView();

		// Instanciation du formulaire des rubriques
		$themes = new ThematiqueCollection;
		$rubriques = $_TDNDocument->getRubriques();
		foreach ($rubriques as $r) {
			$_theme = new Thematique;
			$_theme->setRubrique($r);
			$themes->addRubrique($_theme);
		}
		$formThematiques = $this->createForm(new ThematiqueCollectionType, $themes);

		// Indexation du document
		$indexCollection = new IndexCollection;
		$tags = $_TDNDocument->getFilTags();
		foreach ($tags as $t) {
			$indexCollection->addIndex($t);
		}
		$formIndex = $this->createForm(new IndexCollectionType, $indexCollection);
		$variables['formIndex'] = $formIndex->createView();

		// Instanciation du formulaire du Slider
		if ($_TDNDocument->getLnPromu() instanceof Slider) {
			$slider = $_TDNDocument->getLnPromu();
			$exSlider = true;
		} else {
			$slider = new Slider();
			$exSlider = false;
		}
		$formSlider = $this->createForm(new SlideType, $slider);

		if ($request->getMethod() === 'POST') {
			$form->bindRequest($request);
			if ($form->isValid()) {
				$now = new \DateTime();
		        $imageProcessor = $this->get('tdn.image_processor');
				$_auteur = $_TDNDocument->getLnAuteur();

				$type = $this->determineType($_TDNDocument);

				$slug = $_TDNDocument->makeSlug();
				$_TDNDocument->setVersion(1 + $_TDNDocument->getVersion());
				$_TDNDocument->setDateModification($now);

				// Modification de l'illustration de la question
				$hasNewIllustration = false;
				$reuse = (integer)$request->get('reuseIllustration');
				if ($reuse !== 0) {
					$_TDNDocument->setLnIllustration($this->reuseImageIllustration($reuse));
				} else {
					$imageNana = $_TDNDocument->getLnIllustration();
					if (($imageNana instanceof Image) && $imageNana->isUpdated()) {
						$legende = $imageNana->getTitre();
						// $err = $imageNana->makeSlug();
						$this->processImageIllustration($imageNana, $usr);
						$em->persist($imageNana);
						$hasNewIllustration = true;
					}	
				}
		
				// Intégration en une du site
				$formSlider->bindRequest($request);
				$miseEnAvant = $request->get('miseEnAvant');
				$hasNewCover = $this->updateSlider($_TDNDocument, $miseEnAvant, $slider, $exSlider);

				// Gestion du rubriquage des contenus
				$formThematiques->bindRequest($request);
				$listeRubriques = $themes->getRubriques();
				$this->updateRubriques($_TDNDocument, $listeRubriques);

				// Traitement des mots-clefs
				$formIndex->bindRequest($request);
				$semTagger = $this->get('tdn.tag.manager');
				$tags = $semTagger->tagsUpdate($_TDNDocument, $indexCollection->getIndex());

				$em->persist($_TDNDocument);
				$em->flush();

				$destinataire = $_auteur->getEmail();
				// Notifier l'auteur
				$admins = $this->container->getParameter('admin_notifications');
				$expediteurs = $this->container->getParameter('mail_expediteur');				
				$message = \Swift_Message::newInstance();
				$corps['expediteur'] = "Administrateur";
				$corps['role'] = "Système";
				$corps['destinataire'] = "Justine";
				$corps['dateEnvoi'] = date(' d m Y - H:i:s');
				$corps['pseudo'] = $_auteur->getUsername();
				$corps['titre'] = $_TDNDocument->getTitre();

				$message->setSubject('[TDN] Révision du jeu-concours : '.$_TDNDocument->getTitre())
						->setContentType('text/html')
        				->setFrom($expediteurs['admin'])
        				->setTo($destinataire)
        				->setBody(
            				$this->renderView('ConcoursBundle:Mail:revisionConcours.html.twig', $corps),
            				'text/html'
	        			);
				foreach($admins['redaction'] as $destinataire) {
					$message->addTo($destinataire);
				}
    			$this->get('mailer')->send($message);

				return $this->redirect($this->generateURL('ConcoursBundle_index'));
			}
		}
		
		$variables['titreDetail'] = "Révision du jeu-concours";
		$variables['formCallback'] = "Concours_reviser";
		$variables['TDNDoc_id'] = $id;
		$variables['form'] = $form->createView();
		$variables['formThematiques'] = $formThematiques->createView();
		$variables['formSlider'] = $formSlider->createView();
		if ($exSlider) {
			$variables['isChecked'] = 1;
		}

		if ($_TDNDocument->getStatut() == 'CONCOURS_ACHEVE') {
			$rep_part = $em->getRepository('TDN\ConcoursBundle\Entity\ConcoursParticipant');
			$variables['listeGagnants'] = $rep_part->findBy(
				array(
				'lnConcours' => $_TDNDocument->getIdDocument(),
				'gagnant' => true
				));
		}

		return $this->render('ConcoursBundle:Admin:concoursRevision.html.twig', $variables);
	}

	public function tirageGagnantsAction ($id) {
		
		$request = $this->get('request');
		$em = $this->get('doctrine.orm.entity_manager');
	    $URLmanager = $this->get('tdn.document.url');
		$rep = $em->getRepository('TDN\ConcoursBundle\Entity\Concours');
		$rep_part = $em->getRepository('TDN\ConcoursBundle\Entity\ConcoursParticipant');

		$concours = $rep->find($id);
		if ($concours->getStatut() === 'CONCOURS_ACHEVE') {
			$this->get('session')->getFlashBag()->add('fail', 'Le tirage au sort a déjà été effectué.');
		} else {
			$_participants = $concours->getFilParticipants();
			$historiqueGagnants = $rep_part->findHistoriqueGagnants();
			switch($concours->getTypeJeuConcours()) {

				case 'QCM':
					$_listeQuestions = $concours->getQuestions();
					$tabReponses = new \stdClass;
					$_nq = 1;
					foreach ($_listeQuestions as $_q) {
						$_listeReponsesQuestions = $_q->getFilReponses();
						$_rang = 1;
						foreach ($_listeReponsesQuestions as $_r) {
							if ($_r->getExact() == 1) $tabReponses->$_nq = $_rang;
							$_rang += 1;
						}
						$_nq += 1;
					}
					$_choixReponses = count($tabReponses);
					foreach ($_participants as $p) {
						$_listeReponsesJoueur = json_decode($p->getReponse());
						if (is_object($_listeReponsesJoueur)) {
							if ($_listeReponsesJoueur == $tabReponses) {
								$invites = $p->getInvitations();
								$candidats[$p->getIdParticipation()] = rand(0,100) + 20*count(explode(',', $invites));
							}
						}
					}
						
					arsort($candidats);
					$candidats = array_slice($candidats, 0, $concours->getNombreGagnants(), true);
					foreach ($candidats as $jetonPartticipation => $score) {
						$p = $rep_part->find($jetonPartticipation);
						$p->setGagnant(true);
					}
					$concours->setStatut('CONCOURS_ACHEVE');
					break;

				case 'Q&R':
					$_listeQuestions = $concours->getQuestions();
					$_q = $_listeQuestions[0];
					$_listeReponsesQuestions = $_q->getFilReponses();
					$_r = $_listeReponsesQuestions[0]->getReponse();
					print_r($_r);
					foreach ($_participants as $p) {
						$_elementsReponsesJoueur = explode(' ',$p->getReponse());
						$_elementsReference = explode(' ', $_r);
						$couverture = count(array_intersect($_elementsReference, $_elementsReponsesJoueur));
						$note = 100 * $couverture/count($_elementsReference);
						$invites = $p->getInvitations();
						$candidats[$p->getIdParticipation()] = $note + rand(0,50) + 20*count(explode(',', $invites));
					}
						
					arsort($candidats);
					$candidats = array_slice($candidats, 0, $concours->getNombreGagnants(), true);
					foreach ($candidats as $jetonPartticipation => $score) {
						$p = $rep_part->find($jetonPartticipation);
						$p->setGagnant(true);
					}
					$concours->setStatut('CONCOURS_ACHEVE');
					break;

				case 'VOTE':
					break;

				case 'TOS':
				default:
					$scores = array();
					foreach ($_participants as $p) {
						$invites = $p->getInvitations();
						$needle = array($p->getMailParticipant());
						$blackListee = 0;
						if ($p->getLnParticipant() instanceof Nana) {
							$needle[] = $p->getLnParticipant()->getIdNana();
							$needle[] = $p->getLnParticipant()->getEmail();
							$blackListee = $p->getLnParticipant()->getBlacklist();
							$grade = $p->getLnParticipant()->getGrade();
							$anciennete = ($p->getLnParticipant()->getDateInscription() < $concours->getDateDebut()) ? 1 : 0;
						} else {
							$grade = 0;
							$anciennete = 0;
						}
						$_i = array_intersect($needle, $historiqueGagnants);
						unset($needle);
						$dejaGagnant = (!empty($_i)) ? 1 : 0;
						$scores[$p->getIdParticipation()] = rand(0,100) + 10*count(explode(',', $invites)) + 20*$grade + 20*$anciennete - 400*$dejaGagnant - 5000*$blackListee;
					}
					$nbGagnants = $concours->getNombreGagnants();
					arsort($scores);
					// print_r($scores); die;
					$scores = array_slice($scores, 0, $nbGagnants, true);
					foreach ($scores as $jetonParticipation => $score) {
						$p = $rep_part->find($jetonParticipation);
						$p->setGagnant(true);
					}
					$concours->setStatut('CONCOURS_ACHEVE');
					break;
			}
			$em->flush();			
			$this->get('session')->getFlashBag()->add('success', 'Vous avez désigné le(s) gagnant(s) de ce jeu-concours. Celui-ci est désormais figé.');
		}

		return $this->redirect($URLmanager->refererURL($request->headers->get('referer')));
	}

	public function notificationGagnantsAction ($id) {

		$URLmanager = $this->get('tdn.document.url');
		$request = $this->get('request');
		$em = $this->get('doctrine.orm.entity_manager');
		$rep = $em->getRepository('TDN\ConcoursBundle\Entity\Concours');
		$corps['concours'] = $rep->find($id);
		$rep_part = $em->getRepository('TDN\ConcoursBundle\Entity\ConcoursParticipant');
		$listeGagnants = $rep_part->findBy(
			array(
			'lnConcours' => $corps['concours']->getIdDocument(),
			'gagnant' => true
			));

		$statut = $corps['concours']->getStatut();
		if ($statut !== 'CONCOURS_ACHEVE') {
			$this->get('session')->getFlashBag()->add('success', 'Le concours n’est pas clos');
		} else {		
			if (!empty($listeGagnants)) {
				foreach ($listeGagnants as $_gagnant) {
					if ($_gagnant->getLnParticipant() instanceof Nana) {
						$destinataire = $_gagnant->getLnParticipant()->getEmail();
						$pseudo = $_gagnant->getLnParticipant()->getUsername();
					} else {
						$destinataire = $_gagnant->getMailParticipant();
						$pseudo = "";
					}
					// Notifier l'auteur
					$admins = $this->container->getParameter('admin_notifications');
					$expediteurs = $this->container->getParameter('mail_expediteur');				
					$message = \Swift_Message::newInstance();
					$corps['expediteur'] = "La rédaction de TDN";
					$corps['role'] = "Concours";
					$corps['destinataire'] = $pseudo;
					$corps['dateEnvoi'] = date(' d m Y - H:i:s');

					$message->setSubject('[TDN] Tu as gagné au jeu-concours : '.$corps['concours']->getTitre())
							->setContentType('text/html')
	        				->setFrom($expediteurs['redaction'])
	        				->setTo($destinataire)
	        				->setBody(
	            				$this->renderView('ConcoursBundle:Mail:notificationGagnants.html.twig', $corps),
	            				'text/html'
		        			);
					foreach($admins['redaction'] as $bcc) {
						$message->addBcc($bcc);
					}
	    			$this->get('mailer')->send($message);
	    			print_r($destinataire);
				}
				$this->get('session')->getFlashBag()->add('success', 'Les messages ont été envoyés');
			} else {
				$this->get('session')->getFlashBag()->add('fail', 'La liste des gagnants est vide !');
			}
		}

		return $this->redirect($URLmanager->refererURL($request->headers->get('referer')));
	}

}