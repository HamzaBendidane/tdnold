<?php

namespace TDN\NanaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * TDN\NanaBundle\Entity\Nana
 */
class Nana implements AdvancedUserInterface, \Serializable 
{
    /**
     * @var string $username
     */
    private $username;

    /**
     * @var string $password
     */
    private $password;

    /**
     * @var string $salt
     */
    private $salt;

    /**
     * @var string $prenom
     */
    private $prenom;

    /**
     * @var string $nom
     */
    private $nom;

    /**
     * @var \DateTime $dateNaissance
     */
    private $dateNaissance;

    /**
     * @var string $email
     */
    private $email;

    /**
     * @var integer $sexe
     */
    private $sexe;

    /**
     * @var string $ville
     */
    private $ville;

    /**
     * @var string $occupation
     */
    private $occupation;

    /**
     * @var string $popularite
     */
    private $popularite;

    /**
     * @var string $biographie
     */
    private $biographie;

    /**
     * @var \DateTime $dateInscription
     */
    private $dateInscription;

    /**
     * @var \DateTime $dateAbonnement
     */
    private $dateAbonnement;

    /**
     * @var boolean $active
     */
    private $active;

    /**
     * @var boolean $newsletter
     */
    private $newsletter;

    /**
     * @var boolean $blacklist
     */
    private $blacklist;

    /**
     * @var string $adresseIP
     */
    private $adresseIP;

    /**
     * @var integer $adresseIP
     */
    private $v2ID;

    /**
     * @var integer $idNana
     */
    private $idNana;

    /**
     * @var TDN\ImageBundle\Entity\Image
     */
    private $lnAvatar;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $filProductions;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $filActivite;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $lnSociaux;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $galeriePerso;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $lnHobbies;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $expertises;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $lnCommentaires;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $roles;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $follows;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $isFollowed;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $pokes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->filProductions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->lnSociaux = new \Doctrine\Common\Collections\ArrayCollection();
        $this->galeriePerso = new \Doctrine\Common\Collections\ArrayCollection();
        $this->lnHobbies = new \Doctrine\Common\Collections\ArrayCollection();
        $this->expertises = new \Doctrine\Common\Collections\ArrayCollection();
        $this->lnCommentaires = new \Doctrine\Common\Collections\ArrayCollection();
        $this->roles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->follows = new \Doctrine\Common\Collections\ArrayCollection();
        $this->isFollowed = new \Doctrine\Common\Collections\ArrayCollection();
        $this->pokes = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set username
     *
     * @param string $username
     * @return Nana
     */
    public function setUsername($username)
    {
        $this->username = $username;
    
        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Nana
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return Nana
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    
        return $this;
    }

    /**
     * Get salt
     *
     * @return string 
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     * @return Nana
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    
        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Nana
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    
        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     * @return Nana
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;
    
        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return \DateTime 
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Nana
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set sexe
     *
     * @param string $sexe
     * @return Nana
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;
    
        return $this;
    }

    /**
     * Get sexe
     *
     * @return integer 
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set ville
     *
     * @param string $ville
     * @return Nana
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
    
        return $this;
    }

    /**
     * Get ville
     *
     * @return string 
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set occupation
     *
     * @param string $occupation
     * @return Nana
     */
    public function setOccupation($occupation)
    {
        $this->occupation = $occupation;
    
        return $this;
    }

    /**
     * Get occupation
     *
     * @return string 
     */
    public function getOccupation()
    {
        return $this->occupation;
    }

    /**
     * Set popularite
     *
     * @param float $popularite
     * @return Nana
     */
    public function setPopularite($popularite)
    {
        $this->popularite = $popularite;
    
        return $this;
    }

    /**
     * Get popularite
     *
     * @return float 
     */
    public function getPopularite()
    {
        return $this->popularite;
    }

    /**
     * Set biographie
     *
     * @param string $biographie
     * @return Nana
     */
    public function setBiographie($biographie)
    {
        $this->biographie = $biographie;
    
        return $this;
    }

    /**
     * Get biographie
     *
     * @return string 
     */
    public function getBiographie()
    {
        return $this->biographie;
    }

    /**
     * Set dateInscription
     *
     * @param \DateTime $dateInscription
     * @return Nana
     */
    public function setDateInscription($dateInscription)
    {
        $this->dateInscription = $dateInscription;
    
        return $this;
    }

    /**
     * Get dateInscription
     *
     * @return \DateTime 
     */
    public function getDateInscription()
    {
        return $this->dateInscription;
    }

    /**
     * Set dateAbonnement
     *
     * @param \DateTime $dateAbonnement
     * @return Nana
     */
    public function setDateAbonnement($dateAbonnement)
    {
        $this->dateAbonnement = $dateAbonnement;
    
        return $this;
    }

    /**
     * Get dateAbonnement
     *
     * @return \DateTime 
     */
    public function getDateAbonnement()
    {
        return $this->dateAbonnement;
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return Nana
     */
    public function setActive($active)
    {
        $this->active = $active;
    
        return $this;
    }

    /**
     * Get active
     *
     * @return boolean 
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set newsletter
     *
     * @param boolean $newsletter
     * @return Nana
     */
    public function setNewsletter($newsletter)
    {
        $this->newsletter = $newsletter;
    
        return $this;
    }

    /**
     * Get newsletter
     *
     * @return boolean 
     */
    public function getNewsletter()
    {
        return $this->newsletter;
    }

    /**
     * Set blacklist
     *
     * @param boolean $blacklist
     * @return Nana
     */
    public function setBlacklist($blacklist)
    {
        $this->blacklist = $blacklist;
    
        return $this;
    }

    /**
     * Get blacklist
     *
     * @return boolean 
     */
    public function getBlacklist()
    {
        return $this->blacklist;
    }

    /**
     * Set adresseIP
     *
     * @param string $adresseIP
     * @return Nana
     */
    public function setAdresseIP($adresseIP)
    {
        $this->adresseIP = $adresseIP;
    
        return $this;
    }

    /**
     * Get adresseIP
     *
     * @return integer 
     */
    public function getV2ID()
    {
        return $this->v2ID;
    }

    /**
     * Set adresseIP
     *
     * @param nteger $v2ID
     * @return Nana
     */
    public function setV2ID($v2ID)
    {
        $this->v2ID = $v2ID;
    
        return $this;
    }

    /**
     * Get adresseIP
     *
     * @return string 
     */
    public function getAdresseIP()
    {
        return $this->adresseIP;
    }

    /**
     * Get idNana
     *
     * @return integer 
     */
    public function getIdNana()
    {
        return $this->idNana;
    }

    /**
     * Set lnAvatar
     *
     * @param TDN\ImageBundle\Entity\Image $lnAvatar
     * @return Nana
     */
    public function setLnAvatar(\TDN\ImageBundle\Entity\Image $lnAvatar = null)
    {
        $this->lnAvatar = $lnAvatar;
    
        return $this;
    }

    /**
     * Get lnAvatar
     *
     * @return TDN\ImageBundle\Entity\Image 
     */
    public function getLnAvatar()
    {
        return $this->lnAvatar;
    }

    /**
     * Add filProductions
     *
     * @param TDN\DocumentBundle\Entity\Document $filProductions
     * @return Nana
     */
    public function addFilProduction(\TDN\DocumentBundle\Entity\Document $filProductions)
    {
        $this->filProductions[] = $filProductions;
    
        return $this;
    }

    /**
     * Remove filProductions
     *
     * @param TDN\DocumentBundle\Entity\Document $filProductions
     */
    public function removeFilProduction(\TDN\DocumentBundle\Entity\Document $filProductions)
    {
        $this->filProductions->removeElement($filProductions);
    }

    /**
     * Get filProductions
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getFilProductions()
    {
        return $this->filProductions;
    }

    /**
     * Add lnSociaux
     *
     * @param TDN\NanaBundle\Entity\NanaNetwork $lnSociaux
     * @return Nana
     */
    public function addLnSociaux(\TDN\NanaBundle\Entity\NanaNetwork $lnSociaux)
    {
        $this->lnSociaux[] = $lnSociaux;
    
        return $this;
    }

    /**
     * Remove lnSociaux
     *
     * @param TDN\NanaBundle\Entity\NanaNetwork $lnSociaux
     */
    public function removeLnSociaux(\TDN\NanaBundle\Entity\NanaNetwork $lnSociaux)
    {
        $this->lnSociaux->removeElement($lnSociaux);
    }

    /**
     * Get lnSociaux
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getLnSociaux()
    {
        return $this->lnSociaux;
    }

    /**
     * Add galeriePerso
     *
     * @param TDN\NanaBundle\Entity\NanaPortraitImageProxy $galeriePerso
     * @return Nana
     */
    public function addGaleriePerso(\TDN\NanaBundle\Entity\NanaPortraitImageProxy $galeriePerso)
    {
        $this->galeriePerso[] = $galeriePerso;
    
        return $this;
    }

    /**
     * Remove galeriePerso
     *
     * @param TDN\NanaBundle\Entity\NanaPortraitImageProxy $galeriePerso
     */
    public function removeGaleriePerso(\TDN\NanaBundle\Entity\NanaPortraitImageProxy $galeriePerso)
    {
        $this->galeriePerso->removeElement($galeriePerso);
        $dir = $_SERVER['DOCUMENT_ROOT'].'uploads/documents/profils/'.$this->idNana;
        $fichier = $galeriePerso->getLnImage()->getFichier();
        if (is_file($dir.'/'.$fichier)) unlink($dir.'/'.$fichier);
        // $galeriePerso->delete();
    }

    /**
     * Get galeriePerso
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getGaleriePerso()
    {
        return $this->galeriePerso;
    }

    /**
     * Add lnHobbies
     *
     * @param TDN\NanaBundle\Entity\NanaHobby $lnHobbies
     * @return Nana
     */
    public function addLnHobbie(\TDN\NanaBundle\Entity\NanaHobby $lnHobbies)
    {
        $this->lnHobbies[] = $lnHobbies;
    
        return $this;
    }

    /**
     * Remove lnHobbies
     *
     * @param TDN\NanaBundle\Entity\NanaHobby $lnHobbies
     */
    public function removeLnHobbie(\TDN\NanaBundle\Entity\NanaHobby $lnHobbies)
    {
        $this->lnHobbies->removeElement($lnHobbies);
    }

    /**
     * Get lnHobbies
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getLnHobbies()
    {
        return $this->lnHobbies;
    }

    /**
     * Add expertises
     *
     * @param TDN\ConseilExpertBundle\Entity\ConseilExpert $expertises
     * @return Nana
     */
    public function addExpertise(\TDN\ConseilExpertBundle\Entity\ConseilExpert $expertises)
    {
        $this->expertises[] = $expertises;
    
        return $this;
    }

    /**
     * Remove expertises
     *
     * @param TDN\ConseilExpertBundle\Entity\ConseilExpert $expertises
     */
    public function removeExpertise(\TDN\ConseilExpertBundle\Entity\ConseilExpert $expertises)
    {
        $this->expertises->removeElement($expertises);
    }

    /**
     * Get expertises
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getExpertises()
    {
        return $this->expertises;
    }

    /**
     * Add lnCommentaires
     *
     * @param TDN\CommentaireBundle\Entity\Commentaire $lnCommentaires
     * @return Nana
     */
    public function addLnCommentaire(\TDN\CommentaireBundle\Entity\Commentaire $lnCommentaires)
    {
        $this->lnCommentaires[] = $lnCommentaires;
    
        return $this;
    }

    /**
     * Remove lnCommentaires
     *
     * @param TDN\CommentaireBundle\Entity\Commentaire $lnCommentaires
     */
    public function removeLnCommentaire(\TDN\CommentaireBundle\Entity\Commentaire $lnCommentaires)
    {
        $this->lnCommentaires->removeElement($lnCommentaires);
    }

    /**
     * Get lnCommentaires
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getLnCommentaires()
    {
        return $this->lnCommentaires;
    }

    /**
     * Add roles
     *
     * @param TDN\NanaBundle\Entity\NanaRoles $roles
     * @return Nana
     */
    public function addRole(\TDN\NanaBundle\Entity\NanaRoles $roles)
    {
        $this->roles[] = $roles;
    
        return $this;
    }

    /**
     * Remove roles
     *
     * @param TDN\NanaBundle\Entity\NanaRoles $roles
     */
    public function removeRole(\TDN\NanaBundle\Entity\NanaRoles $roles)
    {
        $this->roles->removeElement($roles);
    }

    /**
     * Get roles
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getRoles()
    {
        return $this->roles->toArray();
    }

    /**
     * Add follows
     *
     * @param TDN\NanaBundle\Entity\Nana $follows
     * @return Nana
     */
    public function addFollow(\TDN\NanaBundle\Entity\Nana $follows)
    {
        $this->follows[] = $follows;
    
       if (! $follows->getIsFollowed()->contains($this)) {
            $follows->addIsFollowed($this);
        }

       return $this;
    }

    /**
     * Remove follows
     *
     * @param TDN\NanaBundle\Entity\Nana $follows
     */
    public function removeFollow(\TDN\NanaBundle\Entity\Nana $follows)
    {
        $this->follows->removeElement($follows);
    }

    /**
     * Get follows
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getFollows()
    {
        return $this->follows;
    }

    /**
     * Add isFollowed
     *
     * @param TDN\NanaBundle\Entity\Nana $isFollowed
     * @return Nana
     */
    public function addIsFollowed(\TDN\NanaBundle\Entity\Nana $isFollowed)
    {
        $this->isFollowed[] = $isFollowed;
    
        return $this;
    }

    /**
     * Remove isFollowed
     *
     * @param TDN\NanaBundle\Entity\Nana $isFollowed
     */
    public function removeIsFollowed(\TDN\NanaBundle\Entity\Nana $isFollowed)
    {
        $this->isFollowed->removeElement($isFollowed);
    }

    /**
     * Get isFollowed
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getIsFollowed()
    {
        return $this->isFollowed;
    }

    /**
     * Add pokes
     *
     * @param TDN\DocumentBundle\Entity\Document $pokes
     * @return Nana
     */
    public function addPoke(\TDN\DocumentBundle\Entity\Document $pokes)
    {
        $this->pokes[] = $pokes;
    
        return $this;
    }

    /**
     * Remove pokes
     *
     * @param TDN\DocumentBundle\Entity\Document $pokes
     */
    public function removePoke(\TDN\DocumentBundle\Entity\Document $pokes)
    {
        $this->pokes->removeElement($pokes);
    }

    /**
     * Get pokes
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getPokes()
    {
        return $this->pokes;
    }

    /**
     * @see UserInterface::eraseCredentials()
     */
    public function eraseCredentials() {
    
    } 

    /**
     * @see \Serializable::serialize()
     */
    
    public function serialize() {

        return serialize($this->username);
    }

    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return !$this->blacklist;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->active;
    }

        /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized) {
        
        $this->username = unserialize($serialized);
    }

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $filConcours;


    /**
     * Add filConcours
     *
     * @param TDN\ConcoursBundle\Entity\ConcoursParticipant $filConcours
     * @return Nana
     */
    public function addFilConcour(\TDN\ConcoursBundle\Entity\ConcoursParticipant $filConcours)
    {
        $this->filConcours[] = $filConcours;
    
        return $this;
    }

    /**
     * Remove filConcours
     *
     * @param TDN\ConcoursBundle\Entity\ConcoursParticipant $filConcours
     */
    public function removeFilConcour(\TDN\ConcoursBundle\Entity\ConcoursParticipant $filConcours)
    {
        $this->filConcours->removeElement($filConcours);
    }

    /**
     * Get filConcours
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getFilActivite()
    {
        return $this->filActivite;
    }

    /**
     * Add filConcours
     *
     * @param TDN\ConcoursBundle\Entity\ConcoursParticipant $filConcours
     * @return Nana
     */
    public function addFilActivite(\TDN\CoreBundle\Entity\Journal $activite)
    {
        $this->filActivite[] = $activite;
    
        return $this;
    }

    /**
     * Remove filConcours
     *
     * @param TDN\ConcoursBundle\Entity\ConcoursParticipant $filConcours
     */
    public function removeFilActivite(\TDN\CoreBundle\Entity\Journal $activite)
    {
        $this->filConcours->removeElement($activite);
    }

    /**
     * Get filConcours
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getFilConcours()
    {
        return $this->filConcours;
    }


    /**
     * Get Age
     *
     * @return string 
     */
    public function getAge($typeReturn = 'string') {
        $age = $this->getDateNaissance()->diff(new \DateTime)->format('%y');
        if ($typeReturn == 'string') {
            return $age.' ans';
        } else {
            return (integer)$age;
        }
    }


    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $setExpertises;


    /**
     * Add setExpertises
     *
     * @param TDN\NanaBundle\Entity\NanaExpertise $setExpertises
     * @return Nana
     */
    public function addSetExpertise(\TDN\NanaBundle\Entity\NanaExpertise $setExpertises)
    {
        $this->setExpertises[] = $setExpertises;
    
        return $this;
    }

    /**
     * Remove setExpertises
     *
     * @param TDN\NanaBundle\Entity\NanaExpertise $setExpertises
     */
    public function removeSetExpertise(\TDN\NanaBundle\Entity\NanaExpertise $setExpertises)
    {
        $this->setExpertises->removeElement($setExpertises);
    }

    /**
     * Get setExpertises
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getSetExpertises()
    {
        return $this->setExpertises;
    }

    /**
     * Mise à jour de la popularité
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function updatePopularite($points) {

        $now = new \DateTime;
        $semaine = (integer)$now->format('W');
        $_p = $this->popularite;
        $_pops = json_decode($_p);
        if (!is_object($_pops)) {
            $_pops = new \stdClass;
            for ($i = 1; $i <= 52; $i++) $_pops->$i = 0;
            $_pops->last = 0;
        }
        $last = (integer)$_pops->last;
        // On met à jour les stats des semaines précédentes depuis la dernière intervention
        if (($last === $semaine) || ($last === ($semaine -1))) {
        } elseif ($last < ($semaine -1)) {
            for ($i = $last + 1; $i < $semaine; $i++) {
                $_pops->$i = 0;
                $j = '0'.$i;
            }
        } else {
            for ($i = 1; $i == $semaine; $i++) {
                $_pops->$i = 0;
            }
            for ($i = $last + 1; $i == 52; $i++) {
                $_pops->$i = 0;
            }
        }
        $_patchSemaines = array('01','02','03,','04','05','06','07','08','09');
        foreach ($_patchSemaines as $_pS) {
           if (isset($_pops->$_pS)) {
                $j = (integer)$_pS;
                $_pops->$j += $_pops->$_pS;
                unset($_pops->$_pS);
            }
        }
        $_pops->$semaine += $points;
        $_pops->last = $semaine;
        $_pops->score = 0;
        for ($i = 1; $i  <= 52; $i++) $_pops->score += $_pops->$i;
        $_p = json_encode($_pops);
        $this->popularite = $_p ;            
        return $this;
    }

    public function resetPopularite() {

        // print_r(' '.$this->username.' ');
        $now = new \DateTime;
        $_semaine = (integer)$now->format('W');
        $_pops = new \stdClass;
        $_p = $this->popularite;
        $_pops = json_decode($_p);
         if (!is_object($_pops)) {
            $_pops = new \stdClass;
            for ($i = 1; $i <= 52; $i++) $_pops->$i = 0;
            $_pops->last = $_semaine;
        }

        if ($this->getNewsletter()) {
            $_pops->$_semaine += 200;
        }
        if ($this->getOffresPartenaires()) {
            // $_pops->$_semaine += 200;
        }
        if ($this->hasCompletedProfile()) {
            $_pops->$_semaine += 200;
        }

        $_pops->score = 0;
        $_pops->last = $_semaine;
        for ($i = 1; $i  <= 52; $i++) $_pops->score += $_pops->$i;
        $_p = json_encode($_pops);
        $this->popularite = $_p ;      
        return $this;
    }

   public function recalculePopularite()
    {
        // print_r(' '.$this->username.' ');
        $now = new \DateTime;
        $semaine = (integer)$now->format('W');
        $_pops = new \stdClass;
        for ($i = 1; $i <= 52; $i++) $_pops->$i = 0;

        if (true) {
            $_pops->$semaine += 600;
        } else {
            if ($this->getNewsletter()) {
                $_pops->$semaine += 200;
            }
            if ($this->getOffresPartenaires()) {
                $_pops->$semaine += 200;
            }
            if ($this->hasCompletedProfile()) {
                $_pops->$semaine += 200;
            }            
        }

        $_pops->last = $semaine;
        $_pops->score = 0;
        for ($i = 1; $i  <= 52; $i++) $_pops->score += $_pops->$i;
        $_p = json_encode($_pops);
        $this->popularite = $_p ;      
        return $this;
    }

    private function hasCompletedProfile () {
        $prenom = $this->getPrenom();
        $nom = $this->getNom();
        $bio = $this->getBiographie();
        $avatar = $this->getLnAvatar();

        return !(empty($prenom) || empty($nom) || empty($bio) || empty($avatar));
    }
 
    public function getLogarithmicGrade () {

        $total = 52;
        $_activite = json_decode($this->popularite);
        if (isset($_activite->score)) {
            $_grade = $_activite->score;
        } elseif (isset($_activite->$total)) {
            $_grade = 0;
            for ($i = 1; $i <= $_activite->$total ; $i++) {
                $_grade += $_activite->$i;
            }
        } else {
            $_grade = 0;
        }

        $exposant = log(max(4, $_grade), 2);
        $grade = floor($exposant /2) -1;

        return $grade;
    }

   public function getLinearGrade () {

        $total = 52;
        $_activite = json_decode($this->popularite);
        if (isset($_activite->score)) {
            $_grade = $_activite->score;
        } elseif (isset($_activite->$total)) {
            $_grade = 0;
            for ($i = 1; $i <= $_activite->$total ; $i++) {
                $_grade += $_activite->$i;
            }
        } else {
            $_grade = 0;
        }

        $grade = floor(min(5,$_grade/100));

        return $grade;
    }

    public function getGrade($method = 'lineaire') {

        if ($method == 'log') {
            return $this->getLogarithmicGrade();
        } else {
            return $this->getLinearGrade();
        }
    }

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $filPresence;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $filAlertes;


    /**
     * Add filPresence
     *
     * @param TDN\NanaBundle\Entity\NanaSocialNetwork $filPresence
     * @return Nana
     */
    public function addFilPresence(\TDN\NanaBundle\Entity\NanaSocialNetwork $filPresence)
    {
        $this->filPresence[] = $filPresence;
    
        return $this;
    }

    /**
     * Remove filPresence
     *
     * @param TDN\NanaBundle\Entity\NanaSocialNetwork $filPresence
     */
    public function removeFilPresence(\TDN\NanaBundle\Entity\NanaSocialNetwork $filPresence)
    {
        $this->filPresence->removeElement($filPresence);
    }

    /**
     * Get filPresence
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getFilPresence()
    {
        return $this->filPresence;
    }

    /**
     * Add filAlertes
     *
     * @param TDN\CoreBundle\Entity\Journal $filAlertes
     * @return Nana
     */
    public function addFilAlerte(\TDN\CoreBundle\Entity\Journal $filAlertes)
    {
        $this->filAlertes[] = $filAlertes;
    
        return $this;
    }

    /**
     * Remove filAlertes
     *
     * @param TDN\CoreBundle\Entity\Journal $filAlertes
     */
    public function removeFilAlerte(\TDN\CoreBundle\Entity\Journal $filAlertes)
    {
        $this->alertes->removeElement($filAlertes);
    }

    /**
     * Get filAlertes
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getFilAlertes()
    {
        return $this->filAlertes;
    }
    /**
     * @var boolean $offresPartenaires
     */
    private $offresPartenaires;

    /**
     * @var integer $semainePromue
     */
    private $semainePromue;


    /**
     * Set offresPartenaires
     *
     * @param boolean $offresPartenaires
     * @return Nana
     */
    public function setOffresPartenaires($offresPartenaires)
    {
        $this->offresPartenaires = $offresPartenaires;
    
        return $this;
    }

    /**
     * Get offresPartenaires
     *
     * @return boolean 
     */
    public function getOffresPartenaires()
    {
        return $this->offresPartenaires;
    }

    /**
     * Set semainePromue
     *
     * @param integer $semainePromue
     * @return Nana
     */
    public function setSemainePromue($semainePromue)
    {
        $this->semainePromue = $semainePromue;
    
        return $this;
    }

    /**
     * Get semainePromue
     *
     * @return integer 
     */
    public function getSemainePromue()
    {
        return $this->semainePromue;
    }
}