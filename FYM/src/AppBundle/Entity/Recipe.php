<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Recipe
 *
 * @ORM\Table(name="recipe")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RecipeRepository")
 */
class Recipe
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Quantity", mappedBy="recipe", cascade={"all"})
     */
    private $igredientQuantity;

    
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
     * Set name
     *
     * @param string $name
     * @return Recipe
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
     * Set description
     *
     * @param string $description
     * @return Recipe
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
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

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->igredientQuantity = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add igredientQuantity
     *
     * @param \AppBundle\Entity\Quantity $igredientQuantity
     * @return Recipe
     */
    public function addIgredientQuantity(\AppBundle\Entity\Quantity $igredientQuantity)
    {
        $this->igredientQuantity[] = $igredientQuantity;

        return $this;
    }

    /**
     * Remove igredientQuantity
     *
     * @param \AppBundle\Entity\Quantity $igredientQuantity
     */
    public function removeIgredientQuantity(\AppBundle\Entity\Quantity $igredientQuantity)
    {
        $this->igredientQuantity->removeElement($igredientQuantity);
    }

    /**
     * Get igredientQuantity
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIgredientQuantity()
    {
        return $this->igredientQuantity;
    }
}
