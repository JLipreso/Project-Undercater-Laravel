<?php

namespace App\Http\Controllers\booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * 
 */

class Profile extends Controller
{
    public static function profile(Request $request) {

        $header             = DB::table('booking')->where('dataid', $request['booking_dataid'])->get()[0];
        $foods              = DB::table('booking_foods')
                            ->join('menu','booking_foods.menu_dataid', '=', 'menu.dataid')
                            ->select('menu.*', 'booking_foods.dataid as booking_food_dataid')
                            ->where('booking_foods.booking_dataid', $request['booking_dataid'])
                            ->orderBy('menu.name', 'asc')
                            ->get();
        $count_dessert      = 0;
        $count_dish         = 0;

        foreach($foods as $food) {
            if(strtolower($food->category) == 'dessert') {
                $count_dessert = $count_dessert + 1;
            }
            else {
                $count_dish     = $count_dish + 1;
            }
        }

        $addons             = DB::table('booking_addons')
                            ->join('add_ons', 'booking_addons.addon_dataid', '=', 'add_ons.dataid')
                            ->select(
                                'add_ons.*',
                                'booking_addons.dataid as booking_addons_dataid',
                                'booking_addons.price as booking_addons_price'
                                )
                            ->where('booking_addons.booking_dataid', $request['booking_dataid'])
                            ->orderBy('add_ons.name', 'asc')
                            ->get();
        $addons_total = 0;
        foreach($addons as $addon) {
            $addons_total = $addons_total + floatval($addon->booking_addons_price);
        }

        $pax_cost               = $header->event_pax * floatval($header->event_pax_price);

        $grand_total            = $addons_total + $pax_cost;

        return [
            "header"            => $header,
            "addons"            => [
                "addons"               => $addons,
                "total"                => $addons_total
            ],
            "foods"             => [
                "foods"                 => $foods,
                "count_dessert"         => $count_dessert,
                "count_dish"            => $count_dish
            ],
            "pax_cost"          => [
                "label"             => $header->event_pax . 'pax X ' . $header->event_pax_price . '/pax',
                "value"             => $pax_cost
            ],
            "grand_total"       => $grand_total
        ];
    }
}
