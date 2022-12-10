<?php

use Illuminate\Support\Facades\Route;
use App\Admin\Controllers\AuthController;
use Illuminate\Routing\Router;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group([ 'prefix' => 'driver','as' => 'driver.'], function(Router $router){
    $router->get('/login', [AuthController::class, 'getDriverLogin']);
    $router->get('/register', [AuthController::class, 'getDriverRegister']);
    $router->post('/registerDriver', [AuthController::class], 'postDriverRegister');
});

