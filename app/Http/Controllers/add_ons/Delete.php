<?php

namespace App\Http\Controllers\add_ons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Delete extends Controller
{
    public static function delete(Request $request) {
        
        $deleted = DB::table("add_ons")->where("dataid", $request['dataid'])->delete();
        
        if($deleted) {
            return [
                "success"   => true,
                "message"   => "Add-ons deleted successfully"
            ];
        }
        else {
            return [
                "success"   => false,
                "message"   => "Fail to deleted add-ons, try again later"
            ];
        }
    }
}
