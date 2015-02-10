<?php

namespace TDN\DossierRedactionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use TDN\DocumentBundle\Entity\Document;

/**
 * TDN\DossierRedactionBundle\Entity\Dossier
 */
class Dossier extends Document {
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $fascicule;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fascicule = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add fascicule
     *
     * @param TDN\DossierRedactionBundle\Entity\Feuillet $fascicule
     * @return Dossier
     */
    public function addFascicule(\TDN\DossierRedactionBundle\Entity\Feuillet $fascicule)
    {
        $this->fascicule[] = $fascicule;
    
        return $this;
    }

    /**
     * Remove fascicule
     *
     * @param TDN\DossierRedactionBundle\Entity\Feuillet $fascicule
     */
    public function removeFascicule(\TDN\DossierRedactionBundle\Entity\Feuillet $fascicule)
    {
        $this->fascicule->removeElement($fascicule);
    }

    /**
     * Get fascicule
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getFascicule()
    {
        return $this->fascicule;
    }
}
