<?php

namespace App\Http\Controllers\booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * 
 */

class Draft extends Controller
{
    public static function get($user_dataid) {
        
        $source = DB::table("booking")
        ->orderBy('dataid', 'desc')
        ->where([
            ['user_dataid', $user_dataid],
            ['status', 0]
        ])
        ->get();

        if(count($source) > 0) {
            $booking    = $source[0];
            $addons     = DB::table('booking_addons')
                        ->join('add_ons', 'booking_addons.addon_dataid', '=', 'add_ons.dataid')
                        ->select(
                            'add_ons.*',
                            'booking_addons.dataid as booking_addons_dataid',
                            'booking_addons.price as booking_addons_price'
                        )
                        ->where('booking_addons.booking_dataid', $booking->dataid)
                        ->orderBy('add_ons.name', 'asc')
                        ->get();
            $addons_total = 0;
            foreach($addons as $addon) {
                $addons_total = $addons_total + floatval($addon->booking_addons_price);
            }

            return [
                "success"   => true,
                "data"      => [
                    "header"        => $booking,
                    "event"         => \App\Http\Controllers\events\FetchSingle::fetch($booking->event_dataid),
                    "status"        => \App\Http\Controllers\booking\Translate::bookingStatus($booking->status),
                    "valid_id"      => env('FTP_DIRECTORY') . $booking->valid_id_path,
                    "location"      => \App\Http\Controllers\booking\Translate::bookingLocation($booking->event_location),
                    "food"          => DB::table('booking_foods')
                        ->join('menu','booking_foods.menu_dataid', '=', 'menu.dataid')
                        ->select('menu.*', 'booking_foods.dataid as booking_food_dataid')
                        ->where('booking_foods.booking_dataid', $booking->dataid)
                        ->orderBy('menu.name', 'asc')
                        ->get(),
                    "addons"        => $addons,
                    "addons_total"  => $addons_total
                ]
            ];          
        }
        else {
            return [
                "success"   => false,
                "data"      => []
            ];
        }
    }
}
