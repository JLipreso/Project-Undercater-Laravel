<?php

namespace App\Http\Controllers\inventory_stocks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Update extends Controller
{
    public static function update(Request $request) {
        if(empty($request['dataid'])) {
            return [
                "success"   => false,
                "message"   => "Inventory ID is undefined"
            ];
        }
        else if(empty($request['name'])) {
            return [
                "success"   => false,
                "message"   => "Name is required"
            ];
        }
        else if(empty($request['price'])) {
            return [
                "success"   => false,
                "message"   => "Price value is required, put zero (0) if not applicable."
            ];
        }
        else {
            $updated = DB::table('inventory_stocks')
                ->where('dataid', $request['dataid'])
                ->update([
                    "name"          => $request['name'],
                    "price"         => $request['price'],
                    "stock"         => $request['stock'],
                    "lost"          => $request['lost'],
                    "damage"        => $request['damage']
                ]);

            if($updated) {
                return [
                    "success"   => true,
                    "message"   => "Item updated successfully"
                ];
            }
            else {
                return [
                    "success"   => false,
                    "message"   => "Fail to update item, try again later"
                ];
            }
        }
    }
}
