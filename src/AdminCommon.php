<?php

namespace Touge\AdminCommon;

use Encore\Admin\Extension;

class AdminCommon extends Extension
{
    public $name = 'admin-common';

    public $views = __DIR__.'/../resources/views';

    public $assets = __DIR__.'/../resources/assets';

    public $menu = [
        'title' => 'Admincommon',
        'path'  => 'admin-common',
        'icon'  => 'fa-gears',
    ];
}