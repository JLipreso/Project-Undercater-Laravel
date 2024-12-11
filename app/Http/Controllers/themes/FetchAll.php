<?php

namespace App\Http\Controllers\themes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * themes/fetchAll
 */

class FetchAll extends Controller
{
    public static function fetchAll(Request $request) {
        return DB::table("themes")
        ->orderBy('name', 'asc')
        ->get();
    }
}
