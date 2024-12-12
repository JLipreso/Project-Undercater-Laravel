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
        return DB::table("blogs")
        ->orderBy('dataid', 'desc')
        ->get();
    }
}
