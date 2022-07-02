<?php

use App\Admin\Controllers\DictionaryController;
use App\Admin\Controllers\GroupController;
use App\Admin\Controllers\SchoolController;
use App\Admin\Controllers\TeacherController;
use App\Admin\Controllers\UserController;
use App\Admin\Controllers\WordController;
use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('/app/users', UserController::class);
    $router->resource('/app/dictionaries', DictionaryController::class);
    $router->resource('/app/groups', GroupController::class);
    $router->resource('/app/schools', SchoolController::class);
    $router->resource('/app/teachers', TeacherController::class);
    $router->resource('/app/words', WordController::class);

});
