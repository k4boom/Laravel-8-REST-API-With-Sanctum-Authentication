<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use App\Models\User;
class AuthController extends Controller
{
    public function register(Request $request){
        $fields =   $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'

        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response,201);
    }


    public function login(Request $request){
        $fields =   $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'

        ]);

        //Check Email

        $user = User::whereEmail($fields['email'])->first();

        //Check Password

        //False Login
        if(!$user || !(Hash::check($fields['password'], $user->password))){
                return response([
                    'message' => 'Bad Credentials'
                ],401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response,201);
    }



    public function logout(Request $request){
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }
}
