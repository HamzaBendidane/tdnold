<?php
namespace TDN\CauseuseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TDN\CauseuseBundle\Form\Type\BreveType;
use TDN\CauseuseBundle\Entity\Question;
use TDN\CauseuseBundle\Form\Type\CauseuseQuestionEditionType;

use TDN\DocumentBundle\Controller\AdminController as DocumentController;
use TDN\DocumentBundle\Entity\DocumentType;
use TDN\DocumentBundle\Entity\Slider;
use TDN\DocumentBundle\Form\Type\SlideType;
use TDN\DocumentBundle\Form\Model\Thematique;
use TDN\DocumentBundle\Form\Model\ThematiqueCollection;
use TDN\DocumentBundle\Form\Type\ThematiqueCollectionType;
use TDN\DocumentBundle\Form\Model\IndexCollection;
use TDN\DocumentBundle\Form\Type\IndexCollectionType;

use TDN\ImageBundle\Entity\Image;

class AdminController extends DocumentController {
	
	function make_tiny($url) {

		$ch = curl_init();  
		$timeout = 5;  
		curl_setopt($ch, CURLOPT_URL,'http://tinyurl.com/api-create.php?url='.$url);  
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);  	
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER,TRUE);  
		$data = curl_exec($ch);  
		curl_close($ch);  
		return $data;  
	}

	public function indexAction () {

		$variables['rubrique'] = 'tdn';
		$variables['questionsList'] = array();
		$variables['colonnesList'] = array('Question', 'Auteur', 'Rubrique');
		$variables['actionsList'] = array('(Dé)Publier', 'Supprimer');
		$variables['actionsRoutesList'] = array('CauseuseBundle_publier', 'CauseuseBundle_supprimer');
		$variables['selectList'] = array(
			array('value' => 'question', 'texte' => 'Question'),
			array('value' => 'lnAuteur', 'texte' => 'Auteur'),
			array('value' => 'rubriques', 'texte' => 'Rubrique')
			);

		$em = $this->get('doctrine.orm.entity_manager');

		$request = $this->get('request');
		if ($request->isMethod('POST')) {
			$valeur = "%".$request->get('selectValeur')."%";
			$variables['isSelectedField'] = $request->get('selectField');
			$variables['isSelectedValeur'] = $request->get('selectValeur');
			$where = array($request->get('selectField') => $request->get('selectValeur'));
			$variables['questionsList'] = $em->getRepository('TDN\CauseuseBundle\Entity\Question')->findBy($where);
		} else {
			$variables['isSelectedField'] = "";
			$variables['isSelectedValeur'] = "";
			$variables['questionsList'] = $em->getRepository('TDN\CauseuseBundle\Entity\Question')->findAll();
		}

		return $this->render('CauseuseBundle:Admin:questionIndex.html.twig', $variables);
	}

	public function pendingAction () {

		$variables['rubrique'] = 'tdn';
		$variables['questionsList'] = array();
		$variables['colonnesList'] = array('Question', 'Auteur', 'Rubrique');
		$variables['actionsList'] = array('(Dé)Publier', 'Supprimer');
		$variables['actionsRoutesList'] = array('CauseuseBundle_publier', 'CauseuseBundle_supprimer');
		$em = $this->get('doctrine.orm.entity_manager');
		$where = array('statut' => 'QUESTION_POSEE');
		$variables['questionsList'] = $em->getRepository('TDN\CauseuseBundle\Entity\Question')->findByStatut('QUESTION_POSEE');

		return $this->render('CauseuseBundle:Admin:questionPending.html.twig', $variables);
	}

	public function modifierAction ($id) {

		$request = $this->get('request');

	    // Récupération de l'entity manager qui va nous permettre de gérer les entités.
	    $em = $this->get('doctrine.orm.entity_manager');      

		// Instanciation du Repository
		$rep = $em->getRepository('TDN\CauseuseBundle\Entity\Question');
		$_TDNDocument = $rep->find($id);
		$_auteur = $_TDNDocument->getLnAuteur();
		$backupQuestion = clone($_TDNDocument);

		$form = $this->createForm(new CauseuseQuestionEditionType, $_TDNDocument);

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

		$_auteur_id = $_auteur->getidNana();	

		if ($request->getMethod() == "POST") {
			// $blackListed = $nana->getBlacklist() === 0;
			$blackListed = $_auteur->getBlacklist();
			if ($blackListed) {

			} else {
				$form->bindRequest($request);
				if ($form->isValid()) {
					if ($_TDNDocument->getStatut() == 'QUESTION_REFUSEE') {

						// Envoi d'un message de notification à la lectrice
						$admins = $this->container->getParameter('admin_notifications');
						$expediteurs = $this->container->getParameter('mail_expediteur');				
						$message = \Swift_Message::newInstance();
						$_rp = $_TDNDocument->getRubriques();
						$corps['expediteur'] = "Justine";
						$corps['role'] = "Rédaction";
						$corps['destinataire'] = $_auteur->getUsername();
						$corps['dateEnvoi'] = date(' d m Y - H:i:s');
						// spécifiques
						$corps['question'] = $_TDNDocument->getQuestion();
						$corps['rubrique'] = $_rp[0]->getSlug();
						$corps['slug'] = $_TDNDocument->getSlug();
						$corps['motif'] = $request->get('messageNotification');

						$message->setSubject('[TDN] Ta question n’a pas pu être prise en compte')
							->setContentType('text/html')
							->setFrom($expediteurs['redaction'])
							->addTo($_auteur->getEmail())
							->setBody(
								$this->renderView('CauseuseBundle:Mail:ecartQuestion.html.twig', $corps),
								'text/html'
							);
						foreach($admins['redaction'] as $destinataire) {
							$message->addBcc($destinataire);
						}
						$this->get('mailer')->send($message);
						
						$em->flush();

						$this->get('session')->getFlashBag()->add('success', 'La question a été écartée et le message envoyé à la personne qui a posé la question :<br/>'.$corps['motif']);
						
					} else {
						$imageProcessor = $this->get('tdn.image_processor');
						$now = new \DateTime;
						$usr= $this->get('security.context')->getToken()->getUser();				
	
						$slug = $_TDNDocument->makeSlug();
						$_TDNDocument->setDateModification(new \DateTime);
						$_TDNDocument->setVersion($_TDNDocument->getVersion() + 1);
	
						// Modification de l'illustration de la question
						$hasNewIllustration = false;
						
						// Modification de l'illustration de la question
						$hasNewIllustration = false;
						$reuse = (integer)$request->get('reuseIllustration');
						if ($reuse !== 0) {
							$_TDNDocument->setLnIllustration($this->reuseImageIllustration($reuse));
						} else {
							$imageNana = $_TDNDocument->getLnIllustration();
							if ($imageNana instanceof Image && $imageNana->isUpdated()) {
								$legende = $imageNana->getTitre();
								if (empty($legende)) $imageNana->setTitre('image postée par '.$usr->getUsername());
								$dossierIllustration = '/public/'.$now->format('Y').'/'.$now->format('m').'/n_/'.$_auteur->getidNana().'/';
								$imageNana->init($dossierIllustration, $usr, $_auteur);
								$em->persist($imageNana);
								$hasNewIllustration = true;
							}	
						}

						// Intégration en une du site
						$hasNewCover = false;
						$miseEnAvant = $request->get('miseEnAvant');
						if (!($miseEnAvant == 1)) {
							$em->remove($slider);
							$_TDNDocument->setLnPromu(NULL);
						} else {
							$formSlider->bindRequest($request);
							$imageCover = $slider->getLnCover();
							if (!$exSlider) {
								$slider->setup($_TDNDocument->getLnAuteur());
								$slider->setLnSource($_TDNDocument);
								$_m = $imageCover->getDatePublication()->format('m');
								$_y = $imageCover->getDatePublication()->format('Y');
								$dossierSlider = '/public/'.$_y.'/'.$_m.'/';
								$em->persist($slider);
								$em->persist($imageCover);
								$hasNewCover = true;
							} else {
								if ($slider->getLnCover()->isUpdated()) {
									$_m = $imageCover->getDatePublication()->format('m');
									$_y = $imageCover->getDatePublication()->format('Y');
									$dossierSlider = '/public/'.$_y.'/'.$_m.'/';
									$imageCover->init($dossierSlider, $usr, $imageCover->getLnAuteur());
									$em->persist($imageCover);
									$hasNewCover = true;
								}
							}
						}
						
						// Gestion du rubriquage des contenus
						$formThematiques->bindRequest($request);
						$listeRubriques = $themes->getRubriques();
						foreach($_TDNDocument->getRubriques() as $r) {
							$_TDNDocument->removeRubrique($r);
						}
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
						$tags = $semTagger->tagsUpdate($_TDNDocument, $indexCollection->getIndex());

						if (($backupQuestion->getStatut() == 'QUESTION_POSEE') &&
							($_TDNDocument->getStatut() == 'QUESTION_PUBLIEE')) {
								$_TDNDocument->setDatePublication(new \DateTime);
						}
	
						$em->flush();

						// Post-traitement
						// Illustration
						if ($hasNewIllustration) {
							// Post-traitement de l'image
						$fichierImage = $imageNana->getFichier();
						$source = $this->container->getParameter('media_root').$dossierIllustration.$fichierImage;
						$err = $imageProcessor->square($source, 300, 'sqr_');
						$err = $imageProcessor->downScale($source, 700, 'height');
						}

						// Slider
						if ($hasNewCover) {
							//Post-traitement de l'image
							 $imageProcessor = $this->get('tdn.image_processor');
							 $fichierImage = $imageCover->getFichier();
							$source = $this->container->getParameter('media_root').$dossierSlider.$fichierImage;
							$err = $imageProcessor->downScale($source, 600, 'width', 'slider_');
						}

						// Envoi d'un message de notification à la rédaction en chef
						$admins = $this->container->getParameter('admin_notifications');
						$expediteurs = $this->container->getParameter('mail_expediteur');				
						$message = \Swift_Message::newInstance();
						$_rp = $_TDNDocument->getRubriques();
						$corps['expediteur'] = "Administrateur";
						$corps['role'] = "Système";
						$corps['destinataire'] = $_auteur->getUsername();
						$corps['dateEnvoi'] = date(' d m Y - H:i:s');
						// spécifiques
						$corps['question'] = $_TDNDocument->getQuestion();
						$corps['rubrique'] = $_rp->first()->getSlug();
						$corps['slug'] = $_TDNDocument->getSlug();
						$statut = $_TDNDocument->getStatut();
						if ($backupQuestion->getStatut() == 'QUESTION_POSEE') {
							if ($statut == 'QUESTION_PUBLIEE') {
								$templateReponse ='CauseuseBundle:Mail:publicationQuestion.html.twig';
								$message->setSubject('[TDN] Publication d’une question aux nanas');
								$this->get('session')->getFlashBag()->add('success', 'La question a été publiée');
	
							} elseif ($statut == 'QUESTION_REFUSEE') {
								$templateReponse ='CauseuseBundle:Mail:ecartQuestion.html.twig';
								$message->setSubject('[TDN] Ecart d’une question aux nanas');
								$this->get('session')->getFlashBag()->add('success', 'La question a été écartée');
							} else {
								$templateReponse = 'CauseuseBundle:Mail:relectureQuestion.html.twig';
								$message->setSubject('[TDN] Modification d’une question aux nanas');
								$this->get('session')->getFlashBag()->add('success', 'La question a été mise à jour');
							}
						}
	
						$message->setContentType('text/html')
							->setSubject('[TDN] Ta question a été lue par la rédaction')
							->setFrom('postmaster@trucdenana.com')
							->addTo($_auteur->getEmail())
							->setBody(
							$this->renderView('CauseuseBundle:Mail:relectureQuestion.html.twig', $corps),
							'text/html'
						);
						foreach($admins['redaction'] as $destinataire) {
							$message->addBcc($destinataire);
						}
						$this->get('mailer')->send($message);
	
						if (
						    ($backupQuestion-> getStatut() != $_TDNDocument->getStatut()) 
						    && $_TDNDocument->getStatut() == 'QUESTION_PUBLIEE') {
						    $this->processPublication($_TDNDocument);
						}
					}

				return $this->redirect($this->generateURL('CauseuseBundle_index'));
				}
			}
		}
		
		// Hydratation du formulaire
		$illustration = $_TDNDocument->getLnIllustration();
		if (!is_null($_TDNDocument->getLnIllustration())) {
			$_dp = $_TDNDocument->getDatePublication();
			$_ai = $_TDNDocument->getLnAuteur()->getIdNana();
			$path = '/'.$this->container->getParameter('media_root').$this->container->getParameter('tdn_media');
			$path .= $_dp->format('Y').'/'.$_dp->format('m').'/n_/'.$_ai.'/';
			$variables['pathIllustration'] = $path.$illustration->getFichier();
		} else {
			$variables['pathIllustration'] = NULL;
		}
		$variables['dateSoumission'] = $_TDNDocument->getDateSoumission();
		$titreDetail = $_TDNDocument->getTitre();;
		$variables['titreDetail'] = $titreDetail ?: '< Sans titre >';
		$prefd = $_TDNDocument->getReponseAcceptee();
		if ($prefd) {
			$rep = $em->getRepository('TDN\CauseuseBundle\Entity\Reponse');
			$variables['reponseAcceptee'] = $rep->find($prefd);
		} else {
			$variables['reponseAcceptee'] = "";
		}
		$variables['pseudoDemandeur'] = $_auteur->getUsername();
		$variables['form'] = $form->createView();
		$variables['formThematiques'] = $formThematiques->createView();
		$variables['formSlider'] = $formSlider->createView();
		$variables['formCallback'] = "CauseuseBundle_editer";
		$variables['TDNDoc_id'] = $_TDNDocument->getIdDocument();
		
		return $this->render('CauseuseBundle:Admin:questionEdit.html.twig', $variables);
	}

	function supprimerAction ($id) {

		$em = $this->get('doctrine.orm.entity_manager');
		$rep = $em->getRepository('TDN\CauseuseBundle\Entity\Question');
		$question = $rep->find($id);

		$em->remove($question);
		$em->flush();

		return $this->redirect($this->generateURL('CauseuseBundle_index'));
	}

	function publierAction ($id) {

		$em = $this->get('doctrine.orm.entity_manager');
		$rep = $em->getRepository('TDN\CauseuseBundle\Entity\Question');
		$_TDNDocument = $rep->find($id);
		$_auteur = 

		$question->setStatut("QUESTION_PUBLIEE");
		$question->setDatePublication(new \DateTime);

		$em->flush();

		$this->processPublication($_TDNDocument);

		$this->get('session')->getFlashBag()->add('success', 'La question a été publiée');
		return $this->redirect($this->generateURL('CauseuseBundle_index'));
	}

	function processPublication ($_TDNDocument)
	{
		// Notifications
		$em = $this->get('doctrine.orm.entity_manager');
		$_auteur = $_TDNDocument->getLnAuteur();
		$followers = $_auteur->getIsFollowed();
		$_rp = $_TDNDocument->getRubriques();

		foreach ($followers as $ff) {
			print_r($ff->getEmail());
			// Envoir d'un message de notification à la rédaction en chef
			$message = \Swift_Message::newInstance();
			$corps['expediteur'] = "Justine";
			$corps['role'] = "Rédaction TDN";
			$corps['destinataire'] = $ff->getUsername();
			$corps['dateEnvoi'] = date(' d m Y - H:i:s');
			// VAriables du corsp du mail
			$corps['auteur'] = $_auteur->getUsername();
			$corps['question'] = $_TDNDocument->getQuestion();
			$corps['url'] = $this->generateURL('CauseuseBundle_conversation', array(
				'slug' => $_TDNDocument->getSlug(),
				'id' => $_TDNDocument->getIdDocument(),
				'rubrique' => $_TDNDocument->getLnThematique()->getSlug()
				));

			$message->setSubject('[TDN] '.$_auteur->getUsername().' a posé une question aux nanas')
					->setContentType('text/html')
        			->setFrom('postmaster@trucdenana.com')
        			->addTo($ff->getEmail())
        			->setBody(
            			$this->renderView('CauseuseBundle:Mail:followPublicationQuestion.html.twig', $corps),
            			'text/html'
            		);
		    $this->get('mailer')->send($message);
		}

		// Gratification
        $points = $this->container->getParameter('action_points');
        $score = $points['question_nanas'] * ((!is_null($_TDNDocument->getLnPromu())) ? 2 : 1);
        $_auteur->updatePopularite($score);
        $em->flush();

        // Journalisation
	}
}
