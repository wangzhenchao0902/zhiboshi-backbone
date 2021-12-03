<?php

namespace App\Models\ProductChechuang;

use App\Models\WarrantyChechuang\WarrantyChechuang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Str;

class ProductChechuang extends Model
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
        $prefix = 'CZ'; // Chechuang & Zbs
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
     * @param WarrantyChechuang $warranty
     * @return void
     */
    public function registerWarrantyChechuang(WarrantyChechuang $warranty)
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
    public function warrantyChechuang()
    {
        return $this->belongsTo(WarrantyChechuang::class);
    }
}
