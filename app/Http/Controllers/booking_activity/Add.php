<?php

namespace App\Http\Controllers\booking_activity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * booking_activity/add?booking_id=1&title=11&description=ddfddf&status
 */

class Add extends Controller
{
    public static function add(Request $request) {

        if(empty($request['title'])) {
            return [
                "success"   => false,
                "message"   => "Activity title is required."
            ];
        }
        else if(empty($request['description'])) {
            return [
                "success"   => false,
                "message"   => "Activity description is required."
            ];
        }
        else if($request['status'] == '0') {
            return [
                "success"   => false,
                "message"   => "Activity status is required."
            ];
        }
        else {
            $added = DB::table("booking_activity")
                ->insert([
                    "booking_dataid"    => $request['booking_dataid'],
                    "title"             => $request['title'],
                    "description"       => $request['description'],
                    "status"            => $request['status']
                ]);

            if($added) {
                return [
                    "success"   => true,
                    "message"   => "Added successfully"
                ];
            }   
            else {
                return [
                    "success"   => false,
                    "message"   => "Fail to add, try again later."
                ];
            }
        }
    }
}
