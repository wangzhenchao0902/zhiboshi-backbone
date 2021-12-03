<?php

namespace App\Http\Controllers\Manager;

use App\Exports\ProductChechuangExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductChechuang\RepositoriesChechuang\ProductRepositoryChechuang;
use App\Models\ProductChechuang\TransformationsChechuang\ProductTransformableChechuang;
use Excel;

class ProductChechuangController extends Controller
{
    use ProductTransformableChechuang;

    protected $productRep;

    /**
     * constuctor
     *
     * @author suxiangdong
     * @date 2021-01-15
     * @param ProductRepositoryChechuang $rep
     */
    public function __construct(ProductRepositoryChechuang $rep)
    {
        $this->productRep = $rep;
    }

    /**
     * product list
     *
     * @author suxiangdong
     * @date 2021-01-15
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {
        $products = $this->productRep->paginate($request->input('per_page', 20), $request->except('per_page', 'page'));
        $products->getCollection()->transform(function($item)
        {
            return $this->transformProductChechuang($item);
        });
        return success($products);
    }

    /**
     * export
     *
     * @author suxiangdong
     * @date 2021-03-14
     * @return void
     */
    public function export()
    {
        return Excel::download(ProductChechuangExport::instance(), '车窗二维码内容列表.xls');
    }

    /**
     * generate product codes
     *
     * @author suxiangdong
     * @date 2021-01-15
     * @param Request $request
     * @return void
     */
    public function generate(Request $request)
    {
        $this->productRep->generate($request->input('num'), $request->input('year'), $request->input('complimentary'));
        return success();
    }

    /**
     * used
     *
     * @author suxiangdong
     * @date 2021-01-15
     * @param Request $request
     * @param [type] $id
     * @return void
     */
    public function use(Request $request, $id)
    {
        try {
            $this->productRep->setUsed($id);
            return success();
        } catch (\Exceptionn $e) {
            return failure($e->getMessage());
        }
    }
}
