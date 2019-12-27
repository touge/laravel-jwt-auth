<?php

namespace Touge\JwtAuth\Supports;

use Encore\Admin\Extension;

class AdminCommonExamination extends Extension
{
    public $name = 'laravel-admin-common';

    public $views = __DIR__ . '/../../resources/views';

    public $assets = __DIR__ . '/../../resources/assets';

    public $menu = [
        'title' => 'JwtAuth',
        'path'  => 'laravel-admin-common',
        'icon'  => 'fa-gears',
    ];
}