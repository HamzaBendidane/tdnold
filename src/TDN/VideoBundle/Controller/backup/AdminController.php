<?php

namespace TDN\VideoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use TDN\VideoBundle\Entity\Video;
use TDN\VideoBundle\Form\Type\VideoAdminNewType;
use TDN\VideoBundle\Form\Type\VideoAdminReviewType;

use TDN\DocumentBundle\Controller\AdminController as DocumentController;
use TDN\DocumentBundle\Entity\DocumentRubrique;
use TDN\DocumentBundle\Form\Type\selecteurRubriquesType;
use TDN\DocumentBundle\Entity\Slider;
use TDN\DocumentBundle\Form\Type\SlideType;
use TDN\DocumentBundle\Form\Model\Thematique;
use TDN\DocumentBundle\Form\Model\ThematiqueCollection;
use TDN\DocumentBundle\Form\Type\ThematiqueCollectionType;
use TDN\DocumentBundle\Form\Model\IndexCollection;
use TDN\DocumentBundle\Form\Type\IndexCollectionType;

use TDN\ImageBundle\Entity\Image;


class AdminController extends DocumentController {
	
	protected $vimeoPattern = '<iframe src="http://player.vimeo.com/video/%s?badge=0" width="%d" height="%d" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe><p><a href="http://vimeo.com/%s">%s</a> from <a href="%s">%s</a> on <a href="http://vimeo.com">Vimeo</a>.</p>';

	public function indexAction () {
		
		$request = $this->get('request');

		$longueurPage = 100;
		$page = $request->query->get('page');
		$page = (!(isset($page)) || (int)$page === 0) ? 0 : (int)$page - 1;

		$variables['documentList'] = array();
		$variables['colonnesList'] = array('Titre', 'Auteur');
		$variables['actionsList'] = array('(Dé)Publier', 'Supprimer');
		$variables['actionsRoutesList'] = 
			array(
				'Video_publier' => array (
					'VIDEO_PUBLIEE' => 'Retirer',
					'VIDEO_PROPOSEE' => 'Publier'
					),
				'Video_supprimer' => 'Supprimer');
		$variables['selectList'] = array(
			array('value' => 'titre', 'texte' => 'Titre'),
			array('value' => 'lnAuteur', 'texte' => 'Auteur'),
			array('value' => 'rubriques', 'texte' => 'Rubrique')
			);

		$em = $this->get('doctrine.orm.entity_manager');
		$rep = $em->getRepository('TDN\VideoBundle\Entity\Video');

		if ($request->isMethod('POST') && ($request->get('selectSubmitter') != '')) {
			$variables['isSelectedField'] = $request->get('selectField');
			$variables['isSelectedValeur'] = $request->get('selectValeur');
			$where = array($request->get('selectField') => $request->get('selectValeur'));
			switch ($variables['isSelectedField']) {
				case 'titre' : 
					$variables['documentList'] = $rep->searchBy($where);
					break;
				case 'lnAuteur' :
					$variables['documentList'] = $rep->searchByAuteur($variables['isSelectedValeur']);
					break;
				case 'rubriques' :
					$variables['documentList'] = $rep->findByRubrique($variables['isSelectedValeur']);
					break;
				default :
					$variables['documentList'] = array();
			}
		    $variables['totalVideos'] = count($variables['documentList']);
		} else {
			// $offset = $page * $longueurPage;
			$variables['isSelectedField'] = "";
			$variables['isSelectedValeur'] = "";
			$variables['documentList'] = $rep->findLimitedAll($longueurPage, $page);
			$_c = $rep->count('all');
		    $variables['totalVideos'] = $_c;
		}

		$variables['page'] = $page + 1;
		$variables['derniere'] = ceil($variables['totalVideos'] / $longueurPage);

		return $this->render('VideoBundle:Admin:videoIndex.html.twig', $variables);
	}
	
	public function enAttenteAction () {
		
		$variables['documentList'] = array();
		$variables['colonnesList'] = array('Titre', 'Auteur');
		$variables['actionsList'] = array('(Dé)Publier', 'Supprimer');
		$variables['actionsRoutesList'] = 
			array(
				'Video_publier' => array (
					'VIDEO_PUBLIEE' => 'Retirer',
					'VIDEO_PROPOSEE' => 'Publier'
					),
				'Video_supprimer' => 'Supprimer');
		$variables['selectList'] = array(
			array('value' => 'titre', 'texte' => 'Titre'),
			array('value' => 'lnAuteur', 'texte' => 'Auteur'),
			array('value' => 'rubriques', 'texte' => 'Rubrique')
			);

		$em = $this->get('doctrine.orm.entity_manager');

		$usr= $this->get('security.context')->getToken()->getUser();

		$where['statut'] = 'VIDEO_PROPOSEE';
		$variables['documentList'] = $em->getRepository('TDN\VideoBundle\Entity\Video')->findBy($where);
	    $variables['totalVideos'] = $variables['documentList'];

		$variables['isSelectedField'] = "";
		$variables['isSelectedValeur'] = "";
		$variables['page'] = 1;
		$variables['derniere'] = 1;

		return $this->render('VideoBundle:Admin:videoIndex.html.twig', $variables);
	}
	
	public function ajouterAction () {

		$request = $this->get('request');
	    $em = $this->get('doctrine.orm.entity_manager');      

		$_TDNDocument = new Video;
		$_TDNDocument->setDatePublication(new \DateTime);

		// Instanciation du formulaire
		$form = $this->createForm(new VideoAdminNewType, $_TDNDocument);
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
		        $imageProcessor = $this->get('tdn.image_processor');
				$usr= $this->get('security.context')->getToken()->getUser();
				$now = new \DateTime;

				$_importable = false;

				$_TDNDocument->setLnAuteur($usr);
				$slug = $_TDNDocument->makeSlug();
				$_TDNDocument->setLikes(0);
				$_TDNDocument->setHits(0);
				$_TDNDocument->setVersion((integer)$_TDNDocument->getVersion()+1);
				// $_TDNDocument->setDatePublication(new \DateTime);
				$_TDNDocument->setDateModification(new \DateTime);
				$_TDNDocument->setCommentThread(new \Doctrine\Common\Collections\ArrayCollection());

				// Infos récupérées via les API des plates-formes
				$idVideo = $_TDNDocument->getIdVideo();
				if (!empty($idVideo)) {
					$videoURLData = $_TDNDocument->parseHebergeurURL($idVideo);
					if (!is_array($videoURLData)) {
						$this->get('session')
							 ->getFlashBag()
							 ->add('fail', 'L’URL de la video n’est pas valide');
							 $_importable = $_importable || false;
					} else {
						$_TDNDocument->setIdHebergeur($videoURLData[2]);
						$_importable = $_importable || $_TDNDocument->videoSegment($videoURLData[3]);
						if (!$_importable) {
							$this->get('session')
								 ->getFlashBag()
								 ->add('fail', 'La vidéo n’a pas pu être trouvée chez l’hébergeur');
						}
					}
				} else {
					$codeIntegration = $_TDNDocument->getCodeIntegration();
					if (empty($codeIntegration)) {
						$this->get('session')
							 ->getFlashBag()
							 ->add('warning', 'Une vidéo doit avoir soit une URL, soit un code d’intégration');
							 $_importable = $_importable || false;
					} else {
							 $_importable = $_importable || true;
					}
				}
				// Modification de l'illustration de la question
				$reuse = (integer)$request->get('reuseIllustration');
				if ($reuse !== 0) {
					$_TDNDocument->setLnIllustration($this->reuseImageIllustration($reuse));
					$_importable = true;
				} else {
					$_importable = $this->processImageIllustration($_TDNDocument->getLnIllustration(), $usr);
				}

				// Intégration en une du site
				$miseEnAvant = $request->get('miseEnAvant');
				if (!($miseEnAvant == 1)) {
					$_TDNDocument->setLnPromu(NULL);
				} else {
					$formSlider->bindRequest($request);
					$slider->setup($_TDNDocument->getLnAuteur());
					$slider->setLnSource($_TDNDocument);
					$em->persist($slider);
		           // Post-traitement de l'image
		            $imageProcessor = $this->get('tdn.image_processor');
		            $fichierImage = $slider->getLnCover()->getFichier();
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
					$_importable = true;
				} else {
					$_importable = false;
				}

				// Traitement des mots-clefs
				$formIndex->bindRequest($request);
				$semTagger = $this->get('tdn.tag.manager');
				$tags = $semTagger->tag($_TDNDocument, $indexCollection->getIndex());

				if ($_TDNDocument->getSlug() === '') {
					$_importable = false;
					$this->get('session')
						 ->getFlashBag()
						 ->add('fail', 'Le titre est obligatoire');
				}

				$duree = $_TDNDocument->getDuree();
				if (empty($duree)) { $_TDNDocument->setDuree('non définie'); }

				if ($_importable) {
					$_TDNDocument->setStatut('VIDEO_PUBLIEE');
	 				$this->get('session')->getFlashBag()->add('success', 'Ta vidéo est maintenant publiée');
				} else {
					$_TDNDocument->setStatut('VIDEO_PROPOSEE');
					$this->get('session')->getFlashBag()->add('fail', 'Ta vidéo est enregistrée, mais n’a pas pu être publiée');
				}

				$em->persist($_TDNDocument);
				$em->flush();

				// Notification
				$admins = $this->container->getParameter('admin_notifications');
				$expediteurs = $this->container->getParameter('mail_expediteur');				
				$message = \Swift_Message::newInstance();
				$corps['expediteur'] = "Administrateur";
				$corps['role'] = "Système";
				$corps['destinataire'] = "Justine";
				$corps['dateEnvoi'] = date(' d m Y - H:i:s');
				// Eléments spécifiques
				$corps['pseudo'] = $usr->getUsername();
				$corps['titre'] = $_TDNDocument->getTitre();
				$corps['statut'] = $_TDNDocument->getStatut();

				$message->setSubject('[TDN] Nouvelle video ('.$_TDNDocument->getVersion().')')
						->setContentType('text/html')
	        			->setFrom($expediteurs['redaction'])
	        			->addTo($_TDNDocument->getLnAuteur()->getEmail())
	        			->setBody(
	            			$this->renderView('VideoBundle:Mail:nouvelleVideo.html.twig', $corps),
	            			'text/html'
	            		);
				foreach($admins['redaction'] as $destinataire) {
					$message->addBcc($destinataire);
				}
			    $this->get('mailer')->send($message);

				return $this->redirect($this->generateURL('Video_index'));
			}
		}

		$variables['titreDetail'] = "Nouvelle vidéo";
		$variables['formCallback'] = "Video_ajouter";

		// Affichage de la page
		return $this->render('VideoBundle:Admin:videoAdd.html.twig', $variables);
	}

	public function inspecterAction ($id) {

		$request = $this->get('request');

	    // Récupération de l'entity manager qui va nous permettre de gérer les entités.
	    $em = $this->get('doctrine.orm.entity_manager');      

		// Instanciation du formulaire
		$rep = $em->getRepository('TDN\VideoBundle\Entity\Video');
		$_backupDocument = $_TDNDocument = $rep->find($id);
		$_backupTitre = $_backupDocument->getTitre();
		$_backupIdVideo = $_backupDocument->getIdVideo();
		$form = $this->createForm(new VideoAdminReviewType, $_TDNDocument);
		$variables['form'] = $form->createView();

		// Instanciation du formulaire des rubriques
		$_actuelRubriques = $_TDNDocument->getRubriques();
		$themes = new ThematiqueCollection;
		if (is_object($_actuelRubriques)) {
			foreach($_actuelRubriques as $r) {
				$t = new Thematique;
				$t->setRubrique($r);
				$themes->addRubrique($t);
			}
		} 
		$formThematiques = $this->createForm(new ThematiqueCollectionType, $themes);
		$variables['formThematiques'] = $formThematiques->createView();

		// Instanciation du formulaire du Slider
		$_actuelSlider = $_TDNDocument->getLnPromu();
		if (is_object($_actuelSlider)) {
			$slider = $_actuelSlider;
			$exSlider = true;
		} else {
			$slider = new Slider;
			$exSlider = false;
		}
		$formSlider = $this->createForm(new SlideType, $slider);
		$variables['formSlider'] = $formSlider->createView();

		// Indexation du document
		$indexCollection = new IndexCollection;
		$tags = $_TDNDocument->getFilTags();
		foreach ($tags as $t) {
			$indexCollection->addIndex($t);
		}
		$formIndex = $this->createForm(new IndexCollectionType, $indexCollection);
		$variables['formIndex'] = $formIndex->createView();

		if ($request->getMethod() === 'POST') {
			$form->bindRequest($request);
			if ($form->isValid()) {
		        $imageProcessor = $this->get('tdn.image_processor');

				$_TDNDocument->setVersion($_TDNDocument->getVersion()+1);
				$_TDNDocument->setDateModification(new \DateTime);
				$_TDNDocument->setSlug($_TDNDocument->makeSlug());
				$usr= $this->get('security.context')->getToken()->getUser();
		
				// Infos récupérées via les API des plates-formes
				$idVideo = $_TDNDocument->getIdVideo();
				$hebergeur= $_TDNDocument->getIdHebergeur();
				$_importable = true;
				if ($_TDNDocument->getIdVideo() != $_backupIdVideo) {
					if (!empty($idVideo)) {
						$videoURLData = $_TDNDocument->parseHebergeurURL($idVideo);
						if (!is_array($videoURLData)) {
							$this->get('session')
								 ->getFlashBag()
								 ->add('fail', 'L’URL de la video n’est pas valide');
								 $_importable = $_importable || false;
						} else {
							$_TDNDocument->setIdHebergeur($videoURLData[2]);
							$_importable = $_importable || $_TDNDocument->videoSegment($videoURLData[3]);
							if (!$_importable) {
								$this->get('session')
									 ->getFlashBag()
									 ->add('fail', 'La vidéo n’a pas pu être trouvée chez l’hébergeur');
							}
						}
					} else {
						$codeIntegration = $_TDNDocument->getCodeIntegration();
						if (empty($codeIntegration)) {
							$this->get('session')
								 ->getFlashBag()
								 ->add('warning', 'Une vidéo doit avoir soit une URL, soit un code d’intégration');
								 $_importable = $_importable || false;
						} else {
								 $_importable = $_importable || true;
						}
					}
				}

				$now = new \DateTime;
				
				// Modification de l'illustration de la question
				$hasNewIllustration = false;
				$reuse = (integer)$request->get('reuseIllustration');
				if ($reuse !== 0) {
					$_TDNDocument->setLnIllustration($this->reuseImageIllustration($reuse));
				} else {
					$imageNana = $_TDNDocument->getLnIllustration();
					if (($imageNana instanceof Image) && $imageNana->isUpdated()) {
						$this->processImageIllustration($imageNana, $usr);
						$em->persist($imageNana);
						$hasNewIllustration = true;
					}	
				}

				// Intégration en une du site
				$hasNewCover = false;
				$miseEnAvant = $request->get('miseEnAvant');
				if (!($miseEnAvant == 1)) {
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

				if ($hasNewCover) {
		           // Post-traitement de l'image
		            $imageProcessor = $this->get('tdn.image_processor');
		            $fichierImage = $slider->getLnCover()->getFichier();
		            $source = $this->container->getParameter('media_root').$dossierSlider.$fichierImage;
		            $err = $imageProcessor->square($source, 300, 'sqr_');
		            $err = $imageProcessor->downScale($source, 700, 'height');
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
				$tags = $semTagger->tagsUpdate($_TDNDocument, $indexCollection->getIndex());

				if ($_importable == true) {
					$em->flush();

					// Notification
					$admins = $this->container->getParameter('admin_notifications');
					$expediteurs = $this->container->getParameter('mail_expediteur');				
					$message = \Swift_Message::newInstance();
					$corps['expediteur'] = "Administrateur";
					$corps['role'] = "Système";
					$corps['destinataire'] = "Justine";
					$corps['dateEnvoi'] = date(' d m Y - H:i:s');
					$corps['pseudo'] = $_TDNDocument->getLnAuteur()->getUsername();
					$corps['titre'] = $_TDNDocument->getTitre();
					$corps['statut'] = $_TDNDocument->getStatut();

					$message->setSubject('[TDN] Modification de video ('.$_TDNDocument->getVersion().')')
							->setContentType('text/html')
		        			->setFrom($expediteurs['admin'])
		        			->addTo($_TDNDocument->getLnAuteur()->getEmail())
		        			->setBody(
		            			$this->renderView('VideoBundle:Mail:nouvelleVideo.html.twig', $corps),
		            			'text/html'
		            		);
					foreach($admins['redaction'] as $destinataire) {
						$message->addTo($destinataire);
					}
				    $this->get('mailer')->send($message);

	 				$this->get('session')->getFlashBag()->add('success', 'Ta vidéo a été modifiée');					
					return $this->redirect($this->generateURL('Video_index'));
				} else {
					$this->get('session')->getFlashBag()->add('fail', 'Il y a une erreur dans l’id de ta vidéo');
				}

			}
		}

		$variables['titreDetail'] = "Modification de vidéo";
		$variables['formCallback'] = "Video_inspecter";
		$variables['TDNDoc_id'] = $_backupDocument->getIdDocument();
		$variables['previewCodeIntegration'] = $_backupDocument->getCodeIntegration();
		$variables['previewVignette'] = $_backupDocument->getVignette();

		// Affichage de la page
		return $this->render('VideoBundle:Admin:videoInspect.html.twig', $variables);
	}

	public function supprimerAction ($id) {

		// Récupération des services
	    $em = $this->get('doctrine.orm.entity_manager');      
		$repository = $em->getRepository('TDN\VideoBundle\Entity\Video');
		$request = $this->get('request');

		$_TDNDocument = $repository->find($id);
		$this->deleteRecord($_TDNDocument);
		$this->get('session')->getFlashBag()->add('success', 'La vidéo a été supprimée');
		return $this->redirect($request->headers->get('referer'));
	}

	function publierAction ($id) {

		$em = $this->get('doctrine.orm.entity_manager');
		$rep = $em->getRepository('TDN\VideoBundle\Entity\Video');
		$_TDNDocument = $rep->find($id);

		$statut = $_TDNDocument->getStatut();
		if ($statut == 'VIDEO_PUBLIEE') {
			$_TDNDocument->setStatut('VIDEO_PROPOSEE');
			$this->get('session')->getFlashBag()->add('success', 'La vidéo a été ôtée du site');			
		} else {
			$_TDNDocument->setStatut('VIDEO_PUBLIEE');
			$this->get('session')->getFlashBag()->add('success', 'La vidéo a été publiée');
		}

		$em->flush();
/*
		// Envoi d'un message de notification à la rédaction en chef
		$admins = $this->container->getParameter('admin_notifications');
		$expediteurs = $this->container->getParameter('mail_expediteur');				
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
    			->setBody(
        			$this->renderView('CauseuseBundle:Mail:soumissionQuestion.html.twig', $corps),
        			'text/html'
        		);
		foreach($admins['redaction'] as $destinataire) {
			$message->addTo($destinataire);
		}
	    $this->get('mailer')->send($message);

	    //Recalcul de la popularité d'auteur
		$points = $this->container->getParameter('action_points');
		$_TDNDocument->getLnAuteur()->updatePopularite($points['article_redaction']);


*/
		return $this->redirect($this->generateURL('Video_index'));
	}

}
