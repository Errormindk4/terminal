<?php

namespace App\Services\Product;

abstract class FactoryAbstract {

    /**
     * @param string $code
     * @param object $product
     *
     * @return Product
     */
    public function create (string $code, object $product) :Product {
        if (property_exists($product->price, 'pax')) {
            return new PaxProduct($code, $product->name, $product->price);
        }
        if (property_exists($product->price, 'depend_code')) {
            return new DependProduct($code, $product->name, $product->price);
        }

        return new RegularProduct($code, $product->name, $product->price);
    }
}
