<?php

namespace TDN\NanaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TDN\NanaBundle\Entity\NanaHobbyImageProxy
 */
class NanaHobbyImageProxy
{
    /**
     * @var integer $idImageHobby
     */
    private $idImageHobby;

    /**
     * @var TDN\NanaBundle\Entity\NanaHobby
     */
    private $lnHobby;


    /**
     * Get idImageHobby
     *
     * @return integer 
     */
    public function getIdImageHobby()
    {
        return $this->idImageHobby;
    }

    /**
     * Set lnHobby
     *
     * @param TDN\NanaBundle\Entity\NanaHobby $lnHobby
     * @return NanaHobbyImageProxy
     */
    public function setLnHobby(\TDN\NanaBundle\Entity\NanaHobby $lnHobby = null)
    {
        $this->lnHobby = $lnHobby;
    
        return $this;
    }

    /**
     * Get lnHobby
     *
     * @return TDN\NanaBundle\Entity\NanaHobby 
     */
    public function getLnHobby()
    {
        return $this->lnHobby;
    }
    /**
     * @var TDN\NanaBundle\Entity\
     */
    private $lnImage;


    /**
     * Set lnImage
     *
     * @param TDN\ImageBundle\Entity\Image $lnImage
     * @return NanaHobbyImageProxy
     */
    public function setLnImage(\TDN\ImageBundle\Entity\Image $lnImage = null)
    {
        $this->lnImage = $lnImage;
    
        return $this;
    }

    /**
     * Get lnImage
     *
     * @return TDN\ImageBundle\Entity\Image
     */
    public function getLnImage()
    {
        return $this->lnImage;
    }
}