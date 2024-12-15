<?php

namespace App\Http\Controllers\blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * blog/create?
 */

class Create extends Controller
{
    public static function create(Request $request) {
        if(empty($request['title'])) {
            return [
                "success"   => false,
                "message"   => "Title is required"
            ];
        }
        else if(empty($request['description'])) {
            return [
                "success"   => false,
                "message"   => "Description is required"
            ];
        }
        else if(empty($request['photo'])) {
            return [
                "success"   => false,
                "message"   => "Photo is required"
            ];
        }
        else if(empty($request['status'])) {
            return [
                "success"   => false,
                "message"   => "Status is required"
            ];
        }
        else {
            $created = DB::table('blogs')->insert([
                "title"             => $request['title'],
                "description"       => $request['description'],
                "photo"             => $request['photo'],
                "status"            => $request['status'],
                "created_at"        => date('Y-m-d h:i:s')
            ]);
            if($created) {
                return [
                    "success"   => true,
                    "message"   => "Blog successfully created"
                ];
            }
            else {
                return [
                    "success"   => false,
                    "message"   => "Fail to create blog, try again later."
                ];
            }
        }
    }
}
