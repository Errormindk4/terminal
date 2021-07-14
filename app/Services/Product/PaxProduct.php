<?php

namespace App\Services\Product;

use App\Services\Product\Price\PaxPrice;

class PaxProduct extends Product {

    /**
     * @var PaxPrice
     */
    protected $price;

    public function __construct($code, $name, $price)
    {
        parent::__construct($code, $name);
        $this->price = new PaxPrice($price->amount, $price->tax, $price->pax, $price->pax_amount);
    }

    /**
     * @return float
     */
    public function getTotal() :float
    {
        return $this->price->getTotal($this->count);
    }
}
