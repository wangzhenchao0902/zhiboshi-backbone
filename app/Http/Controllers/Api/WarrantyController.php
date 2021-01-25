<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Warranty\Repositories\WarrantyRepository;

class WarrantyController extends Controller
{
    protected $warrantyRep;

    public function __construct(WarrantyRepository $rep)
    {
        $this->warrantyRep = $rep;
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
        $warrantys = $this->warrantyRep->get(array_filter($request->except('per_page', 'page')), ['id', 'name', 'phone', 'start_at', 'end_at']);
        return success($warrantys);
    }

}
