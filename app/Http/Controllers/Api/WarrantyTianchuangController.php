<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductTianchuang\RepositoriesTianchuang\ProductRepositoryTianchuang;
use Illuminate\Http\Request;
use App\Models\WarrantyTianchuang\RepositoriesTianchuang\WarrantyRepositoryTianchuang;

class WarrantyTianchuangController extends Controller
{
    protected $warrantyRep;
    protected $productRep;

    public function __construct(WarrantyRepositoryTianchuang $rep, ProductRepositoryTianchuang $prep)
    {
        $this->warrantyRep = $rep;
        $this->productRep = $prep;
    }

    /**
     * Undocumented function
     *
     * @author suxiangdong
     * @date 2021-01-24
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {
        if (!$request->input('phone')) {
            return failure('请输入查询手机号');
        }
        
        $warrantys = $this->warrantyRep->get(array_filter($request->except('per_page', 'page')), ['id', 'year', 'name', 'complimentary', 'phone', 'start_at', 'end_at', 'status']);
        return success($warrantys);
    }

    /**
     * Undocumented function
     *
     * @author suxiangdong
     * @date 2021-01-24
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $sn = $request->input('sn');

        if (!$product = $this->productRep->findBySn($sn)) {
            return failure('未找到天窗冰甲信息');
        }

        if ($this->warrantyRep->findByProductTianchuang($product)) {
            return failure('产品已注册');
        }

        $this->warrantyRep->createWarrantyTianchuang([
            'product_id' => $product->id,
            'year' => $product->year,
            'phone' => $request->input('phone'),
            'name' => $request->input('name'),
            'vin' => $request->input('vin'),
            'complimentary' => $product->complimentary,
        ]);

        return success();
    }


}
