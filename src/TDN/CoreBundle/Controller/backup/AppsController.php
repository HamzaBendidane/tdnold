<?php

namespace TDN\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use TDN\DocumentBundle\Entity\Document;
use TDN\ImageBundle\Entity\Image;
use TDN\RedactionBundle\Entity\Article;

class AppsController extends Controller {

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

    protected function extractData ($doc, $controleur) {
            $items = array();
            $items['titre'] = $this->safeString($doc->getTitre());
            if ($doc instanceof Article) {
               $items['contenu'] = $this->safeString($this->cut($doc->getCorps(), 150)); 
            } else {
               $items['contenu'] = $this->safeString($this->cut($doc->getQuestion(), 150)); 
            }
            $items['ptime'] = $doc->getDatePublication()->format('Y-m-d H:i:s');
            if ($doc->getLnIllustration() instanceof Image) {
                $_ill = $doc->getLnIllustration();
                $_m = $_ill->getDatePublication()->format('m/');
                $_Y = $_ill->getDatePublication()->format('Y/');
                $dir = '/'.$this->container->getParameter('media_root').$this->container->getParameter('tdn_media').$_Y.$_m;
                $items['photo'] = self::domaine.$dir.$_ill->getFichier();
            }
            $rSet = $doc->getRubriques();
            $items['url'] = self::domaine.$this->generateURL($controleur, 
                array('id' => $doc->getIdDocument(),'slug' => $doc->getSlug(), 'rubrique' => $doc->getLnThematique()->getSlug()));
            return $items;      
    }

	private function extractVideoData ($doc, $controleur) {
    	$items = array();
        $items['titre'] = $this->safeString($doc->getTitre());
        $items['chapo'] = strip_tags($this->safeString($doc->getAbstract())); 
        $items['ptime'] = $doc->getDatePublication()->format('Y-m-d H:i:s');
        $items['likes'] = $doc->getLikes();
        $items['hebergeur'] = $doc->getIdHebergeur();
        $items['idVideo'] = $doc->getIdVideo();
        $items['rubrique'] = $doc->getLnThematique()->getTitre();
        $items['couleur'] = $doc->getLnThematique()->getCouleur();
        $vignette = $doc->getVignette();
        if ($vignette) {
            $items['vignette'] = $vignette;
        } elseif ($doc->getLnIllustration() instanceof Image) {
            $_ill = $doc->getLnIllustration();
    		$_m = $_ill->getDatePublication()->format('m/');
    		$_Y = $_ill->getDatePublication()->format('Y/');
    		$dir = '/'.$this->container->getParameter('media_root').$this->container->getParameter('tdn_media').$_Y.$_m;
  		  	$items['vignette'] = self::domaine.$dir.$_ill->getFichier();
        } else {
            $items['vignette'] = '';
        }
        return $items;      
	}

    protected function extractHeader ($doc, $controleur) {
        $items = array();
        $items['id'] = $doc->getIdDocument();
        $items['titre'] = $this->safeString($doc->getTitre());
        $items['rubrique'] = $doc->getLnThematique()->getTitre();
        $items['couleur'] = $doc->getLnThematique()->getCouleur();
        if ($doc->getLnIllustration() instanceof Image) {
            $_ill = $doc->getLnIllustration();
            $_m = $_ill->getDatePublication()->format('m/');
            $_Y = $_ill->getDatePublication()->format('Y/');
            $dir = '/'.$this->container->getParameter('media_root').$this->container->getParameter('tdn_media').$_Y.$_m;
            $items['photo'] = self::domaine.$dir.$_ill->getFichier();
        }
        $items['url'] = $this->generateURL($controleur, array(
                'slug' => $doc->getSlug(),
                'id' => $doc->getIdDocument(),
                'rubrique' => $doc->getLnThematique()->getSlug()));
        return $items;      
    }

    protected function extractSlider ($doc, $image) {
        $items = array();
        $items['id'] = $doc->getIdDocument();
        $items['titre'] = $this->safeString($doc->getTitre());
        $items['rubrique'] = $doc->getLnThematique()->getTitre();
        $items['couleur'] = $doc->getLnThematique()->getCouleur();
        if ($image instanceof Image) {
            $_ill = $image;
            $_m = $_ill->getDatePublication()->format('m/');
            $_Y = $_ill->getDatePublication()->format('Y/');
            $dir = '/'.$this->container->getParameter('media_root').$this->container->getParameter('tdn_media').$_Y.$_m;
            $items['photo'] = self::domaine.$dir.$_ill->getFichier();
        }
         return $items;      
    }

    private function getVideos ($limite, $panel = NULL) 
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $rep = $em->getRepository('TDN\VideoBundle\Entity\Video');
        $_articles = $rep->findMostRecent($limite, $panel);
        $resultats = array();
        foreach ($_articles as $a) {
            $resultats[] = $this->extractVideoData($a,'VideoBundle_video');
        }

        return $resultats;
    }

	private function getArticles ($limite, $panel = NULL) 
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $rep = $em->getRepository('TDN\RedactionBundle\Entity\Article');
        $_articles = $rep->findMostRecent($limite, $panel);
        $resultats = array();
        foreach ($_articles as $a) {
            $resultats[] = $this->extractData($a,'RedactionBundle_article');
        }

        return $resultats;
	}

	private function getConseils ($limite, $panel = NULL) 
    {
		$em = $this->get('doctrine.orm.entity_manager');
        $rep = $em->getRepository('TDN\ConseilExpertBundle\Entity\ConseilExpert');
        $_articles = $rep->findMostRecent($limite, $panel);
        $resultats = array();
        foreach ($_articles as $a) {
            $resultats[] = $this->extractData($a,'ConseilExpert_conseil');
         }
        return $resultats;
	}

	private function getBreves ($limite, $panel = NULL) 
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $rep = $em->getRepository('TDN\BreveBundle\Entity\Breve');
        $_articles = $rep->findMostRecent($limite, $panel);
        $resultats = array();
        foreach ($_articles as $a) {
        	$items = array();
            $items['titre'] = '';
        	$items['contenu'] = $this->safeString($a->getMessage());
        	$items['url'] = '';
            $items['photo'] = '';
            $items['ptime'] = $a->getDatePublication()->format('Y-m-d H:i:s');
            $resultats[] = $items;
        }

        return $resultats;
	}

	private function getPosts ($limite, $panel = NULL) 
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $rep = $em->getRepository('TDN\DocumentBundle\Entity\Document');
        $_articles = $this->getArticles($limite, $panel);
        $_conseils = $this->getConseils($limite, $panel);
        $_breves = $this->getBreves($limite);
        // $_breves = array();
        $posts = array();
        while (!(empty($_articles) && empty($_conseils) && empty($_breves) )) {
            if (!empty($_articles)) {
                if (!empty($_conseils)) {
                    if (($_articles[0]['ptime'] > $_conseils[0]['ptime'])) {
                        if (($_articles[0]['ptime'] > $_conseils[0]['ptime'])) {
                            $element = array_shift($_articles);
                            $posts[] = $element;                                
                        } else {
                            $element = array_shift($_breves);
                            $posts[] = $element;                                                        
                        }
                    } elseif (!empty($_breves)) {
                        if ($_conseils[0]['ptime'] > $_breves[0]['ptime']) {
                            $element = array_shift($_conseils);
                            $posts[] = $element;
                        } else {
                            $element = array_shift($_breves);
                            $posts[] = $element;                           
                        }
                    } else {
                        $element = array_shift($_conseils);
                        $posts[] = $element;                                  
                    }
                } elseif (!empty($_breves)) {
                    if (($_articles[0]['ptime'] > $_breves[0]['ptime'])) {
                        $element = array_shift($_articles);
                        $posts[] = $element;               
                    } else {
                       $element = array_shift($_breves);
                       $posts[] = $element;               
                    }
                } else {
                    $element = array_shift($_articles);
                    $posts[] = $element;               
                }

            } elseif (!empty($_conseils)) {
                if (!empty($_breves)) {
                    if ($_conseils[0]['ptime'] > $_breves[0]['ptime']) {
                        $element = array_shift($_conseils);
                        $posts[] = $element;
                    } else {
                        $element = array_shift($_breves);
                        $posts[] = $element;
                    }
                } else {
                    $element = array_shift($_conseils);
                    $posts[] = $element;
                }

            } elseif (!empty($_breves)) {
                $element = array_shift($_breves);
                $posts[] = $element;
            } else {}
        }
        return $posts;

	}

    public function iPhoneFluxAction () 
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $repRubriques = $em->getRepository('TDN\DocumentBundle\Entity\DocumentRubrique');

        $request = $this->get('request');
        $categorie = $request->query->get('categorie');
        $type = $request->query->get('type');
        $limite = $request->query->get('limite');
        // file_put_contents('json_log.txt', serialize($_REQUEST));

        if (!$type || (int)$type < 1 || (int)$type > 7) {
            $_type = 0;
        } else $_type = (int)$type;

        if (!$categorie || (int)$categorie < 1 || (int)$categorie > 8) {
            $categorie = $panel = NULL;
        } else {
            $slug = $this->rubV3[$categorie];
            $_r = $repRubriques->findOneBySlug($slug);
            $_ssr = $_r->getSousRubriques();
            if (count($_ssr) === 0) {
                $panel = array($slug);
            } else {
                foreach ($_ssr as $_r) {
                    $panel[] = $_r->getSlug();
                }
            }
        }

        $_limite = $limite ? (int)$limite : 30;
        // $_limite = 3;
        
        $res = array();
        if ($type == 0) {
            $res['flux'] =  $this->getPosts($_limite, $panel);
        } else {
            if ($type >= 4) {
                $type -= 4;
                $res['flux'] = $this->getArticles($_limite, $panel);
            }
            if ($type >= 2) {
                $type -= 2;
                $res['flux'] = $this->getConseils($_limite, $panel);
            }
            if ($type >= 1) {
                $res['flux'] =  $this->getBreves($_limite, $categorie);
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

    // Derniers articles
    public function iOSDerniersArticlesAction () 
    {
        $request = $this->get('request');
        $limite = $request->query->get('limite');
        $panel = NULL;
        $em = $this->get('doctrine.orm.entity_manager');
        $rep = $em->getRepository('TDN\RedactionBundle\Entity\Article');
        $_articles = $rep->findMostRecent($limite, $panel);
        foreach ($_articles as $a) {
            $resultats[] = $this->extractHeader($a,'RedactionBundle_article');
         }

        // $flux = json_encode($res);
        $flux = preg_replace("/\\\\u([a-f0-9]{4})/e", "iconv('UCS-4LE','UTF-8',pack('V', hexdec('U$1')))", json_encode($resultats));
        $flux = str_replace('\\', '', $flux);
        // $response = new Response($flux);
        // $response->headers->set('Content-Type', 'application/json');
        // $response->headers->set('Accept-Charset', 'utf-8');
        // return $response;
        return $flux;
    }

    // Articles mis en avant
    public function iOSFeaturedAction () 
    {
        $request = $this->get('request');
        $limite = $request->query->get('limite') ?: 10;
        $panel = NULL;
        $em = $this->get('doctrine.orm.entity_manager');
        $rep = $em->getRepository('TDN\DocumentBundle\Entity\Slider');
        $_articles = $rep->getFeatured($limite);
        foreach ($_articles as $a) {
            $resultats[] = $this->extractSlider($a->getLnSource(), $a->getlnCover());
         }
        $flux = preg_replace("/\\\\u([a-f0-9]{4})/e", "iconv('UCS-4LE','UTF-8',pack('V', hexdec('U$1')))", json_encode($resultats));
        $flux_featured = str_replace('\\', '', $flux);

        $rep = $em->getRepository('TDN\RedactionBundle\Entity\Article');
        $_articles = $rep->findMostRecent($limite, $panel);
        foreach ($_articles as $a) {
            $resultats[] = $this->extractHeader($a,'RedactionBundle_article');
         }
        $flux = preg_replace("/\\\\u([a-f0-9]{4})/e", "iconv('UCS-4LE','UTF-8',pack('V', hexdec('U$1')))", json_encode($resultats));
        $flux_articles = str_replace('\\', '', $flux);
       // $derniersArticles = $this->iOSDerniersArticlesAction();
        $flux = json_encode(array('featured' => json_decode($flux_featured), 'articles' => json_decode($flux_articles)));

        $response = new Response($flux);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Accept-Charset', 'utf-8');
        return $response;
    }

    public function iOSArticlesAction () 
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
            $_limite = 0;
        } else $_limite = (int)$limite;


        if (is_array($rubrique)) {
            $panel = array();
            foreach ($rubrique as $r) {
                $panel[] = $this->expandRubrique($r);
            }
        } else {
            $panel = $this->expandRubrique($rubrique);
        }

        $res = array();
        if ($type == 0) {
            $res['flux'] =  $this->getPosts($_limite, $panel);
        } else {
            if ($type >= 4) {
                $type -= 4;
                $res['flux'] = $this->getIOSArticles($_limite, $panel);
            }
            if ($type >= 2) {
                $type -= 2;
                $res['flux'] = $this->getConseils($_limite, $panel);
            }
            if ($type >= 1) {
                $res['flux'] =  $this->getBreves($_limite, $panel);
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

    public function iOSVideosAction () 
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


        if (is_array($rubrique)) {
            $panel = array();
            foreach ($rubrique as $r) {
                $panel[] = $this->expandRubrique($r);
            }
        } else {
            $panel = $this->expandRubrique($rubrique);
        }

        $res = array();
        $res['flux'] =  $this->getVideos($_limite, $panel);

        // $flux = json_encode($res);
        $flux = preg_replace("/\\\\u([a-f0-9]{4})/e", "iconv('UCS-4LE','UTF-8',pack('V', hexdec('U$1')))", json_encode($res));
        $flux = str_replace('\\', '', $flux);
        $response = new Response($flux);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Accept-Charset', 'utf-8');
        return $response;
    }

    private function expandRubrique ($rubrique) {
        if (!$rubrique || (int)$rubrique < 1 || (int)$rubrique > 8) {
            $panel = NULL;
        } else {
            $slug = $this->rubV3[$rubrique];
            $_r = $repRubriques->findOneBySlug($slug);
            $_ssr = $_r->getSousRubriques();
            if (count($_ssr) === 0) {
                $panel = array($slug);
            } else {
                foreach ($_ssr as $_r) {
                    $panel[] = $_r->getSlug();
                }
            }
        }
    }

    public function articlesRSSAction ()
    {
        // Récupération de l'entity manager qui va nous permettre de gérer les entités.
        $em = $this->get('doctrine.orm.entity_manager');

        $request = $this->get('request');
        $panel = $request->query->get('vue');
        // Récupération des articles les plus récents
        $rep = $em->getRepository('TDN\RedactionBundle\Entity\Article');
        $_articles = $rep->findMostRecent(10, $panel);

        $RSS = new \SimpleXMLElement('<?xml version="1.0" encoding="utf-8" ?><rss/>');
        $RSS->addAttribute('version', '2.0');

        // $this->flux = new \DomDocument('1.0', 'utf-8');
        // $this->flux->loadXML("<rss version='2.0'><channel></channel></rss>");

        $channel = $RSS->addChild('channel');
        $channel->addChild('title', 'Trucs de Nanas - Articles');
        $channel->addChild('description', 'Nos derniers articles publiés sur http://www.trucsdenana.com --- (10)');
        $channel->addChild('link', 'http://www.trucsdenana.com');
        $channel->addChild('language', 'fr-FR');
        $channel->addChild('generator', 'Texomobile');

        foreach($_articles as $_a) {
        //     // $element = $this->flux->createElement($e);
            $item = $channel->addChild('item');
            $titre = str_replace('&', '&amp;', $_a->getTitre());
            $item->addChild('title', $titre);
            // $item->addChild('title', html_entity_decode(html_entity_decode($_a->getTitre(), ENT_QUOTES, 'UTF-8'), ENT_QUOTES, 'UTF-8'));
            if ($_a->getLnIllustration() instanceof Image) {
                $root = 'http://www.trucsdenana.com/uploads/documents/public/';
                $dossier = $_a->getDatePublication()->format('Y/').$_a->getDatePublication()->format('m/');
                $fichier = $root.$dossier."sqr_".$_a->getLnIllustration()->getFichier();
                $tag = "<img src='$fichier' style='float:left;max-width:100px;margin-right:40px' />";
            } else {
                $tag = '';
            }
            $decodedAbstract = str_replace('&', '&amp;', $_a->getAbstract());
            // $decodedAbstract = html_entity_decode(html_entity_decode($decodedAbstract, ENT_QUOTES, 'UTF-8'), ENT_QUOTES, 'UTF-8');
            $description = $tag.$decodedAbstract;
            $item->addChild('description', $description);
            $item->addChild('pubDate', $_a->getDatePublication()->format('Y-m-d H:i:s'));
            $_r = $_a->getRubriques();
            $url = $this->generateURL('RedactionBundle_article', 
                array('id' => $_a->getIdDocument(), 
                      'slug' => $_a->getSlug(), 
                      'rubrique' => $_r[0]->getSlug()));
            $_aLink = $item->addChild('link', self::domaine.$url);
            $_Guid = $item->addChild('guid', self::domaine.$url);
            if ($_a->getLnIllustration() instanceof Image) {
                $_enclosure = $item->addChild('enclosure');
                $root = 'http://www.trucsdenana.com/uploads/documents/public/';
                $dossier = $_a->getDatePublication()->format('Y/').$_a->getDatePublication()->format('m/');
                $_enclosure->addAttribute('url', $root.$dossier.$_a->getLnIllustration()->getFichier());
                $_enclosure->addAttribute('length', '');
                $_enclosure->addAttribute('type', 'image/jpeg');                
            }
        }

        $flux = $RSS->asXml();
        print_r($flux); die;
        $response = new Response($flux);
        // $response->headers->set('Content-Type', 'application/xml');
        return $response;
    }

       public function conseilsRSSAction ()
    {
        // Récupération de l'entity manager qui va nous permettre de gérer les entités.
        $em = $this->get('doctrine.orm.entity_manager');

        $request = $this->get('request');
        $panel = $request->query->get('vue');
        // Récupération des articles les plus récents
        $rep = $em->getRepository('TDN\ConseilExpertBundle\Entity\ConseilExpert');
        $_articles = $rep->findMostRecent(10, $panel);

        $RSS = new \SimpleXMLElement('<rss/>');
        $RSS->addAttribute('version', '2.0');

        $channel = $RSS->addChild('channel');
        $channel->addChild('title', 'Trucs de Nana - Conseils d’experts');
        $channel->addChild('description', 'Nos derniers conseils publiés sur http://www.trucsdenana.com --- (10)');
        $channel->addChild('link', 'http://www.trucsdenana.com');
        $channel->addChild('language', 'fr-FR');
        $channel->addChild('generator', 'Texomobile');

        foreach($_articles as $_a) {
            $item = $channel->addChild('item');
            $item->addChild('title', $_a->getTitre());
           if ($_a->getLnIllustration() instanceof Image) {
                $root = 'http://www.trucsdenana.com/uploads/documents/public/';
                $dossier = $_a->getDatePublication()->format('Y/').$_a->getDatePublication()->format('m/');
                $fichier = $root.$dossier."sqr_".$_a->getLnIllustration()->getFichier();
                $tag = "<img src='$fichier' style='float:left;max-width:100px;margin-right:40px' />";
            } else {
                $tag = '';
            }
           $item->addChild('description', $tag.$_a->getQuestion());
            $item->addChild('pubDate', $_a->getDatePublication()->format('Y-m-d H:i:s'));
            $_r = $_a->getRubriques();
            $url = $this->generateURL('RedactionBundle_article', 
                array('id' => $_a->getIdDocument(), 
                      'slug' => $_a->getSlug(), 
                      'rubrique' => $_r[0]->getSlug()));
            $_aLink = $item->addChild('link', self::domaine.$url);
            $_Guid = $item->addChild('guid', self::domaine.$url);
            if ($_a->getLnIllustration() instanceof Image) {
                $_enclosure = $item->addChild('enclosure');
                $root = 'http://www.trucsdenana.com/uploads/documents/public/';
                $dossier = $_a->getDatePublication()->format('Y/').$_a->getDatePublication()->format('m/');
                $_enclosure->addAttribute('url', $root.$dossier.$_a->getLnIllustration()->getFichier());
                $_enclosure->addAttribute('length', '');
                $_enclosure->addAttribute('type', 'image/jpeg');                
            }

        }

        $flux = $RSS->asXml();
        $response = new Response($flux);
        // $response->headers->set('Content-Type', 'application/xml');
        return $response;
    }

    public function testFluxAction () 
    {
        return $this->render('CoreBundle:Page:testFlux.html.twig');
    }

}
