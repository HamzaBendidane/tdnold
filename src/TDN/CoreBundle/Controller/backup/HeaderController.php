<?php

namespace TDN\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TDN\CoreBundle\Entity\Journal;

class HeaderController extends Controller {

    public function displayAction () {

    	// $me = $this->getUser();
        $em = $this->get('doctrine.orm.entity_manager');      
        // $rep_journal = $em->getRepository('TDN\CoreBundle\Entity\JournalRepository');
		$security = $this->container->get('security.context');


    	if ($security->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
			$me = $security->getToken()->getUser();
    		$slots['username'] = $me->getUsername();
            $slots['avatar'] = $me->getLnAvatar();
    		foreach ($me->getRoles() as $r) {
    			$my_roles[] = $r->getName();
    		}
    		$slots['statut'] = "(".implode(',', $my_roles).")";
            $slots['me'] = $me;

            $id = $me->getIdNana();
            // $slots['textes'] = $rep_journal->findMyJournal($id, array('COMMENTAIRE', 'REPONSE', 'REPONSE_COMMENTAIRE'));
            // $slots['likes'] = $rep_journal->findMyJournal($id, array('AIME'));
            // $slots['follows'] = $rep_journal->findMyJournal($id, array('FOLLOW'));

            $alertes = $me->getFilAlertes();
            $slots['gain'] = 0;
            foreach($alertes as $entree) {
                $action = $entree->getAction();
                switch ($action) {
                    case 'UPGRADE':
                        $slots['gain'] += 1;
                        break;
                    
                    default:
                        break;
                }
            }
        }
        
        $slots['perso'] = "";
        $slots['activite'] = "";
        $slots['relations'] = "";

		return $this->render('CoreBundle:Bloc:header.html.twig', $slots);
	}
}