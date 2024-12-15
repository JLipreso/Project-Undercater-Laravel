<?php

namespace App\Http\Controllers\menu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * menu/fetchAll
 */

class FetchAll extends Controller
{
    public static function fetchAll(Request $request) {
        if((isset($request['category'])) && ($request['category'] !== 'all')) {
            return DB::table("menu")
                ->orderBy('name', 'asc')
                ->where("category", $request['category'])
                ->get();
        }
        else {
            return DB::table("menu")
                ->orderBy('name', 'asc')
                ->get();
        }
    }
}
