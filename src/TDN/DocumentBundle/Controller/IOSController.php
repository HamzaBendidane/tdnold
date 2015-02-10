<?php

namespace TDN\DocumentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use TDN\CoreBundle\Entity\Journal;

use TDN\CoreBundle\Controller\AppsController;

use TDN\NanaBundle\Entity\Nana;

class IOSController extends AppsController {
    
    public function rechercheAction ($seed = NULL) {

        if (is_null($seed)) {
            $request = $this->get('request');
            if ($request->isMethod('POST')) {
                $seed = $request->get('seed');
            } else {
                $seed = $request->query->get('seed');
                $seed = str_replace("_", " ", $seed);
            }
        }

        if (strlen($seed) > 2) {

            $flux['contenus'] = array();
            
            // Récupération de l'entity manager qui va nous permettre de gérer les entités.
            $em = $this->get('doctrine.orm.entity_manager');      
            $rep = $repository = $em->getRepository('TDN\RedactionBundle\Entity\Article');
            $resultatsRecherche = $rep->findBySeed($seed);
            if ($resultatsRecherche) foreach ($resultatsRecherche as $r) {
                $flux['contenus']['articles'] = $this->extractHeader($r, 'RedactionBundle_article');     
            }

            $rep = $em->getRepository('TDN\RedactionBundle\Entity\SelectionShopping');
            $resultatsRecherche = $rep->findBySeed($seed);
            if ($resultatsRecherche) foreach ($resultatsRecherche as $r) {
                $flux['contenus']['shopping'] = $this->extractHeader($r, 'Redaction_showSelection');     
            }
 
            $rep = $repository = $em->getRepository('TDN\ConseilExpertBundle\Entity\ConseilExpert');
            $resultatsRecherche = $rep->findBySeed($seed);
            if ($resultatsRecherche) foreach ($resultatsRecherche as $r) {
                $flux['contenus']['conseils'] = $this->extractHeader($r, 'ConseilExpert_conseil');     
            }
 
 			$rep = $repository = $em->getRepository('TDN\VideoBundle\Entity\Video');
            $resultatsRecherche = $rep->findBySeed($seed);
            if ($resultatsRecherche) foreach ($resultatsRecherche as $r) {
                $flux['contenus']['videos'] = $this->extractHeader($r, 'VideoBundle_video');     
            }

			$rep = $repository = $em->getRepository('TDN\CauseuseBundle\Entity\Question');
            $resultatsRecherche = $rep->findBySeed($seed);
            if ($resultatsRecherche) foreach ($resultatsRecherche as $r) {
                $flux['contenus']['questions'] = $this->extractHeader($r, 'CauseuseBundle_conversation');     
            }

            $rep = $repository = $em->getRepository('TDN\DossierRedactionBundle\Entity\Dossier');
            $resultatsRecherche = $rep->findBySeed($seed);
            if ($resultatsRecherche) foreach ($resultatsRecherche as $r) {
                $flux['contenus']['dossiers'] = $this->extractHeader($r, 'DossierRedaction_dossier');     
            }

            $rep = $repository = $em->getRepository('TDN\ConcoursBundle\Entity\Concours');
            $resultatsRecherche = $rep->findBySeed($seed);
            if ($resultatsRecherche) foreach ($resultatsRecherche as $r) {
                $flux['contenus']['concours'] = $this->extractHeader($r, 'Concours_show');     
            }

        } else {
            $flux['reponse'] = 'ERRSEED';
        }

        $flux = preg_replace("/\\\\u([a-f0-9]{4})/e", "iconv('UCS-4LE','UTF-8',pack('V', hexdec('U$1')))", json_encode($flux));
        $flux_resultats = str_replace('\\', '', $flux);
        $flux = json_encode(json_decode($flux_resultats));

        $response = new Response($flux);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Accept-Charset', 'utf-8');
        return $response;
    }

    /**
    *
    * aimeAction
    *
    * Aimer un contenu
    *
    * @param int $id — Identifiant du document
    * @return Response $response
    *
    **/
    public function aimeAction ($id) {

        $request = $this->get('request');
        $em = $this->get('doctrine.orm.entity_manager');      
        $URLmanager = $this->get('tdn.document.url');

        $rep = $repository = $em->getRepository('TDN\DocumentBundle\Entity\Document');
        $rep_nanas = $repository = $em->getRepository('TDN\NanaBundle\Entity\Nana');
        $doc = $rep->find($id);
        $idNana = $request->query->get('userID');
        $usr = (is_null($idNana)) ? "" : $rep_nanas->find($idNana); 

        // Test pçur éliminer les robots et les votes automatiques
        $agent = $_SERVER['HTTP_USER_AGENT'];
        $botList = $this->container->getParameter('bots');
        $isBot = false;
        foreach ($botList as $_b) {
            $isBot = $isBot || strpos($agent, $_b);
        }

        if ($isBot) {
            $ack = 'ERRBOT';
        } else {
            if ($usr instanceof Nana) {
                $rep_journal = $em->getRepository('TDN\CoreBundle\Entity\Journal');
                $instance = $rep_journal->findOneBy(array(
                    'action' => 'AIME',
                    'lnActeur' => $usr->getIdNana(),
                    'titre' => $doc->getTitre()
                ));

                if ($instance instanceof Journal) {
                    $ack = 'ERRDOUBLE';
                } else {
                    $doc->setLikes(1 + $doc->getLikes());
                    // Signaler dans le journal
                    $entree = new Journal;
                    if (is_object($usr)) {
                        $entree->setLnActeur($usr);
                    }
                    $entree->setAction('AIME');
                    list($route, $rubrique, $params) = $doc->getURLElements();
                    $entree->setURL($this->generateURL($route, $params));
                    $entree->setTexte('aime');
                    $entree->setTitre($doc->getTitre());
                    $entree->setLnVeilleur($doc->getLnAuteur());
                    $entree->setSupport($_SERVER['HTTP_USER_AGENT']);
                    $entree->setLnRubrique($rubrique);
                    $entree->setDateEntree(new \DateTime);
                    $em->persist($entree);

                    $points = $this->container->getParameter('action_points');
                    $usr->updatePopularite($points['like']);
                }
            } else {
                $doc = $rep->find($id);
                $doc->setLikes(1 + $doc->getLikes());
            }
            $em->flush();                
            $ack = 'ACK';
        }

        $flux = json_encode(array('ack' => $ack));
        $response = new Response($flux);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Accept-Charset', 'utf-8');
        return $response;
    }


}