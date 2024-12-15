<?php

namespace App\Http\Controllers\inventory_stocks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Delete extends Controller
{
    public static function delete(Request $request) {
        $deleted = DB::table("inventory_stocks")->where("dataid", $request['dataid'])->delete();
        if($deleted) {
            return [
                "success"   => true,
                "message"   => "Item deleted successfully"
            ];
        }
        else {
            return [
                "success"   => false,
                "message"   => "Fail to deleted item, try again later"
            ];
        }
    }
}
