<?php

namespace Packs\LaravelShops\Http\Admin\Member;

use Packs\LaravelShops\Http\Controller\Controller;
use Packs\LaravelShops\Models\Admin;
use Illuminate\Http\Request;

/**
 * 管理员控制器
 * Class MemberController
 * @package Packs\LaravelShops\Admin\Member
 */
class MemberController extends Controller
{
    /**
     * 管理员列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminList(Request $request)
    {
        $param = $request->input();
        $condition = [];
        if (!empty($param['username'])) {
            $condition['admin_name'] = ['like','%'.$param['username'].'%'];
        }
        if (!empty($param['start']) || !empty($param['end'])) {
            $return_data = Admin::whereBetween(
                'created_at',[$param['start'], $param['end']]
            )->where($condition)->paginate(10);
        } else if (!empty($param['username'])) {
            $return_data = Admin::where('admin_name','like','%'.$param['username'].'%')->paginate(10);
        } else {
            $return_data = Admin::paginate(10);
        }
        return view('pack::admin/member/memberlist',['admin_list' => $return_data]);
    }

    /**
     * 编辑用户信息页面
     * @param Request $request
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
    */
    public function adminEdit(Request $request)
    {
        $admin_id = $request->input('admin_id');
        if (empty($admin_id)) {
            return redirect('pack/admin/admin_list')->with('error', '缺少参数！');
        }
        $first_info = Admin::where(['id' => $admin_id])->first();
        $first_info['admin_pass'] = pass_word_encryption($first_info['admin_pass']);
        return view('pack::admin/member/memberedit',['first_info' => $first_info]);
    }

    /**
     * 编辑管理员信息提交
     * @param Request $request
     * @param Admin $admin_model
     * @return $this
     */
    public function adminCommitEdit(Request $request, Admin $admin_model)
    {
        $param = $request->input();
        if (!$param['admin_id']) {
            return return_admin_info('pack/admin/admin_list','error','缺少参数！');
        }
        $first_info = $admin_model->find($param['admin_id']);
        if ($param['pass']) {
            $first_info->admin_pass = pass_word_encryption($param['pass']);
        }
        if ($first_info['admin_name'] != $param['username']) {
            $first_info->admin_name = $param['username'];
        }
        $return_result = $first_info->save();
        if (!$return_result) {
            return return_admin_info('pack/admin/admin_edit','error','修改失败');
        }
        return return_admin_info('pack/admin/admin_list','success','修改成功');
    }

    /**
     * 修改用户状态
     * @param Request $request
     * @param Admin $admin_model
     * @return string
     */
    public function memberStatusEdit(Request $request, Admin $admin_model)
    {
        $param = $request->input();
        if (!$param['admin_id']) {
            return return_json(100,'缺少参数','');
        }
        $first_info = $admin_model->find($param['admin_id']);
        $first_info->admin_status = $param['admin_status'];
        $return_result = $first_info->save();
        if (!$return_result) {
            return return_json(100,'修改失败','');
        }
        return return_json(200,'修改成功','');
    }

    /**
     * 添加管理员页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function memberAddView()
    {
        return view('pack::admin/member/memberadd');
    }

    /**
     * 提交管理员操作
     * @param Request $request
     * @param Admin $admin_model
     * @return $this
     */
    public function memberAdd(Request $request, Admin $admin_model)
    {
        $param = $request->input();
        if (empty($param['username'])) {
            return return_admin_info('pack/admin/admin_member_add','error','请填写管理员名称！');
        }
        if (empty($param['pass'])) {
            return return_admin_info('pack/admin/admin_member_add','error','请填写管理员密码！');
        }

        $admin_model->admin_name = $param['username'];
        $admin_model->admin_pass = pass_word_encryption($param['pass']);
        $return_result = $admin_model->save();
        if (!$return_result) {
            return return_admin_info('pack/admin/admin_member_add','error','添加失败！');
        }
        return return_admin_info('pack/admin/admin_list','success','添加成功！');

    }
}
