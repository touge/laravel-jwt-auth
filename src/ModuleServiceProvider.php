<?php
/**
 * Created by PhpStorm.
 * User: nick
 * Date: 2019-12-18
 * Time: 16:39
 */

namespace Touge\JwtAuth;


use function Composer\Autoload\includeFile;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class ModuleServiceProvider extends ServiceProvider
{
    protected $namespace = 'Touge\JwtAuth\Controllers';

    protected $config_file= 'laravel-jwt-auth.php';


    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        if( !file_exists(config_path($this->config_file))){
            $this->loadConfig();
        }
        $this->loadTranslationsFrom(__DIR__.'/../resource/lang', 'JwtAuth');
        $this->mapApiRoutes();

        /**
         * 发布配置及语言包
         */
        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__.'/../config' => config_path()], 'touge-laravel-jwt-auth-config');
            $this->publishes([__DIR__.'/../resource/lang' => resource_path('lang')], 'touge-laravel-jwt-auth-lang');
        }
    }

    /**
     * Define the "api" routes for the module.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::group([
            'middleware' => 'api',
            'namespace'  => $this->namespace,
            'prefix'     => 'api',
            'as'=> 'jwt.'
        ], function () {
            require __DIR__ . '/../routes/api.php';
        });
    }


    /**
     * load config file
     * @param $file
     */
    protected function loadConfig(){
        $key = substr($this->config_file, 0, -4);
        $full_path= __DIR__ . '/../config/' . $this->config_file;
        $this->app['config']->set($key, array_merge_recursive(config($key, []), require $full_path));
        config(Arr::dot(config('laravel-jwt-auth.auth', []), 'auth.'));
    }
}