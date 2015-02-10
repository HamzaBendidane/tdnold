<?php

namespace TDN\RedactionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use TDN\DocumentBundle\Entity\Document;

/**
 * TDN\RedactionBundle\Entity\Article
 */
class Article extends Document {
    /**
     * @var string $corps
     */
    private $corps;

    /**
     * @var boolean $sponsor
     */
    private $sponsor;


    /**
     * Set corps
     *
     * @param string $corps
     * @return Article
     */
    public function setCorps($corps)
    {
        $this->corps = $corps;
    
        return $this;
    }

    /**
     * Get corps
     *
     * @return string 
     */
    public function getCorps()
    {
        return $this->corps;
    }

    /**
     * Set sponsor
     *
     * @param boolean $sponsor
     * @return Article
     */
    public function setSponsor($sponsor)
    {
        $this->sponsor = $sponsor;
    
        return $this;
    }

    /**
     * Get sponsor
     *
     * @return boolean 
     */
    public function getSponsor()
    {
        return $this->sponsor;
    }
}
