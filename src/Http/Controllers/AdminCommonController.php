<?php

namespace Touge\AdminCommon\Http\Controllers;

use Encore\Admin\Layout\Content;
use Illuminate\Routing\Controller;

class AdminCommonController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->header('Title')
            ->description('Description')
            ->body(view('admin-common::index'));
    }
}