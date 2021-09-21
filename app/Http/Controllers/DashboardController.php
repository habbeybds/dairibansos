<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\DinsosController;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;


class DashboardController extends Controller

{
    protected $ChildController;
    public function __construct(DinsosController $DinsosController)
    {
        $this->DinsosController = $DinsosController;
    }

    public function index()
    {
        return view('dashboard');
    }

    public function pageDinsosPenerima()
    {
        return view('managecp.dinsos.penerima');
    }
    public function pageDinsosAgen()
    {
        return view('managecp.dinsos.agen');
    }
    public function pageDinsosDesa()
    {
        return view('managecp.dinsos.desa');
    }

    public function pageAgenPenyaluran()
    {
        return view('managecp.agen.penyaluran');
    }
    public function pageAgenBarang()
    {
        return view('managecp.agen.barang');
    }
}
