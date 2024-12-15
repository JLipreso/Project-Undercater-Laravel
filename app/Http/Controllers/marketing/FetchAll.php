<?php

namespace App\Http\Controllers\marketing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * marketing/fetchAll
 */

class FetchAll extends Controller
{
    public static function fetchAll(Request $request) {
        $source = DB::table("marketing")
        ->orderBy('dataid', 'desc')
        ->get();

        $list = [];
        foreach($source as $marketing) {
            $list[] = [
                "dataid"    => $marketing->dataid,
                "title"     => $marketing->title,
                "content"   => $marketing->content,
                "photo"     => $marketing->photo,
                "fullpath"  => env('FTP_DIRECTORY') . $marketing->photo,
                "status"    => $marketing->status
            ];
        }

        return $list;
    }
}
