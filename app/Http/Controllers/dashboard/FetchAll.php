<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 *  dashboard/counter
 */

class FetchAll extends Controller
{
    public static function counter(Request $request) {
        return [
            [
                "label"                 => "Total All Booked",
                "value"                 => DB::table('booking')->count()
            ],
            [
                "label"                 => "Total Users",
                "value"                 => DB::table('users_customer')->count()
            ],
            [
                "label"                 => "Total Staff",
                "value"                 => DB::table('users_system')->count()
            ],
            [
                "label"                 => "Total Pending",
                "value"                 => DB::table('booking')->where('status', 0)->count()
            ],
            [
                "label"                 => "Total Approve",
                "value"                 => DB::table('booking')->where('status', 1)->count()
            ],
            [
                "label"                 => "Total Declined",
                "value"                 => DB::table('booking')->where('status', 3)->count()
            ],
            [
                "label"                 => "Total Event Room",
                "value"                 => DB::table('events')->count()
            ],
            [
                "label"                 => "Total Blogs Room",
                "value"                 => DB::table('blogs')->count()
            ],
            [
                "label"                 => "Total Menu Foods",
                "value"                 => DB::table('menu')->count()
            ],
            [
                "label"                 => "Total Menu Categories",
                "value"                 => DB::table('menu_categories')->count()
            ],
            [
                "label"                 => "Total Add-ons",
                "value"                 => DB::table('add_ons')->count()
            ],
            [
                "label"                 => "Total Inventory",
                "value"                 => DB::table('inventory_stocks')->count()
            ],
        ];
    }
}
