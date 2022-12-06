<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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
Route::get('manage/user/logout',[AdminController::class,'getLogout'])->name('get.logout');

Route::middleware(['CheckLogin'])->group(function () {
    Route::get('manage/user/login',[AdminController::class,'getLogin'])->name('get.login');
    Route::post('manage/user/login',[AdminController::class,'submitLogin'])->name('submit.login');
});

Route::middleware(['CheckAdmin'])->group(function () {
    Route::get('manage/dashboard',[AdminController::class,'Dashboard'])->name('dashboard');
});

Route::get('manage/user/register',[AdminController::class,'getRegister'])->name('get.register');
Route::post('manage/user/register',[AdminController::class,'submitRegister'])->name('submit.register');

