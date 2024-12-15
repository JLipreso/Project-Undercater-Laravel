<?php

namespace App\Http\Controllers\inquiry;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * inquiry/fetchAll
 */

class FetchAll extends Controller
{
    public static function fetchAll(Request $request) {
        return DB::table("inquiry")
        ->orderBy('dataid', 'desc')
        ->get();
    }
}
