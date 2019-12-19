<?php
/**
 * Created by PhpStorm.
 * User: nick
 * Date: 2019-12-19
 * Time: 09:03
 */

namespace Touge\AdminCommon\Providers;


use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

class BaseServiceProvider extends IlluminateServiceProvider
{
    /**
     * Register any additional module middleware.
     *
     * @param array|string $middleware
     *
     * @return void
     */
    protected function addMiddleware($middleware)
    {
        $kernel = $this->app['Illuminate\Contracts\Http\Kernel'];

        if (is_array($middleware)) {
            foreach ($middleware as $ware) {
                $kernel->pushMiddleware($ware);
            }
        } else {
            $kernel->pushMiddleware($middleware);
        }
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


}