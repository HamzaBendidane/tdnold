<?php

namespace TDN\CoreBundle\URL;

use Symfony\Bundle\FrameworkBundle\Routing\Router;

use Doctrine\ORM\EntityManager;

class URLSitemapper {   

    /**
     * @var $em
     * Entity Manager
     */
    private $em;

    /**
     * @var $router
     * Routeur pour la construction des URL
     */
    private $router;

    /**
     * @var $stub
     * Racine de l'arbre XML de la carte de site
     */
    private $stub = '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></urlset>';


    public function __construct (EntityManager $manager, Router $router) {
        $this->em = $manager;
        $this->router = $router;
    }


    /**
    * Construction ex nihilo d'une carte du site selon un type de document
    *
    * @param string $type Type du document attendu (article, consseil, etc.) reprenant de discrimniateur de la classe
    * Document
    * @param int $annee Année à prendre en compe pour l'engendrement de la carte
    * @return boolean $err Renvoie true si la carte a pu être créée, false sinon
    */
    
    public function make($type, $annee)
    {
        switch ($type) {
            case 'article':
                $statut = 'ARTICLE_PUBLIE';
                $route = 'RedactionBundle_article';
                $priority = '0.8';
                $changefreq = 'weekly';
                $genre = 'Blog, Opinion';
                break;
            case 'conseil-expert':
                $statut = 'CONSEIL_PUBLIE';
                $route = 'ConseilExpert_conseil';
                $priority = '0.8';
                $changefreq = 'weekly';
                $genre = 'Blog, Opinion';
               break;
            case 'dossier':
                $statut = 'DOSSIER_PUBLIE';
                $route = 'DossierRedaction_dossier';
                $priority = '0.7';
                $changefreq = 'weekly';
                $genre = 'Opinion';
               break;
            case 'question-de-nana':
                $statut = 'QUESTION_PUBLIEE';
                $route = 'CauseuseBundle_conversation';
                $priority = '0.7';
                $changefreq = 'daily';
                $genre = 'UserGenerated';
               break;
            case 'selection-shopping':
                $statut = 'SELECTION_PUBLIEE';
                $route = 'Redaction_showSelection';
                $priority = '0.6';
                $changefreq = 'weekly';
                $genre = 'Opinion';
               break;
            case 'video':
                $statut = 'VIDEO_PUBLIEE';
                $route = 'VideoBundle_video';
                $priority = '0.5';
                $changefreq = 'weekly';
                $genre = 'UserGenerated';
               break;
            case 'concours':
                $statut = 'CONCOURS_PUBLIE';
                $route = 'VideoBundle_video';
                $priority = '0.4';
                $changefreq = 'weekly';
                $genre = 'UserGenerated';
               break;
            case 'quiz':
                $statut = 'QUIZ_PUBLIE';
                $route = 'Quiz_quiz';
                $priority = '0.3';
                $changefreq = 'weekly';
                $genre = 'UserGenerated';
               break;
            default:
        }

        $repository = $this->em->getRepository('TDN\DocumentBundle\Entity\Document');
        $qb = $repository->createQueryBuilder('u');
        $qexpr = $qb->expr();
        $query = $qb->select('u.idDocument')
                    ->where($qexpr->andX(
                        $qexpr->like('u.statut', ':typeDoc'),
                        $qexpr->gte('u.datePublication', ':debut'),
                        $qexpr->lt('u.datePublication', ':fin')))
                    ->setParameter('debut', new \DateTime($annee.'-01-01'))
                    ->setParameter('fin', new \DateTime(1+$annee.'-01-01'))
                    ->setParameter('typeDoc', $statut);

        $query = $query->orderBy('u.datePublication', 'ASC')
                       ->setMaxResults(3000)
                       ->getQuery();
         $documents = $query->getResult();
echo count($documents);
         $map = new \SimpleXMLElement($this->stub);

         foreach ($documents as $d) {
            $actualDoc = $repository->find($d['idDocument']);
            $feuille = $map->addChild('url');
            $rubriques = $actualDoc->getRubriques();
            $princeps = $rubriques[0]->getSlug();
            $url = $this->router->generate($route, 
                array('id' => $actualDoc->getIdDocument(), 'slug' => $actualDoc->getSlug(), 'rubrique' => $princeps));
            $feuille->addChild('loc', 'http://www.trucsdenana.com'.$url);
            $feuille->addChild('lastmod', $actualDoc->getDateModification()->format('Y-m-d'));
            $now = new \DateTime;
            $changefreq = ($annee == $now->format('Y')) ? $changefreq : 'never';
            $feuille->addChild('changefreq', $changefreq);
            $feuille->addChild('priority', $priority);
        }
        $XMLFile = $type.'map_'.$annee.'.xml';
        $err = $map->asXML($XMLFile);
         if ($err) {
            $xmlmap = file_get_contents($XMLFile);
            $xmlmap = str_replace('news_', 'news:', $xmlmap);
            $xmlmap = preg_replace('/></',">\n<", $xmlmap);
            $err = file_put_contents($XMLFile, $xmlmap);
         }
         return $err;
    }

    /**
    * Création d'une carte de site pour Google Actu. Prend en compte les publications récentes.
    *
    * @return boolean $err Renvoie true si la carte a pu être créée, false sinon
    */
    
    public function actu()
    {
        $repository = $this->em->getRepository('TDN\DocumentBundle\Entity\Document');
        
        $routes = array(
            'ARTICLE_PUBLIE' => 'RedactionBundle_article',
            'CONSEIL_PUBLIE' => 'ConseilExpert_conseil', 
            'QUESTION_PUBLIEE' => 'CauseuseBundle_conversation');
        $now = new \DateTime;
        $laps = $now->sub(new DateInterval('P2D'));

        $qb = $repository->createQueryBuilder('u');
        $qexpr = $qb->expr();
        $query = $qb->select('u')
                    ->where($qexpr->andX(
                        $qexpr->in('u.statut', ':typeDoc'),
                        $qexpr->gte('u.datePublication', ':debut'),
                        $qexpr->lt('u.datePublication', ':fin')))
                    ->setParameter('debut', $laps)
                    ->setParameter('fin', $now)
                    ->setParameter('typeDoc', array_keys($routes));

        $query = $query->orderBy('u.datePublication', 'ASC')
                       ->setMaxResults(3000)
                       ->getQuery();
         $documents = $query->getResult();

         $map = new \SimpleXMLElement($this->stub);

         foreach ($documents as $actualDoc) {
            $feuille = $map->addChild('url');
            $rubriques = $actualDoc->getRubriques();
            $princeps = $rubriques[0]->getSlug();
            $url = $this->router->generate($routes[$actualDoc->getStatut()], 
                array('id' => $actualDoc->getIdDocument(), 'slug' => $actualDoc->getSlug(), 'rubrique' => $princeps));
            $feuille->addChild('loc', 'http://www.trucsdenana.com'.$url);
            $news = $feuille->addChild('news_news');
            $publication = $news->addChild('news_publication');
            $publication->addChild('news_name', 'Truc de nana');
            $publication->addChild('news_language', 'fr');
            if ($actualDoc->getStatut() != 'QUESTION_PUBLIEE') {
                $genre = 'Blog, Opinion';
            } else {
                $genre = 'UserGenerated';
            }
            $news->addChild('news_genres', $genre);
            $news->addChild('news_publicationDate', $actualDoc->getDatePublication()->format('Y-m-d H:i:s'));
            $titre = str_replace('&', '&amp;', $actualDoc->getTitre());
            $news->addChild('news_title', $titre);
            $keywords = implode(',', explode(' ', str_replace('&', '&amp;', $actualDoc->getTags())));
            $news->addChild('news_keywords', $keywords);
         }
        $XMLFile = 'sitemap_actus.xml';
         $err = $map->asXML($XMLFile);
         if ($err) {
            $xmlmap = file_get_contents($XMLFile);
            $xmlmap = str_replace('news_', 'news:', $xmlmap);
            $xmlmap = preg_replace('/></',">\n<", $xmlmap);
            $err = file_put_contents($XMLFile, $xmlmap);
         }
         return $err;
    }

    /**
    * Ajout d'un nouveau document dans la carte du site
    *
    * @param string $type Type du document attendu (article, consseil, etc.) reprenant de discrimniateur de la classe
    * Document
    * @param Document $doc L'instance de la classe Document qui vient d'être créée
    * @return boolean $err Renvoie true si la carte a pu être créée, false sinon
    */
    
    public function update($type, $doc)
    {
        switch ($type) {
            case 'article':
                $statut = 'ARTICLE_PUBLIE';
                $route = 'Redactionbundle_article';
                $priority = '0.8';
                break;
            case 'conseil':
                $statut = 'CONSEIL_PUBLIE';
                break;
            default:
        }

        $map = new \SimpleXMLElement('sitemaps/'.$type.'_map.xml', FALSE, TRUE);

        foreach ($documents as $d) {
            $feuille = $map->addChild('url');
            $rubriques = $d->getRubriques();
            $princeps = $rubriques[0]->getSlug();
            $url = $this->router->generate($route, 
                array('id' => $d->getIdDocument(), 'slug' => getSlug(), 'rubrique' => $princeps));
            $feuille->addChild('loc', 'http://www.trucsdenana.com'.$url);
            $feuille->addChild('lastmod', $d->getDateModification());
            $feuille->addChild('changefreq', 'never');
            $feuille->addChild('priority', $priority);
        }

        $err = $xml_map = $map->asXML($type.'map.xml');
        return $err;
    }

}
