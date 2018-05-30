<?php

/*
|--------------------------------------------------------------------------
| Backpack\UserManager Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are
| handled by the Backpack\UserManager package.
|
*/

Route::group([
            'namespace'  => 'Backpack\UserManager\app\Http\Controllers',
            'prefix'     => config('backpack.base.route_prefix', 'admin'),
            'middleware' => ['web', backpack_middleware()],
    ], function () {
        CRUD::resource('user', 'UserCrudController');
    });
