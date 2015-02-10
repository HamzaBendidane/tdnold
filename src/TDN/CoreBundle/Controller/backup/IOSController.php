<?php

namespace TDN\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use TDN\DocumentBundle\Entity\Document;
use TDN\DocumentBundle\Entity\DocumentRubrique;
use TDN\ImageBundle\Entity\Image;
use TDN\RedactionBundle\Entity\Article;

class IOSController extends Controller {

    private $RSS;
    protected $rubV3 = array(NULL, 'mode', 'deco', 'beaute', 'recettes', 'bien-etre', 'sexo-psycho', 'a-la-une', 'geekette', NULL);
    const domaine = "http://www.trucsdenana.com";

	private function cut ($texte, $longueur) {

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
        $string = str_replace('\'', '’', $string);
/*        $patterns[0] = '/(\w)\"/';
        $replacement[0] = "$1 » ";
        $patterns[1] = '/"\./';
        $replacement[1] = " ».";
        $patterns[2] = '/\"(\w)/';
        $replacement[2] =  " « $1";       
        $patterns[3] = "/^\s\s+/";
        $replacement[3] = " ";
*/        $patterns[0] = '/\"/';
        $replacement[0] =  "_";
        $patterns[1] = '/&quot;/';
        $replacement[1] =  "*";
        $sortie = preg_replace($patterns, $replacement, $string);
        // $sortie = addslashes($string);
        // $sortie = $string;
        $sortie = preg_replace_callback("/(&#[0-9]+;)/", function($m) { return mb_convert_encoding($m[1], "UTF-8", "HTML-ENTITIES"); }, $sortie);        // $sortie = html_entity_decode($sortie, ENT_QUOTES, 'ISO-8859-1');
        $sortie = html_entity_decode($sortie, ENT_QUOTES, "UTF-8");
        return $sortie;
    }

	private function extractData ($doc, $controleur) {
        	$items = array();
            $items['id'] = $doc->getIdDocument();
            $items['titre'] = $this->safeString($doc->getTitre());
            if ($doc instanceof Article) {
        	   $items['chapo'] = strip_tags($this->safeString($doc->getAbstract())); 
            } else {
            }
            $items['publication'] = $doc->getDatePublication()->format('Y-m-d H:i:s');
        	if ($doc->getLnIllustration() instanceof Image) {
                $_ill = $doc->getLnIllustration();
        		$_m = $_ill->getDatePublication()->format('m/');
        		$_Y = $_ill->getDatePublication()->format('Y/');
        		$dir = '/'.$this->container->getParameter('media_root').$this->container->getParameter('tdn_media').$_Y.$_m;
      		  	$items['photo'] = self::domaine.$dir.$_ill->getFichier();
        	}
        	$rSet = $doc->getLnThematique();
            $items['principale'] = $rSet->getSuperslug();
            $items['url'] = self::domaine.$this->generateURL($controleur, 
            	array('id' => $doc->getIdDocument(),'slug' => $doc->getSlug(), 'rubrique' => $rSet->getSlug()));
            $items['likes'] = $doc->getLikes();
            $items['commentaires'] = count($doc->getCommentaires());
            return $items;
	}

    private function extractArticleData ($doc, $controleur) {
            $items = array();
            $items['id'] = $doc->getIdDocument();
            $items['titre'] = $this->safeString($doc->getTitre());
            if ($doc instanceof Article) {
               $items['chapo'] = $this->safeString($doc->getAbstract()); 
               $items['corps'] = $this->safeString($doc->getCorps()); 
            }
            $items['publication'] = $doc->getDatePublication()->format('Y-m-d H:i:s');
            if ($doc->getLnIllustration() instanceof Image) {
                $_ill = $doc->getLnIllustration();
                $_m = $_ill->getDatePublication()->format('m/');
                $_Y = $_ill->getDatePublication()->format('Y/');
                $dir = '/'.$this->container->getParameter('media_root').$this->container->getParameter('tdn_media').$_Y.$_m;
                $items['photo'] = self::domaine.$dir.$_ill->getFichier();
            }
            $rSet = $doc->getLnThematique();
            $items['principale'] = $rSet->getSuperslug();
            $items['likes'] = $doc->getLikes();
            $_comms = $doc->getCommentaires();
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
                $items['commentaires'] = $commentaires;
            } else {
                $items['commentaires'] = array();
            }
            return $items;
    }

	private function getArticles ($debut, $limite, $panel = NULL) 
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

    private function getOneArticle ($id) 
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $rep = $em->getRepository('TDN\RedactionBundle\Entity\Article');
        $_article = $rep->find($id);
        $resultats = $this->extractArticleData($_article,'RedactionBundle_article');

        return $resultats;
    }

	private function getConseils ($debut, $limite, $panel = NULL) 
    {
		$em = $this->get('doctrine.orm.entity_manager');
        $rep = $em->getRepository('TDN\ConseilExpertBundle\Entity\ConseilExpert');
        $_articles = $rep->findByLot($debut, $limite, $panel);
        $resultats = array();
        foreach ($_articles as $a) {
            $resultats[] = $this->extractData($a,'ConseilExpert_conseil');
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
        $doctype = 4;
        // file_put_contents('json_log.txt', serialize($_REQUEST));

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

        $res = array();
        if ($doctype == 0) {
            $res['flux'] =  $this->getPosts($_debut, $_limite, $panel);
        } else {
            if ($doctype >= 4) {
                $doctype -= 4;
                $res['flux'] = $this->getArticles($_debut, $_limite, $panel);
            }
            if ($doctype >= 2) {
                $doctype -= 2;
                $res['flux'] = $this->getConseils($_debut, $_limite, $panel);
            }
            if ($doctype >= 1) {
                $res['flux'] =  $this->getBreves($_debut, $_limite, $panel);
            }            
        }

        // $flux = json_encode($res);
        $flux = preg_replace("/\\\\u([a-f0-9]{4})/e", "iconv('UCS-4LE','UTF-8',pack('V', hexdec('U$1')))", json_encode($res));
        $flux = str_replace('\\', '', $flux);
        $response = new Response($flux);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Accept-Charset', 'utf-8');
         return $response;
    }

    // Version nouvelle du flux
    public function iOSArticleAction () 
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $repRubriques = $em->getRepository('TDN\DocumentBundle\Entity\DocumentRubrique');

        $request = $this->get('request');
        $id = $request->query->get('id');
        $res = array();
        $res['article'] = $this->getOneArticle($id);
        // $flux = json_encode($res);
        $flux = preg_replace("/\\\\u([a-f0-9]{4})/e", "iconv('UCS-4LE','UTF-8',pack('V', hexdec('U$1')))", json_encode($res));
        $flux = str_replace('\\', '', $flux);
        $response = new Response($flux);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Accept-Charset', 'utf-8');
        return $response;
    }

    private function expandRubriqueBySlug ($slug) {
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
