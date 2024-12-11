<?php

namespace App\Http\Controllers\users_customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Login extends Controller
{
    public static function login(Request $request) {
        $source = DB::table("users_customer")->where([
            ['email', $request['email']],
            ['password', $request['password']],
            ['email_verified', '1']
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
