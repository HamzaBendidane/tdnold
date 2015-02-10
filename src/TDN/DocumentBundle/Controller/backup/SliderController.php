<?php

namespace TDN\DocumentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TDN\DocumentBundle\Entity\Slider;
use TDN\DocumentBundle\Form\Type\SlideInspecteurType;


class SliderController extends Controller
{
    
	public function showAction ($limite = 6)
	{
	    // Récupération de l'entity manager qui va nous permettre de gérer les entités.
	    $em = $this->get('doctrine.orm.entity_manager');      

		// Instanciation du Repository
		$repository = $em->getRepository('TDN\DocumentBundle\Entity\Slider');
		$variables['slider'] = $repository->findSelection($limite);
		$err = shuffle($variables['slider']);
		foreach ($variables['slider'] as $contenu) {
			$source = $contenu->getLnSource();
			list($route, $rubrique, $params) = $source->getURLElements();
			$variables['routes'][] = $this->generateURL($route, $params);
		}

        return $this->render('DocumentBundle:Slider:sliderPlayer.html.twig', $variables);
	}

    public function indexAction()
    {
        $variables['promsList'] = array();
		$variables['colonnesList'] = array('Titre', 'Etat', 'Type');
		$variables['actionsList'] = array('Supprimer');
		$variables['actionsRoutesList'] = array('DocumentBundle_sliderSupprimer');
		$variables['selectList'] = array(
			array('value' => 'type', 'texte' => 'Type'),
			array('value' => 'lnAuteur', 'texte' => 'Auteur'),
			array('value' => 'rubriques', 'texte' => 'Rubrique')
			);

		$em = $this->get('doctrine.orm.entity_manager');

		$request = $this->get('request');
		if ($request->isMethod('POST')) {
			$valeur = "%".$request->get('selectValeur')."%";
			$variables['isSelectedField'] = $request->get('selectField');
			$variables['isSelectedValeur'] = $request->get('selectValeur');
			$where = array($request->get('selectField') => $request->get('selectValeur'));
			$variables['promsList'] = $em->getRepository('TDN\DocumentBundle\Entity\Slider')->findBy($where);
		} else {
			$variables['isSelectedField'] = "";
			$variables['isSelectedValeur'] = "";
			$variables['promsList'] = $em->getRepository('TDN\DocumentBundle\Entity\Slider')->findAll();
			foreach($variables['promsList'] as $contenu) {
				$classe = explode('\\', get_class($contenu->getLnsource()));
				$variables['promsClass'][] = array_pop($classe);
			}
		}

		return $this->render('DocumentBundle:Admin:SliderIndex.html.twig', $variables);
    }

    public function inspectAction ($id)
    {
		$usr= $this->get('security.context')->getToken()->getUser();				

    	$variables['formCallback'] = 'Document_sliderInspecteur';
    	$variables['titreDetail'] = 'Inspection de slide';
    	$variables['args'] = json_encode(array('id' => $id));
    	$variables['id'] =  $id;

		$em = $this->get('doctrine.orm.entity_manager');
		$rep_slider = $em->getRepository('TDN\DocumentBundle\Entity\Slider');
		$slide = $rep_slider->find($id);
		$form = $this->createForm(new SlideInspecteurType, $slide);
		$variables['form'] = $form->createView();

		$variables['slide'] = $slide;
		$classe = explode('\\', get_class($slide->getLnSource()));
		$variables['classe'] = array_pop($classe);

		$request = $this->get('request');
		$modifiedCover = $request->get('lnCover');
		if ($request->isMethod('POST')) {
			$form->bindRequest($request);
			if ($form->isValid()) {

				// Modification de l'illustration de la question
				$modifiedCover = $slide->getLnCover();
				if ($modifiedCover->isUpdated()) {
		            $now = new \DateTime;
		            $dossier = '/public/'.$now->format('Y').'/'.$now->format('m').'/';
		            $modifiedCover->init($dossier, $usr, $usr)/*->scale(600, 0, true)*/;
				}

				// $slide->setDateModification(new \DateTime);
		
				$em->flush();

				return $this->redirect($this->generateURL('DocumentBundle_sliderIndex'));
			}
		}

		return $this->render('DocumentBundle:Admin:SliderInspecteur.html.twig', $variables);
    }

    public function supprimerAction ($id) {

	    $em = $this->get('doctrine.orm.entity_manager');      
		$rep = $em->getRepository('TDN\DocumentBundle\Entity\Slider');
		$rep_doc = $em->getRepository('TDN\DocumentBundle\Entity\Document');

		$slide = $rep->find($id);
		$doc = $rep_doc->findOneby(array('lnPromu' => $id));
		if ($doc instanceof Document) {
			$doc->setLnPromu(NULL);
		}
		$em->remove($slide);
		$em->flush();

		$this->get('session')->getFlashBag()->add('success', 'Le contenu n’est plus mis en avant.');
		return $this->redirect($URLmanager->refererURL($request->headers->get('referer')));
    }
}