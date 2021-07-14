<?php

namespace App\Services\Product;

use App\Services\Product\Price\Price;

abstract class Product {

    /**
     * @var string
     */
    protected $code;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var int
     */
    public $count = 1;

    public function __construct($code, $name)
    {
        $this->code = $code;
        $this->name = $name;
    }

    /**
     * @return float
     */
    abstract public function getTotal () :float;

    /**
     * @return $this
     */
    public function addProduct () :Product
    {
        $this->count++;
        return $this;
    }

    /**
     * @return Price
     */
    public function price() :Price
    {
        return $this->price;
    }
}
