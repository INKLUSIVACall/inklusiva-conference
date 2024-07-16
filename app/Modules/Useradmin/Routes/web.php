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

use App\Modules\Useradmin\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Modules\Useradmin\Http\Controllers\UserController;

Route::group(
    [
        'middleware' => ['auth', 'activated', 'permission:edit users'],
        'prefix' => 'admin/user',
        'as' => 'useradmin.user.'
    ],
    function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/confirmdestroy', [UserController::class, 'confirmdestroy'])->name('confirmdestroy');
        Route::post('/destroy/{id}', [UserController::class, 'destroy'])->name('destroy');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [UserController::class, 'update'])->name('update');
        Route::get('/confirmactivate/{user}', [UserController::class, 'confirmActivation'])->name('confirmactivate');
        Route::post('/activate/{user}', [UserController::class, 'activate'])->name('activate');
    }
);

Route::group(
    [
        'middleware' => ['auth', 'activated'],
        'prefix' => 'profile',
        'as' => 'useradmin.profile.'
    ],
    function () {
        Route::get('/maindata', [ProfileController::class, 'index'])->name('index');
        Route::get('/accessdata', [ProfileController::class, 'accessDataIndex'])->name('accessDataIndex');
        Route::get('/maindata/editdata', [ProfileController::class, 'editData'])->name('editData');
        Route::post('/maindata/editdata', [ProfileController::class, 'updateData'])->name('updateData');
        Route::get('/accessdata/editemail', [ProfileController::class, 'editEmail'])->name('editEmail');
        Route::post('/accessdata/editmail', [ProfileController::class, 'updateEmail'])->name('updateEmail');
        Route::get('/accessdata/confirmemail', [ProfileController::class, 'confirmEmail'])->name('confirmEmail');
        Route::post('/accessdata/confirmemail', [ProfileController::class, 'switchEmail'])->name('switchEmail');
        Route::get('/accessdata/sendPinAgain', [ProfileController::class, 'sendPinAgain'])->name('sendPinAgain');
        Route::get('/accessdata/editpassword', [ProfileController::class, 'editPassword'])->name('editPassword');
        Route::post('/accessdata/editpassword', [ProfileController::class, 'updatePassword'])->name('updatePassword');
    }
);
