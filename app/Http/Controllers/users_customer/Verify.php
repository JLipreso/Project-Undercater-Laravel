<?php

namespace App\Http\Controllers\users_customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * users_customer/verify?token=ZB1MR-lJFQP9C8VcAv_Xwu|x6koaY7N4
 */

class Verify extends Controller
{
    public static function verify(Request $request) {
        
        $source = DB::table("users_customer")
        ->where("token", $request['token'])
        ->update([
            "email_verified" => 1
        ]);

        if($source) {
            return [
                "success"   => true,
                "message"   => "Verified successfully"
            ];
        }
        else {
            return [
                "success"   => false,
                "message"   => "Invalid or expired verification token"
            ];
        }
    }
}
