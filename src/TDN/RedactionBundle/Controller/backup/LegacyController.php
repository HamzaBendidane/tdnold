<?php

namespace TDN\RedactionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use TDN\CommentaireBundle\Entity\Commentaire;
use TDN\RedactionBundle\Entity\Article;

class LegacyController extends Controller {

	protected $legacySousRubriquesPairs = array(
		'sorties' => 'bons-plans-sorties',
		'100-web' => '100-pour-cent-web',
		'culture' => 'actu-culture',
		'evenements' => 'a-la-une',
		'musique-au-top' => 'actu-culture',
		'actu' => 'actu-culture',
		// 'vos-envies-nos-idees' => '',
		'cheveux' => 'des-cheveux-au-top',
		'makeup' => 'make-up',
		// 'actu-beaute' => '',
		'soins' => 'le-must-des-soins',
		'le-bio-et-moi' => '',
		'tendance' => 'tendances',
		'sc_shopping' => '',
		// 'coup-de-coeur' => '',
		'girly' => '',
		'le-point-geek' => 'zone-high-tech',
		// 'gadgets-a-gogo' => '',
		'pour-les-nulles' => '',
		'accessoires' => 'accessoires-et-shoes',
		'createurs' => '',
		'bonsplans' => 'bonnes-affaires',
		'fashion' => 'univers-fashion',
		'sante' => 'carnet-de-sante',
		'nutrition' => 'astuces-nutrition',
		'forme' => 'on-se-bouge',
		'no-stress' => 'bien-etre',
		'naturellement' => 'bien-etre',
		// 'parlons-q' => '',
		// '100-psy' => '',
		'temoignages' => 'nos-rencontres',
		// 'love-and-co' => '',
		'gourmande' => 'recettes-gourmandes',
		'minceur' => 'recettes-legeres',
		// 'express' => 'express',
		'festives' => 'recettes-festives'
 		);

	protected $legacyRubriquesPairs = array(
		'alaune' => 'a-la-une',
		'bienetre' => 'bien-etre',
		'sexo' => 'sexo-psycho'
		);

	protected function cutText($completeArticle) {
		
	}

    public function articleAction($rubrique = NULL, $slug = NULL, $id, $page) {
	    $em = $this->get('doctrine.orm.entity_manager');      
		$repository = $em->getRepository('TDN\RedactionBundle\Entity\Article');
		$article = $repository->findOneByV2ID($id);
		if ($article instanceof Article) {
			$_r = $article->getRubriques();
			// Redirection vers la nouvelle page
	    	$vars['rubrique'] = $_r[0]->getSlug();
	    	$vars['slug'] = $article->getSlug();
	    	$vars['id'] = $article->getIdDocument();
			return $this->redirect($this->generateURL('RedactionBundle_article', $vars), 301);
		} else {
			return $this->redirect($this->generateURL('_welcome', array()), 301);
		}
    }

    public function sommaireRubriqueAction ($rubrique) {

    	if (array_key_exists($rubrique, $this->legacyRubriquesPairs)) {
    		$rubrique = $this->legacyRubriquesPairs[$rubrique];
    	}

		return $this->redirect($this->generateURL('Core_sommaire', array('slug' => $rubrique)), 301);
    }

    public function sommaireSousRubriqueAction ($rubrique, $sousRubrique) {

    	if (array_key_exists($sousRubrique, $this->legacySousRubriquesPairs)) {
    		$sousRubrique = $this->legacySousRubriquesPairs[$sousRubrique];
    	}

		return $this->redirect($this->generateURL('Core_sommaire', array('slug' => $sousRubrique)), 301);
    }

    public function articleV1Action($slug = NULL, $id, $page) {
	    $em = $this->get('doctrine.orm.entity_manager');      
		$repository = $em->getRepository('TDN\RedactionBundle\Entity\Article');
		$article = $repository->findOneByV1ID('a.'.$id);
		if ($article instanceof Article) {
			$_r = $article->getRubriques();
			// Redirection vers la nouvelle page
	    	$vars['rubrique'] = $_r[0]->getSlug();
	    	$vars['slug'] = $article->getSlug();
	    	$vars['id'] = $article->getIdDocument();
			return $this->redirect($this->generateURL('RedactionBundle_article', $vars), 301);
		} else {
			return $this->redirect($this->generateURL('_welcome', array()), 301);
		}
	}

    public function tendanceV1Action($slug = NULL, $id, $page) {
	    $em = $this->get('doctrine.orm.entity_manager');      
		$repository = $em->getRepository('TDN\RedactionBundle\Entity\Article');
		$article = $repository->findOneByV1ID('t.'.$id);
		if ($article instanceof Article) {
			$_r = $article->getRubriques();
			// Redirection vers la nouvelle page
	    	$vars['rubrique'] = $_r[0]->getSlug();
	    	$vars['slug'] = $article->getSlug();
	    	$vars['id'] = $article->getIdDocument();
			return $this->redirect($this->generateURL('RedactionBundle_article', $vars), 301);
		} else {
			return $this->redirect($this->generateURL('_welcome', array()), 301);
		}

    }


}
