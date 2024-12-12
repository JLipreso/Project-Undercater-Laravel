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

        if(count($foods) == 0) {
            return [
                "success"   => false,
                "message"   => "Please select ". $request['target_dish'] ." food and ". $request['target_dessert'] ." dessert"
            ];
        }
        else if($count_dish < intval($request['target_dish'])) {
            return [
                "success"   => false,
                "message"   => $request['target_dish'] . " dish is required to continue."
            ];
        }
        else if($count_dish !== intval($request['target_dish'])) {
            return [
                "success"   => false,
                "message"   => $request['target_dish'] . " dish is required."
            ];
        }
        else if($count_dessert !== intval($request['target_dessert'])) {
            return [
                "success"   => false,
                "message"   => $request['target_dessert'] . " dessert is required."
            ];
        }
        else {
            return [
                "success"           => true,
                "message"           => "Next",
                "data"              => [
                    "foods"             => $foods,
                    "count_dessert"     => $count_dessert,
                    "count_dish"        => $count_dish
                ]
            ];
        }
    }
}
