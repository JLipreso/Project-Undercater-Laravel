<?php

namespace App\Http\Controllers\themes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Delete extends Controller
{
    public static function delete(Request $request) {

        if(empty($request['dataid'])) {
            return [
                "success"   => false,
                "message"   => "Theme ID is undefined"
            ];
        }
        else {
            $updated = DB::table('themes')
                ->where('dataid', $request['dataid'])
                ->delete();
            
            if($updated) {
                return [
                    "success"   => true,
                    "message"   => "Theme delete successfully"
                ];
            }
            else {
                return [
                    "success"   => false,
                    "message"   => "Fail to delete theme, try again later"
                ];
            }
        }
   } 
}
