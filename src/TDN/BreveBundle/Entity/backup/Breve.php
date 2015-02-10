<?php

namespace TDN\BreveBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TDN\BreveBundle\Entity\Breve
 */
class Breve
{
    /**
     * @var string $message
     */
    private $message;

    /**
     * @var string $url
     */
    private $url;

    /**
     * @var string $datePublication
     */
    private $datePublication;

    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var TDN\NanaBundle\Entity\Nana
     */
    private $lnAuteur;

    /**
     * @var TDN\DocumentBundle\Entity\DocumentRubrique
     */
    private $lnRubrique;


    /**
     * Set message
     *
     * @param string $message
     * @return Breve
     */
    public function setMessage($message)
    {
        $this->message = $message;
    
        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Breve
     */
    public function setUrl($url)
    {
        $this->url = $url;
    
        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set datePublication
     *
     * @param string $datePublication
     * @return Breve
     */
    public function setDatePublication($datePublication)
    {
        $this->datePublication = $datePublication;
    
        return $this;
    }

    /**
     * Get datePublication
     *
     * @return string 
     */
    public function getDatePublication()
    {
        return $this->datePublication;
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
     * Set lnAuteur
     *
     * @param TDN\NanaBundle\Entity\Nana $lnAuteur
     * @return Breve
     */
    public function setLnAuteur(\TDN\NanaBundle\Entity\Nana $lnAuteur = null)
    {
        $this->lnAuteur = $lnAuteur;
    
        return $this;
    }

    /**
     * Get lnAuteur
     *
     * @return TDN\NanaBundle\Entity\Nana 
     */
    public function getLnAuteur()
    {
        return $this->lnAuteur;
    }

    /**
     * Set lnRubrique
     *
     * @param TDN\DocumentBundle\Entity\DocumentRubrique $lnRubrique
     * @return Breve
     */
    public function setLnRubrique(\TDN\DocumentBundle\Entity\DocumentRubrique $lnRubrique = null)
    {
        $this->lnRubrique = $lnRubrique;
    
        return $this;
    }

    /**
     * Get lnRubrique
     *
     * @return TDN\DocumentBundle\Entity\DocumentRubrique 
     */
    public function getLnRubrique()
    {
        return $this->lnRubrique;
    }

    /**
     * Get make_tiny
     *
     * @return String 
     */
    public function make_tiny($url)
    {
        $ch = curl_init();  
        $timeout = 5;  
        curl_setopt($ch, CURLOPT_URL,'http://tinyurl.com/api-create.php?url='.$url);  
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);     
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,TRUE);  
        $data = curl_exec($ch);  
        curl_close($ch);  
        return $data;  
    }

    /**
     * @var string $tinyURL
     */
    private $tinyURL;

    /**
     * @var boolean $statut
     */
    private $statut;


    /**
     * Set tinyURL
     *
     * @param string $tinyURL
     * @return Breve
     */
    public function setTinyURL($tinyURL)
    {
        $this->tinyURL = $tinyURL;
    
        return $this;
    }

    /**
     * Get tinyURL
     *
     * @return string 
     */
    public function getTinyURL()
    {
        return $this->tinyURL;
    }

    /**
     * Set statut
     *
     * @param boolean $statut
     * @return Breve
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;
    
        return $this;
    }

    /**
     * Get statut
     *
     * @return boolean 
     */
    public function getStatut()
    {
        return $this->statut;
    }
}