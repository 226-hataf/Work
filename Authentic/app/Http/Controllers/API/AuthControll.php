<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Users;

class AuthControll extends Controller
{
    public function register(Request $request)
    {
        $user= User::create([

            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),

        ]);

        $token=$user->createToken('Token')->accessToken;
        return response()->json(['token' =>$token ,'user'=>$user],200);
    }

    public function login(Request $request)
        {
            $data=[
                'email' => $request->email,
                'password' => $request->password,
            ];

            if(auth()->attempt($data))
            {
                $token=auth()->user()->createToken('Token')->accessToken;
                return response()->json(['token' =>$token],200);
}
}
}
