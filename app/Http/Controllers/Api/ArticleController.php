<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article\Repositories\ArticleRepository;
use App\Models\Article\Transformations\ArticleTransformable;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    use ArticleTransformable;

    protected $articleRep;

    public function __construct(ArticleRepository $rep)
    {
        $this->articleRep = $rep;
    }

    /**
     * query cases
     *
     * @author suxiangdong
     * @date 2021-01-03
     * @param Request $request
     * @return void
     */
    public function case(Request $request)
    {
        $tags = $request->input('tags', '');
        if($tags !== '') {
            $conditions = array_merge(array_filter($request->except('per_page', 'page')), ['category_id' => 2, 'status' => 1, 'tags' => urlencode($tags)]);
            var_dump($conditions);
            exit;
        } else {
            $conditions = array_merge(array_filter($request->except('per_page', 'page')), ['category_id' => 2, 'status' => 1]);
        }
        $articles = $this->articleRep->paginate($request->input('per_page', 20), $conditions, 'id', 'desc', ['id', 'cover', 'title', 'tags']);
        $articles->getCollection()->transform(function($item)
        {
            return $this->transformArticle($item);
        });
        return success($articles);
    }

    /**
     * query news
     *
     * @author suxiangdong
     * @date 2021-01-03
     * @param Request $request
     * @return void
     */
    public function news(Request $request)
    {
        $conditions = array_merge(array_filter($request->except('per_page', 'page')), ['category_id' => 1, 'status' => 1]);
        $articles = $this->articleRep->paginate($request->input('per_page', 20), $conditions, 'order_number', 'desc', ['id', 'tags', 'category_id', 'cover', 'title', 'created_at', 'order_number']);
        $articles->getCollection()->transform(function($item)
        {
            return $this->transformArticle($item);
        });
        return success($articles);
    }

    /**
     * Undocumented function
     *
     * @author suxiangdong
     * @date 2021-01-24
     * @param Request $request
     * @param [type] $id
     * @return void
     */
    public function show(Request $request, $id)
    {
        if (!$article = $this->articleRep->find($id)) {
            return failure('未找到相关文章');
        }
        if ($article->isForbidden()) {
            return failure('未找到相关文章');
        }
        return success($article);
    }

    /**
     * Undocumented function
     *
     * @author suxiangdong
     * @date 2021-01-24
     * @param Request $request
     * @param [type] $id
     * @return void
     */
    public function about(Request $request)
    {
        $article = $this->articleRep->getAbout();
        return success($article);
    }

    /**
     * Undocumented function
     *
     * @author suxiangdong
     * @date 2021-01-24
     * @param Request $request
     * @param [type] $id
     * @return void
     */
    public function contact(Request $request)
    {
        $article = $this->articleRep->getContact();
        return success($article);
    }

    /**
     * Undocumented function
     *
     * @author suxiangdong
     * @date 2021-01-24
     * @param Request $request
     * @return void
     */
    public function allIds(Request $request)
    {
        $articleIds = $this->articleRep->get(['category_id' => $request->input('category_id', 1), 'status' => 1], ['id']);
        return success($articleIds);
    }
}
