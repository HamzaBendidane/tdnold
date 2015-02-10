<?php

namespace TDN\VideoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use TDN\VideoBundle\Form\Type\VideoType;
use TDN\VideoBundle\Entity\Video;

use TDN\DocumentBundle\Entity\DocumentRubrique;
use TDN\DocumentBundle\Entity\DocumentType;
use TDN\DocumentBundle\Entity\DocumentRubriqueRepository;



class PublicationController extends Controller {
	
	public function videoProposerAction () {

		$request = $this->get('request');

		$variables['rubrique'] = 'tdn';

		$em = $this->get('doctrine.orm.entity_manager');

		// Instanciation du formulaire
		$_TDNDocument = new Video;
		$form = $this->createForm(new VideoType, $_TDNDocument);
		$variables['form'] = $form->createView();
		if ($request->getMethod() == "POST") {
			$form->bind($request);
			if ($form->isValid()) {
				$url = $_TDNDocument->getIdVideo();
				$_importable = false;
				$valideURLData = $_TDNDocument->parseHebergeurURL($url);
				if (!$valideURLData) {
						$this->get('session')
							 ->getFlashBag()
							 ->add('fail', 'L’URL de la video n’est pas valide');
							 $_importable = $_importable || false;
				} else {
					$domaine = array($valideURLData[2]);
					$_kwown = array_intersect($domaine, array('youtube', 'dailymotion', 'vimeo'));
					if (empty ($_kwown)) {
						$_TDNDocument->setIdVideo(NULL);
						$_code = $_TDNDocument->getCodeIntegration();
						if (!empty($_code)) {
							$_importable = true;
						} else {
							$_importable = false;
							$this->get('session')
								 ->getFlashBag()
								 ->add('fail', 'Tu dois donner soit une URL valide, soit un code d’intégration.');
						}
					} else {
						$idVideo = $_TDNDocument->getIdVideo();
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
					}
				}
				if ($_importable) {
					$usr= $this->get('security.context')->getToken()->getUser();
					// print_r($usr); die;		
					// $_TDNDocument->setTitre($OriginalTitle);
					$_TDNDocument->setSlug('');
					$_TDNDocument->setLnAuteur($usr);
					$_TDNDocument->setLikes(0);
					$_TDNDocument->setHits(0);
					$_TDNDocument->setParams("{}");
					$_TDNDocument->setTags("");
					$_TDNDocument->setCommentThread(new \Doctrine\Common\Collections\ArrayCollection());
					$_TDNDocument->setDatePublication(new \DateTime);
					$_TDNDocument->setDateModification($_TDNDocument->getDatePublication());
					$_TDNDocument->setVersion("1.0");

					$_TDNDocument->setStatut('VIDEO_PROPOSEE');
					if ($this->get('security.context')->isGranted('ROLE_JOUNALISTE')) {
						$this->get('session')->getFlashBag()->add('success', 'Cette vidéo est enregistrée et a le statut de brouillon');
					} else {
		 				$this->get('session')->getFlashBag()->add('success', 'Merci d’avoir proposé cette vidéo. La rédaction va la valider au plus vite');
					}

					$em->persist($_TDNDocument);
					$em->flush();

					// Notification
				$admins = $this->container->getParameter('admin_notifications');
				$expediteurs = $this->container->getParameter('mail_expediteur');				
					$message = \Swift_Message::newInstance();
					$corps['expediteur'] = "Justine";
					$corps['role'] = "Rédaction";
					$corps['destinataire'] = "Justine";
					$corps['dateEnvoi'] = date(' d m Y - H:i:s');
					// Spécifiques
					$corps['pseudo'] = $usr->getUsername();
					$corps['titre'] = $_TDNDocument->getTitre();
					if (!empty($url)) { $corps['url'] = $url; }

					$message->setSubject('[TDN] '.$usr->getEmail().' propose une vidéo' )
							->setContentType('text/html')
		        			->setFrom($usr->getEmail())
		        			->addTo($usr->getEmail())
		        			->setBody(
		            			$this->renderView('VideoBundle:Mail:propositionVideo.html.twig', $corps),
		            			'text/html'
		            		);
					foreach($admins['redaction'] as $destinataire) {
						$message->addTo($destinataire);
					}
				    $this->get('mailer')->send($message);

					return $this->redirect($this->generateURL('VideoBundle_sommaire'));									
				} else {
					return $this->render('VideoBundle:Page:videoProposition.html.twig', $variables);
				}
			} else {
				return $this->generateURL('VideoBundle_sommaire');									
			}
		}

		return $this->render('VideoBundle:Page:videoProposition.html.twig', $variables);
	}

	public function videoSommaireAction ($rubrique = '') {

		$longueurPage = 42;
		$session = $this->get('session');
		$request = $this->get('request');

		if (empty($rubrique)) {
			$rubrique = $request->query->get('rubrique');
		}
	    // print_r($rubrique); die;
		$page = $request->query->get('page');
		if (!empty($rubrique)) {
			$session->set('tri-video', $rubrique);
		} else {
			if (!empty($page)) {
				$rubrique = $session->get('tri-video');
			} else {
				$rubrique = $session->remove('tri-video');
				$rubrique = 'tdn';
			}
			
		}
		$page = ((int)$page === 0) ? 0 : (int)$page - 1;

	    // Récupération de l'entity manager qui va nous permettre de gérer les entités.
	    $em = $this->get('doctrine.orm.entity_manager');      
		$rep = $em->getRepository('TDN\VideoBundle\Entity\Video');
	    // $listeVideos = $rep->findWithin($longueurPage);
	    if ($rubrique == 'tdn' || empty($rubrique)) {
	    	$variables['listeVideos'] = $rep->findBy(array('statut' => 'VIDEO_PUBLIEE'), array('idDocument' => 'DESC'), $longueurPage, 1+$page*($longueurPage-1));
		    $variables['totalVideos'] = $rep->count();
	    } else {
	    	$variables['listeVideos'] = $rep->findByRubrique($rubrique, $longueurPage, $page);
		    $variables['totalVideos'] = $rep->count($rubrique);
	    }

		$rep = $em->getRepository('TDN\DocumentBundle\Entity\DocumentRubrique');
		$variables['rubriques'] = $rep->findBy(array('parent' => NULL));
		$_objRubrique = $rep->findOneBySlug($rubrique);
		
		$largeurSegment = 4;
		$variables['rubrique'] = $rubrique;
		$variables['nomRubrique'] = ($_objRubrique instanceof DocumentRubrique) ? $_objRubrique->getTitre() : 'Toutes';

		$variables['page'] = $page + 1;
		$variables['derniere'] = ceil($variables['totalVideos'] / $longueurPage);

		// Affichage de la page
		return $this->render('VideoBundle:Page:videoSommaire.html.twig', $variables);
	}


	public function videoAction ($rubrique, $slug, $id) {
	/* Tableau qui va stocker toutes les données à remplacer dans le template twig */
	    $variables = array();  
	    // Récupération de l'entity manager qui va nous permettre de gérer les entités.
	    $em = $this->get('doctrine.orm.entity_manager');      
		// Instanciation du Repository
		$rep_video = $em->getRepository('TDN\VideoBundle\Entity\Video');
		$video = $rep_video->find($id);
		$rep_commentaires = $em->getRepository('TDN\CommentaireBundle\Entity\Commentaire');
		$variables['commentaires'] = $rep_commentaires->findByFilDocument($id);
		
		$hebergeur = $video->getIdHebergeur();
		switch ($hebergeur) {
			case 'dailymotion':
			case '2':
				$params = $video->getParams();
				$params = json_decode($params);
				$variables['codeIntegration'] = $video->getCodeIntegration();
				$variables['codeIntegration'] = str_replace('480', '360', $variables['codeIntegration']);
				$variables['codeIntegration'] = str_replace('360', '203', $variables['codeIntegration']);
				$minutes = floor($video->getDuree()/60);
				$secondes = $video->getDuree() - ($minutes * 60);
				$variables['duree'] = $minutes."' ".$secondes."\"";
				break;
			case 'vimeo':
			case '1':
				$ID = $video->getIdVideo();
				$variables['codeIntegration'] = "<iframe src='http://player.vimeo.com/video/$ID' width='360' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>";
				break;
			case 'youtube':
			case '0':
				$ID = $video->getIdVideo();
				$variables['codeIntegration'] = "<iframe width='360' height='270' src='https://www.youtube.com/embed/$ID?rel=0' frameborder='0' allowfullscreen></iframe>";
				break;
			default:
				$variables['codeIntegration'] = stripslashes($video->getCodeIntegration());
		}

		$video->updateHits();
		$em->flush();

		$_rubriques = $video->getRubriques();
		$variables['rubriqueEntity'] = $_rubriques[0];
		$variables['canonical'] = $this->generateURL('VideoBundle_video', 
			array('id' => $video->getIdDocument(),
				  'slug' => $video->getSlug(),
				  'rubrique' => $_rubriques[0]->getSlug())
			);
		$variables['meta_description'] = strip_tags($video->getAbstract());
		$variables['rubrique'] = $rubrique;
		$variables['video'] = $video;
		
	    $variables['paths'] = array(
	    	'Article' => 'RedactionBundle_article',
	    	'ConseilExpert' => 'ConseilExpert_conseil',
	    	'Question' => 'CauseuseBundle_conversation',
	    	'Video' => 'VideoBundle_video',
	    	'Dossier' => 'DossierRedaction_dossier'
	    	);

		// Documents proches (pour aller plus loin)
	    $rep_tags = $em->getRepository('TDN\DocumentBundle\Entity\Tag');
	    $sims = $rep_tags->findSimilars($id);

	    $rep_docs = $em->getRepository('TDN\DocumentBundle\Entity\Document');
	    $variables['similaires'] = array();
	    foreach($sims as $s) {
	    	$variables['similaires'][] = $rep_docs->find($s['id']);
	    }

		// Affichage de la page
		return $this->render('VideoBundle:Page:video.html.twig', $variables);
	}
}
