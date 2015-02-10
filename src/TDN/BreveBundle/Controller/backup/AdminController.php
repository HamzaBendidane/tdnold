<?php
namespace TDN\BreveBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TDN\BreveBundle\Form\Type\BreveType;
use TDN\BreveBundle\Entity\Breve;

use TDN\DocumentBundle\Entity\DocumentType;
use TDN\DocumentBundle\Form\Type\selecteurRubriquesType;
use TDN\DocumentBundle\Entity\DocumentRubrique;

class AdminController extends Controller {
	
	public function logAction () {

		$variables['rubrique'] = 'tdn';
		$variables['brevesList'] = array();
		$variables['colonnesList'] = array('Message', 'Rubrique');
		$variables['actionsList'] = array('(Dé)Publier', 'Liste noire', 'Supprimer');
		$variables['actionsRoutesList'] = array('BreveBundle_publier', 'BreveBundle_addBlacklist', 'BreveBundle_supprimer');
		$variables['selectList'] = array(
			array('value' => 'message', 'texte' => 'Message'),
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
			$variables['brevesList'] = $em->getRepository('TDN\BreveBundle\Entity\Breve')->findBy($where);
		} else {
			$variables['isSelectedField'] = "";
			$variables['isSelectedValeur'] = "";
			$variables['brevesList'] = $em->getRepository('TDN\BreveBundle\Entity\Breve')->findMostRecent(200);
		}

		return $this->render('BreveBundle:Admin:breveLog.html.twig', $variables);
	}

	public function ajouterAction () {

		$request = $this->get('request');

		$variables['rubrique'] = 'tdn';
		// Affichage de la page

		// Instanciation du formulaire
		$breve = new Breve;
		$form = $this->createForm(new BreveType, $breve);

		if ($request->getMethod() == "POST") {

			$em = $this->get('doctrine.orm.entity_manager');
			$usr= $this->get('security.context')->getToken()->getUser();

			$blackListed = $usr->getBlacklist() === 0;
			if ($blackListed) {

			} else {
				$form->bind($request);
				$breve->setStatut("BREVE_PUBLIEE");
				$breve->setDatePublication(new \DateTime);
				$breve->setlnAuteur($nana);

				$url = $breve->getUrl();
				if ($url != "") {
					$_tiny = $breve->make_tiny($url);
					if ($_tiny != 'ERROR') {
						$breve->setTinyURL($breve->make_tiny($url));
					}
				}

				$em->persist($breve);
				$em->flush();

				return $this->render('BreveBundle_breveLog');
			}
		}

		// Affichage
		$variables['form'] = $form->createView();
		return $this->render('BreveBundle:Admin:postForm.html.twig', $variables);
	}

	public function editerAction ($id) {

		$request = $this->get('request');

		$variables['rubrique'] = 'tdn';
		// Affichage de la page

		// Instanciation du formulaire
		$em = $this->get('doctrine.orm.entity_manager');
		$rep = $em->getRepository('TDN\BreveBundle\Entity\Breve');
		$breve = $rep->find($id);
		$form = $this->createForm(new BreveType, $breve);

		if ($request->getMethod() == "POST") {

			$em = $this->get('doctrine.orm.entity_manager');
			$usr= $this->get('security.context')->getToken()->getUser();

			$form->bind($request);
			$url = $breve->getUrl();
			if ($url != "") {
				$breve->setTinyURL($breve->make_tiny($url));
			}

			$em->flush();

			$this->get('session')->getFlashBag()->add('success', 'L’info a bien été mise à jour');
			return $this->redirect($this->generateURL('BreveBundle_breveLog'));
		}

		// Affichage
		$variables['form'] = $form->createView();
		$variables['id'] = $breve->getId();
		return $this->render('BreveBundle:Admin:relectureBreve.html.twig', $variables);
	}

	public function enregistrerAction () {

		$variables['rubrique'] = 'tdn';
		$request = $this->get('request');

		$breve = new Breve;
		$form = $this->createForm(new BreveType, $breve);
		// Instanciation du formulaire des Rubriques
		$theme = new DocumentRubrique;
		$formRubrique = $this->createForm(new selecteurRubriquesType, $theme);

		if ($request->getMethod() == "POST") {

			$em = $this->get('doctrine.orm.entity_manager');
			$rep_nana = $em->getRepository('TDN\NanaBundle\Entity\Nana');
			$usr= $this->get('security.context')->getToken()->getUser();
			$nana = $rep_nana->find($usr->getIdNana());
			// $blackListed = $nana->getBlacklist() === 0;
			$blackListed = false;
			if ($blackListed) {

			} else {
				$form->bind($request);
				// $breve->setStatut("public");
				$breve->setDatePublication(new \DateTime);
				$breve->setlnAuteur($nana);

				$url = $breve->getUrl();
				if ($url != "") {
					$breve->setTinyURL($breve->make_tiny($url));
				}

				$formRubrique->bindRequest($request);
				foreach ($theme->rubriques->toArray() as $theme) {
					$breve->setLnRubrique($theme);
				}

				$breve->setStatut(1);

				$em->persist($breve);
				$em->flush();
			}
		}
		return $this->redirect($this->generateURL('BreveBundle_breveLog'));
	}

	function supprimerAction ($id) {

		$em = $this->get('doctrine.orm.entity_manager');
		$rep = $em->getRepository('TDN\BreveBundle\Entity\Breve');
		$breve = $rep->find($id);

		$em->remove($breve);
		$em->flush();

		return $this->redirect($this->generateURL('BreveBundle_breveLog'));
	}

	function publierAction ($id) {

		$em = $this->get('doctrine.orm.entity_manager');
		$rep = $em->getRepository('TDN\BreveBundle\Entity\Breve');
		$breve = $rep->find($id);

		$breve->setStatut(($breve->getStatut() === 'BREVE_RECUE') ? 'BREVE_PUBLIEE' : 'BREVE_MASQUEE');

		$em->flush();

		return $this->redirect($this->generateURL('BreveBundle_breveLog'));
	}

	function blacklistAction ($id) {

		$em = $this->get('doctrine.orm.entity_manager');
		$rep = $em->getRepository('TDN\BreveBundle\Entity\Breve');
		$breve = $rep->find($id);
		$nana = $breve->getLnAuteur();

		$nana->setBlacklist(1);

		$em->flush();

		return $this->redirect($this->generateURL('BreveBundle_breveLog'));
	}
}
