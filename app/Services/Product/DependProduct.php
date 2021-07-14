<?php

namespace App\Services\Product;

use App\Services\Product\Price\DependedPrice;

class DependProduct extends Product {

    /**
     * @var DependedPrice
     */
    protected $price;

    public function __construct($code, $name, $price)
    {
        parent::__construct($code, $name);
        $this->price = new DependedPrice($price->amount, $price->tax, $price->depend_code);
    }

    /**
     * @param int $depended_count Depended products scanned count
     *
     * @return float
     */
    public function getTotal($depended_count = 0) :float
    {
        return $this->price->getTotal($this->count, $depended_count);
    }
}
