<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Respose;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $fields = $request->validate([
            'email'=>'required|string',
            'password'=>'required|string'
        ]);


        $user = User::where('email',$fields['email'])->first();


        // echo $user->password;

        if(!$user || !Hash::check($fields['password'],$user->password)){
            return response([
                'message'=>'Invalid Credentials'
            ],401);
        }

        $token = $user->createToken('my_token')->plainTextToken;

        $response = [
            'user'=>$user,
            'token'=>$token,
        ];

        return response($response,201);
    }


    public function register(Request $request)
    {
        $fields = $request->validate([
            'name'=>'required|string',
            'email'=>'required|string|unique:users,email',
            'password'=>'required|string'
        ]);


        $user = User::create([
            'name'=>$fields['name'],
            'email'=>$fields['email'],
            'password'=>Hash::make($fields['password']),
        ]);


        $token = $user->createToken('my_token')->plainTextToken;

        $response = [
            'user'=>$user,
            'token'=>$token,
        ];

        return response($response,201);
    }

    public function logout(Request $request){
        auth()->user()->tokens()->delete();

        return [
            'message'=>'Logged out'
        ];

    }
}
