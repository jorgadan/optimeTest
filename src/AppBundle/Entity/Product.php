<?php

namespace AppBundle\Entity;

use AppBundle\Traits\TimestamplableTrait;
use AppBundle\Traits\CommonTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table(name="products",options={"collate"="utf8mb4_unicode_ci"})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductRepository")
 */
class Product
{
    use CommonTrait, TimestamplableTrait;

    /**
     * @var string
     *
     * @ORM\Column(name="brand", type="string", length=50)
     */
    private $brand;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float", options={"comment":"product price"})
     */
    private $price;

    /**
     * @var Category
     *
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="products")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $categoryId;

    /**
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param string $brand
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }
}

