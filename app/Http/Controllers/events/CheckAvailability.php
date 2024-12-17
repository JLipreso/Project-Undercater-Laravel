<?php

namespace App\Http\Controllers\events;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * events/checkAvailability?date=1&start_time=&end_time=
 */

class CheckAvailability extends Controller
{
    public static function check(Request $request) {
        if(empty($request['date'])) {
            return [
                "success"   => false,
                "message"   => "Date is required"
            ];
        }
        else if(empty($request['start_time'])) {
            return [
                "success"   => false,
                "message"   => "Start time is required"
            ];
        }
        else if(empty($request['end_time'])) {
            return [
                "success"   => false,
                "message"   => "End time is required"
            ];
        }
        else {
            $count = DB::table('booking')->where('event_date', $request['date'])->count();

            if($count > 0) {
                return [
                    "success"   => false,
                    "message"   => "Date is not available"
                ];
            }
            else {  
                return [
                    "success"   => true,
                    "message"   => "Event is available"
                ];
            }
        }
    }
}
