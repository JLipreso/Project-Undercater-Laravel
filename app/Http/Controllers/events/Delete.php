<?php

namespace App\Http\Controllers\events;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * 
 */

class Delete extends Controller
{
    public static function delete(Request $request) {
        $deleted = DB::table("events")->where("dataid", $request['dataid'])->delete();
        if($deleted) {
            return [
                "success"   => true,
                "message"   => "Event deleted successfully"
            ];
        }
        else {
            return [
                "success"   => false,
                "message"   => "Fail to deleted event, try again later"
            ];
        }
    }
}
