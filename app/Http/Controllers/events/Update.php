<?php

namespace App\Http\Controllers\events;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * 
 */

class Update extends Controller
{
    public static function update(Request $request) {
        $updated = DB::table("events")
            ->where("dataid", $request['dataid'])
            ->update([
                "name"          => $request['name'],
                "description"   => $request['description'],
                "package"       => $request['package'],
                "min_occupancy" => $request['min_occupancy'],
                "max_occupancy" => $request['max_occupancy'],
                "price"         => $request['price']
            ]);
        
        if($updated) {
            return [
                "success"   => true,
                "message"   => "Event updated successfully"
            ];
        }
        else {
            return [
                "success"   => false,
                "message"   => "Fail to update event, try again later"
            ];
        }
    }
}
