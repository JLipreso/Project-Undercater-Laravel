<?php

namespace App\Http\Controllers\add_ons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Update extends Controller
{
    public static function update(Request $request) {
        if(empty($request['name'])) {
            return [
                "success"   => false,
                "message"   => "Add-ons name is required."
            ];
        }
        else if(empty($request['description'])) {
            return [
                "success"   => false,
                "message"   => "Add-ons description is required."
            ];
        }
        else if((empty($request['price'])) || (intval($request['price']) <= 0 )) {
            return [
                "success"   => false,
                "message"   => "Valid add-ons price is required."
            ];
        }
        else if(empty($request['photo'])) {
            return [
                "success"   => false,
                "message"   => "Add-ons photo is required."
            ];
        }
        else {
            $created = DB::table("add_ons")
            ->where('dataid', $request['dataid'])
            ->update([
                "name"              => $request['name'],
                "description"       => $request['description'],
                "price"             => $request['price'],
                "priceSale"         => $request['priceSale'],
                "photo"             => $request['photo']
            ]);

            if($created) {
                return [
                    "success"   => true,
                    "message"   => "Add-ons successfully updated"
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
