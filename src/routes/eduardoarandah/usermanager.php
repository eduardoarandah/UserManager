<?php
Route::group([
            'namespace'  => 'EduardoArandaH\UserManager\app\Http\Controllers',
            'prefix'     => config('backpack.base.route_prefix', 'admin'),
            'middleware' => ['web', backpack_middleware()],
    ], function () {
        CRUD::resource('user', 'UserCrudController');
    });
