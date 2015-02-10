<?php

namespace TDN\CauseuseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use TDN\DocumentBundle\Entity\Document;

/**
 * TDN\CauseuseBundle\Entity\Reponse
 */
class Reponse extends Document {
    /**
     * @var string $reponse
     */
    private $reponse;

    /**
     * @var TDN\CauseuseBundle\Entity\Question
     */
    private $lnConversation;


    /**
     * Set reponse
     *
     * @param string $reponse
     * @return Reponse
     */
    public function setReponse($reponse)
    {
        $this->reponse = $reponse;
    
        return $this;
    }

    /**
     * Get reponse
     *
     * @return string 
     */
    public function getReponse()
    {
        return $this->reponse;
    }

    /**
     * Set lnConversation
     *
     * @param TDN\CauseuseBundle\Entity\Question $lnConversation
     * @return Reponse
     */
    public function setLnConversation(\TDN\CauseuseBundle\Entity\Question $lnConversation = null)
    {
        $this->lnConversation = $lnConversation;
    
        return $this;
    }

    /**
     * Get lnConversation
     *
     * @return TDN\CauseuseBundle\Entity\Question 
     */
    public function getLnConversation()
    {
        return $this->lnConversation;
    }
}