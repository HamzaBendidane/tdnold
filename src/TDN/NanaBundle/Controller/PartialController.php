<?php

namespace TDN\NanaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PartialController extends Controller
{
    public function showSelectionNanasAction($limite = 10)
    {
   	// Récupération de l'entity manager qui va nous permettre de gérer les entités.
	    $em = $this->get('doctrine.orm.entity_manager');      
		$repNana = $em->getRepository('TDN\NanaBundle\Entity\Nana');

		// Récupération de la question la plus récente
		$variables['selectionNanas'] = $repNana->selectionNanas($limite);
		$variables['nanaDeLaSemaine'] = $repNana->nanaDeLaSemaine();
		$variables['cardInscrits'] = $repNana->count('all');

        return $this->render('NanaBundle:Bloc:footerWidget.html.twig', $variables);
    }
}
