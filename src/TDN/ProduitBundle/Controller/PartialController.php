<?php

namespace TDN\ProduitBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PartialController extends Controller
{
    public function panoramaCoupsDeCoeurAction($limite = 8)
    {
	    $em = $this->get('doctrine.orm.entity_manager');      
		$rep = $em->getRepository('TDN\ProduitBundle\Entity\Produit');
		// $variables['coupsDeCoeur'] = $rep->findBy(array('favori' => '1'), array('datePublication' => 'DESC'), $limite);
		$variables['coupsDeCoeur'] = $rep->selectionPanorama($limite);

		return $this->render('ProduitBundle:Bloc:panoramaCoupsDeCoeur.html.twig', $variables);
    }
}
