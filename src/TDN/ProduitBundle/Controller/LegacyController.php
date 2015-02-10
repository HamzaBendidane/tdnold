<?php

namespace TDN\ProduitBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;

use TDN\CommentaireBundle\Entity\Commentaire;
use TDN\ProduitBundle\Entity\Produit;

class LegacyController extends Controller {
    
	protected function cutText($completeArticle) {
		
	}

    public function showDefaultAction($rubrique = NULL, $slug, $id) {
	
	    $em = $this->get('doctrine.orm.entity_manager');      
		$rep_produits = $em->getRepository('TDN\ProduitBundle\Entity\Produit');
		$produit = $rep_produits->findOneByV2ID($id);
		if ($produit instanceof Produit) {
			$rubriques = $produit->getRubriques();
			// Redirection vers la nouvelle page
	    	$vars['rubrique'] = $rubriques[0]->getSlug();
	    	$vars['slug'] = $produit->getSlug();
	    	$vars['id'] = $produit->getIdDocument();
	    	print_r($vars);
			return $this->redirect($this->generateURL('Produit_showProduit', $vars), 301);			
		} else {
			$this->get('session')->getFlashBag()->add('fail', 'Le produit que tu cherches n’est plus chroniqué dans la nouvelle version du site.');
			return $this->redirect($this->generateURL('Produit_catalogue'), 301);
		}
    }
    public function goneAction () {
			$this->get('session')->getFlashBag()->add('fail', 'Le produit que tu cherches n’est plus chroniqué dans la nouvelle version du site.');
			return $this->redirect($this->generateURL('Produit_catalogue'), 301);
    }

}
