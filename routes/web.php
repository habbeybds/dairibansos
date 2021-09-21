<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\DashboardController;

/* Admin Dinsos Controller */
use App\Http\Controllers\JenisBantuanController;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\AgenController;
use App\Http\Controllers\PenerimaController;
use App\Http\Controllers\SetujuiBarangController;

/* Agen Controller */
use App\Http\Controllers\agen\BarangController;
use App\Http\Controllers\agen\PenyaluranController;

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

Route::get("/", function ($message = '', $initial = 'welcome', $style = '') {
    if (session()->has('id')) {
        return redirect('dashboard');
    }
    return view('welcome', compact('initial', 'message', 'style'));
})->name('welcome');


Route::post("login", [UserAuthController::class, "userLogin"])->name('userlogin');

Route::get("/login", function ($message = '', $initial = 'login', $style = '') {
    if (session()->has('id')) {
        return redirect('dashboard');
    }
    return view('login', compact('initial', 'message', 'style'));
})->name('login');

Route::get("/logout", function () {
    if (session()->has('id')) {
        Auth::logout();
        Session::flush();
    }
    return redirect('login');
})->name('logout');



// Route::group(['middleware' => ['auth', 'cekLevel:1']], function () {
//     Route::get("/dashboard", function ($initial = 'dashboard') {
//         if (session()->has('id')) {
//             return view('dashboard', compact('initial'));
//         }
//         return redirect('login');
//     })->name('dashboard');
// });

// Route::group(['middleware' => ['auth', 'cekLevel:2']], function () {
//     Route::get("/dashboard", function ($initial = 'dashboard') {
//         if (session()->has('id')) {
//             return view('dashboard', compact('initial'));
//         }
//         return redirect('login');
//     })->name('dashboard');
//     Route::get("/baranglist", [DashboardController::class, "pageAgenBarang"])->name('baranglist');
//     Route::get("/panyaluran", [DashboardController::class, "pageAgenPenyaluran"])->name('panyaluran');
// });

Route::group(['middleware' => ['auth']], function () {
    Route::get("/dashboard", function ($initial = 'dashboard') {
        if (session()->has('id')) {
            return view('dashboard', compact('initial'));
        }
        return redirect('login');
    })->name('dashboard')->middleware(['cekLevel:1,2']);

    // MENU ADMIN
    //Route::get("/penerimalist", [DashboardController::class, "pageDinsosPenerima"])->name('penerimalist')->middleware(['cekLevel:1']);
    //Route::get("/agenlist", [DashboardController::class, "pageDinsosAgen"])->name('agenlist')->middleware(['cekLevel:1']);
    //Route::get("/desalist", [DashboardController::class, "pageDinsosDesa"])->name('desalist')->middleware(['cekLevel:1']);
    
    Route::group(['middleware' => ['auth']], function () {

        /* DINAS SOSIAL ADMIN */
        /* JENIS BANTUAN */
        Route::get("/jenisbantuanlist", [JenisBantuanController::class, "pageDinsosJenisBantuan"])->name('jenisbantuanlist')->middleware(['cekLevel:1']);
        Route::get("/jenisbantuan", [JenisBantuanController::class, "pageDinsosTambahJenisBantuan"])->name('jenisbantuan')->middleware(['cekLevel:1']);
        Route::post("addjenisbantuan", [JenisBantuanController::class, "TambahJenisBantuan"])->name('addjenisbantuan');
        Route::get("/jenisbantuan/edit/{id}", [JenisBantuanController::class, "pageDinsosEditJenisBantuan"])->name('editjenisbantuan')->middleware(['cekLevel:1']);
        Route::post("updatejenisbantuan/{id}", [JenisBantuanController::class, "UbahJenisBantuan"])->name('updatejenisbantuan');
        Route::post("jenisbantuan/{id}", [JenisBantuanController::class, "pageDinsosDeleteJenisBantuan"])->name('deletejenisbantuan');
        
        /* DESA */
        Route::get("/desalist", [DesaController::class, "pageDinsosDesa"])->name('desalist')->middleware(['cekLevel:1']);
        Route::get("/desa", [DesaController::class, "pageDinsosTambahDesa"])->name('tambahdesa')->middleware(['cekLevel:1']);
        Route::post("add_desa", [DesaController::class, "TambahDesa"])->name('add_desa');
        Route::get("/desa/edit/{id}", [DesaController::class, "pageDinsosEditDesa"])->name('editdesa')->middleware(['cekLevel:1']);
        Route::post("updatedesa/{id}", [DesaController::class, "UbahDesa"])->name('updatedesa');
        Route::post("desa/{id}", [DesaController::class, "pageDinsosDeleteDesa"])->name('deletedesa');
        
        /* AGEN */
        Route::get("/agenlist", [AgenController::class, "pageDinsosAgen"])->name('agenlist')->middleware(['cekLevel:1']);
        Route::get("/agen", [AgenController::class, "pageDinsosTambahAgen"])->name('tambahagen')->middleware(['cekLevel:1']);
        Route::post("add_agen", [AgenController::class, "TambahAgen"])->name('add_agen');
        Route::get("/agen/edit/{id}", [AgenController::class, "pageDinsosEditAgen"])->name('editagen')->middleware(['cekLevel:1']);
        Route::post("updateagen/{id}", [AgenController::class, "UbahAgen"])->name('updateagen');
        Route::post("agen/{id}", [AgenController::class, "pageDinsosDeleteAgen"])->name('deleteagen');
        
        /* PENERIMA */
        Route::get("/penerimalist", [PenerimaController::class, "pageDinsosPenerima"])->name('penerimalist')->middleware(['cekLevel:1']);
        Route::get("/penerima", [PenerimaController::class, "pageDinsosTambahPenerima"])->name('tambahpenerima')->middleware(['cekLevel:1']);
        Route::post("getdesa", [PenerimaController::class, "getDesa"])->name('getdesa');
        Route::post("add_penerima", [PenerimaController::class, "TambahPenerima"])->name('add_penerima');
        Route::post("/getdataimportpenerima", [PenerimaController::class, "getimportDataPenerima"])->name('getdataimportpenerima')->middleware(['cekLevel:1']);
        Route::post("submitimportpenerima", [PenerimaController::class, "submitDataPenerima"])->name('submitimportpenerima')->middleware(['cekLevel:1']);
        
        /* BERSETUJUAN BARANG */
        Route::get("/setujuibaranglist", [SetujuiBarangController::class, "pageDinsosSetujuiBarang"])->name('setujuibaranglist')->middleware(['cekLevel:1']);
        Route::post("approveBarang", [SetujuiBarangController::class, "pageDinsosApprovedBarang"])->name('approveBarang')->middleware(['cekLevel:1']);
        Route::post("cancelBarang", [SetujuiBarangController::class, "pageDinsosCancelledBarang"])->name('cancelBarang')->middleware(['cekLevel:1']);
        
        
        /* AGEN */
        /* BARANG */
        // MENU AGEN
        Route::get("/baranglist", [BarangController::class, "pageAgenBarang"])->name('baranglist')->middleware(['cekLevel:2']);
        Route::get("/barang", [BarangController::class, "pageDinsosTambahBarang"])->name('tambahbarang')->middleware(['cekLevel:2']);
        Route::post("add_barang", [BarangController::class, "TambahBarang"])->name('add_barang');
        Route::get("/barang/edit/{id}", [BarangController::class, "pageDinsosEditBarang"])->name('editbarang')->middleware(['cekLevel:2']);
        Route::post("updatebarang/{id}", [BarangController::class, "UbahBarang"])->name('updatebarang');
        Route::post("barang/{id}", [BarangController::class, "pageDinsosDeleteBarang"])->name('deletebarang');
        
        Route::get("/penyaluranlist", [PenyaluranController::class, "pageAgenPenyaluran"])->name('penyaluranlist')->middleware(['cekLevel:2']); 
        Route::get("/panyaluran", [PenyaluranController::class, "pageAgenTambahPenyaluran"])->name('tambahpanyaluran')->middleware(['cekLevel:2']); 
        Route::get("autocompletepenerima", [PenyaluranController::class, "autoCompletePenerima"])->name('autocompletepenerima')->middleware(['cekLevel:2']); 
        Route::post("add_penyaluran", [PenyaluranController::class, "TambahPenyaluran"])->name('add_penyaluran');
    });
    
});

//Route::view("login","login")->name('login');
// Route::get('/', function () {
//     return view('welcome');
// });
