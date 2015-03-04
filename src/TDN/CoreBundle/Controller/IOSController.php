<?php

namespace TDN\CoreBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use TDN\DocumentBundle\Entity\Document;
use TDN\DocumentBundle\Entity\DocumentRubrique;
use TDN\ImageBundle\Entity\Image;
use TDN\RedactionBundle\Entity\Article;
use TDN\VideoBundle\Entity\Video;
use Symfony\Component\HttpFoundation\JsonResponse;


class IOSController extends Controller {

    const NOMBRE_DOCUMENTS = 10;
    const DOMAINE = "http://www.trucsdenana.com";

    protected $RSS;
    protected $rubV3 = array(NULL, 'mode', 'deco', 'beaute', 'recettes', 'bien-etre', 'sexo-psycho', 'a-la-une', 'geekette', NULL);

    /**
    *
    * _makeJSON
    *
    * Encodage de la réponse en JSON
    *
    * @param array $resultats — Données à encoder
    * @return $flux
    *
    **/
    protected function _makeJSON ($resultats) {
       // $flux = preg_replace("/\\\\u([a-f0-9]{4})/e", "iconv('UCS-4LE','UTF-8',pack('V', hexdec('U$1')))", json_encode($resultats));
        $flux = str_replace('\\', '', json_encode($resultats));

        return $flux;
    }

    /**
    *
    * _illustrationPath
    *
    * Constrit l'URL de l'illustration d'un document
    *
    * @param Image $image — Image à adjoindre
    * @return string
    *
    **/
    protected function _illustrationPath ($image, $full = false) {
        $_m = $image->getDatePublication()->format('m/');
        $_Y = $image->getDatePublication()->format('Y/');
        $sqr_ = ($full) ? '' : 'sqr_';
        $dir = '/'.$this->container->getParameter('media_root').$this->container->getParameter('tdn_media').$_Y.$_m;
        return self::DOMAINE.$dir.$sqr_.$image->getFichier();
    }

	protected function cut ($texte, $longueur) {

		$nakedTexte = strip_tags($texte);
		if (strlen($nakedTexte) > $longueur) {
			$sample = substr($nakedTexte,0,$longueur);
			$_x = strrpos($sample, ' ');
			$_y = strrpos($sample, '.');
			$_z = strrpos($sample, ',');
			$sample = substr($sample,0,max($_x,$_y,$_z)).'... Lire la suite';
            return $sample;
 		} else {
			return $nakedTexte;
		}
	}

    public function safeString($string)
    {
        $string = preg_replace('/\\r\\n/', '', $string);

        $sortie = html_entity_decode($string, ENT_QUOTES, "UTF-8");
        return $sortie;
    }

    /**
    *
    * _extractHeader
    *
    * Fournit les données d'un Document pour les affichages en liste
    *
    * @param Document $doc — Document à analyser
    * @param String $controleur — Le contrôleur associé au document
    * @return array $items
    *
    **/
    protected function _extractHeader ($doc, $controleur) {
        $items = array();
        $items['id'] = intval($doc->getIdDocument());
        $items['chapo'] = $this->safeString(strip_tags($doc->getAbstract()));
        $items['titre'] = $this->safeString($doc->getTitre());
        $items['rubrique'] = $doc->getLnThematique()->getTitre();
        $items['couleur'] = $doc->getLnThematique()->getCouleur();
        $items['principale'] = $doc->getLnThematique()->getTitre();
        $items['likes'] = $doc->getLikes();
        $items['date'] = $doc->getDatePublication()->format('Y-m-d H:i:s');;
        $items['commentaires'] = count($doc->getCommentaires());
        $_hasVignette = false;
        if ($doc instanceof Video) {
            $items['idHebergeur'] = $doc->getIdHebergeur();
            $items['idVideo'] = $doc->getIdVideo();
            if (!is_null($doc->getVignette())) {
                $items['photo'] = $doc->getVignette();
                $_hasVignette = true;
            }
        }
        if (!$_hasVignette) {
            if ($doc->getLnIllustration() instanceof Image) {
                $items['photo'] = $this->_illustrationPath($doc->getLnIllustration());
            }            
        }
        $items['url'] = $this->generateURL($controleur, array(
                'slug' => $doc->getSlug(),
                'id' => $doc->getIdDocument(),
                'rubrique' => $doc->getLnThematique()->getSlug()));
        return $items;      
    }


    /**
    *
    * extractData
    *
    * Fournit les données d'un Document pour les affichages en liste
    *
    * @param Document $doc — Document à analyser
    * @param String $controleur — Le contrôleur associé au document
    * @return array $items
    *
    **/
	protected function extractData ($doc, $controleur) {
        	$items = array();
            $items['id'] = $doc->getIdDocument();
            $items['titre'] = $this->safeString($doc->getTitre());
            $items['chapo'] = strip_tags($this->safeString($doc->getAbstract()));

            $items['publication'] = $doc->getDatePublication()->format('Y-m-d H:i:s');
        	if ($doc->getLnIllustration() instanceof Image) {
                $_ill = $doc->getLnIllustration();
        		$_m = $_ill->getDatePublication()->format('m/');
        		$_Y = $_ill->getDatePublication()->format('Y/');
        		$dir = '/'.$this->container->getParameter('media_root').$this->container->getParameter('tdn_media').$_Y.$_m;
      		  	$items['photo'] = self::DOMAINE.$dir.'sqr_'.$_ill->getFichier();
        	}
            $items['principale'] = $doc->getLnThematique()->getSuperSlug();
            $items['couleur'] = $doc->getLnThematique()->getCouleur();
            $items['url'] = self::DOMAINE.$this->generateURL($controleur, 
            	array('id' => $doc->getIdDocument(),'slug' => $doc->getSlug(), 'rubrique' => $doc->getLnThematique()->getSlug()));
            $items['likes'] = $doc->getLikes();
            $items['commentaires'] = count($doc->getCommentaires());
            return $items;
	}

    /**
    *
    * _extractCommentaires
    *
    * Prépare les commentaires prpore au document pour l'iPhone
    *
    * @param Document $document — Document à envoyer
    * @return array $commentaires
    *
    **/
    protected function _extractCommentaires($document) {
        $_comms = $document->getCommentaires();
        if (!empty($_comms)) {
            $commentaires = array();
            foreach ($_comms as $c) {
                $_element = array();
                if (is_null($c->getFilAuteur())) {
                    $_element['id'] = '';
                    $_element['username'] = 'Anonyme';
                    $_element['age'] = '';
                    $_element['avatar'] = '';
                } else {
                    $_element['id'] = $c->getFilAuteur()->getIdNana();
                    $_element['username'] = $c->getFilAuteur()->getUsername();
                    $_element['age'] = $c->getFilAuteur()->getAge();
                    $_element['avatar'] = $c->getFilAuteur()->getLnAvatar()->getFichier();
                }
                $_element['publication'] = $c->getDatePublication()->format('Y-m-d H:i:s');
                $_element['likes'] = $c->getLike();
                $_element['texteCommentaire'] = str_replace("\"", "”", $c->getTexteCommentaire());
                $commentaires[] = $_element;
            }
            return $commentaires;
        } else {
            return array();
        }
    }

    /**
    *
    * _extractSlider
    *
    * Prépare les données propres aux documents mis en avant
    *
    * @param Document $document — Document à envoyer
    * @return array $commentaires
    *
    **/
    protected function _extractSlider ($doc, $image) {
        $items = array();
        $items['id'] = $doc->getIdDocument();
        $items['titre'] = $this->safeString($doc->getTitre());
        $items['rubrique'] = $doc->getLnThematique()->getTitre();
        $items['couleur'] = $doc->getLnThematique()->getCouleur();
        if ($image instanceof Image) {
            $items['photo'] = $this->_illustrationPath($image, 'full');
        }
         return $items;      
    }

    /**
    *
    * _extractDocumentData
    *
    * Prépare les données génériques à tous les documents pour l'iPhone
    *
    * @param Document $doc — Document à envoyer
    * @param Controller $controleur — Contrôleur
    * @param boolean $safe — prétraitement du texte ()
    * @return array $items
    *
    **/
    protected function _extractDocumentData ($doc, $controleur, $safe = false) {
        $items = array();
        $items['id'] = $doc->getIdDocument();
        $items['titre'] = $this->safeString($doc->getTitre());
        $items['chapo'] = $this->safeString($doc->getAbstract());
        $items['publication'] = $doc->getDatePublication()->format('Y-m-d H:i:s');
        $specials = $this->_extractDocumentTypeData($doc);
        $items = array_merge($items, $specials);
        if ($doc->getLnIllustration() instanceof Image) {
            $items['photo'] = $this->_illustrationPath($doc->getLnIllustration());
        }
        $items['principale'] = $doc->getLnThematique()->getTitre();
        $items['likes'] = $doc->getLikes();
        $items['commentaires'] = $this->_extractCommentaires($doc);
        return $items;
    }

    /**
    *
    * _getOneContenu
    *
    * Prépare les données d'un contenu pour l'envoi vers iPhone
    *
    * @param array $type — Données relatives au type de contenu : entité et route
    * @param int $id — Identifiant du document à envoyer
    * @return $resultats
    *
    **/
    protected function _getOneContenu (array $entite, $id) {

        $request = $this->get('request');
        $em = $this->get('doctrine.orm.entity_manager');

        $rep = $em->getRepository($entite['entite']);
        $_contenu = $rep->find($id);
        if (!is_object($_contenu)) {

            $ack = array('reponse' => 'ERRNODOC');
            return new JsonResponse($ack);

        } else {

            $resultats = $this->_extractDocumentData($_contenu, $entite['route']);

        }

        return new JsonResponse($resultats);
    }

    /**
    *
    * iOSDerniersContenusAction
    *
    * Fournit une liste des derniers contenus d'un type donné
    *
    * @param array $type Données relatives au type de contenu : entité et route
    * @return Response $response
    *
    **/
    protected function _iOSDerniersContenus (array $type) {

        $request = $this->get('request');
        $limite = (int)($request->query->get('limite') ?: self::NOMBRE_DOCUMENTS);
        $debut = (int)($request->query->get('debut') ?: self::NOMBRE_DOCUMENTS);

        $panel = NULL;
        $em = $this->get('doctrine.orm.entity_manager');
        $rep = $em->getRepository($type['entite']);
        $_articles = $rep->findMostRecent($limite, $panel,$debut);
        foreach ($_articles as $a) {
            $resultats[] = $this->_extractHeader($a, $type['route']);
         }

        return new JsonResponse($resultats);
    }

    /**
    *
    * iOSFeaturedAction
    *
    * Fournit une liste des derniers contenus mis en avant
    *
    * @param array $type Données relatives au type de contenu : entité et route
    * @return Response $response
    *
    **/
    public function iOSFeaturedAction () 
    {
        $request = $this->get('request');
        $limite = (int)($request->query->get('limite') ?: self::NOMBRE_DOCUMENTS);
        $panel = NULL;
        $em = $this->get('doctrine.orm.entity_manager');
        $rep = $em->getRepository('TDN\DocumentBundle\Entity\Slider');
        $_articles = $rep->getFeatured($limite);
        foreach ($_articles as $a) {
            $resultats[] = $this->_extractSlider($a->getLnSource(), $a->getlnCover());
         }
        $flux_featured = $this->_makeJSON($resultats);

        $rep = $em->getRepository('TDN\RedactionBundle\Entity\Article');
        $_articles = $rep->findMostRecent($limite, $panel);
        $resultats = array();
        foreach ($_articles as $a) {
            $resultats[] = $this->_extractHeader($a,'RedactionBundle_article');
         }
        $flux_articles = $this->_makeJSON($resultats);
       // $derniersArticles = $this->iOSDerniersArticlesAction();
        $flux = json_encode(array('featured' => json_decode($flux_featured), 'articles' => json_decode($flux_articles)));

        $response = new Response($flux);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Accept-Charset', 'utf-8');
        return $response;
    }

	protected function getArticles ($debut, $limite, $panel = NULL)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $rep = $em->getRepository('TDN\RedactionBundle\Entity\Article');
        $_articles = $rep->findByLot($debut, $limite, 'ARTICLE_PUBLIE', $panel);
        $resultats = array();
        foreach ($_articles as $a) {
            $resultats[] = $this->extractData($a,'RedactionBundle_article');
        }

        return $resultats;
	}

	protected function getConseils ($debut, $limite, $panel = NULL)
    {
		$em = $this->get('doctrine.orm.entity_manager');
        $rep = $em->getRepository('TDN\ConseilExpertBundle\Entity\ConseilExpert');
        $_articles = $rep->findByLot($debut, $limite, 'CONSEIL_PUBLIE', $panel);
        $resultats = array();
        foreach ($_articles as $a) {
            $resultats[] = $this->extractData($a,'ConseilExpert_conseil');
         }
        return $resultats;
    }

    protected function getQuestions ($debut, $limite, $panel = NULL)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $rep = $em->getRepository('TDN\CauseuseBundle\Entity\Question');
        $_articles = $rep->findByLot($debut, $limite, 'QUESTION_PUBLIEE', $panel);
        $resultats = array();
        foreach ($_articles as $a) {
            $resultats[] = $this->extractData($a,'CauseuseBundle_conversation');
         }
        return $resultats;
    }

    // Version nouvelle du flux
    public function iOSFluxAction () 
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $repRubriques = $em->getRepository('TDN\DocumentBundle\Entity\DocumentRubrique');

        $request = $this->get('request');
        $rubrique = $request->query->get('rubrique');
        $debut = $request->query->get('debut');
        $limite = $request->query->get('limite');
        $doctype = $request->query->get('doctype');
        $doctype = $doctype ?: 4;

        $_debut = (int)$debut;

        if (!$limite || (int)$limite < 0) {
            $_limite = 10;
        } else $_limite = (int)$limite;


        if (empty($rubrique)) {
            $panel = NULL;
        }
        elseif (is_array($rubrique)) {
            $panel = array();
            foreach ($rubrique as $r) {
                $panel[] = $this->expandRubriqueBySlug($r);
            }
        } else {
            $panel = $this->expandRubriqueBySlug($rubrique);
        }
        switch ($doctype){
            case 0 :
                die;
                $res['flux'] =  $this->getPosts($_debut, $_limite, $panel);
                break;
            case 4 :
                $res['flux'] = $this->getArticles($_debut, $_limite, $panel);
                break;
            case 2 :
                $res['flux'] = $this->getConseils($_debut, $_limite, $panel);
                break;
            case 1 :
                $res['flux'] =  $this->getQuestions($_debut, $_limite, $panel);
                break;
        }

        return new JsonResponse($res);
    }

    protected function expandRubriqueBySlug ($slug) {
        $em = $this->get('doctrine.orm.entity_manager');
        $repRubriques = $em->getRepository('TDN\DocumentBundle\Entity\DocumentRubrique');
        $_r = $repRubriques->findOneBySlug($slug);
        $_ssr = $_r->getSousRubriques();
        if (count($_ssr) === 0) {
            $panel = array($slug);
        } else {
            foreach ($_ssr as $_r) {
                $panel[] = $_r->getSlug();
            }
        }

        return $panel;
    }
}
