<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\IndexController;

class DashboardController extends IndexController
{
    public function index()
    {
        return view('dashboard'); 
    }
}
