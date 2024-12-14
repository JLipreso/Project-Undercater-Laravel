<?php

namespace App\Http\Controllers\booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * booking/approve?booking_dataid=1
 */

class Approve extends Controller
{
    public static function approve(Request $request) {
        $approved = DB::table('booking')
            ->where([
                ["dataid", $request['booking_dataid']],
                ["status", 1]
            ])
            ->update([
                "status"    => 2
            ]);
        
        if($approved) {
            /**
             * Send email here!
             */
            return [
                "success"   => true,
                "message"   => "Booking approved successfully"
            ];
        }
        else {
            return [
                "success"   => false,
                "message"   => "Fail to approve booking, try again later."
            ];
        }
    }
}
