<?php

namespace TDN\ConseilExpertBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use TDN\ConseilExpertBundle\Entity\ConseilExpert;
use TDN\ConseilExpertBundle\Form\Type\ConseilExpertDispatchType;
use TDN\ConseilExpertBundle\Form\Type\ConseilExpertReponseType;
use TDN\ConseilExpertBundle\Form\Type\ConseilExpertRelectureType;

use TDN\DocumentBundle\Controller\AdminController as DocumentController;
use TDN\DocumentBundle\Form\Type\ThematiqueCollectionType;
use TDN\DocumentBundle\Form\Model\ThematiqueCollection;
use TDN\DocumentBundle\Form\Model\Thematique;
use TDN\DocumentBundle\Entity\Slider;
use TDN\DocumentBundle\Form\Type\SlideType;
use TDN\DocumentBundle\Form\Model\IndexCollection;
use TDN\DocumentBundle\Form\Type\IndexCollectionType;
use TDN\DocumentBundle\Entity\DocumentRubrique;

use TDN\ImageBundle\Entity\Image;
use TDN\Nanabundle\Entity\Nana;

class AdminController extends DocumentController {

	private $etat = array ('CONSEIL_ENREGISTRE', 'CONSEIL_TRANSMIS', 'CONSEIL_REPONDU', 'CONSEIL_PUBLIE');
	protected $_tplVars = array(
		'selectList' => array(
			array('value' => 'titre', 'texte' => 'Titre'),
			array('value' => 'question', 'texte' => 'Question'),
			array('value' => 'lnAuteur', 'texte' => 'Auteur'),
			array('value' => 'lnExpert', 'texte' => 'Expert'),
			// array('value' => 'rubriques', 'texte' => 'Rubrique')
			),
		'colonnesList' => array('Titre', 'Statut', 'Pseudo', 'Soumise le')
		);

	protected function selectionQuery ($constantes, $tri, $limite) {
		$em = $this->get('doctrine.orm.entity_manager');
		$rep = $em->getRepository('TDN\ConseilExpertBundle\Entity\ConseilExpert');
		$request = $this->get('request');
		if ($request->isMethod('POST')) {
			$valeur = $request->get('selectValeur');
			$champ = $request->get('selectField');
			if ($valeur !== '') {
				$this->_tplVars['isSelectedField'] = $request->get('selectField');
				$this->_tplVars['isSelectedValeur'] = $request->get('selectValeur');
				switch ($champ) {
				 	case 'lnAuteur':
				 	case 'lnExpert':
				 		$rep_nanas = $em->getRepository('TDN\NanaBundle\Entity\Nana');
				 		$nana = $rep_nanas->findOneByUsername($valeur);
				 		if ($nana instanceof Nana) {
				 			$constantes[$champ] =  $nana->getIdNana();
				 		}
				 		break;
				 	
				 	case 'titre':
				 	default:
				 		$wildcards[$champ] =  $valeur;
				 		break;				 	
				}
				if (!empty($wildcards)) {
					$this->_tplVars['documentListe'] = $rep->findByWithWilcards($wildcards, $constantes, $tri, $limite);
				} else {
					$this->_tplVars['documentListe'] = $rep->findBy($constantes, $tri, $limite);
				}
			} else {
				$this->_tplVars['documentListe'] = $rep->findBy($constantes, $tri, $limite);
			}
		} else {
			$this->_tplVars['documentListe'] = $rep->findBy($constantes, $tri, $limite);
		}

		return true;
	}

	public function indexAction ()
	{		
		$usr= $this->get('security.context')->getToken()->getUser();
		// Liste des actions disponibles pour ce contenu
		$action = array('deleguer' => 'Déléguer', 'repondre' => 'Répondre', 'publier' => 'Publier');

		$this->_tplVars['titrePage'] = "Index des conseils";
		$this->_tplVars['referer'] = "ConseilExpertBundle_index";
		$routes = array_keys($action);
		// $_c = $routes[$statut-1];
		// $controleur = sprintf('ConseilExpertBundle_%s', $_c);
		// $labelAction = $action[$_c];
		// $controleur = sprintf('ConseilExpertBundle_%s', $_c);
		// $labelAction = $action[$_c];
		$this->_tplVars['actionsList'] = array(
			// 'Action' => array(
			// 	'action' => $labelAction,
			// 	'controleur' => $controleur
			// 	),
			'Supprimer' => array(
				'action' => 'Supprimer',
				'controleur' => 'ConseilExpertBundle_supprimer',
				'class' => 'deleteConfirm',
				'role' => 'ROLE_ADMIN'
				)
			);


		$tri = array('idDocument' => 'DESC');
		// if ($this->get('security.context')->isGranted('ROLE_ADMIN')) {
		// 	$limite = 100;
		// 	$constantes = array();
		// } elseif ($this->get('security.context')->isGranted('ROLE_EXPERT')) {
			$limite = NULL;
			// $constantes['lnExpert'] = $usr->getIdNana();
			$constantes = array();
		// }
		// $this->selectionQuery($constantes, $tri, $limite);
		$em = $this->get('doctrine.orm.entity_manager');
		$rep = $em->getRepository('TDN\ConseilExpertBundle\Entity\ConseilExpert');
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

		return $this->render('ConseilExpertBundle:Admin:conseilContentListe.html.twig', $this->_tplVars);
	}

	public function logStatutAction ($statut) {
		
		$action = array('deleguer' => 'Déléguer', 'repondre' => 'Répondre', 'publier' => 'Publier');

		$em = $this->get('doctrine.orm.entity_manager');
		$rep = $em->getRepository('TDN\ConseilExpertBundle\Entity\ConseilExpert');

		$variables['conseilsList'] = array();
		$variables['colonnesList'] = array('Titre', 'Statut', 'Auteur', 'Soumission');
		$routes = array_keys($action);
		$_c = $routes[$statut-1];
		$controleur = sprintf('ConseilExpertBundle_%s', $_c);
		$labelAction = $action[$_c];
		$variables['actionsList'] = array(
			'Action' => array(
				'action' => $labelAction,
				'controleur' => $controleur
				),
			'Supprimer' => array(
				'action' => 'Supprimer',
				'controleur' => 'ConseilExpertBundle_supprimer',
				'class' => 'deleteConfirm',
				'role' => 'ROLE_ADMIN'
				)
			);
		$variables['selectList'] = array(
			array('value' => 'titre', 'texte' => 'Titre'),
			array('value' => 'lnAuteur', 'texte' => 'Auteur'),
			array('value' => 'rubriques', 'texte' => 'Rubrique')
			);

		$usr= $this->get('security.context')->getToken()->getUser();
		$params['statut'] = $this->etat[$statut-1];

		$em = $this->get('doctrine.orm.entity_manager');
		if ($this->get('security.context')->isGranted('ROLE_ADMIN')) {
			$variables['conseilsList'] = $rep->findBy(
				array('statut' => $params['statut']),
				array('dateSoumission' => 'DESC'));
		}
		elseif ($this->get('security.context')->isGranted('ROLE_EXPERT')) {
			$variables['conseilsList'] = $rep->findBy(
				array(
					'statut' => $params['statut'],
					'lnExpert' => $usr->getIdNana()), 
				array('dateSoumission' => 'DESC'));
		}

		return $this->render('ConseilExpertBundle:Admin:conseilListe.html.twig', $variables);
	}

	public function logTriAction ($ordre) {
		
		$variables['conseilsList'] = array();
		$variables['colonnesList'] = array('Titre', 'Statut');
		$variables['actionsList'] = array('Supprimer');

		$em = $this->get('doctrine.orm.entity_manager');
		$rep = $em->getRepository('TDN\ConseilExpertBundle\Entity\ConseilExpert');

		$_e = $this->etat[$ordre] - 1;
		// $qb = $this->createQueryBuilder('u');
		// $query = $qb->select('c')
		// 			 ->where($qb->expr()>like('u.statut', $qb->expr()->literal(':etat')))
		// 			 ->setParameter('etat', $ordre)
  //   				 ->orderBy('idDocument', 'DESC')
  //   				 ->getQuery();
		// $variables['conseilsList'] = $query->getResult();
		$variables['conseilsList'] = $rep->findByStatut('CONSEIL_ENREGISTRE');

		return $this->render('ConseilExpertBundle:Admin:conseilListe.html.twig', $variables);
	}
	
	public function editerAction () {
		
		return $this->render('ConseilExpertBundle:Admin:conseilForm.html.twig');
	}
	
	public function conseilDispatchAction ($id) {

		$request = $this->get('request');

		$variables['rubrique'] = 'tdn';
		$variables['titreDetail'] = 'Choix d’un expert';

	    // Récupération de l'entity manager qui va nous permettre de gérer les entités.
	    $em = $this->get('doctrine.orm.entity_manager');      

		// Instanciation du Repository
		$rep_conseils = $em->getRepository('TDN\ConseilExpertBundle\Entity\ConseilExpert');
	    $conseil = $rep_conseils->find($id);
		$rep_images = $em->getRepository('TDN\ImageBundle\Entity\Image');
	    $image = $conseil->getLnImage();

		// Instanciation du formulaire
		// Le 3ème argument pour passer une valeur à champ de type 'entity'
		$form = $this->createForm(new ConseilExpertDispatchType, $conseil);

		// Instanciation du formulaire
		$doc =  new ThematiqueCollection;

		if ($request->getMethod() == 'POST') {


			return $this->redirect($this->generateURL('Core_adminDashboard'));
		}

		foreach($conseil->getRubriques() as $r) {
			$t = new Thematique();
			$t->setRubrique($r);
			$doc->addRubrique($t);
		}
		$formRubrique = $this->createForm(new ThematiqueCollectionType, $doc);

		$variables['flowId'] = $conseil->getIdDocument();
		$variables['dateSoumission'] = $conseil->getDateSoumission();
		if ($image) {
			$variables['image'] = $image->getFichier();
			$variables['alt'] = $image->getAlt();
		}
		$variables['auteur'] = $conseil->getLnAuteur()->getUsername();
		$variables['age'] = date_diff(new \DateTime, $conseil->getLnAuteur()->getDateNaissance())->format('%Y');
		$variables['sourceQuestion'] = $conseil->getQuestion();

		// Affichage de la page
		$variables['formRubrique'] = $formRubrique->createView();
		$variables['form'] = $form->createView();
		return $this->render('ConseilExpertBundle:Admin:conseilDispatchForm.html.twig', $variables);
	}

	public function conseilFlowDispatchAction () {

		$request = $this->get('request');

		$variables['rubrique'] = 'tdn';

	    $em = $this->get('doctrine.orm.entity_manager');      

		// Instanciation du Repository
		$rep_conseils = $em->getRepository('TDN\ConseilExpertBundle\Entity\ConseilExpert');
	    $_TDNDocument = $rep_conseils->find($request->get('flowId'));
		$form = $this->createForm(new ConseilExpertDispatchType, $_TDNDocument);

		$themes =  new ThematiqueCollection;
		$formThematiques = $this->createForm(new ThematiqueCollectionType, $themes);

		if ($request->getMethod() == "POST") {
			$dismissed_demande = $request->get('dismiss_demande');
			if ($dismissed_demande == 1) {
				$dismissed_texte = $request->get('dismiss_texte');
				$_TDNDocument->setStatut('CONSEIL_ECARTE');
				$em->flush();
				$this->processEcart($_TDNDocument, $dismissed_texte);
				$this->get('session')->getFlashBag()->add('success', 'La question est écartée et ton message a été envoyé à la lectrice.');
				return $this->redirect($this->generateURL('ConseilExpertBundle_index'));
			} else {
				$form->bind($request);
				$_TDNDocument->setStatut('CONSEIL_TRANSMIS');

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

				$em->persist($_TDNDocument);
				$em->flush();

				$auteur = $_TDNDocument->getLnAuteur();
				$expert = $_TDNDocument->getLnExpert();

	 			// Notification
				$admins = $this->container->getParameter('admin_notifications');
				$expediteurs = $this->container->getParameter('mail_expediteur');				
				$message = \Swift_Message::newInstance();
				// Elements généraiques
				$corps['expediteur'] = "Justine";
				$corps['role'] = "Rédaction";
				$corps['destinataire'] = $expert->getPrenom();
				$corps['dateEnvoi'] = date(' d m Y - H:i:s');
				// Eléments spécifiques
				$corps['pseudo'] = $auteur->getUsername();
				$age = date_diff(new \DateTime, $auteur->getDateNaissance());
				$corps['age'] = $age->format('%y ans');
				$corps['question'] = $_TDNDocument->getQuestion();

				$message->setSubject('[TDN] Nouvelle demande de conseil')
						->setContentType('text/html')
	        			->setFrom($expediteurs['redaction'])
	        			->addTo($expert->getEmail())
	        			->setBody(
	            			$this->renderView('ConseilExpertBundle:Mail:dispatchConseil.html.twig', $corps),
	            			'text/html'
	            		);
				foreach($admins['redaction'] as $destinataire) {
					$message->addTo($destinataire);
				}
			    $this->get('mailer')->send($message);

			    return $this->redirect($this->generateURL('ConseilExpert_logStatut', array('statut' => 1) ));
			}
		}

		// Affichage de la page
		return $this->render('ConseilExpertBundle:Admin:conseilListe.html.twig', $variables);
	}

	public function conseilRepondreAction ($id) {

		$variables['rubrique'] = 'tdn';

	    // Récupération de l'entity manager qui va nous permettre de gérer les entités.
	    $em = $this->get('doctrine.orm.entity_manager');      

		// Instanciation du Repository
		$rep_conseils = $em->getRepository('TDN\ConseilExpertBundle\Entity\ConseilExpert');
	    $variables['conseil'] = $_TDNDocument = $rep_conseils->find($id);

		// Instanciation du formulaire
		$form = $this->createForm(new ConseilExpertReponseType, $_TDNDocument);
		$variables['form'] = $form->createView();

		$variables['flowId'] = $_TDNDocument->getIdDocument();
		$variables['sourceDocument'] = $_TDNDocument->getReponse();

		// Affichage de la page
		return $this->render('ConseilExpertBundle:Admin:conseilRepondreForm.html.twig', $variables);
	}

	public function conseilFlowRepondreAction () {

		$request = $this->get('request');
		$whoami = $this->container->get('security.context')->getToken()->getUser();

		$variables['rubrique'] = 'tdn';

	    $em = $this->get('doctrine.orm.entity_manager');      

		// Instanciation du Repository
		$rep_conseils = $em->getRepository('TDN\ConseilExpertBundle\Entity\ConseilExpert');
	    $_TDNDocument = $rep_conseils->find($request->get('flowId'));
		$form = $this->createForm(new ConseilExpertReponseType, $_TDNDocument);

		if ($request->getMethod() == "POST") {
			$form->bind($request);
			if ($form->isValid()) {
				$now = new \DateTime;

				// A revoir pour permettre l'ajour d'images par les experts
				// $image = $_TDNDocument->getLnImage();
				// if ($image instanceof Image) {
				// 	$dossier = '/public/'.$now->format('Y').'/'.$now->format('m').'/';
				// 	$this->processImageIllustration($image, $whoami);
				// }

				$poursuivre = $request->get('valider');
				if ($poursuivre) {
					$_TDNDocument->setStatut('CONSEIL_REPONDU');
				}

				// $em->persist($_TDNDocument);
				$em->flush();

				$auteur = $_TDNDocument->getLnAuteur();
				$expert = $_TDNDocument->getLnExpert();

	 			// Notification
				$admins = $this->container->getParameter('admin_notifications');
				$expediteurs = $this->container->getParameter('mail_expediteur');				
				$message = \Swift_Message::newInstance();
				$corps['expediteur'] = "Administrateur";
				$corps['role'] = "Rédaction";
				$corps['destinataire'] = "";
				$corps['dateEnvoi'] = date(' d m Y - H:i:s');
				$corps['pseudo'] = $auteur->getUsername();
				$corps['expert'] = $expert->getPrenom().' '.$expert->getNom();
				$age = date_diff(new \DateTime, $auteur->getDateNaissance());
				$corps['reponse'] = $_TDNDocument->getReponse();

				$message->setSubject('[TDN] Réponse à une demande de conseil')
						->setContentType('text/html')
        				->setFrom($expediteurs['admin'])
 	        			->setBody(
	            			$this->renderView('ConseilExpertBundle:Mail:reponseConseil.html.twig', $corps),
	            			'text/html'
	            		);
				foreach($admins['redaction'] as $destinataire) {
					$message->addTo($destinataire);
				}
			    $this->get('mailer')->send($message);

		    return $this->redirect($this->generateURL('ConseilExpert_logStatut', array('statut' => 2) ));
			}
		}

		// Affichage de la page
		return $this->render('ConseilExpertBundle:Admin:conseilListe.html.twig', $variables);
	}

	public function conseilRelireAction ($id) {

		$request = $this->get('request');

		$variables['rubrique'] = 'tdn';

	    // Récupération de l'entity manager qui va nous permettre de gérer les entités.
	    $em = $this->get('doctrine.orm.entity_manager');      

		// Instanciation du Repository
		$rep_conseils = $em->getRepository('TDN\ConseilExpertBundle\Entity\ConseilExpert');
	    $variables['conseil'] = $_TDNDocument = $rep_conseils->find($id);
	    $_backup = $rep_conseils->find($id);
	    $_auteur = $_TDNDocument->getLnAuteur();

		// Instanciation du formulaire
		$form = $this->createForm(new ConseilExpertRelectureType, $_TDNDocument);

		// Instanciation du formulaire du Slider
		if ($_TDNDocument->getLnPromu() instanceof Slider) {
			$slider = $_TDNDocument->getLnPromu();
			$exSlider = true;
		} else {
			$slider = new Slider();
			$exSlider = false;
		}
		$formSlider = $this->createForm(new SlideType, $slider);

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

		// Indexation du document
		$indexCollection = new IndexCollection;
		$tags = $_TDNDocument->getFilTags();
		foreach ($tags as $t) {
			$indexCollection->addIndex($t);
		}
		$formIndex = $this->createForm(new IndexCollectionType, $indexCollection);
		$variables['formIndex'] = $formIndex->createView();

		if ($request->getMethod() == 'POST') {
			$form->bind($request);
			if ($form->isValid()) {
				if ($_TDNDocument->getStatut() == 'CONSEIL_ECARTE') {
				} else {

			        $imageProcessor = $this->get('tdn.image_processor');
					$now = new \DateTime;
					$_auteur = $_TDNDocument->getLnAuteur();
					$usr= $this->get('security.context')->getToken()->getUser();				

					$slug = $_TDNDocument->makeSlug();
					$_TDNDocument->setVersion($_TDNDocument->getVersion() + 1);
					// $_TDNDocument->setDatePublication(new \DateTime);
					$_TDNDocument->setDateModification(new \DateTime);

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

					// Traitement des mots-clefs
					$formIndex->bindRequest($request);
					$semTagger = $this->get('tdn.tag.manager');
					$tags = $semTagger->tagsUpdate($_TDNDocument, $indexCollection->getIndex());
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

				$statut = $_TDNDocument->getStatut();

	 			// Notification
				$admins = $this->container->getParameter('admin_notifications');
				$expediteurs = $this->container->getParameter('mail_expediteur');				
				$message = \Swift_Message::newInstance();
				// Elements génériques
				$corps['expediteur'] = "Justine";
				$corps['role'] = "Rédaction TDN";
				$corps['destinataire'] = $usr->getUsername();
				$corps['dateEnvoi'] = date(' d m Y - H:i:s');
				// Elements spécifiques
				$corps['titre'] = $_TDNDocument->getTitre();
				$corps['question'] = $_TDNDocument->getQuestion();
				$corps['lecteur'] = $usr->getUsername();
				$HTMLBody = $this->renderView('ConseilExpertBundle:Mail:relectureConseil.html.twig', $corps);
				$PlainBody = '';

				$message->setSubject('[TDN] Révision d’un conseil d’expert')
						->setContentType('text/html')
	        			->setFrom($expediteurs['admin'])
	        			->setBody($HTMLBody, 'text/html')
	        			->addPart($PlainBody, 'text/plain');
			    $this->get('mailer')->send($message);
			}
			foreach($admins['redaction'] as $destinataire) {
				$message->addTo($destinataire);
			}

/*		    if ($_backup->getStatut() != $_TDNDocument->getStatut()) {
		    	if ($_TDNDocument->getStatut() == 'CONSEIL_PUBLIE')) {
			    	$this->processPublication($_TDNDocument);
				} elseif ($_TDNDocument->getStatut() == 'CONSEIL_ECARTE')) {
		    		$this->processEcart($_TDNDocument);
		    	}
		    }
*/			$this->get('session')->getFlashBag()->add('success', 'Les modifications ont bien été enregistées');
			return $this->redirect($this->generateURL('Core_adminDashboard'));
		}

		// Affichage de la page
		$variables['flowId'] = $_TDNDocument->getIdDocument();
		$variables['titreDetail'] = "Demande de conseil";
		$variables['formCallback'] = "ConseilExpertBundle_relire";
		$variables['TDNDoc_id'] = $id;

		$variables['form'] = $form->createView();
		$variables['formThematiques'] = $formThematiques->createView();
		$variables['formSlider'] = $formSlider->createView();
		if ($_backup->getLnPromu() instanceof Slider) $variables['isChecked'] = "checked";

		return $this->render('ConseilExpertBundle:Admin:conseilRelireForm.html.twig', $variables);	
	}

	public function publierAction () {
		
		$conseil->setStatut('CONSEIL_PUBLIE');
		return $this->render('ConseilExpertBundle:Admin:conseilListe.html.twig');
	}
	
	public function supprimerAction ($id) {

		$URLmanager = $this->get('tdn.document.url');
		$request = $this->get('request');
	    $em = $this->get('doctrine.orm.entity_manager');      
		$repository = $em->getRepository('TDN\ConseilExpertBundle\Entity\ConseilExpert');
		$_TDNDocument = $repository->find($id);
		$this->deleteRecord($_TDNDocument);
		$this->get('session')->getFlashBag()->add('success', 'Ce conseil a été supprimé');					
		return $this->redirect($URLmanager->refererURL($request->headers->get('referer')));
	}

	protected function processPublication($_TDNDocument) {

 		// Notifications
		$em = $this->get('doctrine.orm.entity_manager');
		$_auteur = $_TDNDocument->getLnAuteur();
		$_expert = $_TDNDocument->getLnExpert();
		$followers = $_auteur->getIsFollowed();
		$_rp = $_TDNDocument->getRubriques();

		// Notification à l'autur de la question
			$message = \Swift_Message::newInstance();
			$corps['expediteur'] = "Justine";
			$corps['role'] = "Rédaction TDN";
			$corps['destinataire'] = $_auteur->getUsername();
			$corps['dateEnvoi'] = date(' d m Y - H:i:s');
			// VAriables du corsp du mail
			$corps['expert'] = $_expert->getUsername();
			$corps['question'] = $_TDNDocument->getQuestion();
			$corps['titre'] = $_TDNDocument->getTitre();
			$corps['url'] = $this->generateURL('ConseilExpert_conseil', array(
				'slug' => $_TDNDocument->getSlug(),
				'id' => $_TDNDocument->getIdDocument(),
				'rubrique' => $_rp[0]->getSlug()
				));

			$message->setSubject('[TDN] La réponse à ta question a été publiée')
					->setContentType('text/html')
        			->setFrom('postmaster@trucdenana.com')
        			->addTo($ff->getEmail())
        			->setBody(
            			$this->renderView('ConseilExpertBundle:Mail:publicationConseil.html.twig', $corps),
            			'text/html'
            		);
		    $this->get('mailer')->send($message);

		// Notification à tous les followers
		foreach ($followers as $ff) {
			print_r($ff->getEmail());
			$message = \Swift_Message::newInstance();
			// Eléments génériques
			$corps['expediteur'] = "Justine";
			$corps['role'] = "Rédaction TDN";
			$corps['destinataire'] = $ff->getUsername();
			$corps['dateEnvoi'] = date(' d m Y - H:i:s');
			// Eléments spécifiques du message
			$corps['auteur'] = $_auteur->getUsername();
			$corps['expert'] = $_expert->getUsername();
			$corps['question'] = $_TDNDocument->getQuestion();
			$corps['titre'] = $_TDNDocument->getTitre();
			$corps['url'] = $this->generateURL('ConseilExpert_conseil', array(
				'slug' => $_TDNDocument->getSlug(),
				'id' => $_TDNDocument->getIdDocument(),
				'rubrique' => $_rp[0]->getSlug()
				));

			$message->setSubject('[TDN] Une réponse à une question de '.$_auteur->getUsername().' a été publiée')
					->setContentType('text/html')
        			->setFrom('postmaster@trucdenana.com')
        			->addTo($ff->getEmail())
        			->setBody(
            			$this->renderView('ConseilExpertBundle:Mail:followersConseil.html.twig', $corps),
            			'text/html'
            		);
		    $this->get('mailer')->send($message);
		}

		$points = $this->container->getParameter('action_points');
        $score = $points['question_expert'] * ($_TDNDocument->getLnPromu() instanceof Slider) ? 2 : 1;
        $_auteur->updatePopularite($score);
		$score = $points['reponse_expert'] * ($_TDNDocument->getLnPromu() instanceof Slider) ? 2 : 1;
        $_expert->updatePopularite($score);

        $em->flush();

        return true;
	}

	protected function processEcart($_TDNDocument, $motivation = NULL) {

 		// Notifications
		$em = $this->get('doctrine.orm.entity_manager');
		$_auteur = $_TDNDocument->getLnAuteur();

		// Notification à l'autur de la question
		$admins = $this->container->getParameter('admin_notifications');
		$expediteurs = $this->container->getParameter('mail_expediteur');				
			$message = \Swift_Message::newInstance();
			$corps['expediteur'] = "Justine";
			$corps['role'] = "Rédaction TDN";
			$corps['destinataire'] = $_auteur->getUsername();
			$corps['dateEnvoi'] = date(' d m Y - H:i:s');
			// VAriables du corsp du mail
			$corps['question'] = $_TDNDocument->getQuestion();
			$corps['message'] = $motivation;

			$message->setSubject('[TDN] Ta question n’a pu être validée par la rédaction')
					->setContentType('text/html')
        			->setFrom(array($expediteurs['redaction'] => 'La rédaction de TDN'))
        			->addTo($_auteur->getEmail())
					->setBody(
            			$this->renderView('ConseilExpertBundle:Mail:ecartConseil.html.twig', $corps),
            			'text/html'
            		);
			foreach($admins['redaction'] as $destinataire) {
				$message->addTo($destinataire);
			}
		    $this->get('mailer')->send($message);

        return true;
	}

	public function journalExpertAction () 
	{
	    $em = $this->get('doctrine.orm.entity_manager');      
		$rep_nanas = $em->getRepository('TDN\NanaBundle\Entity\Nana');
		$rep_conseils = $em->getRepository('TDN\ConseilExpertBundle\Entity\ConseilExpert');

		$listeExperts = "";
		foreach (array('ROLE_EXPERT', 'ROLE_JOURNALISTE', 'ROLE_ADMIN') as $role) {
			$experts = $rep_nanas->findByRole($role);

			foreach($experts as $e) {
				$conseils = $rep_conseils->findBy(array('statut' => 'CONSEIL_TRANSMIS', 'lnExpert' => $e->getIdNana()));

				if (!empty($conseils)) {
					$message = \Swift_Message::newInstance();
					// Eléments génériques
					$corps['expediteur'] = "Justine";
					$corps['role'] = "Rédaction TDN";
					$corps['destinataire'] = $e->getPrenom();
					$corps['dateEnvoi'] = date(' d m Y - H:i:s');
					// Eléments spécifiques du message
					$corps['conseils'] = $conseils;
					// $corps['expert'] = $;

					$message->setSubject('[TDN] Les demandes de conseils en attente de réponse')
							->setContentType('text/html')
		        			->setFrom('postmaster@trucdenana.com')
		        			->addTo($e->getEmail())
		        			->addTo($this->container->getParameter('mail_moderation_1'))
		        			->setBody(
		            			$this->renderView('ConseilExpertBundle:Mail:alerteExpert.html.twig', $corps),
		            			'text/html'
		            		);
				    $this->get('mailer')->send($message);
					$listeExperts .= "<p>+ ".$e->getUsername().' : '.count($conseils)."</p>";
				} else {
					$listeExperts .= "<p style='color:#999;'>- ".$e->getUsername()."</p>";
				}
			}
			
		}
		// die;
		return new Response('<div>'.$listeExperts.'</div>');

	}

}