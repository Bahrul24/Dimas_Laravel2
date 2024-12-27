<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Apiresource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class authController extends Controller
{
    public function login(Request $request)
{
    $request->validate([
        "email" => "required|email",
        "password" => "required",
    ]);

    $user = User::where("email", $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return new Apiresource(401, "Login Gagal", false);
    }

    $token = $user->createToken('auth-token', $user->getAllPermissions()->pluck('name')->toArray())->plainTextToken;

    return new Apiresource(['token' => $token], "Login berhasil", true);
}

    public function logout(Request $request)
    {

        $request->user()->tokens()->delete();
        return new Apiresource(
            null, "Log Out Berhasil", true
        );
    }
}
    



