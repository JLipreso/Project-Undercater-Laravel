<?php

namespace App\Http\Controllers\menu_categories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Update extends Controller
{
    public static function update(Request $request) {

        if(empty($request['dataid'])) {
            return [
                "success"   => false,
                "message"   => "Category ID is undefined"
            ];
        }
        else if(empty($request['name'])) {
            return [
                "success"   => false,
                "message"   => "Name is required"
            ];
        }
        else if(empty($request['description'])) {
            return [
                "success"   => false,
                "message"   => "Description is required"
            ];
        }
        else {
            $updated = DB::table("menu_categories")
                ->where("dataid", $request['dataid'])
                ->update([
                    "name"          => $request['name'],
                    "description"   => $request['description']
                ]);
            
            if($updated) {
                return [
                    "success"   => true,
                    "message"   => "Category updated successfully"
                ];
            }
            else {
                return [
                    "success"   => false,
                    "message"   => "Fail to update category, try again later"
                ];
            }
        }
    }
}
