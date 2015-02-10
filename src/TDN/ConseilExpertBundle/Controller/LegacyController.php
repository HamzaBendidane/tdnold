<?php

namespace TDN\ConseilExpertBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use TDN\CommentaireBundle\Entity\Commentaire;
use TDN\ConseilExpertBundle\Entity\ConseilExpert;

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
		'sexo' => 'sexo-psycho',
		'Bien-être' => 'bien-etre'
		);

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

    public function sommaireRubriqueAction ($rubrique) {

    	if (array_key_exists($rubrique, $this->legacyRubriquesPairs)) {
    		$rubrique = $this->legacyRubriquesPairs[$rubrique];
    	}

		return $this->redirect($this->generateURL('Core_sommaire', array('slug' => $rubrique)), 301);
    }

    public function sommaireSousRubriqueAction ($rubrique, $sousRubrique, $slug) {

    	if (array_key_exists($sousRubrique, $this->legacySousRubriquesPairs)) {
    		$sousRubrique = $this->legacySousRubriquesPairs[$sousRubrique];
    	}

		return $this->redirect($this->generateURL('Core_sommaire', array('slug' => $sousRubrique)), 301);
    }

    public function goneAction () {
        $response = $this->render('CoreBundle:Errors:410-gone.html.twig', array('rubrique' => 'tdn'));
        return new Response($response, 410);
    }
}
