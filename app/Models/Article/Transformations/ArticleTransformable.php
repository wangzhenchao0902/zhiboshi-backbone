<?php

namespace App\Models\Article\Transformations;

use App\Models\Article\Article;
use Arr;

trait ArticleTransformable
{
    public function transformArticle(Article $article)
    {
        $article->category_name = Arr::get(Article::$categories, $article->category_id, '');
        $article->preview_url = uploadFileUrl($article->cover);
        return $article;
    }
}