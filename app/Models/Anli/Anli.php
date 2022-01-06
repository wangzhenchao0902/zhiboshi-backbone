<?php

namespace App\Models\Anli;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class Anli extends Model
{
    use HasFactory;

    protected $table = "articles";

    protected $guarded=[];

    /**
     * Undocumented variable
     *
     * @var array
     * @author suxiangdong
     * @date 2021-01-06
     */
    public static $categories = [
        1 => '新闻中心',
        2 => '案例中心',
        3 => '关于我们',
        4 => '联系我们',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function isForbidden()
    {
        return $this->status != 1;
    }
}
