<?php

namespace App\Http\Controllers\booking_foods;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * 
 */

class Add extends Controller
{
    public static function add(Request $request) {
        
        $source = DB::table("booking_foods")->insert([
            "booking_dataid"    => $request['booking_dataid'],
            "menu_dataid"       => $request['menu_dataid'],
            "menu_category"     => strtolower($request['menu_category'])
        ]);

        if($source) {
            return [
                "success"   => true,
                "message"   => "Successfully added to your cart"
            ];
        }
        else {
            return [
                "success"   => false,
                "message"   => "Fail to add, try again later."
            ];
        }
    }

    public static function verify(Request $request) {
        
        $foods          = DB::table("booking_foods")->where("booking_dataid", $request['booking_dataid'])->get();
        $count_dish     = 0;
        $count_dessert  = 0;

        foreach($foods as $food) {
            if($food->menu_category == 'dessert') {
                $count_dessert = $count_dessert + 1;
            }
            else {
                $count_dish     = $count_dish + 1;
            }
        }

        return [
            "foods"             => $foods,
            "count_dessert"     => $count_dessert,
            "count_dish"        => $count_dish
        ];
    }
}
