<?php
namespace TDN\CauseuseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use TDN\CauseuseBundle\Form\Type\BreveType;
use TDN\CauseuseBundle\Entity\Question;
use TDN\CauseuseBundle\Form\Type\CauseuseQuestionEditionType;

use TDN\DocumentBundle\Controller\AdminController as DocumentController;
use TDN\DocumentBundle\Entity\DocumentType;
use TDN\DocumentBundle\Entity\Slider;
use TDN\DocumentBundle\Form\Type\SlideType;
use TDN\DocumentBundle\Form\Model\Thematique;
use TDN\DocumentBundle\Form\Model\ThematiqueCollection;
use TDN\DocumentBundle\Form\Type\ThematiqueCollectionType;

use TDN\ImageBundle\Entity\Image;

class ReponseAdminController extends DocumentController {

	public function reponseSupprimerAction ($id) {
	
		$request = $this->get('request');
	    $em = $this->get('doctrine.orm.entity_manager');      
		$repository = $em->getRepository('TDN\CauseuseBundle\Entity\Reponse');
		$_TDNDocument = $repository->find($id);
		$this->deleteRecord($_TDNDocument);
		return $this->redirect($request->headers->get('referer'));
	}	
}