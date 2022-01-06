<?php

namespace App\Models\Anli\Transformations;

use App\Models\Anli\Anli;
use Arr;

trait AnliTransformable
{
    public function transformAnli(Anli $anli)
    {
        $anli->category_name = Arr::get(Anli::$categories, $anli->category_id, '');
        $anli->preview_url = uploadFileUrl($anli->cover);
        return $anli;
    }
}