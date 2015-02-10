<?php

namespace TDN\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use TDN\BreveBundle\Form\Type\BreveType;
use TDN\BreveBundle\Entity\Breve;
use TDN\CoreBundle\Form\Type\ContactType;
use TDN\CoreBundle\Form\Model\Contact;

class DefaultController extends Controller
{
    public function homeAction()
    {
     	// Récupération de l'entity manager qui va nous permettre de gérer les entités.
	    $em = $this->get('doctrine.orm.entity_manager');      
	    $textProcessor = $this->get('tdn.core.textprocessor');      

		// Récupération de la question la plus récente
		$repCauseuse = $em->getRepository('TDN\CauseuseBundle\Entity\Question');
		$dernieresQuestions = $repCauseuse->findMostRecent(5);
		if ($dernieresQuestions) {
			$index = array_rand($dernieresQuestions);
			$variables['question'] = $dernieresQuestions[$index];
			$variables['ageAuteurDerniereQuestion'] = $variables['question']->getLnAuteur()->getAge('string');
		}
		
		// Récupération des dernières vidéos
		$repVideo = $em->getRepository('TDN\VideoBundle\Entity\Video');
		$variables['videosRecentes'] = $repVideo->findMostRecent(4);
		$variables['video'] = array_shift($variables['videosRecentes']);
		// print_r($variables['video']);
		if (!empty($variables['video'])) {		
			$hebergeur = $variables['video']->getIdHebergeur();
			$abstract = $variables['video']->getAbstract();
			$variables['videoAbstract'] = $textProcessor->flattenAtSeparator($abstract, 120);
			$vLink = $this->generateURL('VideoBundle_video', array(
				'id' => $variables['video']->getIdDocument(),
				'slug' => $variables['video']->getSlug(),
				// 'rubrique' => 'geekette'));
				'rubrique' => $variables['video']->getlnThematique()->getSlug()));
			$variables['videoAbstract'] .= $variables['videoAbstract'] === $abstract ? '' : ' (&hellip;&nbsp;suite)';
			$variables['videoAbstract'] = '<a href="'.$vLink.'">'.$variables['videoAbstract'].'</a>';
			switch ($hebergeur) {
				case 'dailymotion':
				case '2':
					$params = $variables['video']->getParams();
					$params = json_decode($params);
					$variables['codeIntegration'] = $variables['video']->getCodeIntegration();
					// $variables['codeIntegration'] = str_replace('480', '315', $variables['codeIntegration']);
					$variables['codeIntegration'] = preg_replace('/width="[0-9]+"/', 'width="360"', $variables['codeIntegration']);
					// $variables['codeIntegration'] = str_replace('360', '236', $variables['codeIntegration']);
					$variables['codeIntegration'] = preg_replace('/height="[0-9]+"/', 'height="203"', $variables['codeIntegration']);
					$minutes = floor($variables['video']->getDuree()/60);
					$secondes = $variables['video']->getDuree() - ($minutes * 60);
					$variables['duree'] = $minutes."' ".$secondes."\"";
					break;
				case 'vimeo':
				case '1':
					$ID = $variables['video']->getIdVideo();
					$variables['codeIntegration'] = "<iframe src='http://player.vimeo.com/video/$ID' width='360' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>";
					break;
				case 'youtube':
				case '0':
					$ID = $variables['video']->getIdVideo();
					$variables['codeIntegration'] = "<iframe width='360' height='270' src='https://www.youtube.com/embed/$ID?rel=0' frameborder='0' allowfullscreen></iframe>";
					break;
				default:
					$variables['codeIntegration'] = $variables['video']->getCodeIntegration();
			}
		}

		// Récupération des dernières brèves
		$repBreve = $em->getRepository('TDN\BreveBundle\Entity\Breve');
		$variables['filInfo'] = $repBreve->findMostRecent(10);

		// Instanciation du formulaire
		$formBreve = $this->createForm(new BreveType, new Breve);
		$variables['formBreve'] = $formBreve->createView();

		$rep_rubriques = $em->getRepository('TDN\DocumentBundle\Entity\DocumentRubrique');
		$home = $rep_rubriques->findOneBySlug('home');
		$variables['meta_description'] = $home->getAbstract();
		if (!is_null($home->getSponsorLink())) {
			$variables['rubriqueTarget'] = $home;
			$variables['rubriqueEntity'] = $home;
			$variables['rubrique'] = 'sponsored';
			$variables['sponsorLink'] = $home->getSponsorLink();
			$variables['style'] = 'style="background:url(/assets/images/pub/'.$home->getSponsorImage().') no-repeat fixed 50% top #FFF"';
		} else {
			$variables['rubrique'] = 'tdn';
		}

        return $this->render('CoreBundle:Bloc:homeContent.html.twig', $variables);
    }

    public function sommaireRubriqueAction($slug)
    {
    	$variables['rubrique'] = 'tdn';
    	// Mots-clefs pour les sous-rubriques vides
    	$clefs['nos-looks'] = array('look', 'style', 'Relooking', 'morphologie', 'star', 'people', 'actrice', 'Blair', 'pretty little liars');
    	$clefs['accessoires-et-shoes'] = array('accessoires', 'shoes', 'chaussures', 'bijoux');
    	$clefs['bonnes-affaires'] = array( 'bons plans', 'soldes', 'promotions', 'réductions', 'conseils');
    	// Récupération de l'entity manager qui va nous permettre de gérer les entités.
	    $em = $this->get('doctrine.orm.entity_manager');      

	    switch ($slug) {
	    	case 'beaute':
	    		$variables['titrePage'] = "Astuces beauté, maquillage, coiffure, relooking, conseils pour la peau, soins visage et corps";
	    		break;
	    	case 'mode':
	    		$variables['titrePage'] = "Astuces mode, conseils relooking, shopping, bons plans, looks";
	    		break;
	    	case 'bien-etre':
	    		$variables['titrePage'] = "Conseils forme et bien-être, astuces minceur, régime, nutrition, fitness";
	    		break;
	    	case 'sexo-psycho':
	    		$variables['titrePage'] = "Conseils couple, sexualité, amour, problèmes amoureux , troubles psychologiques";
	    		break;
	    	case 'geekette':
	    		$variables['titrePage'] = "Tendances High-tech, web, nouveautés, innovations, applications, smartphones";
	    		break;
	    	case 'deco':
	    		$variables['titrePage'] = "Tendances décoration, astuces rangements, relooking , DIY, nouveautés déco";
	    		break;
	    	case 'a-la-une':
	    		$variables['titrePage'] = "Interviews d’artistes, rencontres, actualité, musique, culture";
	    		break;
	    	
	    	default:
	    		$variables['titrePage'] = "";
	    }

		$repRubriques = $em->getRepository('TDN\DocumentBundle\Entity\DocumentRubrique');
		$_r = $repRubriques->findOneBySlug($slug);
		$variables['rubriqueEntity'] = $_r;
		$variables['rubriqueTarget'] = $_r;
		$variables['meta_description'] = $_r->getAbstract();
		$now = new \DateTime();
		$isSponsorActive = !(is_null($_r->getSponsorLink()) || ($_r->getDatePublication() > new \DateTime()));
		if ($isSponsorActive) {
			$variables['sponsorLink'] = $_r->getSponsorLink();
		}
		$_ssr = $_r->getSousRubriques();
		if (count($_ssr) === 0) {
			$panel = array($slug);
			$_parent = $_r->getRubriqueParente();
			if (!empty($_parent)) {
				$variables['rubriqueEntity'] = $_parent;
				$variables['rubrique'] = (is_null($_r->getSponsorLink())) ? $_parent->getSlug() : 'sponsored';
		// print_r($variables['rubrique']); die;
			}
		} else {
			$variables['rubrique'] = ($isSponsorActive) ? 'sponsored' : $slug;
			foreach ($_ssr as $_r) {
				$panel[] = $_r->getSlug();
			}
		}

		// Récupération de la question la plus récente
		$repCauseuse = $em->getRepository('TDN\CauseuseBundle\Entity\Question');
		$dernieresQuestions = $repCauseuse->findMostRecent(5, $panel);
		if ($dernieresQuestions) {
			$index = array_rand($dernieresQuestions);
			$variables['question'] = $dernieresQuestions[$index];
			$variables['ageAuteurDerniereQuestion'] = $variables['question']->getLnAuteur()->getAge('string');
		}

		// Récupération des dernières vidéos
		$repVideo = $em->getRepository('TDN\VideoBundle\Entity\Video');

		if (in_array($slug, array_keys($clefs))) {
		$variables['videosRecentes'] = $repVideo->findMostRecentWithKeys(5, $clefs[$slug]);

		}else {
			$variables['videosRecentes'] = $repVideo->findMostRecent(5, $panel);
		}
		$variables['video'] = array_pop($variables['videosRecentes']);
		// print_r($variables['video']);
		if (!empty($variables['video'])) {		
			$hebergeur = $variables['video']->getIdHebergeur();
			$abstract = $variables['video']->getAbstract();
			$variables['videoAbstract'] =  substr(strip_tags($abstract), 0, 100);
			$vLink = $this->generateURL('VideoBundle_video', array(
				'id' => $variables['video']->getIdDocument(),
				'slug' => $variables['video']->getSlug(),
				'rubrique' => $variables['video']->getlnThematique()->getSlug()));
			$variables['videoAbstract'] .= $variables['videoAbstract'] === $abstract ? '' : ' (&hellip;&nbsp;suite)';
			$variables['videoAbstract'] = '<a href="'.$vLink.'">'.$variables['videoAbstract'].'</a>';
			switch ($hebergeur) {
				case 'dailymotion':
				case '2':
					$params = $variables['video']->getParams();
					$params = json_decode($params);
					$variables['codeIntegration'] = $variables['video']->getCodeIntegration();
					$variables['codeIntegration'] = preg_replace('/width="[0-9]+"/', 'width="360"', $variables['codeIntegration']);
					$variables['codeIntegration'] = preg_replace('/height="[0-9]+"/', 'height="203"', $variables['codeIntegration']);
					$minutes = floor($variables['video']->getDuree()/60);
					$secondes = $variables['video']->getDuree() - ($minutes * 60);
					$variables['duree'] = $minutes."' ".$secondes."\"";
					break;
				case 'vimeo':
				// case '1':
					$ID = $variables['video']->getIdVideo();
					$variables['codeIntegration'] = "<iframe src='http://player.vimeo.com/video/$ID' width='360' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>";
					break;
				case 'youtube':
				case '0':
					$ID = $variables['video']->getIdVideo();
					$variables['codeIntegration'] = "<iframe width='360' height='270' src='https://www.youtube.com/embed/$ID?rel=0' frameborder='0' allowfullscreen></iframe>";
			}
		}

		// Récupération de la question la plus récente
		$repArticle = $em->getRepository('TDN\RedactionBundle\Entity\Article');
		$variables['articlesPlusLus'] = $repArticle->findMostRead(3, $panel);

		// Récupération de la question la plus récente
		$repConseil = $em->getRepository('TDN\ConseilExpertBundle\Entity\ConseilExpert');
		$variables['conseilsPlusLus'] = $repConseil->findMostRead(3, $panel);

		// Récupération des dernières brèves
		$repBreve = $em->getRepository('TDN\BreveBundle\Entity\Breve');
		$variables['filInfo'] = $repBreve->findMostRecent(10, $variables['rubrique']);


		// Instanciation du formulaire
		$formBreve = $this->createForm(new BreveType, new Breve);
		$variables['formBreve'] = $formBreve->createView();

		// // Récupération de la question la plus récente
		// $variables['questionsRecentes'] = $repCauseuse->findMostRecent(4);

		// // Récupération de la question la plus récente
		// $repNana = $em->getRepository('TDN\NanaBundle\Entity\Nana');
		// $variables['nanasDernieresInscrites'] = $repNana->findMostRecent(16);

		$variables['panel'] = $panel;
		$variables['isSommaire'] = 'isSommaire';
        return $this->render('CoreBundle:Bloc:sommaireContent.html.twig', $variables);
    }

    public function contactAction () {

    	$variables['rubrique'] = 'tdn';
 		$request = $this->get('request');

    	$contact = new Contact;
		$formContact = $this->createForm(new ContactType, $contact);
		if ($request->getMethod() == 'POST') {
			$formContact->bind($request);
			$expediteur = filter_var($contact->getEmail(), FILTER_VALIDATE_EMAIL);
			if ($formContact->isValid() && $expediteur) {

				$admins = $this->container->getParameter('admin_notifications');
				$expediteurs = $this->container->getParameter('mail_expediteur');				
				// Envoir d'un message de notification à la rédaction en chef
				$message = \Swift_Message::newInstance();
				$corps['expediteur'] = "";
				$corps['role'] = "Lecteur/Lectrice TDN";
				$corps['destinataire'] = "Rédaction TDN";
				$corps['dateEnvoi'] = date(' d m Y - H:i:s');
				$corps['message'] = $contact->getMessage();

				$message->setSubject('[TDN] Message à la rédaction : '.$contact->getRequete())
						->setContentType('text/html')
	        			->setFrom($expediteur)
	        			->setBody(
	            			$this->renderView('CoreBundle:Mail:contact.html.twig', $corps),
	            			'text/html'
	            		);
				foreach($admins['redaction'] as $destinataire) {
					$message->addTo($destinataire);
				}
			    $this->get('mailer')->send($message);

				$this->get('session')->getFlashBag()->add('success', 'Merci. Ta question a été envoyée à la rédaction');
			    return $this->redirect($this->generateURL('Core_home'));
			}
		}
		// Instanciation du formulaire
		$variables['formContact'] = $formContact->createView();
        return $this->render('CoreBundle:Page:contact.html.twig', $variables);
    }
}
