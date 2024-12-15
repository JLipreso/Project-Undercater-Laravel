<?php

namespace App\Http\Controllers\blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * 
 */

class Update extends Controller
{
    public static function update(Request $request) {

        if(empty($request['dataid'])) {
            return [
                "success"   => false,
                "message"   => "Blog ID is undefined."
            ];
        }
        else if(empty($request['title'])) {
            return [
                "success"   => false,
                "message"   => "Title is required."
            ];
        }
        else if(empty($request['description'])) {
            return [
                "success"   => false,
                "message"   => "Description is required."
            ];
        }
        else if(empty($request['photo'])) {
            return [
                "success"   => false,
                "message"   => "Photo is required."
            ];
        }
        else {
            $updated = DB::table('blogs')
                ->where('dataid', $request['dataid'])
                ->update([
                    "title"         => $request['title'],
                    "description"   => $request['description'],
                    "photo"         => $request['photo']
                ]);

            if($updated) {
                return [
                    "success"   => true,
                    "message"   => "Blog updated successfully"
                ];
            }
            else {
                return [
                    "success"   => false,
                    "message"   => "Fail to update blog, try again later."
                ];
            }
        }
    }
}
