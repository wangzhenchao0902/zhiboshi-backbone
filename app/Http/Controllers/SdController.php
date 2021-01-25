<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SdController extends Controller
{
    public function view(Request $request)
    {
        $path = $request->input('path');
        return response()->file(storage_path('app/'.$path));
    }
}
