<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function responseInvalidEmailOrPassword(){
        return response()->json(["success" => false, "errors" => "invalid email or password"], 400);
    }
    public function register(Request $request)
    {
        $validation = Validator::make($request->all(), [
            "name" => "required|string",
            "password" => "required|string|min:8",
            "email" => "required|string|email|unique:users"
        ]);
        if ($validation->fails()) {
            return response()->json(["success" => false, "errors" => $validation->errors()->getMessages()]);
        }
        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);
        try {
            $result = [
                "success" => true,
                "data" => [
                    "token" => $user->createToken("UserToken", ["api"])->accessToken,
                    "name" => $user->name,
                    "email" => $user->email
                ]
            ];
            return response()->json($result, 201);
        } catch (\Throwable $th) {
            $user->forceDelete();
            dd($th);
        }
    }
    public function login(Request $request)
    {
        $validation = Validator::make($request->all(), [
            "email" => "required|string|email",
            "password" => "required|string|min:8",
        ]);
        if ($validation->fails()) {
            return response()->json(["success" => false, "errors" => $validation->errors()->getMessages()]);
        }
        $user = User::where("email", $request->email)->first();
        if (!$user) {
            return $this->responseInvalidEmailOrPassword();
        }else if (!Hash::check($request->password, $user->password)) {
            return $this->responseInvalidEmailOrPassword();
        }
        $result = [
            "success" => true,
            "data" => [
                "token" => $user->createToken("UserToken", ["api"])->accessToken,
                "name" => $user->name,
                "email" => $user->email,
                "user" => $user,
            ]
        ];
        return response()->json($result, 200);
    }
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(["success" => true, "data" => null], 200);
    }
}
