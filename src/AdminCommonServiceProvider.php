<?php

namespace Touge\AdminCommon;

use Illuminate\Support\ServiceProvider;

class AdminCommonServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(AdminCommon $extension)
    {
        if (! AdminCommon::boot()) {
            return ;
        }

        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, 'admin-common');
        }

        if ($this->app->runningInConsole() && $assets = $extension->assets()) {
            $this->publishes(
                [$assets => public_path('vendor/touge/admin-common')],
                'admin-common'
            );
        }

        $this->app->booted(function () {
            AdminCommon::routes(__DIR__.'/../routes/web.php');
        });
    }
}