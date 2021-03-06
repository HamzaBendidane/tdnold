<?php

namespace Proxies\__CG__\TDN\RedactionBundle\Entity;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class SelectionShopping extends \TDN\RedactionBundle\Entity\SelectionShopping implements \Doctrine\ORM\Proxy\Proxy
{
    private $_entityPersister;
    private $_identifier;
    public $__isInitialized__ = false;
    public function __construct($entityPersister, $identifier)
    {
        $this->_entityPersister = $entityPersister;
        $this->_identifier = $identifier;
    }
    /** @private */
    public function __load()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;

            if (method_exists($this, "__wakeup")) {
                // call this after __isInitialized__to avoid infinite recursion
                // but before loading to emulate what ClassMetadata::newInstance()
                // provides.
                $this->__wakeup();
            }

            if ($this->_entityPersister->load($this->_identifier, $this) === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            unset($this->_entityPersister, $this->_identifier);
        }
    }

    /** @private */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    
    public function addSetProduit(\TDN\ProduitBundle\Entity\Produit $setProduit)
    {
        $this->__load();
        return parent::addSetProduit($setProduit);
    }

    public function removeSetProduit(\TDN\ProduitBundle\Entity\Produit $setProduit)
    {
        $this->__load();
        return parent::removeSetProduit($setProduit);
    }

    public function getSetProduit()
    {
        $this->__load();
        return parent::getSetProduit();
    }

    public function setIdAuteur($idAuteur)
    {
        $this->__load();
        return parent::setIdAuteur($idAuteur);
    }

    public function getIdAuteur()
    {
        $this->__load();
        return parent::getIdAuteur();
    }

    public function setTitre($titre)
    {
        $this->__load();
        return parent::setTitre($titre);
    }

    public function getTitre()
    {
        $this->__load();
        return parent::getTitre();
    }

    public function setHits($hits)
    {
        $this->__load();
        return parent::setHits($hits);
    }

    public function getHits()
    {
        $this->__load();
        return parent::getHits();
    }

    public function setStatut($statut)
    {
        $this->__load();
        return parent::setStatut($statut);
    }

    public function getStatut()
    {
        $this->__load();
        return parent::getStatut();
    }

    public function setDatePublication($datePublication)
    {
        $this->__load();
        return parent::setDatePublication($datePublication);
    }

    public function getDatePublication()
    {
        $this->__load();
        return parent::getDatePublication();
    }

    public function setDateModification($dateModification)
    {
        $this->__load();
        return parent::setDateModification($dateModification);
    }

    public function getDateModification()
    {
        $this->__load();
        return parent::getDateModification();
    }

    public function getIdDocument()
    {
        if ($this->__isInitialized__ === false) {
            return (int) $this->_identifier["idDocument"];
        }
        $this->__load();
        return parent::getIdDocument();
    }

    public function getTypeDocument()
    {
        $this->__load();
        return parent::getTypeDocument();
    }

    public function setSlug($slug)
    {
        $this->__load();
        return parent::setSlug($slug);
    }

    public function getSlug()
    {
        $this->__load();
        return parent::getSlug();
    }

    public function makeSlug()
    {
        $this->__load();
        return parent::makeSlug();
    }

    public function setAbstract($abstract)
    {
        $this->__load();
        return parent::setAbstract($abstract);
    }

    public function setLnThematique(\TDN\DocumentBundle\Entity\DocumentRubrique $lnThematique = NULL)
    {
        $this->__load();
        return parent::setLnThematique($lnThematique);
    }

    public function getlnThematique()
    {
        $this->__load();
        return parent::getlnThematique();
    }

    public function getAbstract()
    {
        $this->__load();
        return parent::getAbstract();
    }

    public function setLikes($likes)
    {
        $this->__load();
        return parent::setLikes($likes);
    }

    public function getLikes()
    {
        $this->__load();
        return parent::getLikes();
    }

    public function setTags($tags)
    {
        $this->__load();
        return parent::setTags($tags);
    }

    public function getTags()
    {
        $this->__load();
        return parent::getTags();
    }

    public function setCommentThread($commentThread)
    {
        $this->__load();
        return parent::setCommentThread($commentThread);
    }

    public function getCommentThread()
    {
        $this->__load();
        return parent::getCommentThread();
    }

    public function setVersion($version)
    {
        $this->__load();
        return parent::setVersion($version);
    }

    public function setOrdreDossier($ordreDossier)
    {
        $this->__load();
        return parent::setOrdreDossier($ordreDossier);
    }

    public function getOrdreDossier()
    {
        $this->__load();
        return parent::getOrdreDossier();
    }

    public function getVersion()
    {
        $this->__load();
        return parent::getVersion();
    }

    public function setV2ID($v2id)
    {
        $this->__load();
        return parent::setV2ID($v2id);
    }

    public function getV2ID()
    {
        $this->__load();
        return parent::getV2ID();
    }

    public function setLnPromu(\TDN\DocumentBundle\Entity\Slider $lnPromu = NULL)
    {
        $this->__load();
        return parent::setLnPromu($lnPromu);
    }

    public function getLnPromu()
    {
        $this->__load();
        return parent::getLnPromu();
    }

    public function addCommentaire(\TDN\CommentaireBundle\Entity\Commentaire $commentaires)
    {
        $this->__load();
        return parent::addCommentaire($commentaires);
    }

    public function removeCommentaire(\TDN\CommentaireBundle\Entity\Commentaire $commentaires)
    {
        $this->__load();
        return parent::removeCommentaire($commentaires);
    }

    public function getCommentaires()
    {
        $this->__load();
        return parent::getCommentaires();
    }

    public function setLnAuteur(\TDN\NanaBundle\Entity\Nana $lnAuteur = NULL)
    {
        $this->__load();
        return parent::setLnAuteur($lnAuteur);
    }

    public function getLnAuteur()
    {
        $this->__load();
        return parent::getLnAuteur();
    }

    public function setLnIllustration(\TDN\ImageBundle\Entity\Image $lnIllustration = NULL)
    {
        $this->__load();
        return parent::setLnIllustration($lnIllustration);
    }

    public function getLnIllustration()
    {
        $this->__load();
        return parent::getLnIllustration();
    }

    public function addRubrique(\TDN\DocumentBundle\Entity\DocumentRubrique $rubriques)
    {
        $this->__load();
        return parent::addRubrique($rubriques);
    }

    public function removeRubrique(\TDN\DocumentBundle\Entity\DocumentRubrique $rubriques)
    {
        $this->__load();
        return parent::removeRubrique($rubriques);
    }

    public function resetRubriques()
    {
        $this->__load();
        return parent::resetRubriques();
    }

    public function assignRubriques($listeRubriques)
    {
        $this->__load();
        return parent::assignRubriques($listeRubriques);
    }

    public function assigneRubriques($collection)
    {
        $this->__load();
        return parent::assigneRubriques($collection);
    }

    public function updateRubriques($collection)
    {
        $this->__load();
        return parent::updateRubriques($collection);
    }

    public function getRubriques()
    {
        $this->__load();
        return parent::getRubriques();
    }

    public function addAnalogue(\TDN\DocumentBundle\Entity\Document $analogues)
    {
        $this->__load();
        return parent::addAnalogue($analogues);
    }

    public function removeAnalogue(\TDN\DocumentBundle\Entity\Document $analogues)
    {
        $this->__load();
        return parent::removeAnalogue($analogues);
    }

    public function getAnalogues()
    {
        $this->__load();
        return parent::getAnalogues();
    }

    public function addTag(\TDN\DocumentBundle\Entity\Tag $tag)
    {
        $this->__load();
        return parent::addTag($tag);
    }

    public function removeTag(\TDN\DocumentBundle\Entity\Tag $tag)
    {
        $this->__load();
        return parent::removeTag($tag);
    }

    public function getFilTags()
    {
        $this->__load();
        return parent::getFilTags();
    }

    public function resetTags()
    {
        $this->__load();
        return parent::resetTags();
    }

    public function getURLElements()
    {
        $this->__load();
        return parent::getURLElements();
    }

    public function updateHits()
    {
        $this->__load();
        return parent::updateHits();
    }

    public function setLnDossier(\TDN\DossierRedactionBundle\Entity\Dossier $lnDossier = NULL)
    {
        $this->__load();
        return parent::setLnDossier($lnDossier);
    }

    public function getLnDossier()
    {
        $this->__load();
        return parent::getLnDossier();
    }

    public function setV1ID($v1ID)
    {
        $this->__load();
        return parent::setV1ID($v1ID);
    }

    public function getV1ID()
    {
        $this->__load();
        return parent::getV1ID();
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'titre', 'slug', 'abstract', 'likes', 'hits', 'tags', 'statut', 'commentThread', 'datePublication', 'dateModification', 'version', 'v2ID', 'v1ID', 'ordreDossier', 'idDocument', 'lnPromu', 'commentaires', 'lnAuteur', 'lnIllustration', 'lnThematique', 'lnDossier', 'rubriques', 'analogues', 'filTags', 'setProduit');
    }

    public function __clone()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;
            $class = $this->_entityPersister->getClassMetadata();
            $original = $this->_entityPersister->load($this->_identifier);
            if ($original === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            foreach ($class->reflFields as $field => $reflProperty) {
                $reflProperty->setValue($this, $reflProperty->getValue($original));
            }
            unset($this->_entityPersister, $this->_identifier);
        }
        
    }
}