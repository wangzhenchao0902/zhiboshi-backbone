<?php

namespace App\Models\Product\Transformations;

use App\Models\Product\Product;

trait ProductTransformable
{
    public function transformProduct(Product $product)
    {
        $product->qr_sn = env('WEB_URL').'/warranty?sn='.$product->sn;
        return $product;
    }
}