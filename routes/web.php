<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
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
Route::get("/",[IndexController::class, "welcome"])->name('welcome');
Route::get("/login",[IndexController::class, "login"])->name('login');

Route::group(['middleware' => 'web'], function () {
    Route::post("/data_login",[IndexController::class, "getLoginData"])->name('data_login');
    Route::get("/dashboard",[DashboardController::class, "index"])->name('dashboard');
});

// Route::get('/', function () {
//     return view('welcome');
// });
