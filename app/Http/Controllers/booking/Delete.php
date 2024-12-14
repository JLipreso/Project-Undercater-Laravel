<?php

namespace App\Http\Controllers\booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * 
 */

class Delete extends Controller
{
    public static function delete(Request $request) {
        
        $delete = DB::table('booking')
            ->where([
                ["dataid", $request['booking_dataid']]
            ])
            ->delete();
        
        if($delete) {
            
            DB::table("booking_activity")->where("booking_dataid", $request['booking_dataid'])->delete();
            DB::table("booking_addons")->where("booking_dataid", $request['booking_dataid'])->delete();
            DB::table("booking_foods")->where("booking_dataid", $request['booking_dataid'])->delete();

            return [
                "success"   => true,
                "message"   => "Booking deleted successfully"
            ];
        }
        else {
            return [
                "success"   => false,
                "message"   => "Fail to deleted booking, try again later."
            ];
        }
    }
}
