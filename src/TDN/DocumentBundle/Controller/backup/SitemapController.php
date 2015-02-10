<?php

namespace TDN\DocumentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TDN\DocumentBundle\Entity\Slider;
use TDN\DocumentBundle\Form\Type\SlideInspecteurType;


class SitemapController extends Controller
{
    
	public function makeAction ($docType = 'article', $annee = NULL)
	{
		if (($docType != 'actu') && is_null($annee)) {
			$now = new \DateTime();
			$annee = $now->format('Y');
		}
	    $em = $this->get('doctrine.orm.entity_manager');      
	    $mapper = $this->get('tdn.core.urlsitemapper');

	    if ($docType == 'actu') {
	    	$err = $mapper->actu();
	    } else {
			$err = $mapper->make($docType, (integer)$annee);
	    }

		echo 'Done';
		die;
        // return $this->render('DocumentBundle:Slider:sliderPlayer.html.twig', $variables);
	}
}