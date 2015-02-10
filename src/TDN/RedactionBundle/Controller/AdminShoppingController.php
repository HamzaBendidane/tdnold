<?php

namespace TDN\RedactionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TDN\RedactionBundle\Entity\SelectionShopping;
use TDN\RedactionBundle\Form\Type\SelectionShoppingNewType;
use TDN\RedactionBundle\Form\Type\SelectionShoppingReviewType;

use TDN\DocumentBundle\Controller\AdminController as DocumentController;
use TDN\DocumentBundle\Entity\DocumentRubrique;
use TDN\DocumentBundle\Form\Type\selecteurRubriquesType;
use TDN\DocumentBundle\Entity\Slider;
use TDN\DocumentBundle\Form\Type\SlideType;
use TDN\DocumentBundle\Form\Model\Thematique;
use TDN\DocumentBundle\Form\Model\ThematiqueCollection;
use TDN\DocumentBundle\Form\Type\ThematiqueCollectionType;
use TDN\ImageBundle\Entity\Image;
use TDN\DocumentBundle\Form\Model\IndexCollection;
use TDN\DocumentBundle\Form\Type\IndexCollectionType;

class AdminShoppingController extends DocumentController {
	
	private $etat = array ('SELECTION_BROUILLON', 'SELECTION_PUBLIEE');
	protected $_tplVars = array(
		'selectList' => array(
			array('value' => 'titre', 'texte' => 'Titre'),
			array('value' => 'lnAuteur', 'texte' => 'Auteur'),
			// array('value' => 'rubriques', 'texte' => 'Rubrique')
			),
		'colonnesList' => array('Titre', 'Statut', 'Auteur', 'Publié le')
		);

	public function indexAction () {
		
		$this->_tplVars['titrePage'] = "Index des articles";
		$this->_tplVars['referer'] = "Redaction_selectionShoppingIndex";
		$this->_tplVars['actionsList'] = array(
			'Statut' => array(
				'action' => array(
					'SELECTION_PUBLIEE' => 'Retirer',
					'SELECTION_BROUILLON' => 'Publier'),
				'controleur' => 'Redaction_selectionShoppingPublier'
				),
			'Supprimer' => array(
				'action' => 'Supprimer',
				'controleur' => 'Redaction_selectionShoppingSupprimer',
				'class' => 'deleteConfirm',
				'role' => 'ROLE_ADMIN'
				)
			);

		$em = $this->get('doctrine.orm.entity_manager');
		$rep = $em->getRepository('TDN\RedactionBundle\Entity\SelectionShopping');
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

		return $this->render('RedactionBundle:Admin:selectionShoppingContentListe.html.twig', $this->_tplVars);
	}
	
	public function brouillonsAction () {
		
		$variables['articlesList'] = array();
		$variables['colonnesList'] = array('Titre', 'Auteur');
		$variables['actionsList'] = array('(Dé)Publier', 'Supprimer');
		$variables['actionsRoutesList'] = array('Redaction_publierSelection', 'Redaction_supprimerSelection');
		$variables['selectList'] = array(
			array('value' => 'titre', 'texte' => 'Titre'),
			array('value' => 'rubriques', 'texte' => 'Rubrique')
			);

		$em = $this->get('doctrine.orm.entity_manager');

		$usr= $this->get('security.context')->getToken()->getUser();

		$request = $this->get('request');
		if ($request->isMethod('POST')) {
			$valeur = "%".$request->get('selectValeur')."%";
			$variables['isSelectedField'] = $request->get('selectField');
			$variables['isSelectedValeur'] = $request->get('selectValeur');
			$where = array($request->get('selectField') => $request->get('selectValeur'));
			$variables['articlesList'] = $em->getRepository('TDN\RedactionBundle\Entity\Article')->findBy($where);
		} else {
			$variables['isSelectedField'] = "";
			$variables['isSelectedValeur'] = "";
			$where = array('lnAuteur' => $usr);
			$where['statut'] = 0;
			$variables['articlesList'] = $em->getRepository('TDN\RedactionBundle\Entity\Article')->findBy($where);
		}

		return $this->render('RedactionBundle:Admin:selectionBrouillons.html.twig', $variables);
	}
	
	public function ajouterAction () {
		
		$request = $this->get('request');

	    // Récupération de l'entity manager qui va nous permettre de gérer les entités.
	    $em = $this->get('doctrine.orm.entity_manager');      

		// Instanciation du formulaire
		$_TDNDocument = new SelectionShopping;
		$_TDNDocument->setDatePublication(new \DateTime);
		$form = $this->createForm(new SelectionShoppingNewType, $_TDNDocument);
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
				$now = new \DateTime;
				$_now = date_parse($now->format('Y-m-d H:i:s'));

				$usr= $this->get('security.context')->getToken()->getUser();
				// print_r($usr); die;		
				$rep_nana = $em->getRepository('TDN\NanaBundle\Entity\Nana');
				$nana = $rep_nana->find($usr->getIdNana());
				$_TDNDocument->setLnAuteur($usr);

				$slug = $_TDNDocument->makeSlug();
				$this->resetProperties($_TDNDocument);

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
					$em->persist($slider);
		           // Post-traitement de l'image
		            $imageProcessor = $this->get('tdn.image_processor');
		            $fichierImage = $slider->getLnCover()->getFichier();
		            // $source = $this->container->getParameter('media_root').$dossier.$fichierImage;
		            // $err = $imageProcessor->downScale($source, 600, 'height');
				}

				// Gestion du rubriquage des contenus
				$formThematiques->bindRequest($request);
				$listeRubriques = $themes->getRubriques();
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

				// Traitement des fiches produit
				$produits = $_TDNDocument->getSetProduit();
				if (!empty($produits)) {
					foreach ($produits as $p) {
						if (is_null($p->getPrix())) {
							$p->setPrix(0);
						}
						$p->setLnAuteur($usr);
						// Accrochage du produit à la sélection (relation directrice)
						$p->setLnSelection($_TDNDocument);
						$s = $p->makeSlug();
						// Traitement de l'illustration du produit
						$this->processImageIllustration($p->getLnIllustration(), $usr);
						$this->resetProperties($p);
						$p->setDatePublication(new \DateTime);
						if (!empty($listeRubriques)) {
							foreach($listeRubriques as $r) {
								$rubrique = $r->getRubrique();
								$p->addRubrique($rubrique);
							}
						}
						$em->persist($p);
					}
				}

				$em->persist($_TDNDocument);
				$em->flush();
// die;
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
				$corps['selection'] = $_TDNDocument->getSetProduit();

				$message->setSubject('[TDN] Nouvelle sélection shopping ('.$_TDNDocument->getVersion().')')
						->setContentType('text/html')
	        			->setFrom($expediteurs['admin'])
	        			->setBody(
	            			$this->renderView('RedactionBundle:Mail:nouvelleSelectionShopping.html.twig', $corps),
	            			'text/html'
	            		);
				foreach($admins['redaction'] as $destinataire) {
					$message->addTo($destinataire);
				}
			    $this->get('mailer')->send($message);

				return $this->redirect($this->generateURL('Redaction_selectionShoppingIndex'));
			}
		}

		$variables['titreDetail'] = "Nouvelle sélection shopping";
		$variables['formCallback'] = "Redaction_ajouterSelection";
		
		return $this->render('RedactionBundle:Admin:selectionShoppingAdd.html.twig', $variables);//array('form' => $form->createView())
	}

	public function modifierAction ($id) {
		
		$request = $this->get('request');

	    // Récupération de l'entity manager qui va nous permettre de gérer les entités.
	    $em = $this->get('doctrine.orm.entity_manager');      

		// Instanciation du formulaire
		$repository = $em->getRepository('TDN\RedactionBundle\Entity\SelectionShopping');
		$_TDNDocument = $repository->find($id);
		$form = $this->createForm(new SelectionShoppingReviewType, $_TDNDocument);
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
		$variables['formThematiques'] = $formThematiques->createView();

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
						$slider->setDatePublication(new \DateTime);
						if ($imageCover instanceof Image) {
							$_m = $imageCover->getDatePublication()->format('m');
							$_y = $imageCover->getDatePublication()->format('Y');
							$dossierSlider = '/public/'.$_y.'/'.$_m.'/';
							$em->persist($imageCover);
							$hasNewCover = true;				
						}
						$em->persist($slider);
					} else {
						if ($slider->getLnCover()->isUpdated()) {
							if ($imageCover instanceof Image) {
								$_date = $imageCover->getDatePublication();
								if ($_date instanceof \DateTime) {
									$_m = $_date->format('m');
									$_y = $_date->format('Y');
								} else {
									$now = new \DateTime;
									$_m = $now->format('m');
									$_y = $now->format('Y');
								}
							}
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

				// Traitement des fiches produit
				$produits = $_TDNDocument->getSetProduit();
				if (!empty($produits)) {
					foreach ($produits as $p) {
						if (is_null($p->getPrix())) {
							$p->setPrix(0);
						}
						if ($p->getLnAuteur() === NULL) {
							$p->setLnAuteur($usr);
							// Accrochage du produit à la sélection (relation directrice)
							$p->setLnSelection($_TDNDocument);
							$s = $p->makeSlug();
							// Traitement de l'illustration du produit
							$this->processImageIllustration($p->getLnIllustration(), $usr);
							$this->resetProperties($p);
							$p->setDatePublication(new \DateTime);
							if (!empty($listeRubriques)) {
								foreach($listeRubriques as $r) {
									$rubrique = $r->getRubrique();
									$p->addRubrique($rubrique);
								}
							}
							$em->persist($p);
						} else {
							$img = $p->getLnIllustration();
							if ($img instanceof Image && $img->isUpdated()) {
								$this->processImageIllustration($p->getLnIllustration(), $usr);
							}
							$p->setDateModification($now);
						}
					}
				}

				// $em->persist($article);
				$em->flush();

				// Slider
				if ($hasNewCover) {
		           //Post-traitement de l'image
		            $imageProcessor = $this->get('tdn.image_processor');
		            $fichierImage = $imageCover->getFichier();
			        $source = $this->container->getParameter('media_root').$dossierSlider.$fichierImage;
			        $err = $imageProcessor->downScale($source, 600, 'width', 'slider_');
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
				$corps['titre'] = $_TDNDocument->getTitre();
				$corps['selection'] = $_TDNDocument->getSetProduit();

				$message->setSubject('[TDN] Modification de sélection shopping [rev. '.$_TDNDocument->getVersion().']')
						->setContentType('text/html')
	        			->setFrom($expediteurs['admin'])
	        			->setBody(
	            			$this->renderView('RedactionBundle:Mail:nouvelleSelectionShopping.html.twig', $corps),
	            			'text/html'
	            		);
				foreach($admins['redaction'] as $destinataire) {
					$message->addTo($destinataire);
				}
			    $this->get('mailer')->send($message);
				
				$this->get('session')->getFlashBag()->add('success', 'Sélection révisée');
				return $this->redirect($this->generateURL('Redaction_selectionShoppingIndex'));
			} else {
				$this->get('session')->getFlashBag()->add('fail', 'Erreur dans le formulaire');
			}
		}

		$variables['titreDetail'] = "Modification d’une sélection shopping";
		$variables['formCallback'] = "Redaction_modifierSelection";
		$variables['TDNDoc_id'] = $id;
		
		return $this->render('RedactionBundle:Admin:selectionShoppingAdd.html.twig', $variables);//array('form' => $form->createView())
}
	}