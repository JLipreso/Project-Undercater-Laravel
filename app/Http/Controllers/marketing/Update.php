<?php

namespace App\Http\Controllers\marketing;

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
        else if(empty($request['content'])) {
            return [
                "success"   => false,
                "message"   => "Content is required."
            ];
        }
        else if(empty($request['photo'])) {
            return [
                "success"   => false,
                "message"   => "Photo is required."
            ];
        }
        else {
            $updated = DB::table('marketing')
                ->where('dataid', $request['dataid'])
                ->update([
                    "title"         => $request['title'],
                    "content"       => $request['content'],
                    "photo"         => $request['photo']
                ]);

            if($updated) {
                return [
                    "success"   => true,
                    "message"   => "Updated successfully"
                ];
            }
            else {
                return [
                    "success"   => false,
                    "message"   => "Fail to update, try again later."
                ];
            }
        }
    }
}
