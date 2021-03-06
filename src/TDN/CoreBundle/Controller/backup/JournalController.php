<?php

namespace TDN\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class JournalController extends Controller {

    public function displayAction () {

        // Récupération de l'entity manager qui va nous permettre de gérer les entités.
        $em = $this->get('doctrine.orm.entity_manager');      

        // Récupération de la question la plus récente
        $rep = $em->getRepository('TDN\CoreBundle\Entity\Journal');
        $variables['entrees'] = $rep->findMostRecent(20);

		return $this->render('CoreBundle:Bloc:journal.html.twig', $variables);
	}

	public function razAlertesAction () 
	{
		$em = $this->get('doctrine.orm.entity_manager');      
        $rep_journal = $em->getRepository('TDN\CoreBundle\Entity\Journal');
		$security = $this->get('security.context');
		$request = $this->get('request');

		$veilleur = $security->getToken()->getUser();
		$actions = $request->get('actions'); 
		
		switch ($actions) {
			case 'messages':
				$keyActions = array('COMMENTAIRE', 'REPONSE', 'REPONSE_COMMENTAIRE');
				break;
			
			case 'likes':
				$keyActions = array('AIME');
				break;
			
			case 'follows':
				$keyActions = array('SUIT');
				break;
			
			case 'upgrade':
				$keyActions = array('UPGRADE');
				break;
			
			default:
				break;
		}
		
		try {
			$entrees = $rep_journal->findMyJournal($veilleur->getIdNana(), $keyActions);
			foreach ($entrees as $e) {
				$e->setLnVeilleur(NULL);
			}
		} catch (\Exception $e) {
				$this->get('session')->getFlashBag()->add('fail', 'Un erreur a empêché l’effacement de la liste');
		}

		$em->flush();

		return $this->redirect($request->headers->get('referer'));
	}
}