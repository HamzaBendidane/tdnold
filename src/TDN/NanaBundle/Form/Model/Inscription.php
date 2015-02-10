<?php

namespace TDN\NanaBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;
use TDN\Nanabundle\Entity\Nana;

class Inscription {
    /**
     * @Assert\Type(type="TDN\Nanabundle\Entity\Nana")
     */
    protected $user;

    /**
     * @Assert\NotBlank()
     * @Assert\True()
     */
    protected $termsAccepted;


    protected $token;

    public function setUser(Nana $user)
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getTermsAccepted()
    {
        return $this->termsAccepted;
    }

    public function setTermsAccepted($termsAccepted)
    {
        $this->termsAccepted = (boolean)$termsAccepted;
    }
    
}