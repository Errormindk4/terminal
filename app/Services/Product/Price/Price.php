<?php

namespace App\Services\Product\Price;

abstract class Price {

    /**
     * @var float
     */
    protected $amount;

    /**
     * @var int
     */
    protected $tax;

    public function __construct($amount, $tax)
    {
        $this->amount = $amount;
        $this->tax = $tax;
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
