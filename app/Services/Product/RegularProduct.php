<?php

namespace App\Services\Product;

use App\Services\Product\Price\RegularPrice;

class RegularProduct extends Product {

    /**
     * @var RegularPrice
     */
    protected $price;

    public function __construct($code, $name, $price)
    {
        parent::__construct($code, $name);
        $this->price = new RegularPrice($price->amount, $price->tax);
    }

    /**
     * @return float
     */
    public function getTotal () :float
    {
        return $this->price->getTotal($this->count);
    }
}
