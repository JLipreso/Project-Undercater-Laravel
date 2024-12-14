<?php

namespace App\Http\Controllers\booking_activity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * 
 */

class Delete extends Controller
{
    public static function delete(Request $request) {
        if(empty($request['dataid'])) {
            return [
                "success"   => false,
                "message"   => "Activity ID is undefined."
            ];
        }
        else {
            $deleted = DB::table("booking_activity")
                ->where("dataid", $request['dataid'])
                ->delete();
                
            if($deleted) {
                return [
                    "success"   => true,
                    "message"   => "Deleted successfully"
                ];
            }   
            else {
                return [
                    "success"   => false,
                    "message"   => "Fail to delete, try again later."
                ];
            }
        }
    }
}
