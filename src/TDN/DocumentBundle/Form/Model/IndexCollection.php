<?php

namespace TDN\DocumentBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;
use TDN\DocumentBundle\Entity\DocumentRubrique;
use TDN\DocumentBundle\Entity\Tag;

class IndexCollection {
    /**
     * @Assert\Type(type="\Doctrine\Common\Collections\ArrayCollection")
     */
    protected $index;

    public function addIndex(Tag $tag)
    // public function addRubrique(\TDN\DocumentBundle\Entity\DocumentRubrique $rubriques)
    {
        $this->index[] = $tag;
    
        return $this;
    }

    /**
     * Remove rubriques
     *
     * @param TDN\DocumentBundle\Entity\DocumentRubrique $rubriques
     */
    public function removeIndex(Tag $tag)
    {
        // $this->rubriques->removeElement($rubriques);
    }

    /**
     * Reset rubriques
     *
     * @param TDN\DocumentBundle\Entity\DocumentRubrique $rubriques
     */
    public function resetIndex()
    {
        $this->index = array();
    }

    /**
     * Get rubriques
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getIndex()
    {
        return $this->index; //return $this->rubriques->toArray();
    }




}
