<?php

namespace App\Services\Product\Price;

class PaxPrice extends Price {

    /**
     * @var int
     */
    protected $pax;

    /**
     * @var float
     */
    protected $pax_amount;

    public function __construct($amount, $tax, $pax, $pax_amount)
    {
        parent::__construct($amount, $tax);

        $this->pax = $pax;
        $this->pax_amount = $pax_amount;
    }

    /**
     * @param int $count Scanned products
     *
     * @return float
     */
    public function getTotal(int $count) : float
    {
        if ($count < $this->pax)
        {
            return parent::getTotal($count);
        }
        $total = 0;
        $pax_count = intdiv($count, $this->pax);

        for ($i = 0; $i < $pax_count; $i ++) {
            $total += $this->pax_amount + ($this->pax_amount * $this->tax / 100);
        }

        return $total + parent::getTotal($count - $pax_count * $this->pax);
    }
}
