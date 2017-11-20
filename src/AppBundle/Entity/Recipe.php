<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="recipe")
 */

class Recipe {
      /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
     /**
     * @ORM\Column(type="string")
     */
    private $name;
     /**
     * @ORM\Column(type="string")
     */
    private $difficult ;
     /**
     * @ORM\Column(type="string")
     */
    private $time;

     /**
     * @ORM\Column(type="string")
     */
    private $picture;
    
      /**
     * @ORM\Column(type="string")
     */
    private $description;
    /**
        * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Product", inversedBy="recipes", cascade={"persist"})
        * @ORM\JoinTable(name="recipe_product")
        */
    private $products;
    

    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
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
     *
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
     * Set difficult
     *
     * @param string $difficult
     *
     * @return Recipe
     */
    public function setDifficult($difficult)
    {
        $this->difficult = $difficult;

        return $this;
    }

    /**
     * Get difficult
     *
     * @return string
     */
    public function getDifficult()
    {
        return $this->difficult;
    }

    /**
     * Set time
     *
     * @param string $time
     *
     * @return Recipe
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return string
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set picture
     *
     * @param string $picture
     *
     * @return Recipe
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return string
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set description
     *
     * @param string $description
     *
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
     * Add product
     *
     * @param \App\Entity\Product $product
     *
     * @return Recipe
     */
    public function addProduct(\App\Entity\Product $product)
    {
        $this->products[] = $product;

        return $this;
    }

    /**
     * Remove product
     *
     * @param \App\Entity\Product $product
     */
    public function removeProduct(\App\Entity\Product $product)
    {
        $this->products->removeElement($product);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProducts()
    {
        return $this->products;
    }
}
