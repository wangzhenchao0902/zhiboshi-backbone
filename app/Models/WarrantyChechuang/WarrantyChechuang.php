<?php

namespace App\Models\WarrantyChechuang;

use App\Models\ProductChechuang\ProductChechuang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarrantyChechuang extends Model
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
        return $this->belongsTo(ProductChechuang::class);
    }
}
