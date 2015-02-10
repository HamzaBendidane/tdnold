<?php

namespace TDN\DocumentBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;
use TDN\DocumentBundle\Entity\DocumentRubrique;
use TDN\DocumentBundle\Form\Model\Thematique;

class ThematiqueCollection {
    /**
     * @Assert\Type(type="\Doctrine\Common\Collections\ArrayCollection")
     */
    protected $rubriques;

    public function addRubrique(\TDN\DocumentBundle\Form\Model\Thematique $rubriques)
    // public function addRubrique(\TDN\DocumentBundle\Entity\DocumentRubrique $rubriques)
    {
        $this->rubriques[] = $rubriques;
    
        return $this;
    }

    /**
     * Remove rubriques
     *
     * @param TDN\DocumentBundle\Entity\DocumentRubrique $rubriques
     */
    public function removeRubrique(\TDN\DocumentBundle\Form\Model\Thematique $rubriques)
    {
        // $this->rubriques->removeElement($rubriques);
    }

    /**
     * Reset rubriques
     *
     * @param TDN\DocumentBundle\Entity\DocumentRubrique $rubriques
     */
    public function resetRubriques()
    {
        $this->rubriques = array();
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




}
