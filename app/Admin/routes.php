<?php

use Illuminate\Routing\Router;
use App\Admin\Controllers\AuthController;
use App\Admin\Controllers\UserController;
use App\Admin\Controllers\DriverController;
use App\Admin\Controllers\UserRolesController;
use App\Admin\Controllers\TravelPlansController;

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
    $router->post('/drivers/approval', [DriverController::class, 'approval']);
});



Route::group([ 'prefix' => 'driver','as' => 'driver.','middleware' => 'web'], function(Router $router){
    $router->get('/login', [AuthController::class, 'getDriverLogin']);
    $router->post('/loginDriver', [AuthController::class, 'postDriverLogin']);
    $router->get('/register', [AuthController::class, 'getDriverRegister']);
    $router->post('/registerDriver', [AuthController::class, 'postDriverRegister']);
});
