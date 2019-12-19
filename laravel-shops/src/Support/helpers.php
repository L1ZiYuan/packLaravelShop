<?php

/**
 * 新的助手函数
 * (必须进行发布文件，因为laravel asset默认函数是指向到laravel目录中，而不是组件中
 * 所以把需要的资源文件通过服务提供者发布到laravel
 * 命令：php artisan vendor:publish --provider="Pack\LaravelShops\Provider\ServiceProvider")
 */
if (! function_exists('shop_asset')) {
    function shop_asset($path, $secure = null)
    {
        // 添加url读写数据   asset(指向新的文件路径)
        return asset("vendor\pack\laravel-shop\\".$path, $secure);
    }
}

/**
 * 密码加验方法
 */
if (! function_exists('pass_word_encryption')) {
    /**
     * 密码加验
     * @param $password
     * @return string
     */
    function pass_word_encryption($password)
    {
        $salt = md5('lms');
        $password = md5($password) . $salt;
        $password = md5($password);
        return $password;
    }
}

/**
 * 返回json
 */
if (! function_exists('return_json')) {

    /**
     * 返回json数据
     * @param $code 状态码
     * @param $msg 提示语
     * @param $data 数据
     * @return string
     */
    function return_json($code, $msg, $data)
    {
        return json_encode(['code' => $code, 'msg' => $msg, 'data' => $data]);
    }
}

if (! function_exists('return_admin_info')) {
    /**
     * 后台返回提示语
     * @param $url 跳转的url
     * @param $status success|error
     * @param $msg 提示语
     * @return $this
     */
    function return_admin_info($url,$status, $msg)
    {
        return redirect($url)->with($status, $msg);
    }
}