<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request){
        $request->validate([
            "name"         => "required|email",

            "email"         => "required|email",
            "password"      => "required",
        ]);

        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,

            "password" => Hash::make($request->password)
        ]);

        return response()->json($user);
    }
}
