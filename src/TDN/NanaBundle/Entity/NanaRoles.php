<?php

namespace TDN\NanaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Role\RoleInterface;

/**
 * TDN\NanaBundle\Entity\NanaRoles
 */
class NanaRoles implements RoleInterface {
    /**
     * @var string $name
     */
    private $name;

    /**
     * @var string $role
     */
    private $role;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $groupe;


    public function __construct() {

        $this->groupe = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set name
     *
     * @param string $name
     * @return NanaRoles
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set role
     *
     * @param string $role
     * @return NanaRoles
     */
    public function setRole($role)
    {
        $this->role = $role;
    
        return $this;
    }

    /**
     * Get role
     *
     * @return string 
     */
    public function getRole()
    {
        return $this->role;
    }

     /**
     * Add groupe
     *
     * @param TDN\NanaBundle\Entity\Nana $groupe
     * @return NanaRoles
     */
    public function addGroupe(\TDN\NanaBundle\Entity\Nana $groupe)
    {
        $this->groupe[] = $groupe;
    
        return $this;
    }

    /**
     * Remove groupe
     *
     * @param TDN\NanaBundle\Entity\Nana $groupe
     */
    public function removeGroupe(\TDN\NanaBundle\Entity\Nana $groupe)
    {
        $this->groupe->removeElement($groupe);
    }

    /**
     * Get groupe
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getGroupe()
    {
        return $this->groupe;
    }
}