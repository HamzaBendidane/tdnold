<?php

namespace TDN\RedactionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use TDN\CommentaireBundle\Entity\Commentaire;
use TDN\RedactionBundle\Entity\Article;
use TDN\NanaBundle\Entity\Nana;

class DefaultController extends Controller {
    
	protected function cutText($completeArticle) {
		
	}

    public function articleAction($rubrique, $slug, $id) {

	    $em = $this->get('doctrine.orm.entity_manager');      
		$repository = $em->getRepository('TDN\RedactionBundle\Entity\Article');
	
		/* Tableau qui va stocker toutes les données à remplacer dans le template twig */
	    $variables = array();  
	    $variables['rubrique'] = 'tdn';

		$variables['article'] = $repository->find($id);

		if (!($variables['article'] instanceof Article)) {
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

			$rubriques = $variables['article']->getRubriques();
			$variables['rubrique'] = $rubriques[0]->getSuperSlug();

			$variables['article']->updateHits();
			$em->flush();

			$variables['canonical'] = $this->generateURL('RedactionBundle_article', 
				array('id' => $variables['article']->getIdDocument(),
					  'slug' => $variables['article']->getSlug(),
					  'rubrique' => $rubriques[0]->getSlug())
				);
			$variables['meta_description'] = strip_tags($variables['article']->getAbstract());
			
			// Documents proches (pour aller plus loin)
		    $rep_tags = $em->getRepository('TDN\DocumentBundle\Entity\Tag');
		    $statement = $this->get('database_connection');	    
		    $sims = $rep_tags->findSimilars($id);

		    $rep_docs = $em->getRepository('TDN\DocumentBundle\Entity\Document');
		    $variables['similaires'] = array();
		    foreach($sims as $s) {
		    	$variables['similaires'][] = $rep_docs->find($s['id']);
		    }

		    $variables['paths'] = array(
		    	'Article' => 'RedactionBundle_article',
		    	'ConseilExpert' => 'ConseilExpert_conseil',
		    	'Question' => 'CauseuseBundle_conversation',
		    	'Video' => 'VideoBundle_video',
		    	'Dossier' => 'DossierRedaction_dossier'
		    	);

			// Affichage de la page
			return $this->render('RedactionBundle:Default:article.html.twig', $variables);			
		}
    }
}
