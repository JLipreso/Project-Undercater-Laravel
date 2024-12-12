<?php

namespace App\Http\Controllers\add_ons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * add_ons/fetchDiscounted
 */

class FetchDiscounted extends Controller
{
    public static function fetch(Request $request) {
        $source = DB::table("add_ons")
            ->where('priceSale', '>', 0)
            ->orderBy('name', 'asc')
            ->get();
        
        $list = [];
        foreach($source as $addon) {
            $list[] = [
                "dataid"        => $addon->dataid,
                "name"          => $addon->name,
                "description"   => $addon->description,
                "price"         => floatval($addon->price),
                "priceSale"     => floatval($addon->priceSale),
                "photo"         => $addon->photo
            ];
        }

        return $list;
    }
}
