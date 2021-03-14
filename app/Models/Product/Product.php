<?php

namespace App\Models\Product;

use App\Models\Warranty\Warranty;
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

    /**
     * Undocumented function
     *
     * @author suxiangdong
     * @date 2021-03-14
     * @return void
     */
    public function setUsed()
    {
        $this->status = 1;
        $this->save();
    }

    /**
     * 注册质保记录
     *
     * @author suxiangdong
     * @date 2021-03-14
     * @param Warranty $warranty
     * @return void
     */
    public function registerWarranty(Warranty $warranty)
    {
        $this->warranty_id = $warranty->id;
        $this->save();
    }

    /**
     * Undocumented function
     *
     * @author suxiangdong
     * @date 2021-03-14
     * @return void
     */
    public function warranty()
    {
        return $this->belongsTo(Warranty::class);
    }
}
