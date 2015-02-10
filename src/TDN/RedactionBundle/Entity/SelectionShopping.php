<?php

namespace TDN\RedactionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use TDN\DocumentBundle\Entity\Document;

/**
 * TDN\RedactionBundle\Entity\SelectionShopping
 */
class SelectionShopping extends Document {
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $setProduit;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setProduit = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add setProduit
     *
     * @param TDN\RedactionBundle\Entity\Produit $setProduit
     * @return SelectionShopping
     */
    public function addSetProduit(\TDN\ProduitBundle\Entity\Produit $setProduit)
    {
        $this->setProduit[] = $setProduit;
    
        return $this;
    }

    /**
     * Remove setProduit
     *
     * @param TDN\RedactionBundle\Entity\Produit $setProduit
     */
    public function removeSetProduit(\TDN\ProduitBundle\Entity\Produit $setProduit)
    {
        $this->setProduit->removeElement($setProduit);
    }

    /**
     * Get setProduit
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getSetProduit()
    {
        return $this->setProduit;
    }
}
