<?php

namespace App\Http\Controllers\inventory_stocks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FetchAll extends Controller
{
    public static function fetchAll(Request $request) {
        return DB::table("inventory_stocks")
            ->orderBy('name', 'asc')
            ->get();
    }
}
