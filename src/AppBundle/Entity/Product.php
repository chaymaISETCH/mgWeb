<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="product")
 */
class Product {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $label;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="string")
     */
    private $description;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    private $barCode;

    /**
     * @ORM\Column(type="string")
     */
    private $picture;

    /**
     * @ORM\Column(type="integer")
     */
    private $guarantee;

    /**
     * @ORM\OneToMany(targetEntity="Promotion", mappedBy="product")
     */
    private $promotions;

    /**
     * @ORM\ManyToOne(targetEntity="Categorie", inversedBy="produits")
     * @ORM\JoinColumn(name="categorie_id", referencedColumnName="id")
     */
    private $categorie;

    /**
     * Constructor
     */

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Recipe", mappedBy="products")
     */
    private $recipes;

    public function __construct() {
        $this->promotions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->recipes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set label
     *
     * @param string $label
     *
     * @return Product
     */
    public function setLabel($label) {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string
     */
    public function getLabel() {
        return $this->label;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return Product
     */
    public function setPrice($price) {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice() {
        return $this->price;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Product
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set barCode
     *
     * @param string $barCode
     *
     * @return Product
     */
    public function setBarCode($barCode) {
        $this->barCode = $barCode;

        return $this;
    }

    /**
     * Get barCode
     *
     * @return string
     */
    public function getBarCode() {
        return $this->barCode;
    }

    /**
     * Set picture
     *
     * @param string $picture
     *
     * @return Product
     */
    public function setPicture($picture) {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return string
     */
    public function getPicture() {
        return $this->picture;
    }

    /**
     * Add promotion
     *
     * @param \AppBundle\Entity\Promotion $promotion
     *
     * @return Product
     */
    public function addPromotion(\AppBundle\Entity\Promotion $promotion) {
        $this->promotions[] = $promotion;

        return $this;
    }

    /**
     * Remove promotion
     *
     * @param \AppBundle\Entity\Promotion $promotion
     */
    public function removePromotion(\AppBundle\Entity\Promotion $promotion) {
        $this->promotions->removeElement($promotion);
    }

    /**
     * Get promotions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPromotions() {
        return $this->promotions;
    }

    /**
     * Set categorie
     *
     * @param \AppBundle\Entity\Categorie $categorie
     *
     * @return Product
     */
    public function setCategorie(\AppBundle\Entity\Categorie $categorie = null) {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \AppBundle\Entity\Categorie
     */
    public function getCategorie() {
        return $this->categorie;
    }

    /**
     * Set guarantee
     *
     * @param integer $guarantee
     *
     * @return Product
     */
    public function setGuarantee($guarantee) {
        $this->guarantee = $guarantee;

        return $this;
    }

    /**
     * Get guarantee
     *
     * @return integer
     */
    public function getGuarantee() {
        return $this->guarantee;
    }

    /**
     * Add recipe
     *
     * @param \App\Entity\Recipe $recipe
     *
     * @return Product
     */
    public function addRecipe(\AppBundle\Entity\Recipe $recipe) {
        $this->recipes[] = $recipe;

        return $this;
    }

    /**
     * Remove recipe
     *
     * @param \App\Entity\Recipe $recipe
     */
    public function removeRecipe(\AppBundle\Entity\Recipe $recipe) {
        $this->recipes->removeElement($recipe);
    }

    /**
     * Get recipes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRecipes() {
        return $this->recipes;
    }

}
