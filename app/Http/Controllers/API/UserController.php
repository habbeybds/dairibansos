<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Usergroup;
use App\Http\Controllers\API\BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends BaseController
{
    public function profile(Request $request)
    {
        // $data = User::all();
        return $this->responseOK($request->user());
    }

    public function getUsergroup()
    {
        $data = Usergroup::all();
        return $this->responseOK($data);
    }

    public function Login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return $this->responseError('Admin Login failed', 422, $validator->errors());
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'usergroupid' => '1']))
        {
            $authenticated_user = Auth::user();
            $user = User::find($authenticated_user->id);
            $usergroup = Usergroup::find($authenticated_user->usergroupid);
         
            $response = [
                'token' => $user->createToken('MyToken')->accessToken,
                'full_name' => $user->first_name.' '.$user->last_name,
                'usergroupid' => $user->usergroupid,
                'level_user' => $usergroup->level,
            ];
            return $this->responseOK($response, 200);

        }else if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'usergroupid' => '2'])){
            print_r("login sebagai Agen");
        }else{
            return $this->responseError('Wrong Email or Password please try again', 401);
        }
    }

    public function RegisterAgen(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'string', 'min:10', 'max:13'],
            'email' => ['required', 'string', 'email', 'max:255','unique:users'],
            'password' => ['required', 'string','min:8','confirmed'],
        ]);

        if ($validator->fails()) {
            return $this->responseError('Registration failed', 422, $validator->errors());
        }

        $params = [
            'usergroupid' => '2',
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        if($user = User::create($params)) {
            $token = $user->createToken('MyToken')->accessToken;

            $response = [
                'token' => $token,
                'user' => $user
            ];

           return $this->responseOK($response, 200);


        }else{
            return $this->responseError('Registration Falied', 400);
        }
    }
}
