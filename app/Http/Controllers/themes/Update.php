<?php

namespace App\Http\Controllers\themes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Update extends Controller
{
   public static function update(Request $request) {

        if(empty($request['dataid'])) {
            return [
                "success"   => false,
                "message"   => "Theme ID is undefined"
            ];
        }
        else if(empty($request['name'])) {
            return [
                "success"   => false,
                "message"   => "Theme name is required"
            ];
        }
        else if(empty($request['description'])) {
            return [
                "success"   => false,
                "message"   => "Theme description is required"
            ];
        }
        else {
            $updated = DB::table('themes')
                ->where('dataid', $request['dataid'])
                ->update([
                    'name'              => $request['name'],
                    'description'       => $request['description']
                ]);
            
            if($updated) {
                return [
                    "success"   => true,
                    "message"   => "Theme updated successfully"
                ];
            }
            else {
                return [
                    "success"   => false,
                    "message"   => "Fail to update theme, try again later"
                ];
            }
        }
   } 
}
