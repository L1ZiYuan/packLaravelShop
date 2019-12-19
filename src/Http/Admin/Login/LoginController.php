<?php

namespace Pack\LaravelShops\Http\Admin\Login;

use Pack\LaravelShops\Http\Controller\Controller;
use Illuminate\Http\Request;
use Pack\LaravelShops\Models\Admin;

/**
 * 后台登陆页面
 * Class IndexController
 * @package Pack\LaravelShops\Http\Admin\Index
 */
class LoginController extends Controller
{
    /**
     * 登陆页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('pack::admin/login/login');
    }

    /**
     * 登陆提交
     * @param Request $request
     * @return string
     */
    public function login(Request $request)
    {
        $param = $request->input();
        if (empty($param['username'])){
            return return_json(100, '用户名必选项不能为空！', '');
        }

        if (empty($param['password'])){
            return return_json(200, '密码必选项不能为空！', '');
        }
        // 检查用户是否存在
        $return_result = Admin::where(
            [
                'admin_name' => $param['username'],
                'admin_pass' => pass_word_encryption($param['password'])
            ])->first()->toArray();
        if ($return_result['admin_status'] == 1) {
            return return_json(100,'该账号已被冻结，请联系管理员！','');
        }
        if (!$return_result) {
            return return_json(100,'用户不存在！','');
        }
        // 登陆成功信息存入session
        session(['admin_info' =>  ['admin_id' => $return_result['id'],'admin_name' => $return_result['admin_name']]]);
        return return_json(200,'登陆成功，正在跳转...','');
    }

    /**
     * 退出登陆
     * @return $this
     */
    public function loginout()
    {
        session()->flash('admin_info');
        return return_admin_info('pack/admin/login','success','退出成功');
    }
}
