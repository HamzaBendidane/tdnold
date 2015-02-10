<?php

namespace TDN\DocumentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TDN\DocumentBundle\Entity\Tag
 */
class Tag
{
    /**
     * @var string $lemme
     */
    private $lemme;

    /**
     * @var string $forme
     */
    private $forme;

    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $setDocument;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setDocument = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set lemme
     *
     * @param string $lemme
     * @return Tag
     */
    public function setLemme($lemme)
    {
        $this->lemme = $lemme;
    
        return $this;
    }

    /**
     * Get lemme
     *
     * @return string 
     */
    public function getLemme()
    {
        return $this->lemme;
    }

    /**
     * Set forme
     *
     * @param string $forme
     * @return Tag
     */
    public function setForme($forme)
    {
        $this->forme = $forme;
    
        return $this;
    }

    /**
     * Get forme
     *
     * @return string 
     */
    public function getForme()
    {
        return $this->forme;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add setDocument
     *
     * @param TDN\DocumentBundle\Entity\Document $setDocument
     * @return Tag
     */
    public function addSetDocument(\TDN\DocumentBundle\Entity\Document $setDocument)
    {
        $this->setDocument[] = $setDocument;
    
        return $this;
    }

    /**
     * Remove setDocument
     *
     * @param TDN\DocumentBundle\Entity\Document $setDocument
     */
    public function removeSetDocument(\TDN\DocumentBundle\Entity\Document $setDocument)
    {
        $this->setDocument->removeElement($setDocument);
    }

    /**
     * Get setDocument
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getSetDocument()
    {
        return $this->setDocument;
    }
}