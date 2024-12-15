<?php

namespace App\Http\Controllers\menu_categories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FetchAll extends Controller
{
    public static function fetchAll(Request $request) {
        return DB::table("menu_categories")
            ->orderBy('name', 'asc')
            ->get();
    }
}
