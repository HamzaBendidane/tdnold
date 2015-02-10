<?php

namespace TDN\ProduitBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PublicController extends Controller
{
	private $em;
	private $rep;

	function construct () {
		// parent::__construct();
	    // Récupération de l'entity manager qui va nous permettre de gérer les entités.
	    $this->em = $this->get('doctrine.orm.entity_manager');      
		$this->rep = $this->em->getRepository('TDN\ProduitBundle\Entity\Produit');
	}

	protected function setSelection ($request, $session) {
		if ($request->isMethod('POST')) {
			$tag = $request->get('tag');
			$session->set('tri-produit', $tag);
			$page = 0;
		} else {
			$reset = $request->query->get('set');
			if ($reset = 'tout') {
				$tag = $session->remove('tri-produit');
				$tag = '';
				$page = 0;
			} else {
				$page = $request->query->get('page');
				$page = ((int)$page === 0) ? 0 : (int)$page - 1;
				$tag = $session->get('tri-produit');
			}
		}
		
		return array($page, $tag);
	}

    public function catalogueAction($id = NULL)
    {
		$longueurPage = 40;
		$session = $this->get('session');
		$request = $this->get('request');

		list($page, $tag) = $this->setSelection($request, $session);

	    // Récupération de l'entity manager qui va nous permettre de gérer les entités.
	    $em = $this->get('doctrine.orm.entity_manager');      
		$rep = $em->getRepository('TDN\ProduitBundle\Entity\Produit');
	    if (empty($tag)) {
	    	$vars['produits'] = $rep->findBy(array('statut' => 'PRODUIT_PUBLIE'), NULL, $longueurPage, 1+$page*($longueurPage-1));
	    } else {
	    	$vars['produits'] = $rep->findByTagKey($tag, $longueurPage, $page);
	    }
	 //    $variables['totalProduits'] = $rep->count('on');
		// $variables['totalProduits'] = array_pop($variables['totalProduits']);
		$vars['totalProduits'] = count($vars['produits']);
		$vars['vedette'] = array_pop($vars['produits']);
	    // $nombreVideos = $rep->compteVideos();

		$largeurSegment = 4;
		$vars['tag'] = ('tdn' == $tag) ? '' : $tag;

		$vars['rubrique'] = 'tdn';
		$vars['page'] = $page + 1;
		$vars['derniere'] = ceil($vars['totalProduits'] / $longueurPage);
		// $variables['derniere'] = ceil($variables['totalVideos'] / $longueurPage);

		// Affichage de la page
        return $this->render('ProduitBundle:Page:pageProduits.html.twig', $vars);
    }

       public function showProduitAction ($id , $slug)
    {
		$longueurPage = 40;
		$session = $this->get('session');
		$request = $this->get('request');

		$page = $request->query->get('page');
		$page = ((int)$page === 0) ? 0 : (int)$page - 1;
		$tag = array();

	    // Récupération de l'entity manager qui va nous permettre de gérer les entités.
	    $em = $this->get('doctrine.orm.entity_manager');      
		$rep = $em->getRepository('TDN\ProduitBundle\Entity\Produit');
	    // $listeVideos = $rep->findWithin($longueurPage);
	    if (empty($tag)) {
	    	$vars['produits'] = $rep->findBy(array('statut' => 'PRODUIT_PUBLIE'), NULL, $longueurPage, 1+$page*($longueurPage-1));
		    $vars['totalProduits'] = $rep->count();
	    } else {
	    	$vars['produits'] = $rep->findByTagKey($tag, $longueurPage, $page);
		    $vars['totalProduits'] = $rep->count($tag);
	    }
	 //    $variables['totalProduits'] = $rep->count('on');
		// $variables['totalProduits'] = array_pop($variables['totalProduits']);
		$vars['vedette'] = $rep->find($id);
	    // $nombreVideos = $rep->compteVideos();

		// $rep = $em->getRepository('TDN\DocumentBundle\Entity\DocumentRubrique');
		// $variables['rubriques'] = $rep->findBy(array('parent' => NULL));
		// $_objRubrique = $rep->findBySlug($rubrique);
		// $_objRubrique = array_pop($_objRubrique);

		$largeurSegment = 4;
		$vars['tag'] = ('tdn' == $tag) ? '' : $tag;

		$vars['rubrique'] = 'tdn';
		$vars['page'] = $page + 1;
		$vars['derniere'] = ceil($vars['totalProduits'] / $longueurPage);
		// $variables['derniere'] = ceil($variables['totalVideos'] / $longueurPage);

		// Affichage de la page
        return $this->render('ProduitBundle:Page:pageProduits.html.twig', $vars);
    }

}
