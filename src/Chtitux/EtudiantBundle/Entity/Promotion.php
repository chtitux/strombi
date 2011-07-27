<?php

namespace Chtitux\EtudiantBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Chtitux\EtudiantBundle\Entity\Promotion
 */
class Promotion
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $nom
     */
    private $nom;

    /**
     * @var string $slug
     */
    private $slug;

    /**
     * @var Chtitux\EtudiantBundle\Entity\Etudiant
     */
    private $etudiants;

    public function __construct()
    {
        $this->etudiants = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        return $this->getNom();
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
     * Set nom
     *
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
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
     * Set slug
     *
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Add etudiants
     *
     * @param Chtitux\EtudiantBundle\Entity\Etudiant $etudiants
     */
    public function addEtudiants(\Chtitux\EtudiantBundle\Entity\Etudiant $etudiants)
    {
        $this->etudiants[] = $etudiants;
    }

    /**
     * Get etudiants
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getEtudiants()
    {
        return $this->etudiants;
    }
}