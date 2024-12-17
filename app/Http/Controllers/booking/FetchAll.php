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

            $list[] = [
                "header"    => $booking,
                "event"     => \App\Http\Controllers\events\FetchSingle::fetch($booking->event_dataid),
                "status"    => \App\Http\Controllers\booking\Translate::bookingStatus($booking->status),
                "valid_id"  => env('FTP_DIRECTORY') . $booking->valid_id_path,
                "location"  => \App\Http\Controllers\booking\Translate::bookingLocation($booking->event_location),
                "food"      => DB::table('booking_foods')
                    ->join('menu','booking_foods.menu_dataid', '=', 'menu.dataid')
                    ->select('menu.*', 'booking_foods.dataid as booking_food_dataid')
                    ->where('booking_foods.booking_dataid', $booking->dataid)
                    ->orderBy('menu.name', 'asc')
                    ->get(),
                "addons"        => $addons,
                "addons_total"  => $addons_total
            ];
        }

        return $list;
    }

    public static function fetchByUser($user_dataid) {
        
        $source = DB::table("booking")
        ->orderBy('dataid', 'desc')
        ->where('user_dataid', $user_dataid)
        ->get();

        $list = [];

        foreach($source as $booking) {

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

            $list[] = [
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
            ];
        }

        return $list;
    }

    public static function fetchByDataID($dataid) {
        
        $source = DB::table("booking")
        ->orderBy('dataid', 'desc')
        ->where("dataid", $dataid)
        ->get();

        if(count($source) > 0) {

            $addons     = DB::table('booking_addons')
                        ->join('add_ons', 'booking_addons.addon_dataid', '=', 'add_ons.dataid')
                        ->select(
                            'add_ons.*',
                            'booking_addons.dataid as booking_addons_dataid',
                            'booking_addons.price as booking_addons_price'
                        )
                        ->where('booking_addons.booking_dataid', $source[0]->dataid)
                        ->orderBy('add_ons.name', 'asc')
                        ->get();

            $addons_total = 0;
            foreach($addons as $addon) {
                $addons_total = $addons_total + floatval($addon->booking_addons_price);
            }


            return [
                "header"    => $source[0],
                "event"     => \App\Http\Controllers\events\FetchSingle::fetch($source[0]->event_dataid),
                "status"    => \App\Http\Controllers\booking\Translate::bookingStatus($source[0]->status),
                "valid_id"  => env('FTP_DIRECTORY') . $source[0]->valid_id_path,
                "location"  => \App\Http\Controllers\booking\Translate::bookingLocation($source[0]->event_location),
                "food"      => DB::table('booking_foods')
                    ->join('menu','booking_foods.menu_dataid', '=', 'menu.dataid')
                    ->select('menu.*', 'booking_foods.dataid as booking_food_dataid')
                    ->where('booking_foods.booking_dataid', $source[0]->dataid)
                    ->orderBy('menu.name', 'asc')
                    ->get(),
                "addons"        => $addons,
                "addons_total"  => $addons_total
            ];
        }
        else {
            return [];
        }
    }

    public static function calendar(Request $request) {
        $source = DB::table('booking')
            ->select("dataid", "event_date", "last_name", "first_name", "status")
            ->whereIn('status', ['1','2','3'])
            ->get();

        $list = [];
        foreach($source as $booking) {
            $backgroundColor    = "";
            $textColor          = "";
            if($booking->status == 2) { $backgroundColor = "green"; $textColor = "white";  }
            else if($booking->status == 3) { $backgroundColor = "red"; $textColor = "white"; }
            else { $backgroundColor = "gray"; $textColor = "white"; }

            $list[] = [
                "id"        => $booking->dataid,
                "title"     => 'Name: ' . $booking->last_name . ' ' . $booking->first_name,
                "start"     => $booking->event_date,
                "backgroundColor" => $backgroundColor,
                "textColor" => $textColor
            ];
        }

        return $list;
    }
}
