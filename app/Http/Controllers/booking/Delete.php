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
