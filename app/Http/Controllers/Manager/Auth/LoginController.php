<?php

namespace App\Http\Controllers\Manager\Auth;

use App\Http\Controllers\Manager\Controller as BaseController;
use Illuminate\Http\Request;

class LoginController extends BaseController
{
    /**
     * manager login
     *
     * @author suxiangdong
     * @date 2020-12-23
     * @param Request $request
     * @return void
     */
    public function login(Request $request)
    {
        if (!$this->authGuard()->attempt($request->only('name', 'password'), $request->input('remember'))) {
            return failure('用户名密码错误');
        }
        $manager = $this->authGuard()->user();
        return success($manager);
    }

    /**
     * lmanager ogout
     *
     * @author suxiangdong
     * @date 2021-01-03
     * @param Request $request
     * @return void
     */
    public function logout(Request $request)
    {
        $this->authGuard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return success();
    }
}
