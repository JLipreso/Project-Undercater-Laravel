<?php

namespace App\Http\Controllers\booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * booking/fetchAll
 */

class FetchAll extends Controller
{
    public static function fetchAll(Request $request) {
        
        $source = DB::table("booking")
        ->orderBy('dataid', 'desc')
        ->where('status', '>', 0)
        ->get();

        $list = [];

        foreach($source as $booking) {
            $list[] = [
                "header"    => $booking,
                "event"     => \App\Http\Controllers\events\FetchSingle::fetch($booking->event_dataid),
                "status"    => \App\Http\Controllers\booking\Translate::bookingStatus($booking->status),
                "valid_id"  => env('FTP_DIRECTORY') . $booking->valid_id_path,
                "location"  => \App\Http\Controllers\booking\Translate::bookingLocation($booking->event_location)
            ];
        }

        return $list;
    }
}
