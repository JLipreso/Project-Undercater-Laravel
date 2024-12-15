<?php

namespace App\Http\Controllers\menu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Delete extends Controller
{
    public static function delete(Request $request) {
        $deleted = DB::table("menu")->where("dataid", $request['dataid'])->delete();
        if($deleted) {
            return [
                "success"   => true,
                "message"   => "Menu deleted successfully"
            ];
        }
        else {
            return [
                "success"   => false,
                "message"   => "Fail to deleted menu, try again later"
            ];
        }
    }
}
