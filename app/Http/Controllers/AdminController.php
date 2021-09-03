<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    function responseInvalidEmailOrPassword()
    {
        return response()->json(["success" => false, "errors" => "invalid email or password"], 400);
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
        $admin = Admin::where("email", $request->email)->first();
        if (!$admin) {
            return $this->responseInvalidEmailOrPassword();
        } else if (!Hash::check($request->password, $admin->password)) {
            return $this->responseInvalidEmailOrPassword();
        }
        $result = [
            "success" => true,
            "data" => [
                "token" => $admin->createToken("adminToken", ["admin"])->accessToken,
                "name" => $admin->name,
                "email" => $admin->email,
                "admin" => $admin,
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
