<?php
/**
 * Created by PhpStorm.
 * User: nick
 * Date: 2019-12-18
 * Time: 16:39
 */

namespace Touge\AdminCommon\Providers;


use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Touge\AdminCommon\Supports\AdminCommonExamination;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        if (! AdminCommonExamination::boot()) {
            return ;
        }
        $this->app->booted(function () {
            $this->loadConfigsFrom(__DIR__.'/../../config');
            $this->loadAdminAuthConfig();
            $this->loadTranslationsFrom(__DIR__.'/../../resource/lang', 'touge-common');
            AdminCommonExamination::routes(__DIR__ . '/../../routes/web.php');
            static::api_routes(__DIR__ . '/../../routes/api.php');
        });
    }

    /**
     * Register any additional config.
     *
     * @param string $path
     *
     * @return void
     */
    protected function loadConfigsFrom($path)
    {
        foreach (glob($path.'/*.php') as $file) {
            $fileName = str_replace($path.'/', '', $file);
            $key = substr($fileName, 0, -4);
            $this->app['config']->set($key, array_merge_recursive(config($key, []), require $file));
        }
    }

    /**
     * Set routes for this extension.
     *
     * @param $callback
     */
    public static function api_routes($callback)
    {
        $attributes = array_merge(
            [
                'prefix'=> 'api',
                'namespace'     => '\Touge\AdminCommon\Controllers\Api',
                'as'=> 'api.',
                'middleware'=> ['api'],
            ],
            AdminCommonExamination::config('route', [])
        );
        Route::group($attributes, $callback);
    }

    /**
     * Setup auth configuration.
     *
     * @return void
     */
    protected function loadAdminAuthConfig()
    {
        config(Arr::dot(config('laravel-admin-common.auth', []), 'auth.'));
    }

}