<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    public function welcome()
    {  

        $initial = 'welcome';

        return view('welcome', compact('initial')); 
    } 


    public function login()
    {
        $initial = 'login';
        
        return view('login', compact('initial')); 
    }

    public function getLoginData()
    {

        $_POST['action'] = empty($_POST['action'])?'':$_POST['action'];

        if($_POST['action'] == 'setDataLogin'){
	
            $data_login = $_POST['data'];
            Session::put('MyToken', $data_login['token']);
            Session::put('id', $data_login['id']);
            Session::put('usergroupid', $data_login['usergroupid']);
            Session::put('progress', 'asdsad5%');
            $ReturnData = array('data_login' => $data_login);
            echo json_encode($ReturnData);
            exit;
            
        
        }
    }
}
