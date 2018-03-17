<?php

namespace AppBundle\Entity;

use AppBundle\Traits\TimestamplableTrait;
use AppBundle\Traits\CommonTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="categories",options={"charset"="utf8mb4","collate"="utf8mb4_unicode_ci"})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoryRepository")
 */
class Category
{
    use CommonTrait, TimestamplableTrait;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", nullable=false)
     */
    private $active;

    /**
     * @var Product[]
     *
     * @ORM\OneToMany(targetEntity="Product", mappedBy="categoryId")
     */
    private $products;

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    /**
     * @return Product[]
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param Product $product
     * @return Category
     */
    public function addProduct(Product $product)
    {
        if (!$this->products->contains($product)) {
            $this->products->add($product);
        }

        return $this;
    }

    public function hasProduct($product)
    {
        return $this->products->contains($product);
    }

    public function removeProduct(Product $product)
    {
        if ($this->hasProduct($product)) {
            $this->products->removeElement($product);
        }

        return $this;
    }

}

