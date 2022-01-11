<?php

use App\Http\Controllers\Admin\Home;
use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\Register;
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

});