<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\UsergroupController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Route::get("users",[UserController::class, "getUser"]);
Route::get("user_groups",[UsergroupController::class, "getAllUserGroup"]);
Route::get("login",[UserController::class, "login"]);


Route::post("add_agen",[UserController::class, "RegisterAgen"]);
// Route::get("desa", function(){
//     return [
//         "message" => "silahisabungan",
//     ];
// });
Route::middleware('auth:api')->group(function () {
    Route::get('/profile',[UserController::class, "profile"]);
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
