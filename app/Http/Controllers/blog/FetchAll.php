<?php

namespace App\Http\Controllers\blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * blog/fetchAll
 */

class FetchAll extends Controller
{
    public static function fetchAll(Request $request) {
        $source =DB::table("blogs")
        ->orderBy('dataid', 'desc')
        ->get();

        $list = [];

        foreach($source as $blog) {
            $list[] = [
                "dataid"        => $blog->dataid,
                "title"         => $blog->title,
                "description"   => $blog->description,
                "photo"         => $blog->photo,
                "fullpath"      => env('FTP_DIRECTORY') . $blog->photo,
                "status"        => $blog->status,
                "created_at"    => $blog->created_at,

            ];
        }

        return $list;

         
    }
}
