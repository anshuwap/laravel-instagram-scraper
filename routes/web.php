<?php

use App\Http\Controllers\Admin\Home;
use App\Http\Controllers\Admin\Robots;
use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\Register;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;

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

Route::prefix('auth')->group(function (){

    Route::get('register' , [Register::class , 'showPage'])->name('register.showPage');

    Route::post('register' , [Register::class , 'store'])->name('register.store');

    Route::get('login' , [Login::class , 'showPage'])->name('login.showPage');

    Route::post('login' , [Login::class , 'loginUser'])->name('login.loginUser');

});


Route::prefix('admin')->group(function () {

    Route::get('dashboard' , [Home::class , 'index'])->name('admin.home');

    Route::prefix('robots')->group(function () {

        Route::get('list' , [Robots::class , 'showAll'])->name('robots.list');

        Route::get('add' , [Robots::class , 'add'])->name('robots.add');

        Route::post('store' , [Robots::class , 'store'])->name('robots.storeNew');

        Route::get('{robot_id}/edit' , [Robots::class , 'edit'])->name('robots.edit');

        Route::put('{robot_id}/update' , [Robots::class , 'update'])->name('robots.update');

        Route::delete('{robot_id}/delete' , [Robots::class , 'delete'])->name('robots.delete');
    });

});

Route::prefix('posts')->group(function () {

    Route::get('' , [PostsController::class , 'showAll'])->name('posts.showAll');

    Route::get('scrap' , [PostsController::class , 'add'])->name('posts.scrap.showPage');

    Route::post('start' , [PostsController::class , 'startScrap'])->name('start.scrap');

});

