<?php

namespace TDN\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function dashboardAction()
    {
	    // Récupération de l'entity manager qui va nous permettre de gérer les entités.
	    $em = $this->get('doctrine.orm.entity_manager');
	    $rep_articles = $em->getRepository('TDN\RedactionBundle\Entity\Article');
	    $rep_conseils = $em->getRepository('TDN\ConseilExpertBundle\Entity\ConseilExpert');
	    $rep_videos = $em->getRepository('TDN\VideoBundle\Entity\Video');

		$usr= $this->get('security.context')->getToken()->getUser();

		// Articles brouillons
		if ($this->get('security.context')->isGranted('ROLE_ADMIN')) {
			$variables['articlesBrouillons'] = $rep_articles->findBy(
				array('statut' => 'ARTICLE_BROUILLON'),
				array('datePublication' => 'DESC'));
		} elseif ($this->get('security.context')->isGranted('ROLE_JOURNALISTE')) {
			$variables['articlesBrouillons'] = $rep_articles->findBy(
				array(
					'lnAuteur' => $usr, 
					'statut' => 'ARTICLE_BROUILLON'),
				array('datePublication' => 'DESC'));
		} else {}

		// Conseils à dispatcher
		if ($this->get('security.context')->isGranted('ROLE_ADMIN')) {
			$variables['conseilsDispatch'] = $rep_conseils->findBy(array('statut' => 'CONSEIL_ENREGISTRE'));
		}

		// Conseils en attente de réponse
		if ($this->get('security.context')->isGranted('ROLE_ADMIN')) {
			$variables['conseilsRepondre'] = $rep_conseils->findBy(array('statut' => 'CONSEIL_TRANSMIS'));
		} elseif ($this->get('security.context')->isGranted('ROLE_EXPERT')) {
			$variables['conseilsRepondre'] = $rep_conseils->findBy(
				array(
					'lnExpert' => $usr, 
					'statut' => 'CONSEIL_TRANSMIS'));
		}

		// Conseils à publier
		if ($this->get('security.context')->isGranted('ROLE_ADMIN')) {
			$variables['conseilsPublier'] = $rep_conseils->findBy(array('statut' => 'CONSEIL_REPONDU'));
		}

		// Vidéos à publier
		if ($this->get('security.context')->isGranted('ROLE_ADMIN')) {
			$where = array('statut' => 'VIDEO_PROPOSEE');
			$variables['videosPublier'] = $em->getRepository('TDN\VideoBundle\Entity\Video')->findBy($where);
		}

		// Questions de nanas à valider
		if ($this->get('security.context')->isGranted('ROLE_ADMIN')) {
			$where = array('statut' => 'QUESTION_POSEE');
			$variables['questionPublier'] = $em->getRepository('TDN\CauseuseBundle\Entity\Question')->findByStatut('QUESTION_POSEE');
		}

		// Commentaires à modérer
		if ($this->get('security.context')->isGranted('ROLE_ADMIN')) {
			$where = array('statut' => 'COMMENT_QUARANTAINE');
			// $variables['commentaires'] = $em->getRepository('TDN\CommentaireBundle\Entity\Commentaire')->findBy($where);
			$variables['commentaires'] = NULL;
		}
		if (isset($variables)) {
        	return $this->render('CoreBundle:Admin:dashboard.html.twig', $variables);
		} else {
			return $this->redirect($this->generateURL('Core_home'));
		}
    }
}
