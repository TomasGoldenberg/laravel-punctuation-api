<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserTokenController extends Controller
{
    public function __invoke(Request $request){//invoke se usa cunado es la unica accion que realizara el controller
        $request->validate([
            "email"         => "required|email",
            "password"      => "required",
            "device_name"   => "required"
        ]);

        /** @var User $user  */
        $user = User::where("email",$request->get("email"))->first();
    
        if(!$user && !Hash::check($request->password, $user->password)){
            throw ValidationExeption::withMessages([
                "email" => "El email no existe o no coincide con nuestros datos"
            ]);
        };

        return response()->json([
            "token" => $user->createToken($request->device_name)->plainTextToken
        ]);
    }
}
