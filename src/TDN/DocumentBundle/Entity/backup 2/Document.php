<?php

namespace TDN\DocumentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use DocumentRubrique;
use Tag;

/**
 * TDN\DocumentBundle\Entity\Document
 */
abstract class Document
{
    /**
     * @var integer $idAuteur
     */
    private $idAuteur;

    /**
     * @var string $titre
     */
    private $titre;

    /**
     * @var string $hits
     */
    private $hits;

    /**
     * @var integer $statut
     */
    private $statut;

    /**
     * @var integer $ordreDossier
     */
    private $ordreDossier;

    /**
     * @var integer $v2ID
     */
    private $v2ID;

    /**
     * @var datetime $datePublication
     */
    private $datePublication;

    /**
     * @var datetime $dateModification
     */
    private $dateModification;

    /**
     * @var integer $idDocument
     */
    private $idDocument;


    /**
     * Set idAuteur
     *
     * @param integer $idAuteur
     */
    public function setIdAuteur($idAuteur)
    {
        $this->idAuteur = $idAuteur;
    }

    /**
     * Get idAuteur
     *
     * @return integer 
     */
    public function getIdAuteur()
    {
        return $this->idAuteur;
    }

    /**
     * Set titre
     *
     * @param string $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set hits
     *
     * @param string $hits
     */
    public function setHits($hits)
    {
        $this->hits = $hits;
    }

    /**
     * Get hits
     *
     * @return string 
     */
    public function getHits()
    {
        return $this->hits;
    }

    /**
     * Set statut
     *
     * @param integer $statut
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;
    }

    /**
     * Get statut
     *
     * @return integer 
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set datePublication
     *
     * @param datetime $datePublication
     */
    public function setDatePublication($datePublication)
    {
        $this->datePublication = $datePublication;
    }

    /**
     * Get datePublication
     *
     * @return datetime 
     */
    public function getDatePublication()
    {
        return $this->datePublication;
    }

    /**
     * Set dateModification
     *
     * @param datetime $dateModification
     */
    public function setDateModification($dateModification)
    {
        $this->dateModification = $dateModification;
    }

    /**
     * Get dateModification
     *
     * @return datetime 
     */
    public function getDateModification()
    {
        return $this->dateModification;
    }

    /**
     * Get idDocument
     *
     * @return integer 
     */
    public function getIdDocument()
    {
        return $this->idDocument;
    }
    /**
     * @var string $slug
     */
    private $slug;

    /**
     * @var string $abstract
     */
    private $abstract;

    /**
     * @var integer $likes
     */
    private $likes;

    /**
     * @var string $tags
     */
    private $tags;

    /**
     * @var integer $commentThread
     */
    private $commentThread;

    /**
     * @var integer $version
     */
    private $version;

    /**
     * @var TDN\DocumentBundle\Entity\Slider
     */
    private $lnPromu;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $commentaires;

    /**
     * @var TDN\NanaBundle\Entity\Nana
     */
    private $lnAuteur;

    /**
     * @var TDN\ImageBundle\Entity\Image
     */
    private $lnIllustration;

    /**
     * @var TDN\DocumentBundle\Entity\DocumentType
     */
    private $typeDocument;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $rubriques;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $analogues;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $filTags;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->commentaires = new \Doctrine\Common\Collections\ArrayCollection();
        $this->rubriques = new \Doctrine\Common\Collections\ArrayCollection();
        $this->analogues = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set slug
     *
     * @return string
     */
    public function getTypeDocument()
    {
         return $this->typeDocument;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Document
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    
        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Makes slug
     *
     * @return string 
     */
    public function makeSlug () 
    {
        $slug = $this->slug;
        if ($slug == "") {
            $str = $this->titre;
            if($str !== mb_convert_encoding( mb_convert_encoding($str, 'UTF-32', 'UTF-8'), 'UTF-8', 'UTF-32') )
                $str = mb_convert_encoding($str, 'UTF-8', mb_detect_encoding($str));
            $str = htmlentities($str, ENT_NOQUOTES, 'UTF-8');
            $str = preg_replace('`&([a-z]{1,2})(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig);`i', '\\1', $str);
            $str = html_entity_decode($str, ENT_NOQUOTES, 'UTF-8');
            $str = preg_replace(array('`[^a-z0-9]`i','`[-]+`'), '-', $str);
            $str = strtolower( trim($str, '-') );
            $this->slug = $str;
            return $str;
        } else {
            return true;
        }
    }

    /**
     * Set abstract
     *
     * @param string $abstract
     * @return Document
     */
    public function setAbstract($abstract)
    {
        $this->abstract = $abstract;
    
        return $this;
    }

    /**
     * Get abstract
     *
     * @return string 
     */
    public function getAbstract()
    {
        return $this->abstract;
    }

    /**
     * Set likes
     *
     * @param integer $likes
     * @return Document
     */
    public function setLikes($likes)
    {
        $this->likes = $likes;
    
        return $this;
    }

    /**
     * Get likes
     *
     * @return integer 
     */
    public function getLikes()
    {
        return $this->likes;
    }

    /**
     * Set tags
     *
     * @param string $tags
     * @return Document
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    
        return $this;
    }

    /**
     * Get tags
     *
     * @return string 
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set commentThread
     *
     * @param integer $commentThread
     * @return Document
     */
    public function setCommentThread($commentThread)
    {
        $this->commentThread = $commentThread;
    
        return $this;
    }

    /**
     * Get commentThread
     *
     * @return integer 
     */
    public function getCommentThread()
    {
        return $this->commentThread;
    }

    /**
     * Set version
     *
     * @param integer $version
     * @return Document
     */
    public function setVersion($version)
    {
        $this->version = $version;
    
        return $this;
    }

    /**
     * Set ordreDossier
     *
     * @param integer $ordreDossier
     * @return Document
     */
    public function setOrdreDossier($ordreDossier)
    {
        $this->ordreDossier = $ordreDossier;
    
        return $this;
    }

    /**
     * Get ordreDossier
     *
     * @return integer 
     */
    public function getOrdreDossier()
    {
        return $this->ordreDossier;
    }


    /**
     * Get version
     *
     * @return integer 
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set v2ID
     *
     * @param integer $v2ID
     * @return Document
     */
    public function setV2ID($v2id)
    {
        $this->v2ID = $v2id;
    
        return $this;
    }

    /**
     * Get v2ID
     *
     * @return integer 
     */
    public function getV2ID()
    {
        return $this->v2ID;
    }

    /**
     * Set lnPromu
     *
     * @param TDN\DocumentBundle\Entity\Slider $lnPromu
     * @return Document
     */
    public function setLnPromu(\TDN\DocumentBundle\Entity\Slider $lnPromu = null)
    {
        if (empty($lnPromu)) {
            $this->lnPromu = NULL;
        } else {
            $lnPromu->setLnSource($this);
        }
    
        return $this;
    }

    /**
     * Get lnPromu
     *
     * @return TDN\DocumentBundle\Entity\Slider 
     */
    public function getLnPromu()
    {
        return $this->lnPromu;
    }

    /**
     * Add commentaires
     *
     * @param TDN\CommentaireBundle\Entity\Commentaire $commentaires
     * @return Document
     */
    public function addCommentaire(\TDN\CommentaireBundle\Entity\Commentaire $commentaires)
    {
        $this->commentaires[] = $commentaires;
    
        return $this;
    }

    /**
     * Remove commentaires
     *
     * @param TDN\CommentaireBundle\Entity\Commentaire $commentaires
     */
    public function removeCommentaire(\TDN\CommentaireBundle\Entity\Commentaire $commentaires)
    {
        $this->commentaires->removeElement($commentaires);
    }

    /**
     * Get commentaires
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }

    /**
     * Set lnAuteur
     *
     * @param TDN\NanaBundle\Entity\Nana $lnAuteur
     * @return Document
     */
    public function setLnAuteur(\TDN\NanaBundle\Entity\Nana $lnAuteur = null)
    {
        $this->lnAuteur = $lnAuteur;
    
        return $this;
    }

    /**
     * Get lnAuteur
     *
     * @return TDN\NanaBundle\Entity\Nana 
     */
    public function getLnAuteur()
    {
        return $this->lnAuteur;
    }

    /**
     * Set lnIllustration
     *
     * @param TDN\ImageBundle\Entity\Image $lnIllustration
     * @return Document
     */
    public function setLnIllustration(\TDN\ImageBundle\Entity\Image $lnIllustration = null)
    {
        $this->lnIllustration = $lnIllustration;
    
        return $this;
    }

    /**
     * Get lnIllustration
     *
     * @return TDN\ImageBundle\Entity\Image 
     */
    public function getLnIllustration()
    {
        return $this->lnIllustration;
    }

    /**
     * Add rubriques
     *
     * @param TDN\DocumentBundle\Entity\DocumentRubrique $rubriques
     * @return Document
     */
    public function addRubrique(\TDN\DocumentBundle\Entity\DocumentRubrique $rubriques)
    {
        $this->rubriques[] = $rubriques;
    
        return $this;
    }

    /**
     * Remove rubriques
     *
     * @param TDN\DocumentBundle\Entity\DocumentRubrique $rubriques
     */
    public function removeRubrique(\TDN\DocumentBundle\Entity\DocumentRubrique $rubriques)
    {
        $this->rubriques->removeElement($rubriques);
    }

    /**
     * Reset rubriques
     *
     * @param TDN\DocumentBundle\Entity\DocumentRubrique $rubriques
     */
    public function resetRubriques()
    {
        $oldies = $this->getRubriques();
        if (!empty($oldies)) foreach ($oldies as $o) {
            $this->removeRubrique($o);
        }
        $this->rubriques = array();
    }

    /**
     * Assigne un ensemble de rubriques à un document
     *
     * @param TDN\DocumentBundle\Entity\DocumentRubrique $rubriques
     */
    public function assignRubriques($listeRubriques) {
        $this->resetRubriques();
        if (!empty($listeRubriques)) {
            foreach($listeRubriques as $r) {
                $rubrique = $r->getRubrique();
                $_this->addRubrique($rubrique);
            }
        }
    }

    /**
     * Get rubriques
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getRubriques()
    {
        return $this->rubriques; //return $this->rubriques->toArray();
    }

    /**
     * Add analogues
     *
     * @param TDN\DocumentBundle\Entity\Document $analogues
     * @return Document
     */
    public function addAnalogue(\TDN\DocumentBundle\Entity\Document $analogues)
    {
        $this->analogues[] = $analogues;
    
        return $this;
    }

    /**
     * Remove analogues
     *
     * @param TDN\DocumentBundle\Entity\Document $analogues
     */
    public function removeAnalogue(\TDN\DocumentBundle\Entity\Document $analogues)
    {
        $this->analogues->removeElement($analogues);
    }

    /**
     * Get analogues
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getAnalogues()
    {
        return $this->analogues;
    }

    /**
     * Add analogues
     *
     * @param TDN\DocumentBundle\Entity\Tag $tag
     * @return Document
     */
    public function addTag(\TDN\DocumentBundle\Entity\Tag $tag)
    {
        $this->filTags[] = $tag;
    
        return $this;
    }

    /**
     * Remove analogues
     *
     * @param TDN\DocumentBundle\Entity\Document $tag
     */
    public function removeTag(\TDN\DocumentBundle\Entity\Tag $tag)
    {
        $this->filTags->removeElement($tag);
    }

    /**
     * Get analogues
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getFilTags()
    {
        return $this->filTags;
    }

    public function getURLElements() {

        $classe = explode('\\', get_class($this));
        $type = array_pop($classe);
        switch ($type) {
            case 'Article':
                $route = 'RedactionBundle_article';
                break;
            case 'SelectionShopping':
                $route = 'Redaction_showSelection';
                break;
            case 'ConseilExpert':
                $route = 'ConseilExpert_conseil';
                break;
            case 'Question':
                $route = 'CauseuseBundle_conversation';
                break;
            case 'Concours':
                $route = 'Concours_show';
                 break;
            case 'DossierRedaction':
                $route = 'DossierRedaction_sommaire';
                break;
            case 'Image':
                $route = 'RedactionBundle_article';
                break;
            case 'Produit':
                $route = 'Produit_showProduit';
                break;
            case 'Quiz':
                $route = 'Quiz_quiz';
                break;
            case 'Video':
                $route = 'VideoBundle_video';
                break;
            default:
                $route = "_welcome";
        }
        $params['slug'] = $this->slug;
        $params['id'] = $this->idDocument;
        $rubrique = $this->rubriques[0];
        if ($rubrique instanceof DocumentRubrique) {
            $params['rubrique'] = $rubrique->getSlug();
        } else {
            $params['rubrique'] = 'tdn';
        }

        return array($route, $rubrique, $params);
    }

        /**
     * Mise à jour de la popularité
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function updateHits()
    {
        $now = new \DateTime;
        $semaine = $now->format('W');
        $_p = $this->hits;
        $_hits = json_decode($_p);
        if (!is_object($_hits)) {
            $_hits = new \stdClass;
            for ($i = 1; $i <= 52; $i++) $_hits->$i = 0;
            $_hits->last = 0;
        }
        $last = (integer)$_hits->last;
        // On met à jour les stats des semaines précédentes depuis la dernière intervention
        if ($last === $semaine) {
        } elseif ($last < $semaine) {
            for ($i = $last + 1; $i == $semaine; $i++) {
                $_hits->$i = 0;
            }
        } else {
            for ($i = 1; $i == $semaine; $i++) {
                $_hits->$i = 0;
            }
            for ($i = $last + 1; $i == 52; $i++) {
                $_hits->$i = 0;
            }
        }
        $_hits->$semaine += 1;
        $_hits->last = $semaine;
        $vues = 0;
        for ($i = 1; $i <= 52; $i++) $vues += $_hits->$i;
        $this->commentThread = $vues;
        $_p = json_encode($_hits);
        $this->hits = $_p ;            
        return $this;
    }

    /**
     * @var TDN\DossierRedactionBundle\Entity\Dossier
     */
    private $lnDossier;


    /**
     * Set lnDossier
     *
     * @param TDN\DossierRedactionBundle\Entity\Dossier $lnDossier
     * @return Document
     */
    public function setLnDossier(\TDN\DossierRedactionBundle\Entity\Dossier $lnDossier = null)
    {
        $this->lnDossier = $lnDossier;
    
        return $this;
    }

    /**
     * Get lnDossier
     *
     * @return TDN\DossierRedactionBundle\Entity\Dossier 
     */
    public function getLnDossier()
    {
        return $this->lnDossier;
    }
    /**
     * @var integer $v1ID
     */
    private $v1ID;


    /**
     * Set v1ID
     *
     * @param integer $v1ID
     * @return Document
     */
    public function setV1ID($v1ID)
    {
        $this->v1ID = $v1ID;
    
        return $this;
    }

    /**
     * Get v1ID
     *
     * @return integer 
     */
    public function getV1ID()
    {
        return $this->v1ID;
    }
}