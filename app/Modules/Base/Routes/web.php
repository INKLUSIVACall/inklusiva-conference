<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your module. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use Illuminate\Support\Facades\Route;
use App\Modules\Base\Http\Controllers\HomeController;
use App\Modules\Useradmin\Http\Controllers\UserController;
use App\Providers\RouteServiceProvider;

Route::group(
    [
        'middleware' => ['auth', 'activated'],
        'prefix' => 'admin/home',
        'as' => 'base.'
    ],
    function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');
    }
);

Route::get(RouteServiceProvider::NOT_VERIFIED, [UserController::class, 'notVerified'])->name('notVerified');
