<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Str;

class Product extends Model
{
    use HasFactory;

    protected $guarded=[];

    /**
     * gen sn
     *
     * @author suxiangdong
     * @date 2021-01-15
     * @return void
     */
    public static function genSn()
    {
        $prefix = 'PZ'; // Product & Zbs
        $time = date('YmdHis');
        $randStr = Str::random(4);
        return $prefix.$time.$randStr;
    }
}
