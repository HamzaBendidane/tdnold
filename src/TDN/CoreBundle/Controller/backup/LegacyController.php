<?php

namespace TDN\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;

use TDN\RedactionBundle\Entity\Article;
use TDN\ConseilExpertBundle\Entity\ConseilExpert;
use TDN\DossierRedactionBundle\Entity\Dossier;
use TDN\VideoBundle\Entity\Video;

class LegacyController extends Controller {
    
    protected $legacyRubriquesPairs = array(
        'alaune' => 'a-la-une',
        'bienetre' => 'bien-etre',
        'sexo' => 'sexo-psycho',
        'hightech' => 'geekette'
        );

    public function equipeAction() {
	
		return $this->redirect($this->generateURL('Document_equipeTDN'), 301);

    }

	public function iPhoneFluxAction () {

        $request = $this->get('request');
        $query = array();
        $categorie = $request->query->get('categorie');
        if ($categorie) { $query[] = "categorie=$categorie"; }
        $type = $request->query->get('type');
        if ($type) { $query[] = "type=$type"; }
        $limite = $request->query->get('limite');
        if ($limite) { $query[] = "limite=$limite"; }
        $query = "?".implode("&", $query);

		return $this->redirect('http://v2.trucdenana.com/lib/rss/json_tdn.php'.$query, 301);
	}

    public function sommaireRubriqueAction ($rubrique) {

        if (array_key_exists($rubrique, $this->legacyRubriquesPairs)) {
            $rubrique = $this->legacyRubriquesPairs[$rubrique];
        }

        return $this->redirect($this->generateURL('Core_sommaire', array('slug' => $rubrique)), 301);
    }

    public function rechercheAction () {

        $request = $this->get('request');
        $query = array();
        $chaine = $request->query->get('recherche');

        return $this->redirect($this->generateURL('Document_recherche', array('seed' => $chaine)), 301);
    }

    public function pageAction($titre)
    {
        switch ($titre) {
            case 'mentions-legales':
                $routeID = 'Document_mentionsLegales';
                break;
            case 'partenaires':
                $routeID = '_welcome';
                break;
            case 'suggestions':
                $routeID = 'Core_contact';
                break;
            
            case 'pourquoi-devenir-membre':
            // NanaBundle_registerForm ?
            default:
                $routeID = '_welcome';
        }
        return $this->redirect($this->generateURL($routeID, array()), 301);
    }

    public function nakedSlugAction($slug, $id)
    {
        $categorie = substr($identifiant,0,3);
        $slug = trim($slug, '- ');
        $slug = preg_replace('/^(sexo|deco|beaute|mode|recettes|alaune|bienetre)-/i', '', $slug);
        switch ($categorie) {
            case 'art':
                $em = $this->get('doctrine.orm.entity_manager');      
                $rep_articles = $em->getRepository('TDN\RedactionBundle\Entity\Article');
                $_art = $rep_articles->findOneBySlug($slug);
                if ($_art instanceof Article) {
                    $rubriques = $_art->getRubriques();
                    return $this->redirect($this->generateURL('RedactionBundle_article', 
                        array('slug' => $_art->getSlug(), 'id' => $_art->getIdDocument(), 'rubrique' => $rubriques[0]->getSlug()),
                        301
                    ));
                } else {
                    throw new NotFoundHttpException('Page inconnue!');
                }
                break;
            
            case 'con':
                $em = $this->get('doctrine.orm.entity_manager');      
                $rep_conseil = $em->getRepository('TDN\ConseilExpertBundle\Entity\ConseilExpert');
                $_con = $rep_conseil->findOneBySlug($slug);
                if ($_con instanceof ConseilExpert) {
                    $rubriques = $_con->getRubriques();
                    return $this->redirect($this->generateURL('ConseilExpert_conseil', 
                        array('slug' => $_con->getSlug(), 'id' => $_con->getIdDocument(), 'rubrique' => $rubriques[0]->getSlug()),
                        301
                    ));
                } else {
                    throw new NotFoundHttpException('Page inconnue!');
                }
                break;
            
            default:
               throw new NotFoundHttpException('Page inconnue!');
        }
    }

    public function nakedURLAction ($slug, $id) 
    {
        $em = $this->get('doctrine.orm.entity_manager');      
        $rep_documents = $em->getRepository('TDN\DocumentBundle\Entity\Document');
        $_docList = $rep_documents->findByV2ID($id);
        $_docMap = array();
        foreach ($_docList as $_doc) {
            if (($_doc instanceof Article) || ($_doc instanceof ConseilExpert) || ($_doc instanceof Dossier) || ($_doc instanceof Video)) {
                $_r = $_doc->getRubriques();
                $classe = explode('\\', get_class($_doc));
                $classe = array_pop($classe);
                $params = array(
                    'id' => $_doc->getIdDocument(), 
                    'slug' => $_doc->getSlug(), 
                    'rubrique' => $_r[0]->getSlug(),
                    'classe' => $classe
                );
                $_docMap[similar_text($slug, $_doc->getSlug())] = $params;
            }
        }

        if (!empty($_docMap)) {
            krsort($_docMap);
            $_doc = array_shift($_docMap);
            $_proximite = similar_text($slug, $_doc['slug'], $percent);
            if ((float)$percent > 80) {
                $classe = array_pop($_doc);
                switch($classe) {
                    case 'Article' :
                        return $this->redirect($this->generateURL('RedactionBundle_article', $_doc), 301);
                        break;

                    case 'ConseilExpert' :
                        return $this->redirect($this->generateURL('ConseilExpert_conseil', $_doc), 301);
                        break;

                    case 'Video' :
                        return $this->redirect($this->generateURL('VideoBundle_video', $_doc), 301);
                        break;

                    case 'Dossier' :
                        return $this->redirect($this->generateURL('DossierRedaction_dossier', $_doc), 301);
                        break;

                    default:
                }
            }            
        }

        $this->get('session')->getFlashBag()->add('success', 'La page demandée n’existe plus.');
        return $this->redirect($this->generateURL('_welcome'), 301);
    }

    public function goneAction () {
        $response = $this->render('CoreBundle:Errors:410-gone.html.twig', array('rubrique' => 'tdn'));
        return new Response($response, 410);
    }

    public function homeAction($value='') {
        return $this->redirect($this->generateURL('_welcome', array()), 301);
    }

    public function infolegalAction () {
        return $this->redirect($this->generateURL('Document_mentionsLegales', array()), 301);
    }

    public function feedbyContenuAction ($type) {
        switch($type) {
            case 'conseil' :
                return $this->redirect('http://www.trucsdenana.com/feeds/conseils-experts.rss', 301);
                break;

            default:
                return $this->redirect('http://www.trucsdenana.com/feeds/articles.rss', 301);
        }         
    }
}
