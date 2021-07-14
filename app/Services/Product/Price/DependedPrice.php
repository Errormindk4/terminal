<?php

namespace App\Services\Product\Price;

class DependedPrice extends Price {

    public $depend_code;

    public function __construct($amount, $tax, $depend_code)
    {
        parent::__construct($amount, $tax);
        $this->depend_code = $depend_code;
    }

    /**
     * @param int $count Scanned products count
     * @param int $depended_count How many depended products scanned
     *
     * @return float
     */
    public function getTotal(int $count, int $depended_count = 0) : float
    {
        if ($count === 1 && $depended_count)
        {
            return 0;
        }

        if ($count > 1 && $depended_count === 0)
        {
            return parent::getTotal($count);
        }

        $pax_count = $count <= $depended_count ? 1 : $count - $depended_count;

        return parent::getTotal($pax_count);
    }
}
