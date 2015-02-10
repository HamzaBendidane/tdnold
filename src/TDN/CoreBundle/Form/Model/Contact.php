<?php

namespace TDN\CoreBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;

class Contact {

    /**
     * @Assert\NotBlank()
     */
    protected $requete;

    protected $email;

    protected $message;

    public function setRequete($requete)
    {
        $this->requete = $requete;
    }

    public function getRequete()
    {
        return $this->requete;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function getMessage()
    {
        return $this->message;
    }
}