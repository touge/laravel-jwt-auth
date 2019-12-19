<?php
/**
 * Created by PhpStorm.
 * User: nick
 * Date: 2019-12-18
 * Time: 16:39
 */

namespace Touge\AdminCommon\Providers;


class ModuleServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadConfigsFrom(__DIR__.'/../config');

        $this->registerGuard();
    }

    /**
     * 注册当前模块所需要的guard守卫
     */
    protected function registerGuard(){
//        $module_guard= config('resources.guard_name');
//        config(['auth.defaults.guard'=> $module_guard]);
    }


    /**
     * Register the module services.
     *
     * @return void
     */
    public function register()
    {
//        $this->app->register(MiddlewareServiceProvider::class);
//        $this->app->register(EventServiceProvider::class);
        $this->app->register(RouteServiceProvider::class);
    }
}