<?php

namespace TDN\CauseuseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PartialController extends Controller
{
    public function showFooterWidgetAction($limite)
    {
    	// Récupération de l'entity manager qui va nous permettre de gérer les entités.
	    $em = $this->get('doctrine.orm.entity_manager');      

		// Récupération de la question la plus récente
		$repCauseuse = $em->getRepository('TDN\CauseuseBundle\Entity\Question');
		$variables['questionsRecentes'] = $repCauseuse->findMostRecent($limite);

        return $this->render('CauseuseBundle:Bloc:footerWidget.html.twig', $variables);
    }
}
