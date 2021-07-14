<?php

namespace App\Services\Product\Price;


class RegularPrice extends Price {

    public function __construct($amount, $tax)
    {
        parent::__construct($amount, $tax);
    }

    /**
     * @param int $count Scanned products
     *
     * @return float
     */
    public function getTotal(int $count) :float
    {
        return ($this->amount + ($this->amount * $this->tax / 100)) * $count;
    }
}
