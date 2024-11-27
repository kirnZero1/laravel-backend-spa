<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request){
        $fields = $request->validate([
            "username" => "required|string",
            "email" => "required|string|unique:users,email",
            "password" => "required|string|confirmed"
        ]);

        $user = User::create([
            "username" => $fields['username'],
            "email" => $fields['email'],
            "password" => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('mypassword124')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return Response($response);
    }

    public function destroy(){
        auth()->user()->tokens()->delete();
        return Response([
            "message" => "Successfully logout user"
        ]);
    }

    public function login(Request $request){
        $fields = $request->validate([
            "email" => "required|string",
            "password" => "required|string"
        ]);

        $user = User::where('email', $fields['email'])->first();

        if(!$user || !Hash::check($fields['password'], $user->password)){
            return [
                "Message" => "Bad Credentials"
            ];
        }

        $token = $user->createToken('mypassword124')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,
            'message' => "Successfully login user."
        ];

        return Response($response);
    }
}
