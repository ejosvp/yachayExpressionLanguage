<?php

namespace ExpLangTest;

class Product
{
    private $price;
    private $stock;
    private $creationDate;

    public function __construct($price, $stock, \DateTime $publicationDate)
    {
        $this->price = $price;
        $this->stock = $stock;
        $this->creationDate = $publicationDate;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getStock()
    {
        return $this->stock;
    }

    public function setStock($stock)
    {
        $this->stock = $stock;
    }

    public function getCreationDate()
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTime $creationDate)
    {
        $this->creationDate = $creationDate;
    }
}