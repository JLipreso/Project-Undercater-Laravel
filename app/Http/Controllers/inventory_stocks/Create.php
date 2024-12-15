<?php

namespace App\Http\Controllers\inventory_stocks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Create extends Controller
{
    public static function create(Request $request) {
        if(empty($request['name'])) {
            return [
                "success"   => false,
                "message"   => "Item name is required."
            ];
        }
        else if(empty($request['price'])) {
            return [
                "success"   => false,
                "message"   => "Item price is required."
            ];
        }
        else if(empty($request['stock'])) {
            return [
                "success"   => false,
                "message"   => "Item stock is required."
            ];
        }
        else {
            $created = DB::table("inventory_stocks")->insert([
                "name"              => $request['name'],
                "price"             => $request['price'],
                "priceSale"         => $request['priceSale'],
                "stock"             => $request['stock']
            ]);

            if($created) {
                return [
                    "success"   => true,
                    "message"   => "Item stock successfully added"
                ];
            }
            else {
                return [
                    "success"   => false,
                    "message"   => "Fail to add item, try again later"
                ];
            }
        }
    }
}
