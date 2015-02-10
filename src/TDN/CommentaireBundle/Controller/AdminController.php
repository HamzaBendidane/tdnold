<?php

namespace TDN\CommentaireBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class AdminController extends Controller
{
    
    public function publierAction($id)
    {
	    $em = $this->get('doctrine.orm.entity_manager');      
		$rep_comms = $em->getRepository('TDN\CommentaireBundle\Entity\Commentaire');
		$comm = $rep_comms->find($id);

		$comm->setStatut(1);
		$em->flush();

        return new Response("<p>Commentaire publié</p>");
    }

        public function effacerAction($id)
    {
	    $em = $this->get('doctrine.orm.entity_manager');      
		$rep_comms = $em->getRepository('TDN\CommentaireBundle\Entity\Commentaire');
		$comm = $rep_comms->find($id);

		$em->remove($comm);
		$em->flush();

        return new Response("<p>Commentaire effacé</p>");
    }

}
