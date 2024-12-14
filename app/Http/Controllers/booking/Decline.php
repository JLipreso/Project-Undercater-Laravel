<?php

namespace App\Http\Controllers\booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * booking/decline?booking_dataid=1
 */

class Decline extends Controller
{
    public static function decline(Request $request) {
        $declined = DB::table('booking')
            ->where([
                ["dataid", $request['booking_dataid']],
                ["status", 1]
            ])
            ->update([
                "status"    => 3
            ]);
        
        if($declined) {
            /**
             * Send email here!
             */
            return [
                "success"   => true,
                "message"   => "Booking declined successfully"
            ];
        }
        else {
            return [
                "success"   => false,
                "message"   => "Fail to declined booking, try again later."
            ];
        }
    }
}
