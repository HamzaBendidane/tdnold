<?php

namespace TDN\QuizBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TDN\QuizBundle\Entity\Quiz;

class PartialController extends Controller
{
    public function showQuizSidebarAction()
    {
	    // Récupération de l'entity manager qui va nous permettre de gérer les entités.
	    $em = $this->get('doctrine.orm.entity_manager');      

		// Instanciation du Repository
		$repository = $em->getRepository('TDN\QuizBundle\Entity\Quiz');
		$result = $repository->findLast();
		if (count($result) > 0) {
			$variables['quiz'] = $result[0];
		} else {
			$variables['quiz'] =  $result;
		}

        return $this->render('QuizBundle:Bloc:blocQuizSidebar.html.twig', $variables);
    }

}
