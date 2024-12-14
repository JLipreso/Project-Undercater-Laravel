<?php

namespace App\Http\Controllers\users_system;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * 
 * 
 */

class Login extends Controller
{
    public static function login(Request $request) {
        if(empty($request['email'])) {
            return [
                "success"   => false,
                "message"   => "Email is required",
            ];
        }
        else if(empty($request['password'])) {
            return [
                "success"   => false,
                "message"   => "Password is required",
            ];
        }
        else {
            $source = DB::table("users_system")->where([
                ['email', $request['email']],
                ['password', $request['password']]
            ])
            ->get();

            if(count($source) > 0) {
                return [
                    "success"   => true,
                    "message"   => "Successfully authenticated",
                    "profile"   => $source[0]
                ];
            }
            else {
                return [
                    "success"   => false,
                    "message"   => "Invalid email, password or unverified account.",
                    "profile"   => []
                ];
            }
        }
    }
}
