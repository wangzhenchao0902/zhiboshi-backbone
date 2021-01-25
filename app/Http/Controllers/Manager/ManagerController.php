<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Manager\Requests\CreateRequest;
use App\Models\Manager\Repositories\ManagerRepository;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    protected $managerRep;

    public function __construct(ManagerRepository $rep)
    {
        $this->managerRep = $rep;
    }

    /**
     * create manager
     *
     * @author suxiangdong
     * @date 2021-01-03
     * @param Request $request
     * @return void
     */
    public function store(CreateRequest $request)
    {
        extract($request->only('name', 'password'));

        try {
            $this->managerRep->createManager($name, $password, $request->only('realname'));
            return success();
        } catch (\Exception $e) {
            return failure($e->getMessage());
        }
    }

    /**
     * update manager
     *
     * @author suxiangdong
     * @date 2021-01-06
     * @param [type] $id
     * @param Request $request
     * @return void
     */
    public function update(Request $request, $id)
    {
        try {
            $manager = $this->managerRep->findOneOrFail($id);

            $this->managerRep->setModel($manager);
            $this->managerRep->updateManager($request->except('_method'));
    
            return success();
        } catch (\Exception $e) {
            return failure($e->getMessage());
        }
    }

    /**
     * delete manager
     *
     * @author suxiangdong
     * @date 2021-01-10
     * @param Request $request
     * @param [type] $id
     * @return void
     */
    public function destroy(Request $request)
    {
        try {
            $this->managerRep->deleteByIds($request->input('ids'));
            return success();
        } catch (\Exception $e) {
            return failure($e->getMessage());
        }
    }

    /**
     * query manager
     *
     * @author suxiangdong
     * @date 2021-01-03
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {
        $managers = $this->managerRep->paginate($request->input('per_page', 20), array_filter($request->except('per_page', 'page')));
        return success($managers);
    }
}
