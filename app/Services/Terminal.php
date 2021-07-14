<?php

namespace App\Services;

use App\Services\Product\DependProduct;
use App\Services\Product\ProductFactory;

class Terminal {

    private $products = [];

    private $pricing;

    public function __construct($pricing)
    {
        $this->pricing = $pricing;
    }

    /**
     * @param string $code Scanned product code
     *
     * @return bool
     */
    public function scanProduct (string $code) :bool
    {
        if (!empty($this->products[$code]))
        {
            $this->products[$code]->addProduct();
            return true;
        }

        $factory = new ProductFactory();
        $product = $this->pricing[$code];
        try
        {
            $this->products[$code] = $factory->create($code, $product);
        }
        catch (\Exception $e)
        {
            return false;
        }

        return true;
    }

    /**
     * @return float
     */
    public function calcTotal () :float
    {
        $total = 0;

        foreach ($this->products as $product)
        {
            if ($product instanceof DependProduct)
            {
                $code = $product->price()->depend_code;
                if ( ! empty($this->products[$code]))
                {
                    $total += $product->getTotal($this->products[$code]->count);
                    continue;
                }
            }
            $total += $product->getTotal();
        }

        return $total;
    }

    public function clearProducts() :void
    {
        $this->products = [];
    }
}
