<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Quantity
 *
 * @ORM\Table(name="quantity")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\QuantityRepository")
 */
class Quantity
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
     * @var float
     *
     * @ORM\Column(name="quantity", type="float")
     */
    private $quantity;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Igredient", inversedBy="igredientQuantity")
     */
    private $igredient;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Recipe", inversedBy="igredientQuantity")
     */
    private $recipe;
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
     * Set quantity
     *
     * @param float $quantity
     * @return Quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return float 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set igredient
     *
     * @param \AppBundle\Entity\Igredient $igredient
     * @return Quantity
     */
    public function setIgredient($igredient)
    {
        $this->igredient = $igredient;

        return $this;
    }

    /**
     * Get igredient
     *
     * @return \AppBundle\Entity\Igredient 
     */
    public function getIgredient()
    {
        return $this->igredient;
    }

    /**
     * Set recipe
     *
     * @param \AppBundle\Entity\Recipe $recipe
     * @return Quantity
     */
    public function setRecipe($recipe)
    {
        $this->recipe = $recipe;

        return $this;
    }

    /**
     * Get recipe
     *
     * @return \AppBundle\Entity\Recipe 
     */
    public function getRecipe()
    {
        return $this->recipe;
    }
}
