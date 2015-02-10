<?php

namespace TDN\DocumentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use TDN\DocumentBundle\Entity\Document;

class PartialController extends Controller {
	
	public function redactionRecentsAction ($limite = 30, $panel = NULL) {

	    $em = $this->get('doctrine.orm.entity_manager');      
		$rep = $em->getRepository('TDN\DocumentBundle\Entity\Document');
		return ("<div>".get_class($rep)."</div>");
		$variables['articlesRecents'] = $rep->findMostRecentDocument($limite, array('ARTICLE_PUBLIE', 'SELECTION_PUBLIEE'), $panel);

		return $this->render('RedactionBundle:Bloc:articlesRecents.html.twig', $variables);
	}
}