<?php

namespace Packs\LaravelShops\Http\Admin\Auth;

use Packs\LaravelShops\Http\Controller\Controller;
use Illuminate\Http\Request;
use Packs\LaravelShops\Request\AuthRequest;
use Packs\LaravelShops\Models\Auth;

/**
 * 权限操作控制器
 * Class AuthController
 * @package Pack\LaravelShops\Http\Admin\Auth
 */
class AuthController extends Controller
{
    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * 权限列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function authList(Auth $authModel)
    {
        $auth_list = $authModel->paginate(10);
        return view('pack::admin/auth/authlist',['auth_list' => $auth_list]);
    }

    /**
     * 添加权限页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function authAddView(Auth $authModel)
    {
        $auth_pid_list = $authModel->where('auth_pid',0)->get();
        return view('pack::admin/auth/authadd',['auth_pid_list' => $auth_pid_list]);
    }


    /**
     * 添加权限操作
     * @param AuthRequest $authRequest
     * @param Auth $authModel
     * @return $this
     */
    public function authAdd(AuthRequest $authRequest, Auth $authModel)
    {
        $authModel->auth_name = $authRequest->auth_name;
        $authModel->auth_pid = $authRequest->auth_pid;
        $authModel->auth_c = $authRequest->auth_c;
        $authModel->auth_a = $authRequest->auth_a;
        $authModel->auth_sort = $authRequest->auth_pid == 1 ? 2 : 1;
        $authModel->auth_route = $authRequest->auth_route;
        $return_result = $authModel->save();
        if (!$return_result) {
            return return_admin_info('pack/admin/admin_auth_list','error','添加失败！');
        }
        if ($authRequest->auth_pid == 0) {
            $data = 0;
        } else {
            $data = $authRequest->auth_pid.'-'.$authModel->id;
        }

        $authModel->where(['id' => $authModel->id])->update(['auth_path' => $data]);
        return return_admin_info('pack/admin/admin_auth_list','success','添加成功！');
    }

    /**
     * 权限编辑页面
     * @param Request $request
     * @param Auth $authModel
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function authEditView(Request $request, Auth $authModel)
    {
        $param = $request->input();
        $auth_first_info = $authModel::find($param['auth_id']);
        $auth_pid_list = $authModel->where('auth_pid',0)->get();
        return view('pack::admin/auth/authedit',['auth_first_info' => $auth_first_info,'auth_pid_list' => $auth_pid_list]);
    }

    /**
     * 权限编辑操作
     * @param Request $request
     * @param Auth $authModel
     */
    public function authEdit(Request $request, Auth $authModel)
    {
        $param = $request->input();
        $auth_info = $authModel::find($param['auth_id']);
        $auth_info->auth_name = $param['auth_name'];
        $auth_info->auth_pid = $param['auth_pid'];
        $auth_info->auth_c = trim($param['auth_c']);
        $auth_info->auth_a = trim($param['auth_a']);
        $auth_info->auth_route = trim($param['auth_route']);
        $result = $auth_info->save();
        if (!$result) {
            return return_admin_info('pack/admin/admin_auth_list','error','编辑失败！');
        }
        return return_admin_info('pack/admin/admin_auth_list','success','编辑成功！');
    }

    public function authDelete(Request $request, Auth $authModel)
    {
        $param = $request->input();
        $result = $authModel::destroy($param['auth_id']);
        if (!$result) {
            return return_json(100,'删除失败！','');
        }
        return return_json(200,'删除成功！','');
    }

}
