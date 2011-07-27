<?php

namespace Chtitux\EtudiantBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Chtitux\EtudiantBundle\Entity\Etudiant
 */
class Etudiant
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $firstname
     */
    private $firstname;

    /**
     * @var string $lastname
     */
    private $lastname;

    /**
     * @var string $gender
     */
    private $gender;

    /**
     * @var string $description
     */
    private $description;


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
     * Set firstname
     *
     * @param string $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set gender
     *
     * @param string $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * Get gender
     *
     * @return string 
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set description
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    public function __toString()
    {
        return $this->getFirstname()." ".$this->getLastname();
    }
    /**
     * @var Chtitux\EtudiantBundle\Entity\Promotion
     */
    private $promotion;


    /**
     * Set promotion
     *
     * @param Chtitux\EtudiantBundle\Entity\Promotion $promotion
     */
    public function setPromotion(\Chtitux\EtudiantBundle\Entity\Promotion $promotion)
    {
        $this->promotion = $promotion;
    }

    /**
     * Get promotion
     *
     * @return Chtitux\EtudiantBundle\Entity\Promotion 
     */
    public function getPromotion()
    {
        return $this->promotion;
    }
}