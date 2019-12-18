<?php

use Touge\AdminCommon\Http\Controllers\AdminCommonController;

Route::get('admin-common', AdminCommonController::class.'@index');