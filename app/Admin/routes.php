<?php

use Illuminate\Routing\Router;
use App\Admin\Controllers\UserController;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');

    $router->resource('plans', TravelPlansController::class);
    $router->resource('users', UserController::class);
    $router->resource('drivers', DriverController::class);
    $router->resource('user-roles', UserRolesController::class);

    $router->post('/users/approval', [UserController::class, 'approval']);

});
