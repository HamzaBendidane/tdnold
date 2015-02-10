<?php

namespace TDN\BreveBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use TDN\BreveBundle\Form\Type\BreveType;
use TDN\BreveBundle\Entity\Breve;
use TDN\DocumentBundle\Entity\DocumentType;
use TDN\DocumentBundle\Entity\DocumentRubrique;
use TDN\CoreBundle\Entity\Journal;
use TDN\NanaBundle\Entity\Nana;



class PublicController extends Controller {
	
	public function breveProposerAction () {

		$variables['rubrique'] = 'tdn';
		// Affichage de la page

		// Instanciation du formulaire
		$form = $this->createForm(new BreveType, new Breve);
		$variables['form'] = $form->createView();

		return $this->render('BreveBundle:Page:postForm.html.twig', $variables);
	}

	public function brevePosterAction () {

		$em = $this->get('doctrine.orm.entity_manager');
		$request = $this->get('request');

		$variables['rubrique'] = 'tdn';
		$breve = new Breve;
		$form = $this->createForm(new BreveType, $breve);

		if ($request->getMethod() == "POST") {

			$usr= $this->get('security.context')->getToken()->getUser();
			if ($usr instanceof Nana) {
				$blackListed = ($usr->getBlacklist() == 0);
			} else {
				$blackListed = true;
			}
			// $blackListed = false;
			if (!$blackListed) {
				$this->get('session')->getFlashBag()->add('fail', 'Contacte TDN pour pouvoir poster de nouveau sur le site');
			} else {
				$em = $this->get('doctrine.orm.entity_manager');
				$form->bind($request);
				// $breve->setStatut("public");
				$breve->setDatePublication(new \DateTime);
				$breve->setlnAuteur($usr);
				// Vérification de validité de la rubrique
				$rubrique = $breve->getLnRubrique();
				if (!($rubrique instanceof DocumentRubrique)) {
					$rep_rubrique = $em->getRepository('TDN\DocumentRubrique\Entity\DocumentRubrique');
					$defaultRubrique = $rep_rubrique->find(8);
					$breve->setLnRubrique($defaultRubrique);
				}

				$url = $breve->getUrl();
				if ($url != "") {
					$_tiny = $breve->make_tiny($url);
					if ($_tiny != 'ERROR') {
						$breve->setTinyURL($breve->make_tiny($url));
					}
				}

				$breve->setStatut('BREVE_PUBLIEE');
				$em->persist($breve);

				// Signaler dans le journal
				$entree = new Journal;
				$entree->setLnActeur($usr);
				$entree->setAction('INFO');
				// list($route, $rubrique, $params) = $breve->getURLElements();
				// $entree->setURL($breve->getUrl);
				$entree->setTexte('a posté une info');
				$entree->setTitre($breve->getMessage());
				$entree->setSupport('');
				$entree->setLnRubrique($breve->getLnRubrique());
				$entree->setDateEntree($breve->getDatePublication());
				// $em->persist($entree);

				$points = $this->container->getParameter('action_points');
				$usr->updatePopularite($points['post_info']);

				$em->flush();
				$this->get('session')->getFlashBag()->add('success', 'Ton info a été postée dans le fil TDN');
			}
		}

		return $this->redirect($request->headers->get('referer'));
	}


	public function filAction () {

		$fil = 200;
		$request = $this->get('request');
		$getFIl = $request->query->get('fil');
		if (!is_null($getFIl)) $fil = $getFil;
		$rubrique = $request->query->get('rubrique') ? $request->query->get('rubrique') : NULL;
	    // Récupération de l'entity manager qui va nous permettre de gérer les entités.
	    $em = $this->get('doctrine.orm.entity_manager');      
		// Instanciation du Repository
		// $rep = $em->getRepository('TDN\VideoBundle\Entity\Video');
	    // $listeVideos = $rep->findWithin($longueurPage);
	    // $nombreVideos = $rep->compteVideos();

		// Récupération des dernières brèves
		$repBreve = $em->getRepository('TDN\BreveBundle\Entity\Breve');
		$variables['filInfo'] = $repBreve->findMostRecent($fil, $rubrique);
		$variables['rubrique'] = 'tdn';

		// Instanciation du formulaire
		$formBreve = $this->createForm(new BreveType, new Breve);
		$variables['formBreve'] = $formBreve->createView();

		// Affichage de la page
		return $this->render('BreveBundle:Page:filBreves.html.twig', $variables);
	}

	public function filPersoAction ($id) {

		$fil = 200;
	    // Récupération de l'entity manager qui va nous permettre de gérer les entités.
	    $em = $this->get('doctrine.orm.entity_manager');      
		// Instanciation du Repository
		// $rep = $em->getRepository('TDN\VideoBundle\Entity\Video');
	    // $listeVideos = $rep->findWithin($longueurPage);
	    // $nombreVideos = $rep->compteVideos();

		// Récupération des dernières brèves
		$rep_nanas = $em->getRepository('TDN\NanaBundle\Entity\Nana');
		$nana = $rep_nanas->find($id);
		if (is_object($nana)) {
			$repBreve = $em->getRepository('TDN\BreveBundle\Entity\Breve');
			$variables['filInfo'] = $repBreve->findBy(array('lnAuteur' => $nana->getIdNana()), array('datePublication' => 'DESC'), $fil, 0);
			$variables['rubrique'] = 'tdn';
		} else {
			
		}

		// Instanciation du formulaire
		$formBreve = $this->createForm(new BreveType, new Breve);
		$variables['formBreve'] = $formBreve->createView();

		// Affichage de la page
		return $this->render('BreveBundle:Page:filBreves.html.twig', $variables);
	}

}
