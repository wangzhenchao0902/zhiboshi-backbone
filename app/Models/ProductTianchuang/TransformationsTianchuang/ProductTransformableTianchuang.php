<?php

namespace App\Models\ProductTianchuang\TransformationsTianchuang;

use App\Models\ProductTianchuang\ProductTianchuang;

trait ProductTransformableTianchuang
{
    public function transformProductTianchuang(ProductTianchuang $product)
    {
        $product = clone($product);
        $product->qr_sn = env('WEB_URL').'/warrantyTianchuang?sn='.$product->sn;
        $product->warranty_status = $product->warranty ? 1 : 0;
        return $product;
    }
}