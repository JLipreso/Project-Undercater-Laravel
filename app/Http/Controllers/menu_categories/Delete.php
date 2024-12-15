<?php

namespace App\Http\Controllers\menu_categories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Delete extends Controller
{
    public static function delete(Request $request) {
        $deleted = DB::table("menu_categories")->where("dataid", $request['dataid'])->delete();
        if($deleted) {
            return [
                "success"   => true,
                "message"   => "Category deleted successfully"
            ];
        }
        else {
            return [
                "success"   => false,
                "message"   => "Fail to deleted category, try again later"
            ];
        }
    }
}
