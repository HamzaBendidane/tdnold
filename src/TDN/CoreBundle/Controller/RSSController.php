<?php

namespace TDN\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class RSSController extends Controller {

    private $flux;
    private $root = 'http://www.trucdenana.com/uploads/documents/public/';
    private $limite = 30;


    public function feedAction ()
    {
        $em = $this->get('doctrine.orm.entity_manager');      
        $repository = $em->getRepository('TDN\RedactionBundle\Entity\Article');
        $this->flux = new \DomDocument('1.0', 'utf-8');
        $this->flux->loadXML("<rss version='2.0'><channel></channel></rss>");
        $articles = $repository->findMostRecent($this->limite);
        $this->treeBuilder($articles, "Trucs de Nana");
        $summary = $this->flux->saveXML();

        $reponse = new Response($summary);
        $reponse->headers->set('Content-Type', 'application/rss+xml');
        $reponse->headers->set('Accept-Charset', 'utf-8');
        return $reponse;
    }

    public function feedByContenuAction ($type)
    {
        $em = $this->get('doctrine.orm.entity_manager');      
        switch ($type) {
            // Conseils
            case 'conseils-experts':
                $repository = $em->getRepository('TDN\ConseilExpertBundle\Entity\ConseilExpert');
                $titreFlux = "Trucs de Nana - Conseils d'experts";
                break;
            // Videos
            case 'videos':
                $repository = $em->getRepository('TDN\VideoBundle\Entity\Video');
                $titreFlux = "Trucs de Nana - Vidéos";
                break;
            // Questions de nanas
            case 'questions-de-nanas':
                $repository = $em->getRepository('TDN\CauseuseBundle\Entity\Question');
                $titreFlux = "Trucs de Nana - Questions de nanas";
                break;
            // Dossier de la rédaction
            case 'dossiers':
                $repository = $em->getRepository('TDN\DossierRedactionBundle\Entity\Dossier');
                $titreFlux = "Trucs de Nana - Dossiers de la rédaction";
                break;
            
            // Articles
            case 'articles':
            default:
                $repository = $em->getRepository('TDN\RedactionBundle\Entity\Article');
                $titreFlux = "Trucs de Nana - Articles";
        }
        
        $this->flux = new \DomDocument;
        $this->flux->loadXML("<rss version='2.0'><channel></channel></rss>");
        $articles = $repository->findMostRecent($this->limite);
        $this->treeBuilder($articles, $titreFlux);
        $summary = $this->flux->saveXML();

        $reponse = new Response($summary);
        $reponse->headers->set('Content-Type', 'application/rss+xml');
        $reponse->headers->set('Accept-Charset', 'utf-8');
        return $reponse;
    }

    private function treeBuilder($articles, $titreFlux) {
        $elements = array('title', 'link', 'description', 'language', 'managingEditor', 'lastBuildDate');
        $channel = $this->flux->getElementsByTagName("channel")->item(0);

        foreach ($elements as $e) {
            $element = $this->flux->createElement($e);
            switch ($e) {
                // Titre
                case 'title':
                    $contenu = $titreFlux;
                    break;
                // URL du site
                case 'link':
                    $contenu = "http://www.trucsdenana.com".$this->generateURL('_welcome');
                    break;
                // Description
                case 'description':
                    $contenu = "Flux RSS 2.0 émis par Trucdenana.com";
                    break;
                // Langue
                case 'language':
                    $contenu  = 'fr-FR';
                    break;
                // Editeur
                case 'managingEditor':
                    $contenu = 'justine@trucsdenana.com';
                    break;
                // Rubrique principale de l'article
                case 'lastBuildDate':
                    $contenu = new \DateTime;
                    $contenu = $contenu->format("d M Y H:i:s");
                    break;
                default:
            }
            $channel->appendChild($element);
            $element->appendChild($this->flux->createTextNode($contenu));
        }

        foreach ($articles as $a) {
            $item = $this->entryBuilder($a);
            $channel->appendChild($item);
        }

    }

    private function entryBuilder ($article) {
        $elements = array('title', 'link', 'description', 'pubDate', 'author', 'category', 'enclosure');
        $_thematique= $article->getLnThematique();
        // Création d'un item
        $item = $this->flux->createElement('item');

        foreach ($elements as $e) {
            $element = $this->flux->createElement($e);
            switch ($e) {
                // Titre
                case 'title':
                    $contenu = $article->getTitre();
                    break;
                // URL de l'article
                case 'link':
                    $contenu = "http://www.trucsdenana.com".$this->generateURL('RedactionBundle_article', 
                        array('id' => $article->getIdDocument(),
                              'slug' => $article->getSlug(),
                              'rubrique' => $_thematique->getSlug()));
                     break;
                // Description
                case 'description':
                    $contenu = html_entity_decode(strip_tags($article->getAbstract()));
                    break;
                // Date de Publication
                case 'pubDate':
                    $contenu  = $article->getDatePublication()->format("d M Y H:i:s");
                    break;
                // Auteur de l'article
                case 'author':
                    $contenu = $article->getLnAuteur()->getEmail();
                    break;
                // Rubrique principale de l'article
                case 'category':
                    $contenu = $_thematique->getTitre();
                    break;
                // Image associée
                case 'enclosure':
                    $ill = $article->getLnIllustration();
                    if ($ill instanceof Image) {
                        $dossier = $article->getDatePublication()->format('Y/').$article->getDatePublication()->format('m/');
                        $element->setAttribute('url', $this->root.$dossier.$article->getLnIllustration()->getFichier());
                        $element->setAttribute('length', '');
                        $element->setAttribute('type', 'image/jpeg');                        
                    }
                    break;
                default:
            }
            $item->appendChild($element);
            if (isset($contenu)) {
                $element->appendChild($this->flux->createTextNode($contenu));
            }
            unset($contenu);
        }

        return $item;
    }
}