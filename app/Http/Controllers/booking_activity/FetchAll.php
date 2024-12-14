<?php

namespace App\Http\Controllers\booking_activity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * booking_activity/fetchAll?booking_dataid=1
 */

class FetchAll extends Controller
{
    public static function fetchAll(Request $request) {
        return DB::table("booking_activity")
        ->where("booking_dataid", $request['booking_dataid'])
        ->orderBy('sort', 'asc')
        ->get();
    }
}
