<?php

namespace TDN\VideoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use TDN\CommentaireBundle\Entity\Commentaire;
use TDN\VideoBundle\Entity\Video;

class LegacyController extends Controller {
    
	protected function cutText($completeArticle) {
		
	}

    public function videoAction($rubrique = NULL, $slug, $id) {
	
	    $em = $this->get('doctrine.orm.entity_manager');      
		$rep_conseils = $em->getRepository('TDN\VideoBundle\Entity\Video');
		$video = $rep_conseils->findOneByV2ID($id);
		if ($video instanceof Video) {
			$rubriques = $video->getRubriques();
			// Redirection vers la nouvelle page
	    	$vars['rubrique'] = $rubriques[0]->getSlug();
	    	$vars['slug'] = $video->getSlug();
	    	$vars['id'] = $video->getIdDocument();
	    	print_r($vars);
			return $this->redirect($this->generateURL('VideoBundle_video', $vars), 301);			
		} else {
			return $this->redirect($this->generateURL('Core_home'), 302);
		}
    }

    public function videoRubriqueIndexAction($rubrique) {

    	$pairs = array('alaune' => 'a-la-une', 'sexo' => 'sexo-psycho', 'bienetre' => 'bien-etre', 'hightech' => 'geekette');

		if (in_array($rubrique, array_keys($pairs))) {
			$rubrique = $pairs[$rubrique];
		}	
		return $this->redirect($this->generateURL('VideoBundle_sommaire')."?rubrique=$rubrique", 301);			
    }
}
