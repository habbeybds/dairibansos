<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\UsergroupController;
use App\Http\Controllers\API\DinsosController;
use App\Http\Controllers\API\AgenController;

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
Route::get("user_groups", [UsergroupController::class, "getAllUserGroup"]);
Route::get("login", [UserController::class, "login"]);


Route::post("add_agen", [UserController::class, "RegisterAgen"]);
// Route::get("desa", function(){
//     return [
//         "message" => "silahisabungan",
//     ];
// });
Route::middleware('auth:api')->group(function () {
    Route::get('/profile', [UserController::class, "profile"]);

    /* Nomro SK */
    Route::get('/nomorsk', [DinsosController::class, "getTahapanBySKdanJabatan"]);
    
    /* Jenis Bantuan */
    Route::get('/jenisbantuan', [DinsosController::class, "getListJenisBantuan"]);
    Route::post('tambahjenisbantuan', [DinsosController::class, "addJenisBantuan"]);
    Route::get('/jenisbantuan/edit/{id}', [DinsosController::class, "getListJenisBantuanById"]);
    Route::post('/ubahjenisbantuan/{id}', [DinsosController::class, "updateJenisBantuan"]);
    Route::post('/hapusjenisbantuan/{id}', [DinsosController::class, "deleteJenisBantuan"]);

    /* Desa */
    Route::get('/desa', [DinsosController::class, "getListDesa"]);
    Route::get('/kecamatan', [DinsosController::class, "getListKecamatan"]);
    Route::post('tambahdesa', [DinsosController::class, "addDesa"]);
    Route::get('/desa/edit/{id}', [DinsosController::class, "getListDesaById"]);
    Route::post('/ubahdesa/{id}', [DinsosController::class, "updateDesa"]);
    Route::post('/hapusdesa/{id}', [DinsosController::class, "deleteDesa"]);
    
    /* Agen */
    Route::get('/agen', [DinsosController::class, "getListAgen"]);
    Route::post('tambahagen', [DinsosController::class, "addAgen"]);
    Route::get('/agen/edit/{id}', [DinsosController::class, "getListAgenById"]);
    Route::post('/ubahagen/{id}', [DinsosController::class, "updateAgen"]);
    Route::post('/hapusagen/{id}', [DinsosController::class, "deleteAgen"]);
    
    /* Penerima Bantuan */
    Route::get('/penerima', [DinsosController::class, "getListPenerima"]);
    Route::post('getdesa', [DinsosController::class, "getDesaByKecamatan"]);
    Route::post("getdataimportpenerima", [DinsosController::class, "importDataPenerima"]);
    
    /* Setujui Barang */
    Route::get('/setujuibarang', [DinsosController::class, "getListSetujuiBarang"]);
    Route::get('/telahdisetujuibarang', [DinsosController::class, "getListDiSetujuiBarang"]);
    Route::post('approveBarang', [DinsosController::class, "approveBarang"]);
    Route::post('cancelBarang', [DinsosController::class, "cancelBarang"]);
    
    /* Panel Agen */
    /* Barang */
    Route::get('/barang/{id}', [AgenController::class, "getListBarang"]);
    Route::post('tambahbarang', [AgenController::class, "addBarang"]);
    Route::get('/barang/edit/{id}', [AgenController::class, "getListBarangById"]);
    Route::post('updatebarang', [AgenController::class, "updateBarang"]);
    Route::post('/hapusbarang/{id}', [AgenController::class, "deleteBarang"]);

    Route::post('add_penyaluran', [AgenController::class, "addPenyaluran"]);
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
    //     return $request->user();
// });
