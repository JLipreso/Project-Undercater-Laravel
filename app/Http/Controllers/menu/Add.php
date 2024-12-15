<?php

namespace App\Http\Controllers\menu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Add extends Controller
{
    public static function add(Request $request) {

        if(empty($request['name'])) {
            return [
                "success"   => false,
                "message"   => "Name is required"
            ];
        }
        else if((empty($request['category'])) || ($request['category'] == '0')) {
            return [
                "success"   => false,
                "message"   => "Category is required"
            ];
        }
        else if(empty($request['description'])) {
            return [
                "success"   => false,
                "message"   => "Description is required"
            ];
        }
        else if(empty($request['package'])) {
            return [
                "success"   => false,
                "message"   => "Package is required"
            ];
        }
        else if(empty($request['photo'])) {
            return [
                "success"   => false,
                "message"   => "Photo is required"
            ];
        }
        else {
            $added = DB::table('menu')->insert([
                "name"          => $request['name'],
                "category"      => $request['category'],
                "description"   => $request['description'],
                "package"       => $request['package'],
                "photo"         => $request['photo']
            ]);

            if($added) {
                return [
                    "success"   => true,
                    "message"   => "Menu successfully created"
                ];
            }
            else {
                return [
                    "success"   => false,
                    "message"   => "Fail to create menu, try again later"
                ];
            }
        }
    }
}
