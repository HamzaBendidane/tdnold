<?php

namespace TDN\RedactionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

use TDN\CoreBundle\Entity\Journal;

use TDN\CoreBundle\Controller\IOSController as IOSMainController;

use TDN\NanaBundle\Entity\Nana;

class WSController extends IOSMainController {
    
    private $_entite = array('entite' => 'TDN\RedactionBundle\Entity\Article', 'route' => 'RedactionBundle_article');

    /**
    *
    * getBonsPlansAction
    *
    * Contrôleur traitant la requête d'envoi des bons plans récents vers l'application iPhone
    *
    * @return Response $response
    *
    **/
	public function getBonsPlansAction () {

		$request = $this->get('request');
        $limite = $request->query->get('limite') ?: 10;
        $debut = $request->query->get('debut') ?: 0;

        $em = $this->get('doctrine.orm.entity_manager');
        $rep = $em->getRepository('TDN\RedactionBundle\Entity\Article');
        $_articles = $rep->findBonsPlans($limite, $debut);
        foreach ($_articles as $a) {
            $resultats[] = $this->_extractHeader($a,'RedactionBundle_article');
         }

        return new JsonResponse($resultats);

	}

    /**
    *
    * iOSArticleAction
    *
    * Contrôleur traitant la requête d'envoi d'un article pour l'application iPhone
    *
    * @return Response $response
    *
    **/
    public function iOSArticleAction ($id) {

        return $this->_getOneContenu($this->_entite, $id);

    }

    /**
    *
    * iOSDerniersArticlesAction
    *
    * Contrôleur traitant l'envoi des derniers articles parus vers l'application iPhone
    *
    * @return Response
    *
    **/
    public function iOSDerniersArticlesAction () {

        return $this->_iOSDerniersContenus($this->_entite);
    }

    /**
    *
    * _extractDocumentTypeData
    *
    * Prépare les données propres aux articles
    *
    * @param Article $doc Article à envoyer
    * @return array $items
    *
    **/
    protected function _extractDocumentTypeData ($doc) {
        $items = array();
        $items['corps'] = $this->safeString($doc->getCorps());
        // Attribut style et height ) à supprimer
        $pattern_style = "#((?<=<img)[^>]+)((style|height)='[^']*')#";
        $err = preg_match_all($pattern_style, $items['corps'], $matches);
        for ($i = 0; $i < count($matches[0]) ; $i++) {
            $start = strpos($items['corps'], $matches[0][$i]);
            $offset = strpos($matches[0][$i], $matches[2][$i]);
            $start += $offset;
            $items['corps'] = substr_replace($items['corps'], '', $start, strlen($matches[2][$i])+1);
        }
        // Attribut width => forcer à 300px
        $pattern_width = "#((?<=<img)[^>]+)(width='[^']*')[^>]*>#";
        $err = preg_match_all($pattern_width, $items['corps'], $matches);
        for ($i = 0; $i < count($matches[0]) ; $i++) {
            $start = strpos($items['corps'], $matches[0][$i]);
            $offset = strpos($matches[0][$i], $matches[2][$i]);
            $start += $offset;
            $items['corps'] = substr_replace($items['corps'], "width='300'", $start, strlen($matches[2][$i]));
        }

        return $items;
    }



}