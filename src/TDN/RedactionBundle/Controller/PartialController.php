<?php

namespace TDN\RedactionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use TDN\RedactionBundle\Entity\Article;

class PartialController extends Controller {
	
	public function articlesRecentsAction ($limite = 20, $panel = NULL) {

	    $em = $this->get('doctrine.orm.entity_manager');      
		$rep = $em->getRepository('TDN\RedactionBundle\Entity\Article');
		$rep_sel = $em->getRepository('TDN\RedactionBundle\Entity\SelectionShopping');
		$selectionsRecentes = $rep_sel->findMostRecent($limite, $panel);
		$articlesRecents = $rep->findMostRecent($limite, $panel);
		$variables['articlesRecents'] = array();
		for ($i = 0; $i < $limite; $i++) {
			if (empty($selectionsRecentes)) {
				$variables['articlesRecents'] = array_merge($variables['articlesRecents'], $articlesRecents);
				break;
			} elseif (empty($articlesRecents)) {
				$variables['articlesRecents'] = array_merge($variables['articlesRecents'], $selectionsRecentes);
				break;
			} else {
				if ($selectionsRecentes[0]->getDatePublication() > $articlesRecents[0]->getDatePublication()) {
					$variables['articlesRecents'][] = array_shift($selectionsRecentes);
				} else {
					$variables['articlesRecents'][] = array_shift($articlesRecents);
				}					
			}
		}
		return $this->render('RedactionBundle:Bloc:articlesRecents.html.twig', $variables);
	}

	public function articlesPlusLusAction ($limite = 3, $panel = NULL, $shuffle = 30) {

	    $em = $this->get('doctrine.orm.entity_manager');      
		$rep = $em->getRepository('TDN\RedactionBundle\Entity\Article');
		$articlesPlusLus = $rep->findMostRead($shuffle, $panel);
		shuffle($articlesPlusLus);
		$variables['articlesPlusLus'] = array_slice($articlesPlusLus, 0, 3);

		return $this->render('RedactionBundle:Bloc:articlesPlusLus.html.twig', $variables);
	}
}