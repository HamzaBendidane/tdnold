<?php

namespace TDN\DocumentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TDN\CoreBundle\Entity\Journal;
use TDN\NanaBundle\Entity\Nana;

class PublicController extends Controller
{
    
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
            // Récupération de l'entity manager qui va nous permettre de gérer les entités.
            $em = $this->get('doctrine.orm.entity_manager');      
            $rep = $repository = $em->getRepository('TDN\RedactionBundle\Entity\Article');
            $resultatsRecherche = $rep->findBySeed($seed);
            $vars['paths']['Articles'] = 'RedactionBundle_article';
            if ($resultatsRecherche) $vars['contenus']['Articles'] = $resultatsRecherche;     

            $rep = $em->getRepository('TDN\RedactionBundle\Entity\SelectionShopping');
            $resultatsRecherche = $rep->findBySeed($seed);
            $vars['paths']['SelectionShopping'] = 'Redaction_showSelection';
            if ($resultatsRecherche) $vars['contenus']['SelectionShopping'] = $resultatsRecherche;     
 
            $rep = $repository = $em->getRepository('TDN\ConseilExpertBundle\Entity\ConseilExpert');
            $resultatsRecherche = $rep->findBySeed($seed);
            $vars['paths']['Conseils'] = 'ConseilExpert_conseil';
            if ($resultatsRecherche) $vars['contenus']['Conseils'] = $resultatsRecherche;     
 
 			$rep = $repository = $em->getRepository('TDN\VideoBundle\Entity\Video');
            $resultatsRecherche = $rep->findBySeed($seed);
            $vars['paths']['Videos'] = 'VideoBundle_video';
            if ($resultatsRecherche) $vars['contenus']['Videos'] = $resultatsRecherche;     

			$rep = $repository = $em->getRepository('TDN\CauseuseBundle\Entity\Question');
            $resultatsRecherche = $rep->findBySeed($seed);
            $vars['paths']['Questions'] = 'CauseuseBundle_conversation';
            if ($resultatsRecherche) $vars['contenus']['Questions'] = $resultatsRecherche;     

            $rep = $repository = $em->getRepository('TDN\DossierRedactionBundle\Entity\Dossier');
            $resultatsRecherche = $rep->findBySeed($seed);
            // $resultatsRecherche = false;
            $vars['paths']['Dossiers'] = 'DossierRedaction_dossier';
           if ($resultatsRecherche) $vars['contenus']['Dossiers'] = $resultatsRecherche;

            $rep = $repository = $em->getRepository('TDN\ConcoursBundle\Entity\Concours');
            $resultatsRecherche = $rep->findBySeed($seed);
            // $resultatsRecherche = false;
            $vars['paths']['Concours'] = 'Concours_show';
           if ($resultatsRecherche) $vars['contenus']['Concours'] = $resultatsRecherche;


        } else {
            $this->get('session')->getFlashBag()->add('fail', 'Le moteur de recherche exige au moins trois caractères');
            $vars['reponses'] = false;
        }

        $vars['rubrique'] = 'tdn';
        return $this->render('DocumentBundle:Page:resultatsRecherche.html.twig', $vars);
    }

    public function mentionsLegalesAction () {

        $vars['rubrique'] = 'tdn';
        return $this->render('DocumentBundle:Static:MentionsLegales.html.twig', $vars);
    }

    public function equipeTDNAction () {

        $em = $this->get('doctrine.orm.entity_manager');      
        $rep = $repository = $em->getRepository('TDN\NanaBundle\Entity\Nana');

        $vars['admins'] = $rep->findByRole('ROLE_ADMIN');
        $vars['journalistes'] = $rep->findByRole('ROLE_JOURNALISTE');
        $vars['experts'] = $rep->findByRole('ROLE_EXPERT');
        $vars['technique'] = array();
        $vars['rubrique'] = 'tdn';
        return $this->render('DocumentBundle:Page:equipeTDN.html.twig', $vars);
    }

    public function aimeAction ($id) {

        $botList = array('MJ12bot', 'Googlebot');
        $request = $this->get('request');
        $em = $this->get('doctrine.orm.entity_manager');      
        $rep = $repository = $em->getRepository('TDN\DocumentBundle\Entity\Document');
        $doc = $rep->find($id);
        $usr = $this->get('security.context')->getToken()->getUser();
        $agent = $_SERVER['HTTP_USER_AGENT'];

        $isBot = false;
        foreach ($botList as $_b) {
            $isBot = $isBot || strpos($agent, $_b);
        }
        if ($isBot === false) {
            if ($usr instanceof Nana) {
                $rep_journal = $em->getRepository('TDN\CoreBundle\Entity\Journal');
                $instance = $rep_journal->findOneBy(array(
                    'action' => 'AIME',
                    'lnActeur' => $usr->getIdNana(),
                    'titre' => $doc->getTitre()
                ));

                if ($instance instanceof Journal) {
                   $this->get('session')->getFlashBag()->add('fail', 'Tu as déjà voté pour cette page');
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
            $this->get('session')->getFlashBag()->add('success', 'Nous sommes ravies que tu aimes cette page');            
        }

        return $this->redirect($URLmanager->refererURL($request->headers->get('referer')));
    }

    protected function upgradePopularite ($action, $who = NULL) {

        $em = $this->get('doctrine.orm.entity_manager');      

        if (is_null($who)) {
            $who = $this->get('security.context')->getToken()->getUser();
        }
        if ($who instanceof Nana) {
            $backGrade = $who->getGrade();
            $points = $this->container->getParameter('action_points');
            $who->updatePopularite($points[$action]);
            $newGrade = $who->getGrade();
            if ($newGrade > $backGrade) {
                // Signaler dans le journal
                $entree = new Journal;
                $entree->setLnActeur($who);
                $entree->setAction('UPGRADE');
                $route = 'NanaBundle_profil';
                $params = array('id' => $who->getIdNana());
                $entree->setURL($this->generateURL($route, $params));
                $entree->setTexte('a obtenu un nouvel escarpin');
                $entree->setTitre('');
                $entree->setSupport('');
                $entree->setLnRubrique(NULL);
                $entree->setDateEntree(new \DateTime);
                $entree->setLnVeilleur($who);
                $em->persist($entree);
            }
            return $newGrade;
        }
        return false;
    }

}
