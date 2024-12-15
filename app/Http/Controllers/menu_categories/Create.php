<?php

namespace App\Http\Controllers\menu_categories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Create extends Controller
{
    public static function create(Request $request) {
        if(empty($request['name'])) {
            return [
                "success"   => false,
                "message"   => "Category name is required."
            ];
        }
        else if(empty($request['description'])) {
            return [
                "success"   => false,
                "message"   => "Category description is required."
            ];
        }
        else {
            $source = DB::table("menu_categories")->insert([
                "name"              => $request['name'],
                "description"       => $request['description']
            ]);

            if($source) {
                return [
                    "success"   => true,
                    "message"   => "Category successfully added"
                ];
            }
            else {
                return [
                    "success"   => false,
                    "message"   => "Fail to add category, try again later"
                ];
            }
        }
    }
}
