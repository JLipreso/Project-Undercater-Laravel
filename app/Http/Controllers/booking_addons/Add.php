<?php

namespace App\Http\Controllers\booking_addons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * booking_addons/add?booking_dataid=1&addon_dataid=12&price=45
 */

class Add extends Controller
{
    public static function add(Request $request) {
        
        $source = DB::table("booking_addons")->insert([
            "booking_dataid"    => $request['booking_dataid'],
            "addon_dataid"      => $request['addon_dataid'],
            "price"             => $request['price']
        ]);

        if($source) {
            return [
                "success"   => true,
                "message"   => "Successfully added to your cart"
            ];
        }
        else {
            return [
                "success"   => false,
                "message"   => "Fail to add, try again later."
            ];
        }
    }
}
