<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    /**
     * upload
     *
     * @author suxiangdong
     * @date 2021-01-07
     * @param Request $request
     * @return void
     */
    public function upload(Request $request)
    {
        $file = $request->file;

        if (!$file->isValid()) {
            return failue('file is not valid');
        }

        $path = $file->store('local');

        return success([
            'file_path' => $path,
            'preview_url' => uploadFileUrl($path)
        ]);
    }

    public function view(Request $request)
    {
        $path = $request->input('path');
        return response()->file(storage_path('app/'.$path));
    }
}
