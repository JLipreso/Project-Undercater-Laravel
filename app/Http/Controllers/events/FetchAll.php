<?php

namespace App\Http\Controllers\events;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * 
 * 
 */

class FetchAll extends Controller
{
    public static function fetchAll(Request $request) {
        return DB::table("events")
        ->orderBy('name', 'asc')
        ->get();
    }
}
