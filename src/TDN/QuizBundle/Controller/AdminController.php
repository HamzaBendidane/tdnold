<?php

namespace TDN\QuizBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use TDN\QuizBundle\Entity\Quiz;
use TDN\QuizBundle\Entity\ProfilQuiz;


class AdminController extends Controller {
	
	public function quizListeAction () {
		
		/* Tableau qui va stocker toutes les données à remplacer dans le template twig */
	    $variables = array();  

	    // Récupération de l'entity manager qui va nous permettre de gérer les entités.
	    $em = $this->get('doctrine.orm.entity_manager');      

		// Instanciation du Repository
		// $repository = $em->getRepository('TDNQuizBundle:Quiz');
		
		// Rechercher l'article
		$variables['quizList'] = $repository->findAll();

		return $this->render('QuizBundle:Admin:quizListe.html.twig', $variables);
	}
	
	public function quizRechercheAction () {
		
		return $this->render('QuizBundle:Admin:quizListe.html.twig');
	}
	
	public function quizCreerAction () {
		return $this->render('QuizBundle:Admin:quizCreer.html.twig' );
	}
	
	public function quizModifierAction ($id) {
		/* Tableau qui va stocker toutes les données à remplacer dans le template twig */
	    $variables = array();  

	    // Récupération de l'entity manager qui va nous permettre de gérer les entités.
	    $em = $this->get('doctrine.orm.entity_manager');      

		// Instanciation du Repository
		// $repository = $em->getRepository('TDNQuizBundle:Quiz');
		
		// Rechercher l'article
		// $variables['quizList'] = $repository->find($id);

		return $this->render('QuizBundle:Admin:quizModifier.html.twig', $variables);		
	}
	
	public function quizEnregistrerAction ($id = NULL) {
		
		// $form = $this->get('form.factory')->create(new ArticleForm, $article);
		
        /* Quiz Entity Manager */
	    $entityManager = $this->get('doctrine.orm.entity_manager');      
        $rep = $entityManager->getRepository("TDN\QuizBundle\Entity\Quiz");
		/* Données du formulaire */
		$request = $this->get('request');

		if (is_null($id)) {
			$quiz = new Quiz;
		} else {
			$quiz = $rep->findBy(array('idQuiz' => $id));
		}
		
		//print_r($quiz); die;
		
		if ($request->getMethod() === 'POST') {
			// $form->bindRequest($request);
			if (false) {
				$quiz->setTitre($request->get('titre'))->setAbstract($request->get('abstract'));
				$quiz->setRubrique(strtolower($request->get('rubrique')));
				$quiz->setNombreQuestions($request->get('nombreQuestions'));
				$quiz->setNombreProfils($request->get('nombreProfils'));
				$quiz->setStatut($request->get('statut'));
				// $rubrique->setDatePublication(date('Y-m-d H:i:s'));

				$em = $this->get('doctrine.orm.entity_manager');
				$em->persist($quiz);
				$em->flush();
				
				$rep->findBy(array(), array('id' => 'desc'),1,0);
				
				return $this->redirect($this->generateURL('quiz_creerProfils', array('id' => $id)));
			} else {
				$id = 1;
				$variables['id'] = 1;
				$variables['titreQuiz'] = $request->get('titreQuiz');
				$variables['nombreProfils'] = $request->get('nombreProfils');
				$variables['nombreQuestions'] = $request->get('nombreQuestions');
				return $this->render('QuizBundle:Admin:quizDefinirProfils.html.twig', $variables);
			}
		}
		
		return $this->render('QuizBundle:Admin:quizModifier.html.twig' );//array('form' => $form->createView())
	}
	
	public function quizSupprimerAction ($id) {
		
		/* Tableau qui va stocker toutes les données à remplacer dans le template twig */
	    $variables = array();  

	    // Récupération de l'entity manager qui va nous permettre de gérer les entités.
	    $em = $this->get('doctrine.orm.entity_manager');      

		// Instanciation du Repository
		$repository = $em->getRepository('TDNQuizBundle:Quiz');
		
		// Rechercher l'article
		$variables['quizList'] = $repository->findAll();
		return $this->render('RedactionBundle:Admin:quizListe.html.twig' );
	}
	
	public function quizEnregistrerProfilsAction ($id) {
		
        $entityManager = $this->get("doctrine.orm.entity_manager");
       
        /* Récupération du genre demandé par url */
        // $quiz = $entityManager->getRepository("TDN\QuizBundle\Entity\Quiz")->find($id);

        $ensembleProfils = new ProfilQuiz;
		
		$request = $this->get('request');
		
		if ($request->getMethod() === 'POST') {

			if (false) {
				$em = $this->get('doctrine.orm.entity_manager');
				$em->persist($quiz);
				$em->flush();
				
				return $this->redirect($this->generateURL('quiz_creerQuestions'));
			} else {
				$id = 1;
				$variables['id'] = 1;
				$variables['titreQuiz'] = $request->get('titreQuiz');
				$variables['nombreProfils'] = $request->get('nombreProfils');
				$variables['nombreQuestions'] = $request->get('nombreQuestions');
				return $this->render('QuizBundle:Admin:quizDefinirQuestions.html.twig', $variables);	} 
		}
		
		return $this->render('RedactionBundle:Admin:articleAdd.html.twig' );//array('form' => $form->createView())
	}
	
	

}