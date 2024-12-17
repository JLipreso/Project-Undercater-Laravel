<?php

namespace App\Http\Controllers\booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mail;

/**
 * 
 */

class Cancel extends Controller
{
    public static function cancel(Request $request) {

        $booking_dataid     = $request['booking_dataid'];
        $email              = $request['email'];
        $book_event         = $request['book_event'];

        $declined = DB::table('booking')
            ->where([
                ["dataid", $booking_dataid]
            ])
            ->update([
                "status"    => 4
            ]);
        
        if($declined) {
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
