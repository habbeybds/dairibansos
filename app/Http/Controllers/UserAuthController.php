<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Usergroup;
use App\Http\Controllers\API\BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserAuthController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function userLogin(Request $req, $message = '', $style ='')
    {
        //$data = $req->input();
        $validator = Validator::make($req->all(), [
            'username' => ['required','string'],
            'password' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            $message = "These credentials do not match our records.";
            $initial = 'login';
            $style = 'show';
        
            return view('login', compact('initial', 'message', 'style')); 
        }

     

        if (Auth::attempt(['username' => $req->username, 'password' => $req->password]))
        {
            $authenticated_user = Auth::user();   
            $user = User::find($authenticated_user->id);
            $usergroup = Usergroup::find($authenticated_user->usergroupid);
         
            $response = [
                'id' => $user->id,
                'token' => $user->createToken('MyToken')->accessToken,
                'username' => $user->username,
                'full_name' => $user->first_name.' '.$user->last_name,
                'usergroupid' => $user->usergroupid,
                'level_user' => $usergroup->level,
            ];

            session()->put('id', $response['id']);
            session()->put('token', $response['token']);
            session()->put('username', $response['username']);
            session()->put('full_name', $response['full_name']);
            session()->put('usergroupid', $response['usergroupid']);
            session()->put('level_user', $response['level_user']);
            
            return redirect('dashboard'); 

        }else{
            $message = "These credentials do not match our records.";
            $initial = 'login';
            $style = 'show';
        
            return view('login', compact('initial', 'message', 'style')); 
        }
        
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
