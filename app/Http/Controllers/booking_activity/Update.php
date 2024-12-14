<?php

namespace App\Http\Controllers\booking_activity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * 
 */

class Update extends Controller
{
    public static function update(Request $request) {
        $update = DB::table("booking_activity")
            ->where("dataid", $request['dataid'])
            ->update([
                "title"         => $request['title'],
                "description"   => $request['description'],
                "status"        => $request['status']
            ]);

        if($update) {
            return [
                "success"   => true,
                "message"   => "Activity created successfully."
            ];
        }
        else {
            return [
                "success"   => true,
                "message"   => "Fail to create activity, try again later."
            ];
        }
    }
}
