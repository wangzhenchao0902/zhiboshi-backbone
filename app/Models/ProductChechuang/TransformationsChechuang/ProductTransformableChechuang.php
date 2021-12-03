<?php

namespace App\Models\ProductChechuang\TransformationsChechuang;

use App\Models\ProductChechuang\ProductChechuang;

trait ProductTransformableChechuang
{
    public function transformProductChechuang(ProductChechuang $product)
    {
        $product = clone($product);
        $product->qr_sn = env('WEB_URL').'/warrantyChechuang?sn='.$product->sn;
        $product->warranty_status = $product->warranty ? 1 : 0;
        return $product;
    }
}