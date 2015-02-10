<?php

namespace TDN\DocumentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TDN\DocumentBundle\Entity\DocumentRubrique
 */
class DocumentRubrique
{
    /**
     * @var string $titre
     */
    private $titre;

    /**
     * @var string $slug
     */
    private $slug;

    /**
     * @var string $abstract
     */
    private $abstract;

    /**
     * @var integer $parent
     */
    private $parent;

    /**
     * @var string $couleur
     */
    private $couleur;

    /**
     * @var string $sponsorImage
     */
    private $sponsorImage;

    /**
     * @var string $sponsorLink
     */
    private $sponsorLink;

    /**
     * @var integer $statut
     */
    private $statut;

    /**
     * @var \DateTime $datePublication
     */
    private $datePublication;

    /**
     * @var \DateTime $dateModification
     */
    private $dateModification;

    /**
     * @var integer $idRubrique
     */
    private $idRubrique;


    /**
     * Set titre
     *
     * @param string $titre
     * @return DocumentRubrique
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    
        return $this;
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
     * Set slug
     *
     * @param string $slug
     * @return DocumentRubrique
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
     * Set abstract
     *
     * @param string $abstract
     * @return DocumentRubrique
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
     * Set parent
     *
     * @param integer $parent
     * @return DocumentRubrique
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
    
        return $this;
    }

    /**
     * Get parent
     *
     * @return integer 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set couleur
     *
     * @param string $couleur
     * @return DocumentRubrique
     */
    public function setCouleur($couleur)
    {
        $this->couleur = $couleur;
    
        return $this;
    }

    /**
     * Get couleur
     *
     * @return string 
     */
    public function getCouleur()
    {
        return $this->couleur;
    }

    /**
     * Set sponsorImage
     *
     * @param string $sponsorImage
     * @return DocumentRubrique
     */
    public function setSponsorImage($sponsorImage)
    {
        $this->sponsorImage = $sponsorImage;
    
        return $this;
    }

    /**
     * Get sponsorImage
     *
     * @return string 
     */
    public function getSponsorImage()
    {
        return $this->sponsorImage;
    }

    /**
     * Set sponsorLink
     *
     * @param string $sponsorLink
     * @return DocumentRubrique
     */
    public function setSponsorLink($sponsorLink)
    {
        $this->sponsorLink = $sponsorLink;
    
        return $this;
    }

    /**
     * Get sponsorLink
     *
     * @return string 
     */
    public function getSponsorLink()
    {
        return $this->sponsorLink;
    }

    /**
     * Set statut
     *
     * @param integer $statut
     * @return DocumentRubrique
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;
    
        return $this;
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
     * @param \DateTime $datePublication
     * @return DocumentRubrique
     */
    public function setDatePublication($datePublication)
    {
        $this->datePublication = $datePublication;
    
        return $this;
    }

    /**
     * Get datePublication
     *
     * @return \DateTime 
     */
    public function getDatePublication()
    {
        return $this->datePublication;
    }

    /**
     * Set dateModification
     *
     * @param \DateTime $dateModification
     * @return DocumentRubrique
     */
    public function setDateModification($dateModification)
    {
        $this->dateModification = $dateModification;
    
        return $this;
    }

    /**
     * Get dateModification
     *
     * @return \DateTime 
     */
    public function getDateModification()
    {
        return $this->dateModification;
    }

    /**
     * Get idRubrique
     *
     * @return integer 
     */
    public function getIdRubrique()
    {
        return $this->idRubrique;
    }
}
