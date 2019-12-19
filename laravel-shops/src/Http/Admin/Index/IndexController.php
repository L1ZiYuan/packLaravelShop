<?php
namespace Pack\LaravelShops\Http\Admin\Index;

use Pack\LaravelShops\Http\Controller\Controller;
use Illuminate\Support\Facades\Redirect;


/**
 * 首页控制器
 * Class IndexController
 * @package Pack\LaravelShops\Http\Admin\Index
 */
class IndexController extends Controller
{
    /**
     * 首页页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function index()
    {
        $admin_user_info =  session()->get('admin_info');
        if (empty($admin_user_info)) {
            return Redirect::route('admin.Login.login');
        }
        return view('pack::admin/index/index',['admin_data' => $admin_user_info]);
    }

}
