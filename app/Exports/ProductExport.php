<?php

namespace App\Exports;

use App\Models\Product\Product;
use App\Models\Product\Transformations\ProductTransformable;
use Maatwebsite\Excel\Concerns\FromArray;

class ProductExport implements FromArray
{
    use ProductTransformable;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function array(): array
    {
        $products = Product::where('status', 0)->where('warranty_id', 0)->paginate(100);
        $cellData = [
            ['ID', '编号']
        ];
        foreach ($products->getCollection() as $product) {
            $item = $this->transformProduct($product);
            $cellData[] = [
                $item->id,
                $item->qr_sn,
            ];
            $product->setUsed();
        }

        return $cellData;
    }

    /**
     * Undocumented function
     *
     * @author suxiangdong
     * @date 2021-03-14
     * @return void
     */
    public static function instance()
    {
        return new self;
    }
}
