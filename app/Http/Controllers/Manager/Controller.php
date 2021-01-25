<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller as BaseController;
use Auth;

class Controller extends BaseController
{
    protected function authGuard()
    {
        return Auth::guard('manager');
    }
}
