<?php

namespace TDN\RedactionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use TDN\CommentaireBundle\Entity\Commentaire;
use TDN\RedactionBundle\Entity\SelectionShopping;

class ShoppingController extends Controller {
    
	protected function cutText($completeArticle) {
		
	}

    public function showAction($rubrique, $slug, $id) {
	
	    $em = $this->get('doctrine.orm.entity_manager');      
		$repository = $em->getRepository('TDN\RedactionBundle\Entity\SelectionShopping');

		/* Tableau qui va stocker toutes les données à remplacer dans le template twig */
	    $variables = array();  
	    $variables['rubrique'] = 'tdn';

		$variables['selection'] = $repository->find($id);

		if (!($variables['selection'] instanceof SelectionShopping)) {
			$this->get('session')->getFlashBag()->add('fail', 'Désolé, ette page n’existe pas');
			return $this->redirect($this->generateURL('Core_home'));
		} else {
			// Suppression du flag de veille pour les notifications myTDN
	    	$request = $this->get('request');
	    	$entreeID = $request->query->get('razj');
	    	if (!empty($entreeID)) {
				$rep_journal = $em->getRepository('TDN\CoreBundle\Entity\Journal');
				$entree = $rep_journal->find($entreeID);
				$entree->setLnVeilleur(NULL);
	    	}

			$rubriques = $variables['selection']->getRubriques();
			$variables['rubrique'] = $rubriques[0]->getSuperSlug();

			$variables['selection']->updateHits();
			$em->flush();

			$variables['auteur'] = $variables['selection']->getLnAuteur();
				
			// Affichage de la page
			return $this->render('RedactionBundle:Default:shopping.html.twig', $variables);
		}
    }
}
