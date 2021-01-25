<?php

namespace App\Models\Warranty;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warranty extends Model
{
    use HasFactory;

    protected $guarded=[];

    public static $status = [
        1 => '正常',
        2 => '作废',
    ];
}
