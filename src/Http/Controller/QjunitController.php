<?php
namespace Pack\LaravelShops\Http\Controller;

use Illuminate\Http\Request;

class QjunitController
{
    /**
     * 渲染页面
     * @return mixed
     */
    public function index()
    {
        return  view('pack::admin/index');
    }

    /**
     * 提交测试的方法
     * @param Request $request
     * @return string
     */
    public function store(Request $request)
    {
        $namespace  = $request->input('namespace');
        $className  = $request->input('className');
        $action     = $request->input('action');
        $param      = $request->input('param');
        $class = ($className == "") ? $namespace : $namespace.'\\'.$className;
        // 要提换的值  需要的结果
        $class = str_replace("/", "\\", $class);
        $object = new $class();
        $param = ($param == "") ? [] : explode('|', $param) ;
        $data = call_user_func_array([$object, $action], $param);
        return (is_array($data)) ? json_encode($data) : dd($data);
    }
}