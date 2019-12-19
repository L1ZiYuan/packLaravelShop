<?php

namespace  Packs\LaravelShops\Middleware;

use Closure;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $login_info = session('admin_info');
        if (empty($login_info)) {
            // 跳转登陆页面
            return redirect('pack/admin/login')->with('error', '请登陆！');
        }
        return $next($request);
    }
}
