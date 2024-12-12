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
        return DB::table("marketing")
        ->orderBy('dataid', 'desc')
        ->get();
    }
}
