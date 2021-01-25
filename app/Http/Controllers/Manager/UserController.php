<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Manager\Controller as BaseController;
use App\Models\Manager\Repositories\ManagerRepository;

class UserController extends BaseController
{
    /**
     * @var ManagerRepository
     */
    protected $managerRep;

    /**
     * constructor
     *
     * @author suxiangdong
     * @date 2021-01-03
     * @param ManagerRepository $rep
     */
    public function __construct(ManagerRepository $rep)
    {
        $this->managerRep = $rep;
    }

    /**
     * 管理员详情
     *
     * @author suxiangdong
     * @date 2021-01-03
     * @return void
     */
    public function userinfo()
    {
        $id = $this->authGuard()->id();

        return success($this->managerRep->find($id));
    }
}
