<?php
namespace Packs\LaravelShops\Provider;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider as Provoder;

/**
 * 提供服务提供者服务，与laravel进行结合，可使用laravel框架带的东西
 * 将该服务放入到laravel -- config\app.php 里
 * Class ServiceProvider
 * @package Packs\LaravelShops\Provider
 */
class ServiceProvider extends Provoder
{
    // 注册的命令
    public $commandData = [
        'Packs\LaravelShops\Console\Command\installlms',
        'Packs\LaravelShops\Console\Command\makeClass',
    ];
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // 加载视图路径
        $this->loadViewsFrom(__DIR__.'/../Resources/view','pack');
        // 发布文件
        $this->registerPublishing();
        $this->registerMigration();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // 注册路由
        $this->registerRoutes();
        $this->commands($this->commandData);
    }


    /**
     * Register the package routes.
     * 注册路由
     * @return void
     */
    private function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__.'/../Routes/routes.php');
        });
    }

    /**
     * 注册迁移文件
     */
    public function registerMigration()
    {
        // 如果是命令执行的才进入
        if($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__.'/../Databases/migrations');
        }
    }

    /**
     * Get the Telescope route group configuration array.
     *
     * @return array
     */
    private function routeConfiguration()
    {
        return [
            // 命名空间指向到控制器
            'namespace' => 'Packs\LaravelShops\Http',
            // 前缀
            'prefix' => 'pack',
            // 中间件
            'middleware' => 'web',
        ];
    }

    /**
     * 发布文件
     */
    public function registerPublishing()
    {
        // 如果是命令行执行的
        if ($this->app->runningInConsole()) {
            // [当前组件配置文件的路径  =》 赋值到的路径]
            $this->publishes([ __DIR__.'/../Resources/assets' => public_path('vendor/pack/laravel-shop')], 'laravel.shop');
        }
    }

}