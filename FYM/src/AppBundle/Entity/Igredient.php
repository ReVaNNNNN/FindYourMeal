<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Igredient
 *
 * @ORM\Table(name="igredient")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\IgredientRepository")
 */
class Igredient
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
     * @var string
     *
     * @ORM\Column(name="category", type="string", length=255)
     */
    private $category;

    /**
     * @var float
     *
     * @ORM\Column(name="price_per_100g", type="float")
     */
    private $pricePer100g;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Quantity", mappedBy="igredient")
     */
    private $igredientQuantity;

    public function __construct()
    {
        $this->recipe = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Igredient
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
     * @return Igredient
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get category
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set category
     *
     * @param string $category
     * @return Igredient
     */
    public function setCategory($category)
    {
        $this->category = $category;

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
     * Set pricePer100g
     *
     * @param float $pricePer100g
     * @return Igredient
     */
    public function setPricePer100g($pricePer100g)
    {
        $this->pricePer100g = $pricePer100g;

        return $this;
    }

    /**
     * Get pricePer100g
     *
     * @return float
     */
    public function getPricePer100g()
    {
        return $this->pricePer100g;
    }


    /**
     * Add igredientQuantity
     *
     * @param \AppBundle\Entity\Quantity $igredientQuantity
     * @return Igredient
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
