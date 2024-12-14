<?php

namespace App\Http\Controllers\events;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * \App\Http\Controllers\events\FetchSingle::fetch($event_dataid);
 */

class FetchSingle extends Controller
{
    public static function fetch($event_dataid) {
        $source = DB::table("events")
        ->orderBy('name', 'asc')
        ->where("dataid", $event_dataid)
        ->get();

        if(count($source) > 0) {
            return $source[0];
        }
        else {
            return [];
        }
    }
}
