<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Article\Requests\CreateRequest;
use App\Models\Article\Repositories\ArticleRepository;
use Illuminate\Http\Request;
use App\Models\Article\Transformations\ArticleTransformable;

class ArticleController extends Controller
{
    use ArticleTransformable;

    protected $articleRep;

    public function __construct(ArticleRepository $rep)
    {
        $this->articleRep = $rep;
    }

    /**
     * create article
     *
     * @author suxiangdong
     * @date 2021-01-03
     * @param Request $request
     * @return void
     */
    public function store(CreateRequest $request)
    {
        $this->articleRep->create($request->all());
        return success();
    }

    /**
     * update article
     *
     * @author suxiangdong
     * @date 2021-01-06
     * @param [type] $id
     * @param Request $request
     * @return void
     */
    public function update(Request $request, $id)
    {
        $article = $this->articleRep->findOneOrFail($id);

        $this->articleRep->setModel($article);
        $this->articleRep->update($request->except('_method'));

        return success();
    }

    /**
     * delete article
     *
     * @author suxiangdong
     * @date 2021-01-10
     * @param Request $request
     * @param [type] $id
     * @return void
     */
    public function destroy(Request $request)
    {
        $this->articleRep->deleteByIds($request->input('ids'));
        return success();
    }

    /**
     * query article
     *
     * @author suxiangdong
     * @date 2021-01-03
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {
        $conditions = array_merge(array_filter($request->except('per_page', 'page')), ['category_id' => 1]);
        $articles = $this->articleRep->paginate($request->input('per_page', 20), $conditions);
        $articles->getCollection()->transform(function($item)
        {
            return $this->transformArticle($item);
        });
        return success($articles);
    }
}
