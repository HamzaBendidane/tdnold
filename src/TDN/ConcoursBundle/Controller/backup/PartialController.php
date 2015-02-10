<?php

namespace TDN\ConcoursBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TDN\ConcoursBundle\Entity\Concours;
use TDN\ConcoursBundle\Entity\ConcoursParticipant;
use TDN\ConcoursBundle\Form\Type\ConcoursParticipationType;
use TDN\ConcoursBundle\Form\Model\Invitations;
use TDN\ConcoursBundle\Form\Type\InvitationType;
use TDN\NanaBundle\Entity\Nana;

class PartialController extends Controller
{
    public function showConcoursSidebarAction()
    {
	    $variables['rubrique'] = 'tdn';
	    // Récupération de l'entity manager qui va nous permettre de gérer les entités.
	    $em = $this->get('doctrine.orm.entity_manager');      

		// Instanciation du Repository
		$repository = $em->getRepository('TDN\ConcoursBundle\Entity\Concours');
		$result = $repository->findLastActive();
		if (count($result) > 0) {
			$variables['concours'] = $result[0];
		} else {
			$variables['concours'] =  $result;
		}

        return $this->render('ConcoursBundle:Bloc:blocConcoursSidebar.html.twig', $variables);
    }

}
