<?php

namespace App\Models\Manager;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DateTimeInterface;

class Manager extends Authenticatable
{
    use HasFactory;

    protected $hidden = ['password', 'email_verified_at', 'remember_token'];

    protected $fillable = ['name', 'password', 'realname'];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
