<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product\Repositories\ProductRepository;
use App\Models\Product\Transformations\ProductTransformable;

class ProductController extends Controller
{
    use ProductTransformable;

    protected $productRep;

    /**
     * constuctor
     *
     * @author suxiangdong
     * @date 2021-01-15
     * @param ProductRepository $rep
     */
    public function __construct(ProductRepository $rep)
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
            return $this->transformProduct($item);
        });
        return success($products);
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
        $this->productRep->generate($request->input('num'));
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
