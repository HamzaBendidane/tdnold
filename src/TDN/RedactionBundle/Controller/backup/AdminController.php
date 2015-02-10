<?php

namespace TDN\RedactionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TDN\RedactionBundle\Entity\Article;
use TDN\RedactionBundle\Form\Type\ArticleNewType;
use TDN\RedactionBundle\Form\Type\ArticleReviewType;

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

use TDN\CoreBundle\Entity\Journal;

use TDN\ImageBundle\Entity\Image;

class AdminController extends DocumentController {
	
	private $etat = array ('ARTICLE_BROUILLON', 'ARTICLE_PUBLIE', 'ARTICLE_ARCHIVE', 'ARTICLE_FEUILLET');
	protected $_tplVars = array(
		'selectList' => array(
			array('value' => 'titre', 'texte' => 'Titre'),
			array('value' => 'lnAuteur', 'texte' => 'Auteur'),
			// array('value' => 'rubriques', 'texte' => 'Rubrique')
			),
		'colonnesList' => array('Titre', 'Statut', 'Auteur', 'Publié le')
		);

	protected function resetProperties ($document)
	{
		$document->setLikes(0);
		$document->setHits(0);
		$document->setVersion(1);
		// $document->setDatePublication(new \DateTime);
		$document->setDateModification(new \DateTime);
		$document->setCommentThread(new \Doctrine\Common\Collections\ArrayCollection());
	}

	public function articleIndexAction () {
		
		$this->_tplVars['titrePage'] = "Index des articles";
		$this->_tplVars['referer'] = "RedactionBundle_articleIndex";
		$this->_tplVars['actionsList'] = array(
			'Statut' => array(
				'action' => array(
					'ARTICLE_PUBLIE' => 'Retirer',
					'ARTICLE_BROUILLON' => 'Publier',
					'ARTICLE_ARCHIVE' => 'Restaurer',
					'ARTICLE_FEUILLET' => ''),
				'controleur' => 'Redaction_articlePublier'
				),
			'Supprimer' => array(
				'action' => 'Supprimer',
				'controleur' => 'Redaction_articleSupprimer',
				'class' => 'deleteConfirm',
				'role' => 'ROLE_ADMIN'
				)
			);

		$em = $this->get('doctrine.orm.entity_manager');
		$rep = $em->getRepository('TDN\RedactionBundle\Entity\Article');
		$rep_nana = $em->getRepository('TDN\NanaBundle\Entity\Nana');
		$rep_rubrique = $em->getRepository('TDN\DocumentBundle\Entity\DocumentRubrique');
		$usr= $this->get('security.context')->getToken()->getUser();
		$longueurPage = 100;

		$request = $this->get('request');
		if ($request->isMethod('POST')) {
			$tri = array('idDocument' => 'DESC');
			$limite = 100;
			$constantes = array();
			$this->documentSelectionQuery($rep, $constantes, $tri, $limite);			
		} elseif ($request->isMethod('GET')) {
			$page = $request->query->get('page');
			if (empty($page) || ($page == 0)) $page = 1;
			$this->_tplVars['isSelectedField'] = "";
			$this->_tplVars['isSelectedValeur'] = "";
			$this->_tplVars['page'] = $page;
			$this->_tplVars['documentListe'] = $rep->findPage($page, $longueurPage, $usr->getIdNana());
		} else {
			$this->_tplVars['isSelectedField'] = "";
			$this->_tplVars['isSelectedValeur'] = "";
			$this->_tplVars['articlesList'] = $rep->findBy(array('lnAuteur' => $usr->getIdNana()));
		}

		return $this->render('RedactionBundle:Admin:articleContentListe.html.twig', $this->_tplVars);
	}
	
	public function articleBrouillonsAction () {
		
		$em = $this->get('doctrine.orm.entity_manager');
		$rep = $em->getRepository('TDN\RedactionBundle\Entity\Article');
		$usr= $this->get('security.context')->getToken()->getUser();
		$request = $this->get('request');

		$variables['colonnesList'] = array('Titre', 'Auteur');
		$variables['actionsList'] = array(
			'(Dé)Publier' => array(
				'action' => array('ARTICLE_BROUILLON' => 'Publier', 'ARTICLE_PUBLIE' => 'Masquer'),
				'property' => 'statut',
				'controleur' => 'Redaction_articlePublier'
				),
			'Supprimer' => array(
				'action' => 'Supprimer',
				'controleur' => 'Redaction_articleSupprimer'));

		// $where = array('lnAuteur' => $usr->getIdNana());
		$where = array('lnAuteur' => $usr->getIdNana());
		$where['statut'] = 'ARTICLE_BROUILLON';
		$variables['articlesList'] = $rep->findBy($where);

		return $this->render('RedactionBundle:Admin:articleBrouillons.html.twig', $variables);
	}
	
	public function articleAddAction () {
		$request = $this->get('request');

	    // Récupération de l'entity manager qui va nous permettre de gérer les entités.
	    $em = $this->get('doctrine.orm.entity_manager');      
		// Instanciation du formulaire
		$_TDNDocument = new Article;
		$_TDNDocument->setDatePublication(new \DateTime);
		$form = $this->createForm(new ArticleNewType, $_TDNDocument);
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

				$_TDNDocument->setLnAuteur($usr);
				$slug = $_TDNDocument->makeSlug();
				$this->resetProperties($_TDNDocument);
				$statut = $_TDNDocument->getStatut();
				if (is_null($statut) || ($statut == '')) {
					$_TDNDocument->setStatut('ARTICLE_BROUILLON');
				}

				// Modification de l'illustration de la question
				$reuse = (integer)$request->get('reuseIllustration');
				if ($reuse !== 0) {
					$_TDNDocument->setLnIllustration($this->reuseImageIllustration($reuse));
				} else {
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
					$slider->setDatePublication($_TDNDocument->getDatePublication());
					if (is_null($slider->getStatut())) {
						$slider->setStatut(0);
					}
					$em->persist($slider);
		           // Post-traitement de l'image
		            $imageProcessor = $this->get('tdn.image_processor');
		            if ($slider->getLnCover() instanceof Image) {
		            	$imageCover = $slider->getLnCover();
			            $fichierImage = $slider->getLnCover()->getFichier();
						$_m = $imageCover->getDatePublication()->format('m');
						$_y = $imageCover->getDatePublication()->format('Y');
						$dossierSlider = '/public/'.$_y.'/'.$_m.'/';
			            $source = $this->container->getParameter('media_root').$dossierSlider.$fichierImage;
			            $err = $imageProcessor->downScale($source, 600, 'height');		            	
		            }
				}

				// Gestion du rubriquage des contenus
				$formThematiques->bindRequest($request);
				$_TDNDocument->assigneRubriques($themes);

				// Traitement des mots-clefs
				$formIndex->bindRequest($request);
				$semTagger = $this->get('tdn.tag.manager');
				$tags = $semTagger->tag($_TDNDocument, $indexCollection->getIndex());

				$errNoRubrique = false;
				$errNoImage = false;
				$listeRubriques = $_TDNDocument->getLnThematique();
				$_hasNoRubriques = !($listeRubriques instanceof DocumentRubrique);
				if (($_TDNDocument->getStatut() == 'ARTICLE_PUBLIE') && $_hasNoRubriques) {
					$_TDNDocument->setStatut('ARTICLE_BROUILLON');
					$errNoRubrique = true;
				}
				$illustration = $_TDNDocument->getLnIllustration();
				$_hasNoIllustration = is_null($illustration);
				if (($_TDNDocument->getStatut() == 'ARTICLE_PUBLIE') && $_hasNoIllustration) {
					$_TDNDocument->setStatut('ARTICLE_BROUILLON');
					$errNoImage = true;
				}

				$em->persist($_TDNDocument);
				$em->flush();

				// Notification
				$message = \Swift_Message::newInstance();
				$corps['expediteur'] = "Administrateur";
				$corps['role'] = "Système";
				$corps['destinataire'] = "Justine";
				$corps['dateEnvoi'] = date(' d m Y - H:i:s');
				$corps['pseudo'] = $usr->getUsername();
				$corps['titre'] = $_TDNDocument->getTitre();

				$message->setSubject('[TDN] Nouvel article ('.$_TDNDocument->getVersion().')')
						->setContentType('text/html')
	        			->setFrom('postmaster@trucdenana.com')
	        			->addTo($this->container->getParameter('mail_moderation_1'))
	        			->addTo($this->container->getParameter('mail_moderation_2'))
	        			->setBody(
	            			$this->renderView('RedactionBundle:Mail:nouvelArticle.html.twig', $corps),
	            			'text/html'
	            		);
			    $this->get('mailer')->send($message);

				if ($errNoRubrique) {
					$this->get('session')->getFlashBag()->add('warning', 'L’article a été créé mais n’a pu être publié car il n’est associé à aucune rubrique');
				} elseif ($errNoImage) {
					$this->get('session')->getFlashBag()->add('warning', 'L’article a été créé mais n’a pu être publié car il n’a pas de vignette');
				} elseif ($_TDNDocument->getStatut() == 'DOSSIER_PUBLIE') {
					$this->get('session')->getFlashBag()->add('success', 'Cet article est désormais accessible surle site.');
				} else {
					$this->get('session')->getFlashBag()->add('success', 'L’article a été créé en mode <strong>brouillon</strong>.');
				}
				return $this->redirect($this->generateURL('RedactionBundle_articleIndex'));
			}
		}

		$variables['titreDetail'] = "Nouvel article de la Rédaction";
		$variables['formCallback'] = "RedactionBundle_articleAdd";
		
		return $this->render('RedactionBundle:Admin:articleAdd.html.twig', $variables);//array('form' => $form->createView())
	}

	public function articleModifierAction ($id) {
		
		$routeur = $this->get('tdn.document.url');
	    $em = $this->get('doctrine.orm.entity_manager');      

		// Instanciation du formulaire
		$repository = $em->getRepository('TDN\RedactionBundle\Entity\Article');
		$_TDNDocument = $repository->find($id);
		$route = $routeur->canonicalURL($_TDNDocument);
		$_backup = clone $_TDNDocument;
		$form = $this->createForm(new ArticleReviewType, $_TDNDocument);
		$variables['form'] = $form->createView();

		// Récupération des sources des textes pour léditeur Aloha
		$variables['sourceAbstract'] = $_TDNDocument->getAbstract();
		$variables['sourceArticle'] = $_TDNDocument->getCorps();
		$isPromu = $_TDNDocument->getLnPromu();
		if (!empty($isPromu)) $variables['isChecked'] = "checked";

		$_ill = $_TDNDocument->getLnIllustration();
		if ($_ill instanceof Image) {
			$_an = $_TDNDocument->getLnIllustration()->getDatePublication()->format('Y');	
			$_mois = $_TDNDocument->getLnIllustration()->getDatePublication()->format('m');	
			$variables['pathIllustration'] = '/'.$this->container->getParameter('media_root')."public/$_an/$_mois/".$_TDNDocument->getLnIllustration()->getFichier();
		}

		// Instanciation du formulaire des rubriques
		$themes = new ThematiqueCollection;
		$principale = $_TDNDocument->getLnThematique();
		if ($principale instanceof DocumentRubrique) {
			$_theme = new Thematique;
			$_theme->setRubrique($principale);
			$themes->addRubrique($_theme);
		}
		$rubriques = $_TDNDocument->getRubriques();
		foreach ($rubriques as $r) {
			$_theme = new Thematique;
			$_theme->setRubrique($r);
			$themes->addRubrique($_theme);
		}
		$formThematiques = $this->createForm(new ThematiqueCollectionType, $themes);
		$variables['formThematiques'] = $formThematiques->createView();

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
		$variables['formSlider'] = $formSlider->createView();

		$request = $this->get('request');

		if ($request->getMethod() === 'POST') {
			$form->bindRequest($request);
			if ($form->isValid()) {
		        $imageProcessor = $this->get('tdn.image_processor');
				$now = new \DateTime;
				$_auteur = $_TDNDocument->getLnAuteur();
				$usr= $this->get('security.context')->getToken()->getUser();				

				$slug = $_TDNDocument->makeSlug();
				$_TDNDocument->setDateModification(new \DateTime);
				$_TDNDocument->setVersion($_TDNDocument->getVersion() + 1);

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
						$slider->setDatePublication($_TDNDocument->getDatePublication());
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
				$_TDNDocument->updateRubriques($themes);
				// print_r($bufferRubriques);
				// print_r(count($bufferRubriques)); die;

				$errNoRubrique = false;
				$errNoImage = false;
				$listeRubriques = $_TDNDocument->getLnThematique();
				$_hasNoRubriques = is_null($listeRubriques);
				if (($_TDNDocument->getStatut() == 'ARTICLE_PUBLIE') && $_hasNoRubriques) {
					$_TDNDocument->setStatut('ARTICLE_BROUILLON');
					$errNoRubrique = true;
				}
				$illustration = $_TDNDocument->getLnIllustration();
				$_hasNoIllustration = is_null($illustration);
				if (($_TDNDocument->getStatut() == 'ARTICLE_PUBLIE') && $_hasNoIllustration) {
					$_TDNDocument->setStatut('ARTICLE_BROUILLON');
					$errNoImage = true;
				}

				// Post-traitement
				// Slider
				if ($hasNewCover) {
		           //Post-traitement de l'image
		            $imageProcessor = $this->get('tdn.image_processor');
		            $fichierImage = $imageCover->getFichier();
			        $source = $this->container->getParameter('media_root').$dossierSlider.$fichierImage;
			        $err = $imageProcessor->downScale($source, 600, 'width', 'slider_');
				}

				// Traitement des mots-clefs
				$formIndex->bindRequest($request);
				$semTagger = $this->get('tdn.tag.manager');
				$tags = $semTagger->tagsUpdate($_TDNDocument, $indexCollection->getIndex());

				$_isJustPublished = ($_backup->getStatut() == 'ARTICLE_BROUILLON') && ($_TDNDocument->getStatut() == 'ARTICLE_PUBLIE');

			    if ($_isJustPublished) {
			    	$this->processPublication($_TDNDocument, $_auteur);
			    }

				$em->flush();

				if ($errNoRubrique) {
					$_warningType = 'warning';
					$_warning = 'Les modifications ont bien été enregistées, mais l’article n’a pu être publié car il n’est associé à aucune rubrique';
				} elseif ($errNoImage) {
					$_warningType = 'warning';
					$_warning = 'Les modifications ont bien été enregistées, mais l’article n’a pu être publié car il n’a pas de vignette';
				} elseif ($_isJustPublished) {
					$_warningType = 'success';
					$_warning = 'Cet article est désormais accessible surle site.';
				} else {
					$_warningType = 'success';
					$_warning = 'L’article a été mis à jour.';
				}

				$_auteur = $_TDNDocument->getLnAuteur();
				$usr= $this->get('security.context')->getToken()->getUser();

				// Notification
				$message = \Swift_Message::newInstance();
				$corps['expediteur'] = "Administrateur";
				$corps['role'] = "Système";
				$corps['destinataire'] = "Justine";
				$corps['dateEnvoi'] = date(' d m Y - H:i:s');
				$corps['pseudo'] = $usr->getPrenom().' '.$usr->getNom();
				$corps['titre'] = $_TDNDocument->getTitre();
				$corps['auteur'] = $_auteur->getPrenom().' '.$_auteur->getNom();
				$corps['statut'] = $_TDNDocument->getStatut();
				$corps['msgStatut'] = $_warning;

				$message->setSubject('[TDN] Modification d’un article')
						->setContentType('text/html')
	        			->setFrom('postmaster@trucdenana.com')
	        			->addTo($this->container->getParameter('mail_moderation_1'))
	        			->addTo($this->container->getParameter('mail_moderation_2'))
	        			->addTo($_auteur->getEmail())
	        			->setBody(
	            			$this->renderView('RedactionBundle:Mail:modificationArticle.html.twig', $corps),
	            			'text/html'
	            		);
			    $this->get('mailer')->send($message);

				$this->get('session')->getFlashBag()->add($_warningType, $_warning);
				return $this->redirect($this->generateURL('RedactionBundle_articleIndex'));
			}
		}

		$variables['titreDetail'] = "Modification d’un article";
		$variables['formCallback'] = "RedactionBundle_articleModifier";
		$variables['TDNDoc_id'] = $id;
		
		return $this->render('RedactionBundle:Admin:articleAdd.html.twig', $variables);//array('form' => $form->createView())
	}

	function publierAction ($id) {

		$em = $this->get('doctrine.orm.entity_manager');
		$rep = $em->getRepository('TDN\DocumentBundle\Entity\Article');
		$rep_nana = $em->getRepository('TDN\NanaBundle\Entity\Nana');
		$_TDNDocument = $rep->find($id);

		$listeRubriques = $_TDNDocument->getLnThematique();
		$_hasNoRubriques = is_null($listeRubriques);
		$illustration = $_TDNDocument->getLnIllustration();
		$_hasNoIllustration = is_null($illustration);
		if ($_hasNoRubriques) {
			$_warningType = 'warning';
			$_warning = 'Les modifications ont bien été enregistées, mais l’article n’a pu être publié car il n’est associé à aucune rubrique';
		} elseif ($_hasNoIllustration) {
			$_warningType = 'warning';
			$_warning = 'Les modifications ont bien été enregistées, mais l’article n’a pu être publié car il n’a pas de vignette';
		} else {
			$_TDNDocument->setStatut("ARTICLE_PUBLIE");
			$this->processPublication($_TDNDocument);
			$em->flush();
			$_warningType = 'success';
			$_warning = 'Cet article est désormais accessible surle site.';
		}
		$this->get('session')->getFlashBag()->add($_warningType, $_warning);	


		return $this->redirect($this->generateURL('Video_index'));
	}

	public function supprimerAction ($id) {

		$request = $this->get('request');
	    $em = $this->get('doctrine.orm.entity_manager');      
		$repository = $em->getRepository('TDN\RedactionBundle\Entity\Article');
		$_TDNDocument = $repository->find($id);
		$this->deleteRecord($_TDNDocument);
		return $this->redirect($this->generateURL('RedactionBundle_articleIndex'));
	}

	protected function processPublication ($_TDNDocument) {

	    $em = $this->get('doctrine.orm.entity_manager');      
		$rep_nana = $em->getRepository('TDN\NanaBundle\Entity\Nana');

		$_TDNDocument->setDatePublication(new \DateTime);

		$_auteur = $_TDNDocument->getLnAuteur();
		$followers = $_TDNDocument->getLnAuteur()->getIsFollowed();
		$followers->add($_auteur);
		$superAdmin = $rep_nana->find(1);
		$followers->add($superAdmin);
		$_r = $_TDNDocument->getLnThematique();
		print_r($_auteur->getUsername());

		$url = $this->generateURL('RedactionBundle_article', array(
				'id' => $_TDNDocument->getIdDocument(), 
				'slug' => $_TDNDocument->getSlug(), 
				'rubrique' => $_r->getSlug()));

		// Envoi d'un message aux followers de l'auteur de l'artcle
		foreach ($followers as $f) {
			$message = \Swift_Message::newInstance();
			$corps['expediteur'] = "Justine";
			$corps['role'] = "rédaction TDN";
			$corps['destinataire'] = $f->getPrenom();
			$corps['dateEnvoi'] = date(' d m Y - H:i:s');
			$corps['pseudo'] = $f->getUsername();
			$corps['auteur'] = $_auteur->getPrenom().' '.$_auteur->getNom();
			$corps['titre'] = $_TDNDocument->getTitre();
			$corps['url'] = $url;

			$message->setSubject('[TDN] Publication d’un nouvel article sur TDN')
					->setContentType('text/html')
	    			->setFrom('postmaster@trucdenana.com')
	    			->addTo($f->getEmail())
	    			->setBody(
	        			$this->renderView('RedactionBundle:Mail:publicationArticle.html.twig', $corps),
	        			'text/html'
	        		);
		    $this->get('mailer')->send($message);
		}

		// Signaler dans le journal
		$entree = new Journal;
		$entree->setLnActeur($_auteur);
		$entree->setAction('PUBLICATION');
		$entree->setURL($url);
		$entree->setTexte('a écrit un article');
		$entree->setTitre($_TDNDocument->getTitre());
		$entree->setSupport('');
		$entree->setLnRubrique($_r);
		$entree->setDateEntree($_TDNDocument->getDatePublication());
		$em->persist($entree);

	    //Recalcul de la popularité d'auteur
		$points = $this->container->getParameter('action_points');
		$_TDNDocument->getLnAuteur()->updatePopularite($points['article_redaction']);			
	}
}