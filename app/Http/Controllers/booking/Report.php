<?php

namespace App\Http\Controllers\booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * booking/report?scope=yearly
 */

class Report extends Controller
{
    public static function report(Request $request) {

        $scope  = $request['scope'];
      
        switch($scope) {
            case "daily":
                $source = DB::table("booking")
                    ->whereDate('event_date', Carbon::today())
                    ->whereIn('status', ['1', '2', '3'])
                    ->get();
                break;
            case "weekly":
                $source = DB::table("booking")
                    ->where('event_date', '>=', Carbon::now()->subDay(7))
                    ->whereIn('status', ['1', '2', '3'])
                    ->get();
                break;
            case "monthly":
                $source = DB::table("booking")
                    ->whereMonth('event_date', Carbon::today()->month)
                    ->whereIn('status', ['1', '2', '3'])
                    ->get();
                break;
            case "yearly":
                $source = DB::table("booking")
                    ->whereYear('event_date', date('Y'))
                    ->whereIn('status', ['1', '2', '3'])
                    ->get();
                break;
            default:
                $source = DB::table("booking")
                ->whereDate('event_date', Carbon::today())
                ->whereIn('status', ['1', '2', '3'])
                ->get();
                break;
        }

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
