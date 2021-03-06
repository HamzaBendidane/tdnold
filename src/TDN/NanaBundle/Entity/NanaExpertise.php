<?php

namespace TDN\NanaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TDN\NanaBundle\Entity\NanaExpertise
 */
class NanaExpertise
{
    /**
     * @var string $domaine
     */
    private $domaine;

    /**
     * @var string $id
     */
    private $id;

    /**
     * @var TDN\NanaBundle\Entity\Nana
     */
    private $expert;

    /**
     * @var TDN\DocumentBundle\Entity\DocumentRubrique
     */
    private $rubrique;


    /**
     * Set domaine
     *
     * @param string $domaine
     * @return NanaExpertise
     */
    public function setDomaine($domaine)
    {
        $this->domaine = $domaine;
    
        return $this;
    }

    /**
     * Get domaine
     *
     * @return string 
     */
    public function getDomaine()
    {
        return $this->domaine;
    }

    /**
     * Get id
     *
     * @return string 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set expert
     *
     * @param TDN\NanaBundle\Entity\Nana $expert
     * @return NanaExpertise
     */
    public function setExpert(\TDN\NanaBundle\Entity\Nana $expert = null)
    {
        $this->expert = $expert;
    
        return $this;
    }

    /**
     * Get expert
     *
     * @return TDN\NanaBundle\Entity\Nana 
     */
    public function getExpert()
    {
        return $this->expert;
    }

    /**
     * Set rubrique
     *
     * @param TDN\DocumentBundle\Entity\DocumentRubrique $rubrique
     * @return NanaExpertise
     */
    public function setRubrique(\TDN\DocumentBundle\Entity\DocumentRubrique $rubrique = null)
    {
        $this->rubrique = $rubrique;
    
        return $this;
    }

    /**
     * Get rubrique
     *
     * @return TDN\DocumentBundle\Entity\DocumentRubrique 
     */
    public function getRubrique()
    {
        return $this->rubrique;
    }
}