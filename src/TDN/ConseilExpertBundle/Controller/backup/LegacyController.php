<?php

namespace TDN\ConseilExpertBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use TDN\CommentaireBundle\Entity\Commentaire;
use TDN\ConseilExpertBundle\Entity\ConseilExpert;

class LegacyController extends Controller {
    
	protected function cutText($completeArticle) {
		
	}

    public function conseilAction($rubrique = NULL, $slug = NULL, $id, $page) {
	
	    $em = $this->get('doctrine.orm.entity_manager');      
		$rep_conseils = $em->getRepository('TDN\ConseilExpertBundle\Entity\ConseilExpert');
		$conseil = $rep_conseils->findOneByV2ID($id);
		if ($conseil instanceof ConseilExpert) {
			$rubriques = $conseil->getRubriques();
	    	$vars['rubrique'] = $rubriques[0]->getSlug();
	    	$vars['slug'] = $conseil->getSlug();
	    	$vars['id'] = $conseil->getIdDocument();
			return $this->redirect($this->generateURL('ConseilExpert_conseil', $vars), 301);			
		} else {
			return $this->redirect($this->generateURL('Core_home'), 302);
		}
    }

    public function conseilV1Action($slug = NULL, $id, $page) {
	    $em = $this->get('doctrine.orm.entity_manager');      
		$repository = $em->getRepository('TDN\ConseilExpertBundle\Entity\ConseilExpert');
		$article = $repository->findOneByV1ID('c.'.$id);
		if ($article instanceof ConseilExpert) {
			$_r = $article->getRubriques();
			// Redirection vers la nouvelle page
	    	$vars['rubrique'] = $_r[0]->getSlug();
	    	$vars['slug'] = $article->getSlug();
	    	$vars['id'] = $article->getIdDocument();
			return $this->redirect($this->generateURL('ConseilExpert_conseil', $vars), 301);
		} else {
			return $this->redirect($this->generateURL('_welcome', array()), 301);
		}
	}

    public function goneAction () {
        $response = $this->render('CoreBundle:Errors:410-gone.html.twig', array('rubrique' => 'tdn'));
        return new Response($response, 410);
    }
}
