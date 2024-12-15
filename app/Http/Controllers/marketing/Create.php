<?php

namespace App\Http\Controllers\marketing;

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
        else if(empty($request['content'])) {
            return [
                "success"   => false,
                "message"   => "Content is required"
            ];
        }
        else if(empty($request['photo'])) {
            return [
                "success"   => false,
                "message"   => "Photo is required"
            ];
        }
        else {
            $created = DB::table('marketing')->insert([
                "title"             => $request['title'],
                "content"           => $request['content'],
                "photo"             => $request['photo']
            ]);
            if($created) {
                return [
                    "success"   => true,
                    "message"   => "Marketing successfully created"
                ];
            }
            else {
                return [
                    "success"   => false,
                    "message"   => "Fail to create marketing, try again later."
                ];
            }
        }
    }
}
