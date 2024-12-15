<?php

namespace App\Http\Controllers\events;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * events/add?
 */

class Add extends Controller
{
    public static function add(Request $request) {

        if(empty($request['name'])) {
            return [
                "success"   => false,
                "message"   => "Event name is required."
            ];
        }
        else if(empty($request['description'])) {
            return [
                "success"   => false,
                "message"   => "Event description is required."
            ];
        }
        else if(empty($request['package'])) {
            return [
                "success"   => false,
                "message"   => "Event package is required."
            ];
        }
        else if($request['min_occupancy'] <= 0) {
            return [
                "success"   => false,
                "message"   => "Event min. occupancy is required."
            ];
        }
        else if($request['min_occupancy'] < 20) {
            return [
                "success"   => false,
                "message"   => "Minimum occupancy is 20."
            ];
        }
        else if($request['max_occupancy'] <= 0) {
            return [
                "success"   => false,
                "message"   => "Max occupancy is required"
            ];
        }
        else if($request['min_occupancy'] > $request['max_occupancy']) {
            return [
                "success"   => false,
                "message"   => "Min. occupancy is greater than max. occupancy"
            ];
        }
        else if($request['price'] <= 0) {
            return [
                "success"   => false,
                "message"   => "Event price is required."
            ];
        }
        else if(empty($request['photo'])) {
            return [
                "success"   => false,
                "message"   => "Event photo is required."
            ];
        }
        else {
            $source = DB::table("events")->insert([
                "name"              => $request['name'],
                "description"       => $request['description'],
                "package"           => $request['package'],
                "min_occupancy"     => $request['min_occupancy'],
                "max_occupancy"     => $request['max_occupancy'],
                "price"             => $request['price'],
                "photo"             => $request['photo']
            ]);

            if($source) {
                return [
                    "success"   => true,
                    "message"   => "Event successfully added"
                ];
            }
            else {
                return [
                    "success"   => false,
                    "message"   => "Fail to add event, try again later"
                ];
            }
        }
    }
}
