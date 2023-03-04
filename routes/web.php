<?php

use Inertia\Inertia;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\TravelPlansController;
use App\Http\Controllers\DashboardController;

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

Route::get('/', [HomepageController::class, 'show'])->name('home');


Route::group([ 'prefix' => 'driver'], function(Router $router){
    $router->get('/list', [DriverController::class, 'list'])->name('driver.list');
    $router->get('/details', [DriverController::class, 'details'])->name('driver.details');
});

Route::group([ 'prefix' => 'travel-plan'], function(Router $router){
    $router->get('/list', [TravelPlansController::class, 'list'])->name('travelPlans.list');
    $router->get('/details', [TravelPlansController::class, 'details'])->name('travelPlans.details');
    $router->post('/join', [TravelPlansController::class, 'join'])->name('travelPlans.join');
    $router->post('/rate', [TravelPlansController::class, 'rate'])->name('travelPlans.rate');
});


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
