<?php

namespace TDN\DossierRedactionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TDN\DossierRedactionBundle\Entity\Dossier;
use TDN\DossierRedactionBundle\Form\Type\DossierRedactionNewType;
use TDN\DossierRedactionBundle\Form\Type\DossierRedactionReviewType;

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

class AdminDossierController extends DocumentController {
	
	private $etat = array ('DOSSIER_BROUILLON', 'DOSSIER_PUBLIE', 'DOSSIER_ARCHIVE');
	protected $_tplVars = array(
		'selectList' => array(
			array('value' => 'titre', 'texte' => 'Titre'),
			array('value' => 'lnAuteur', 'texte' => 'Auteur'),
			// array('value' => 'rubriques', 'texte' => 'Rubrique')
			),
		'colonnesList' => array('Titre', 'Statut', 'Auteur', 'Publié le')
		);

	public function indexAction () {
		
		$this->_tplVars['titrePage'] = "Index des dossiers de la rédaction";
		$this->_tplVars['referer'] = "DossierRedaction_index";
		$this->_tplVars['actionsList'] = array(
			'Publier' => array(
				'action' => array(
					'DOSSIER_PUBLIE' => 'Retirer',
					'DOSSIER_BROUILLON' => 'Publier',
					'DOSSIER_ARCHIVE' => 'Restaurer'),
				'controleur' => 'DossierRedaction_publier'
				),
			'Supprimer' => array(
				'action' => 'Supprimer',
				'controleur' => 'DossierRedaction_supprimer',
				'class' => 'deleteConfirm',
				'role' => 'ROLE_ADMIN'
				)
			);

		$em = $this->get('doctrine.orm.entity_manager');
		$rep = $em->getRepository('TDN\DossierRedactionBundle\Entity\Dossier');
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
			$this->_tplVars['documentListe'] = $rep->findPage($page, $longueurPage, 3);
		} else {
			$this->_tplVars['isSelectedField'] = "";
			$this->_tplVars['isSelectedValeur'] = "";
			$this->_tplVars['articlesList'] = $rep->findBy(array('lnAuteur' => $usr->getIdNana()));
		}

		return $this->render('DossierRedactionBundle:Admin:dossierRedactionContentListe.html.twig', $this->_tplVars);
	}

	public function creerAction () {
		
		$request = $this->get('request');
	    $em = $this->get('doctrine.orm.entity_manager');      

		// Instanciation du formulaire
		$_TDNDocument = new Dossier;
		$_TDNDocument->setDatePublication(new \DateTime);
		$form = $this->createForm(new DossierRedactionNewType, $_TDNDocument);

		// Instanciation du formulaire des rubriques
		$themes = new ThematiqueCollection;
		$formThematiques = $this->createForm(new ThematiqueCollectionType, $themes);

		// Instanciation du formulaire du Slider
		$slider = new Slider;
		$formSlider = $this->createForm(new SlideType, $slider);

		// Indexation du document
		$indexCollection = new IndexCollection;
		$formIndex = $this->createForm(new IndexCollectionType, $indexCollection);
		$variables['formIndex'] = $formIndex->createView();

		if ($request->getMethod() === 'POST') {
			$form->bindRequest($request);
			if ($form->isValid()) {
				// Identification de l'utilisateur connecté
				$usr= $this->get('security.context')->getToken()->getUser();

				// Validation des données d'entrée

				// Valeurs par défaut
				$_TDNDocument->setLnAuteur($usr);
				$slug = $_TDNDocument->makeSlug();
				$this->resetProperties($_TDNDocument);
				$statut = $_TDNDocument->getStatut();
				if (is_null($statut) || ($statut == '')) {
					$_TDNDocument->setStatut('DOSSIER_BROUILLON');
				}

				// Image d'illustration
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
				$corps['pseudo'] = $usr->getUsername();
				$corps['titre'] = $_TDNDocument->getTitre();

				$message->setSubject('[TDN] Nouveau dossier de la rédaction')
						->setContentType('text/html')
	        			->setFrom($expediteurs['admin'])
	        			->setBody(
	            			$this->renderView('DossierRedactionBundle:Mail:nouveauDossierRedaction.html.twig', $corps),
	            			'text/html'
	            		);
				foreach($admins['redaction'] as $destinataire) {
					$message->addTo($destinataire);
				}
			    $this->get('mailer')->send($message);

				return $this->redirect($this->generateURL('DossierRedaction_index'));
			}
		}

		$variables['formThematiques'] = $formThematiques->createView();
		$variables['formSlider'] = $formSlider->createView();
		$variables['form'] = $form->createView();
		$variables['titreDetail'] = "Nouveau dossier de la rédaction";
		$variables['formCallback'] = "DossierRedaction_creer";
		
		return $this->render('DossierRedactionBundle:Admin:DossierRedaction_detail.html.twig', $variables);//array('form' => $form->createView())
	}

	public function reviserAction ($id) {

		$request = $this->get('request');
	    $em = $this->get('doctrine.orm.entity_manager');      

		// Instanciation du formulaire
		$repository = $em->getRepository('TDN\DossierRedactionBundle\Entity\Dossier');
		$_backup = $repository->find($id);
		$_TDNDocument = $repository->find($id);
		$form = $this->createForm(new DossierRedactionReviewType, $_TDNDocument);

		// Récupération des sources des textes pour l'éditeur Aloha
		$variables['sourceAbstract'] = $_TDNDocument->getAbstract();

		$_ill = $_TDNDocument->getLnIllustration();
		if ($_ill instanceof Image) {
			$_an = $_TDNDocument->getLnIllustration()->getDatePublication()->format('Y');	
			$_mois = $_TDNDocument->getLnIllustration()->getDatePublication()->format('m');	
			$variables['pathIllustration'] = '/'.$this->container->getParameter('media_root')."public/$_an/$_mois/".$_TDNDocument->getLnIllustration()->getFichier();
		}

		// Instanciation du formulaire des rubriques
		$themes = new ThematiqueCollection;
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
			$variables['isChecked'] = "checked";
		} else {
			$slider = new Slider();
			$exSlider = false;
		}
		$formSlider = $this->createForm(new SlideType, $slider);

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

				// Illustration
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

				// Slider
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
				$listeRubriques = $themes->getRubriques();
				$_TDNDocument->assignRubriques($listeRubriques);

				// Traitement des mots-clefs
				$formIndex->bindRequest($request);
				$semTagger = $this->get('tdn.tag.manager');
				$tags = $semTagger->tagsUpdate($_TDNDocument, $indexCollection->getIndex());

				// Conditions de publication du dossier
				$errNoRubrique = false;
				$errNoImage = false;
				$listeRubriques = $_TDNDocument->getRubriques();
				$_hasNoRubriques = is_null($listeRubriques);
				if (($_TDNDocument->getStatut() == 'DOSSIER_PUBLIE') && $_hasNoRubriques) {
					$_TDNDocument->setStatut('DOSSIER_BROUILLON');
					$errNoRubrique = true;
				}
				$illustration = $_TDNDocument->getLnIllustration();
				$_hasNoIllustration = is_null($illustration);
				if (($_TDNDocument->getStatut() == 'DOSSIER_PUBLIE') && $_hasNoIllustration) {
					$_TDNDocument->setStatut('DOSSIER_BROUILLON');
					$errNoImage = true;
				}

				$em->flush();

				// Post-traitement
				// Slider
				if ($hasNewCover) {
		           //Post-traitement de l'image
		            $imageProcessor = $this->get('tdn.image_processor');
		            $fichierImage = $imageCover->getFichier();
			        $source = $this->container->getParameter('media_root').$dossierSlider.$fichierImage;
			        $err = $imageProcessor->downScale($source, 600, 'width', 'slider_');
				}

				if ($errNoRubrique) {
					$this->get('session')->getFlashBag()->add('warning', 'Les modifications ont bien été enregistées, mais le dossier n’a pu être publié car il n’est associé à aucune rubrique');
				} elseif ($errNoImage) {
					$this->get('session')->getFlashBag()->add('warning', 'Les modifications ont bien été enregistées, mais le dossier n’a pu être publié car il n’a pas de vignette');
				} elseif ($_TDNDocument->getStatut() == 'DOSSIER_PUBLIE') {
					$this->get('session')->getFlashBag()->add('success', 'Ce dossier est désormais accessible surle site.');
				} else {
					$this->get('session')->getFlashBag()->add('success', 'Le dossier a été mis à jour.');
				}
				return $this->redirect($this->generateURL('DossierRedaction_index'));
			}
		}

		$variables['form'] = $form->createView();
		$variables['formThematiques'] = $formThematiques->createView();
		$variables['formSlider'] = $formSlider->createView();
		$variables['titreDetail'] = "Révision de dossier";
		$variables['formCallback'] = "DossierRedaction_relire";
		$variables['TDNDoc_id'] = $id;
		
		return $this->render('DossierRedactionBundle:Admin:DossierRedaction_detail.html.twig', $variables);

	}
}
