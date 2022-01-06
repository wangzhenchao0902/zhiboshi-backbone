<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Anli\Requests\CreateRequest;
use App\Models\Anli\Repositories\AnliRepository;
use Illuminate\Http\Request;
use App\Models\Anli\Transformations\AnliTransformable;

class AnliController extends Controller
{
    use AnliTransformable;

    protected $anliRep;

    public function __construct(AnliRepository $rep)
    {
        $this->anliRep = $rep;
    }

    /**
     * create anli
     *
     * @author suxiangdong
     * @date 2021-01-03
     * @param Request $request
     * @return void
     */
    public function store(CreateRequest $request)
    {
        $this->anliRep->create($request->all());
        return success();
    }

    /**
     * update anli
     *
     * @author suxiangdong
     * @date 2021-01-06
     * @param [type] $id
     * @param Request $request
     * @return void
     */
    public function update(Request $request, $id)
    {
        $anli = $this->anliRep->findOneOrFail($id);

        $this->anliRep->setModel($anli);
        $this->anliRep->update($request->except('_method'));

        return success();
    }

    /**
     * delete anli
     *
     * @author suxiangdong
     * @date 2021-01-10
     * @param Request $request
     * @param [type] $id
     * @return void
     */
    public function destroy(Request $request)
    {
        $this->anliRep->deleteByIds($request->input('ids'));
        return success();
    }

    /**
     * query anli
     *
     * @author suxiangdong
     * @date 2021-01-03
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {
        $conditions = array_merge(array_filter($request->except('per_page', 'page')), ['category_id' => 2]);
        $anlis = $this->anliRep->paginate($request->input('per_page', 20), $conditions);
        $anlis->getCollection()->transform(function($item)
        {
            return $this->transformAnli($item);
        });
        return success($anlis);
    }
}
