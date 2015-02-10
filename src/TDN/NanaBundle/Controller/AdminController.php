<?php

namespace TDN\NanaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TDN\NanaBundle\Entity\Nana;
use TDN\NanaBundle\Form\Type\NanaDispatchType;
use TDN\NanaBundle\Form\Type\NanaReponseType;
use TDN\NanaBundle\Form\Type\NanaRelectureType;
use TDN\DocumentBundle\Form\Type\selecteurRubriquesType;
use TDN\DocumentBundle\Entity\DocumentRubrique;

class AdminController extends Controller {
	
	public function logAction () {
		
		$variables['conseilsList'] = array();
		$variables['colonnesList'] = array('Pseudo', 'Roles');
		$variables['actionsList'] = array('Bannir', 'Supprimer');
		$variables['actionsRoutesList'] = array('NanaBundle_addBlacklist', 'NanaBundle_supprimer');
		$variables['selectList'] = array(
			array('value' => 'nom', 'texte' => 'Nom'),
			array('value' => 'roles', 'texte' => 'Role'),
			array('value' => 'username', 'texte' => 'Pseudo')
			);

		$em = $this->get('doctrine.orm.entity_manager');

		$request = $this->get('request');
		if ($request->isMethod('POST')) {
			$valeur = "%".$request->get('selectValeur')."%";
			$variables['isSelectedField'] = $request->get('selectField');
			$variables['isSelectedValeur'] = $request->get('selectValeur');
			$where = array($request->get('selectField') => $request->get('selectValeur'));
			$variables['nanasList'] = $em->getRepository('TDN\NanaBundle\Entity\Nana')->findBy($where);
		} else {
			$page = $request->query->get('page');
			$page = !empty($page) ?: 1;
			$longueurPage = 200;
			$offset = $longueurPage * ($page-1);
			$variables['isSelectedField'] = "";
			$variables['isSelectedValeur'] = "";
			$variables['nanasList'] = $em->getRepository('TDN\NanaBundle\Entity\Nana')->findLimitedAll($longueurPage, $offset);
		}

		return $this->render('NanaBundle:Admin:NanaLog.html.twig', $variables);
	}
	
	public function logTriAction ($ordre) {
		
		$variables['conseilsList'] = array();
		$variables['colonnesList'] = array('Titre', 'Statut');
		$variables['actionsList'] = array('Supprimer');

		$em = $this->get('doctrine.orm.entity_manager');
		$rep = $em->getRepository('TDN\NanaBundle\Entity\Nana');

		$query = $rep->createQueryBuilder('c')
    				 ->orderBy('c.'.strtolower($ordre), 'ASC')
    				 ->getQuery();
		$variables['conseilsList'] = $query->getResult();

		return $this->render('NanaBundle:Admin:conseilListe.html.twig', $variables);
	}
	
	public function editerAction () {
		
		return $this->render('NanaBundle:Admin:conseilForm.html.twig');
	}
	
	public function conseilDispatchAction ($id) {

		$variables['rubrique'] = 'tdn';

	    // Récupération de l'entity manager qui va nous permettre de gérer les entités.
	    $em = $this->get('doctrine.orm.entity_manager');      

		// Instanciation du Repository
		$rep_conseils = $em->getRepository('TDN\NanaBundle\Entity\Nana');
	    $conseil = $rep_conseils->find($id);
		$rep_images = $em->getRepository('TDN\ImageBundle\Entity\Image');
	    $image = $conseil->getLnImage();

		// Instanciation du formulaire
		$form = $this->createForm(new NanaDispatchType, $conseil);
		// $form = $this->createForm(new NanaDispatchType, $conseil);
		$variables['form'] = $form->createView();

		// Instanciation du formulaire
		$doc =  new DocumentRubrique;
		$formRubrique = $this->createForm(new selecteurRubriquesType, $doc);
		$variables['formRubrique'] = $formRubrique->createView();

		$variables['flowId'] = $conseil->getIdDocument();
		$variables['dateSoumission'] = $conseil->getDateSoumission();
		if ($image) {
			$variables['image'] = $image->getFichier();
			$variables['alt'] = $image->getAlt();
		}
		$variables['auteur'] = "<anonymous>";
		// Recherche des experts

		// Affichage de la page
		return $this->render('NanaBundle:Admin:conseilDispatchForm.html.twig', $variables);
	}

	public function conseilFlowDispatchAction () {

		$request = $this->get('request');

		$variables['rubrique'] = 'tdn';

	    $em = $this->get('doctrine.orm.entity_manager');      

		// Instanciation du Repository
		$rep_conseils = $em->getRepository('TDN\NanaBundle\Entity\Nana');
	    $conseil = $rep_conseils->find($request->get('flowId'));
		$form = $this->createForm(new NanaDispatchType, $conseil);

		if ($request->getMethod() == "POST") {
			$form->bind($request);
			$conseil->setStatut($conseil->getStatut()+1);

			$em->persist($conseil);
			$em->flush();

			// Notifier l'expert
			$message = \Swift_Message::newInstance()
        			->setSubject('Un conseil vous est demandé par une lectrice de TDN')
        			->setFrom('justine@trucdenana.com')
        			->setTo('recipient@example.com')
        			->setBody(
            			$this->renderView(
                			'NanaBundle:Mail:dispatchConseil.html.twig',
                			array('name' => $name)
            			)
        			);
    		$this->get('mailer')->send($message);
		}

		// Affichage de la page
		return $this->render('NanaBundle:Admin:conseilListe.html.twig', $variables);
	}

	public function conseilRepondreAction ($id) {

		$variables['rubrique'] = 'tdn';

	    // Récupération de l'entity manager qui va nous permettre de gérer les entités.
	    $em = $this->get('doctrine.orm.entity_manager');      

		// Instanciation du Repository
		$rep_conseils = $em->getRepository('TDN\NanaBundle\Entity\Nana');
	    $conseil = $rep_conseils->find($id);
		$rep_images = $em->getRepository('TDN\ImageBundle\Entity\Image');
	    $image = $conseil->getLnImage();

		// Instanciation du formulaire
		$form = $this->createForm(new NanaReponseType, $conseil);
		// $form = $this->createForm(new NanaDispatchType, $conseil);
		$variables['form'] = $form->createView();

		$variables['flowId'] = $conseil->getIdDocument();
		$variables['question'] = $conseil->getQuestion();
		$variables['dateSoumission'] = $conseil->getDateSoumission();
		if ($image) {
			$variables['image'] = $image->getFichier();
			$variables['alt'] = $image->getAlt();
		}
		$variables['auteur'] = "<anonymous>";
		// Recherche des experts

		// Affichage de la page
		return $this->render('NanaBundle:Admin:conseilRepondreForm.html.twig', $variables);
	}

	public function conseilFlowRepondreAction () {

		$request = $this->get('request');

		$variables['rubrique'] = 'tdn';

	    $em = $this->get('doctrine.orm.entity_manager');      

		// Instanciation du Repository
		$rep_conseils = $em->getRepository('TDN\NanaBundle\Entity\Nana');
	    $conseil = $rep_conseils->find($request->get('flowId'));
		$form = $this->createForm(new NanaReponseType, $conseil);

		if ($request->getMethod() == "POST") {
			$form->bind($request);
			$conseil->setStatut($conseil->getStatut()+1);

			$em->persist($conseil);
			$em->flush();

			// Notifier l'expert
			// $message = \Swift_Message::newInstance()
   //      			->setSubject('Un conseil vous est demandé par une lectrice de TDN')
   //      			->setFrom('justine@trucdenana.com')
   //      			->setTo('justine@trucdenana.com')
   //      			->setBody(
   //          			$this->renderView(
   //              			'NanaBundle:Mail:reponseConseil.html.twig',
   //              			array('name' => $name)
   //          			)
   //      			);
   //  		$this->get('mailer')->send($message);
		}

		// Affichage de la page
		return $this->render('NanaBundle:Admin:conseilListe.html.twig', $variables);
	}

	public function conseilRelireAction ($id) {

		$variables['rubrique'] = 'tdn';

	    // Récupération de l'entity manager qui va nous permettre de gérer les entités.
	    $em = $this->get('doctrine.orm.entity_manager');      

		// Instanciation du Repository
		$rep_conseils = $em->getRepository('TDN\NanaBundle\Entity\Nana');
	    $conseil = $rep_conseils->find($id);
		$rep_images = $em->getRepository('TDN\ImageBundle\Entity\Image');
	    $image = $conseil->getLnImage();

		// Instanciation du formulaire
		$form = $this->createForm(new NanaRelectureType, $conseil);
		// $form = $this->createForm(new NanaDispatchType, $conseil);
		$variables['form'] = $form->createView();

		$variables['flowId'] = $conseil->getIdDocument();
		$variables['dateSoumission'] = $conseil->getDateSoumission();
		if ($image) {
			$variables['image'] = $image->getFichier();
			$variables['alt'] = $image->getAlt();
		}
		$variables['auteur'] = "<anonymous>";
		// Recherche des experts

		// Affichage de la page
		return $this->render('NanaBundle:Admin:conseilRelireForm.html.twig', $variables);	}

	public function publierAction () {
		
		return $this->render('NanaBundle:Admin:conseilListe.html.twig');
	}
	
	public function supprimerAction () {
		
		return $this->render('NanaBundle:Admin:conseilListe.html.twig');
	}

	
	public function manageAction ($id) {

		$request = $this->get('request');

		// Instanciation du Repository
		$rep = $em->getRepository('TDN\NanaBundle\Entity\Nana');
	    $nana = $rep->find($id);

		// Instanciation du formulaire
		$form = $this->createForm(new AdminType, $nana);
		$variables['form'] = $form->createView();
		$doc =  new DocumentRubrique;
		$formRubrique = $this->createForm(new selecteurRubriquesType, $doc);

		if ($request->getMethod('POST')) {
			
		}

		$vars['who'] = $nana;
		return $this->render('NanaBundle:Admin:nanaManager.html.twig', $vars);
	}


	public function choixNanaDeLaSemaineAction ($semaine = NULL) {
		
		$request = $this->get('request');
		if (is_null($semaine)) {
			$now = new \DateTime;
			$semaine = (integer)$now->format('W');
		}
	    $em = $this->get('doctrine.orm.entity_manager');      
		$rep = $em->getRepository('TDN\NanaBundle\Entity\Nana');
		
		// Effacement des données pour la nana de l'année précedente
		$precedenteElue = $rep->findOneByAdresseIP($semaine+1);
		if ($precedenteElue instanceof Nana) {
			$precedenteElue->setAdresseIP(NULL);
		}

		$candidate = $rep->isNanaDeLaSemaine($semaine -1);
		// $candidate->setActive((integer)(1 + $semaine));
		$candidate->setAdresseIP($semaine +1);
		// $candidate->setElctions(1 + $candidate->getElections());
		$em->flush();

		$corps = array();
		// Notification adminstration
		$admins = $this->container->getParameter('admin_notifications');
		$expediteurs = $this->container->getParameter('mail_expediteur');				
		$message = \Swift_Message::newInstance();
		$corps['expediteur'] = "Justine";
		$corps['role'] = "Redaction";
		$corps['destinataire'] = "Justine";
		$corps['dateEnvoi'] = date(' d m Y - H:i:s');
		// Eléments spécifiques
		$corps['id'] = $candidate->getIdNana();
		$corps['pseudo'] = $candidate->getUsername();
		$corps['inscription'] = $candidate->getDateInscription();

		$message->setSubject('[TDN] Prochaine nana de la semaine')
				->setContentType('text/html')
    			->setFrom($expediteurs['admin'])
     			->setBody(
        			$this->renderView('NanaBundle:Mail:tosNanaDeLaSemaine.html.twig', $corps),
        			'text/html'
        		);
		foreach($admins['redaction'] as $destinataire) {
			$message->addTo($destinataire);
		}

	    if (!$this->get('mailer')->send($message, $failures)) {
		  echo "Failures:";
		  print_r($failures);
		}

		$points = $this->container->getParameter('action_points');
		$candidate->updatePopularite($points['nana_semaine']);

		$corps = array();
		$corps['nana'] = $candidate;
		// Notification nana
		$message = \Swift_Message::newInstance();
		$corps['expediteur'] = "Justine";
		$corps['role'] = "Redaction";
		$corps['destinataire'] = $candidate->getUsername();
		$corps['dateEnvoi'] = date(' d m Y - H:i:s');
		// Eléments spécifiques
		$corps['id'] = $candidate->getIdNana();
		$corps['pseudo'] = $candidate->getUsername();
		$corps['inscription'] = $candidate->getDateInscription();

		$message->setSubject('[TDN] Prochaine nana de la semaine : '.$candidate->getUsername().' ('.$candidate->getEmail().')')
				->setContentType('text/html')
    			->setFrom('redaction@trucdenana.com')
				->addTo($candidate->getEmail())
				->addBcc($this->container->getParameter('mail_moderation_1'))
     			->setBody(
        			$this->renderView('NanaBundle:Mail:notificationNanaDeLaSemaine.html.twig', $corps),
        			'text/html'
        		);

	    if (!$this->get('mailer')->send($message, $failures)) {
		  echo "Failures:";
		  print_r($failures);
		}

		return $this->render('NanaBundle:Mail:notificationNanaDeLaSemaine.html.twig', $corps);
	}

	public function choixEscarpinsMensuelAction () {
		
		$request = $this->get('request');
	    $em = $this->get('doctrine.orm.entity_manager');      
		$rep = $em->getRepository('TDN\NanaBundle\Entity\Nana');
		
		$now = new \DateTime();
		$ids = $rep->isNanaDuMois();

		$em->clear(); // reset du ResultSetMapping de Doctrine
		foreach ($ids as $c) {
			$nana = $rep->find($c);
			$nana->recalculePopularite();
			$candidates[] = $nana;
		}
		$gagnante = array_shift($candidates);
		$gagnantes_passees = array('mackya', 'dindonno', 'lalotte', 'appadoo', 'katniss59');
		while (in_array($gagnante->getUsername(), $gagnantes_passees)) {
			$gagnante = array_shift($candidates);
		}
		print_r($gagnante->getUsername());
		// $gagnante->setEscarpins(true);

		// die;
		$em->flush();

		$admins = $this->container->getParameter('admin_notifications');
		$expediteurs = $this->container->getParameter('mail_expediteur');				
		// Notification adminstration
		$message = \Swift_Message::newInstance();
		$corps['expediteur'] = "Justine";
		$corps['role'] = "Redaction";
		$corps['destinataire'] = "Justine";
		$corps['dateEnvoi'] = date(' d m Y - H:i:s');
		// Eléments spécifiques
		$corps['id'] = $gagnante->getIdNana();
		$corps['pseudo'] = $gagnante->getUsername();

		$message->setSubject('[TDN] Tirage au sort des escarpins de ce mois')
				->setContentType('text/html')
    			->setFrom('postmaster@trucdenana.com')
     			->setBody(
        			$this->renderView('NanaBundle:Mail:tosEscarpinsMensuel.html.twig', $corps),
        			'text/html'
        		);
		foreach($admins['redaction'] as $destinataire) {
			$message->addTo($destinataire);
		}

	    if (!$this->get('mailer')->send($message, $failures)) {
		  echo "Failures:";
		  print_r($failures);
		}

		// Notification gagnante
		$message = \Swift_Message::newInstance();
		$corps['expediteur'] = "Justine";
		$corps['role'] = "Redaction";
		$corps['destinataire'] = $gagnante->getUsername();
		$corps['dateEnvoi'] = date(' d m Y - H:i:s');
		// Eléments spécifiques
		$corps['popularite'] = $gagnante->getPopularite();

		$message->setSubject('As-tu gagné ce mois-ci les escarpins de Trucs de nana ?')
				->setContentType('text/html')
    			->setFrom($expediteurs['redaction'])
				->addTo($gagnante->getEmail())
				->addBcc($this->container->getParameter('mail_moderation_1'))
     			->setBody(
        			$this->renderView('NanaBundle:Mail:notificationEscarpinsGain.html.twig', $corps),
        			'text/html'
        		);

	    if (!$this->get('mailer')->send($message, $failures)) {
		  echo "Failures:";
		  print_r($failures);
		}

		foreach ($candidates as $perdante) {
			// Notification perdantes
			$message = \Swift_Message::newInstance();
			$corps['expediteur'] = "Justine";
			$corps['role'] = "Redaction";
			$corps['destinataire'] = $perdante->getUsername();
			$corps['dateEnvoi'] = date(' d m Y - H:i:s');
			// Eléments spécifiques
			$corps['popularite'] = $perdante->getPopularite();

			$message->setSubject('As-tu gagné ce mois-ci les escarpins de Trucs de nana ?')
					->setContentType('text/html')
        			->setFrom($expediteurs['redaction'])
					->addTo($perdante->getEmail())
					->addBcc($this->container->getParameter('mail_moderation_1'))
	     			->setBody(
	        			$this->renderView('NanaBundle:Mail:notificationEscarpinsPerdu.html.twig', $corps),
	        			'text/html'
	        		);

		    if (!$this->get('mailer')->send($message, $failures)) {
			  echo "Failures:";
			  print_r($failures);
			}
		}

		return $this->render('NanaBundle:Mail:notificationEscarpinsMensuelNana.html.twig', $corps);
	}

	public function preEscarpinsMensuelAction () {
		
		$request = $this->get('request');
	    $em = $this->get('doctrine.orm.entity_manager');      
		$rep = $em->getRepository('TDN\NanaBundle\Entity\Nana');

		$ids = $rep->isNanaDuMois();
		$em->clear();
		foreach ($ids as $i) {
			$candidates[] = $rep->find($i);
		}

		$corps['data_liste'] = array();
		foreach ($candidates as $c) {
			$data['texte'] = $c->getUsername().' : '.$c->getPrenom().' '.$c->getNom();
			$data['route'] = '';
			$data['attr'] = array();
			$corps['data_liste'][] = $data;
		}

		$admins = $this->container->getParameter('admin_notifications');
		$expediteurs = $this->container->getParameter('mail_expediteur');				
		// Notification adminstration
		$message = \Swift_Message::newInstance();
		$corps['expediteur'] = "Justine";
		$corps['role'] = "Redaction";
		$corps['destinataire'] = "Justine";
		$corps['dateEnvoi'] = date(' d m Y - H:i:s');
		// Eléments spécifiques
		$corps['id'] = 3;
		$corps['pseudo'] = 'Justine';
		$corps['inscription'] = '';

		$message->setSubject('[TDN] Tirage au sort des escarpins de ce mois')
				->setContentType('text/html')
    			->setFrom('postmaster@trucdenana.com')
     			->setBody(
        			$this->renderView('NanaBundle:Mail:preTosEscarpinsMensuel.html.twig', $corps),
        			'text/html'
        		);
		foreach($admins['redaction'] as $destinataire) {
			$message->addTo($destinataire);
		}
		// $message->addTo('michel.cadennes@sens-commun.fr');

	    if (!$this->get('mailer')->send($message, $failures)) {
		  echo "Failures:";
		  print_r($failures);
		}

		foreach ($candidates as $c) {
			// Notification nana
			$message = \Swift_Message::newInstance();
			$corps['expediteur'] = "Justine";
			$corps['role'] = "Redaction";
			$corps['destinataire'] = $c->getUsername();;
			$corps['dateEnvoi'] = date(' d m Y - H:i:s');
			// Eléments spécifiques

			$message->setSubject('[TDN] Tirage au sort des escarpins du mois')
					->setContentType('text/html')
        			->setFrom($expediteurs['redaction'])
					->addTo($c->getEmail())
					->addBcc($this->container->getParameter('mail_moderation_1'))
	     			->setBody(
	        			$this->renderView('NanaBundle:Mail:preEscarpinsMensuelNana.html.twig', $corps),
	        			'text/html'
	        		);

		    if (!$this->get('mailer')->send($message, $failures)) {
			  echo "Failures:";
			  print_r($failures);
			}			
		}


		return $this->render('NanaBundle:Mail:preTosEscarpinsMensuel.html.twig', $corps);
	}

}