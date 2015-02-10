<?php

namespace TDN\ConseilExpertBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use TDN\ConseilExpertBundle\Entity\ConseilExpert;

class PartialController extends Controller {
	
	protected $clefs = array(
		'nos-looks' => array('look', 'style', 'Relooking', 'morphologie', 'star', 'people', 'actrice', 'Blair', 'pretty little liars'),
		'accessoires-et-shoes' => array('accessoires', 'shoes', 'chaussures', 'bijoux'),
		'bonnes-affaires' => array( 'bons plans', 'soldes', 'promotions', 'réductions', 'conseils'));

	public function conseilsRecentsAction ($limite = 20, $panel = NULL) {

	    $em = $this->get('doctrine.orm.entity_manager');      
		$repConseil = $em->getRepository('TDN\ConseilExpertBundle\Entity\ConseilExpert');
		if (is_array($panel)) {
			$_t = array_intersect($panel, array_keys($this->clefs));
			$isException = !empty($_t);
		} else {
			$isException = in_array($panel, array_keys($this->clefs));	
		}

		if (!empty($isException)) {
			$variables['conseilsRecents'] = $repConseil->findMostRecentWithKeys($limite, $this->clefs[$panel[0]]);

		} else {
			$variables['conseilsRecents'] = $repConseil->findMostRecent($limite, $panel);
		}

		return $this->render('ConseilExpertBundle:Bloc:conseilsRecents.html.twig', $variables);
	}

	public function conseilsPlusLusAction ($limite = 3, $panel = NULL, $shuffle = 30) {

	    $em = $this->get('doctrine.orm.entity_manager');      
		$repConseil = $em->getRepository('TDN\ConseilExpertBundle\Entity\ConseilExpert');
		if (is_array($panel)) {
			$_t = array_intersect($panel, array_keys($this->clefs));
			$isException = !empty($_t);
		} else {
			$isException = in_array($panel, array_keys($this->clefs));	
		}

		if (!empty($isException)) {
			$conseilsPlusLus = $repConseil->findMostReadWithKeys($shuffle, $this->clefs[$panel[0]]);

		} else {
			$conseilsPlusLus = $repConseil->findMostRead($shuffle, $panel);
		}
		shuffle($conseilsPlusLus);
		$variables['conseilsPlusLus'] = array_slice($conseilsPlusLus, 0, $limite);
		$s = array();
		
		return $this->render('ConseilExpertBundle:Bloc:conseilsPlusLus.html.twig', $variables);
	}
}