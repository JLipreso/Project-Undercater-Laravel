<?php

namespace App\Http\Controllers\themes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Add extends Controller
{
    public static function add(Request $request) {
        $added = DB::table("themes")->insert([
            "name"          => $request['name'],
            "description"   => $request['description']
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
                "message"   => "Fail to add theme, try again later"
            ];
        }
    }
}
