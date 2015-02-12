<?php

namespace TDN\VideoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use TDN\VideoBundle\Form\Type\VideoType;
use TDN\VideoBundle\Entity\Video;

use TDN\CoreBundle\Controller\IOSController as IOSMainController;

use TDN\DocumentBundle\Entity\DocumentRubrique;
use TDN\DocumentBundle\Entity\DocumentType;
use TDN\DocumentBundle\Entity\DocumentRubriqueRepository;



class IOSController extends IOSMainController {
	
    private $_entite = array('entite' => 'TDN\VideoBundle\Entity\Video', 'route' => 'VideoBundle_video');

    /**
    *
    * iOSQuestionAction
    *
    * Contrôleur traitant la requête d'envoi d'une question de nana pour l'application iPhone
    *
    * @return Response $response
    *
    **/
    public function iOSVideoAction ($id) {

        return $this->_getOneContenu($this->_entite, $id);
    }

    /**
    *
    * iOSDerniersConseilsAction
    *
    * Contrôleur traitant l'envoi des dernières questions de nanas parus vers l'application iPhone
    *
    * @return Response
    *
    **/
    public function iOSDernieresVideosAction () {

        return $this->_iOSDerniersContenus($this->_entite);
    }

    /**
    *
    * _extractDocumentTypeData
    *
    * Prépare les données propres aux vidéos
    *
    * @param Article $doc Article à envoyer
    * @return array $items
    *
    **/
    public function _extractDocumentTypeData ($doc) {

       $items = array();  
       $items['vignette'] = $doc->getVignette(); 
       $items['duree'] = $doc->getDuree(); 
       $items['hebergeur'] = $doc->getIdHebergeur(); 
       $items['idVideo'] = $doc->getIdVideo();
        preg_match_all("/src=\"(.*)\" frameborder/is",$doc->getCodeIntegration(),$matches);
       $items['code'] = $matches[1][0];

       return $items;
    }
}
