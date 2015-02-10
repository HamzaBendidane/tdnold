<?php

namespace TDN\DossierRedactionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TDN\DossierRedactionBundle\Entity\Dossier;

class PartialController extends Controller
{
    public function showDossierSidebarAction()
    {
	    // Récupération de l'entity manager qui va nous permettre de gérer les entités.
	    $em = $this->get('doctrine.orm.entity_manager');      

		// Instanciation du Repository
		$repository = $em->getRepository('TDN\DossierRedactionBundle\Entity\Dossier');
		$result = $repository->findLast();
		if (count($result) > 0) {
			$variables['dossier'] = $result[0];
		} else {
			$variables['dossier'] =  $result;
		}

        return $this->render('DossierRedactionBundle:Bloc:blocDossierSidebar.html.twig', $variables);
    }

}
