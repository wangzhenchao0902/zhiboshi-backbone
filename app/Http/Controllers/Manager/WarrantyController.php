<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Warranty\Repositories\WarrantyRepository;

class WarrantyController extends Controller
{
    protected $warrantyRep;

    /**
     * constuctor
     *
     * @author suxiangdong
     * @date 2021-01-15
     * @param ProductRepository $rep
     */
    public function __construct(WarrantyRepository $rep)
    {
        $this->warrantyRep = $rep;
    }

    /**
     * list warranty
     *
     * @author suxiangdong
     * @date 2021-01-17
     * @return void
     */
    public function index(Request $request)
    {
        $w = $this->warrantyRep;
        $ww = $w::join('products', 'products.id', '=', '$w.product_id');
        $warranties = $w->paginate($request->input('per_page', 20), $request->except('per_page', 'page'));
        return success($warranties);
    }

    /**
     * Undocumented function
     *
     * @author suxiangdong
     * @date 2021-01-17
     * @param Reqest $request
     * @param [type] $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        try {
            $warranty = $this->warrantyRep->findOneOrFail($id);

            $this->warrantyRep->setModel($warranty);
            $this->warrantyRep->update($request->except('_method'));
    
            return success();
        } catch (\Exception $e) {
            return failure($e->getMessage());
        }
    }

    /**
     * Undocumented function
     *
     * @author suxiangdong
     * @date 2021-01-17
     * @param Reqest $request
     * @param [type] $id
     * @return void
     */
    public function void(Request $request, $id)
    {
        try {
            $this->warrantyRep->void($id);
            return success();
        } catch (\Exception $e) {
            return failure($e->getMessage());
        }
    }
}
