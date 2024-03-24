<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //

        public function register(RegisterRequest $request)
        {
        try {
            $userRequest = $request->only("name", "email", "password");
            $userRequest["password"] = Hash::make($userRequest["password"]);

            $user = User::create($userRequest);
            $token = $user->createToken("auth_token")->plainTextToken;

            return response()->json([
                "message" => "User created successfully",
                "user" => $user,
                "token" => $token
            ]);
        } catch (\Exception $e) {
            return response()->json(["message" => "User registration failed", "error" => $e->getMessage()], 500);
        }
    }


    public function login(LoginRequest $request)
    {
        try{
            $userrequest = $request->only("email", "password");
            $user = User::where("email", $userrequest["email"])->first();

            if(!$user || !  Hash::check($userrequest["password"], $user->password)){
                return response()->json(["message" => "unauthorized"]);
            }

            $token = $user->createToken("auth_token")->plainTextToken;

            return response()->json([
                "message" => "Logged in successfully",
                "token" => $token
            ]);
        }catch (\Exception $e) {
            return response()->json(["message" => "User registration failed", "error" => $e->getMessage()], 500);
        }
    }




}
