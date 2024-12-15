<?php

namespace App\Http\Controllers\users_system;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * users_system/fetchAll
 */

class FetchAll extends Controller
{
    public static function fetchAll(Request $request) {
        return DB::table("users_system")
        ->orderBy('last_name', 'asc')
        ->get();
    }
}
