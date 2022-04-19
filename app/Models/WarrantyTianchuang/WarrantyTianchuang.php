<?php

namespace App\Models\WarrantyTianchuang;

use App\Models\ProductTianchuang\ProductTianchuang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarrantyTianchuang extends Model
{
    use HasFactory;

    protected $guarded=[];

    public static $status = [
        1 => '正常',
        2 => '作废',
    ];

    /**
     * Undocumented function
     *
     * @author suxiangdong
     * @date 2021-03-14
     * @return void
     */
    public function product()
    {
        return $this->belongsTo(ProductTianchuang::class);
    }
}
