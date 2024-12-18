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

    public static function chart(Request $request) {
        return [
            "sale"      => [
                "labels"        => ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                "data"          => [
                    FetchAll::countBooking(1), 
                    FetchAll::countBooking(2), 
                    FetchAll::countBooking(3), 
                    FetchAll::countBooking(4), 
                    FetchAll::countBooking(5), 
                    FetchAll::countBooking(6), 
                    FetchAll::countBooking(7), 
                    FetchAll::countBooking(8), 
                    FetchAll::countBooking(9), 
                    FetchAll::countBooking(10), 
                    FetchAll::countBooking(11), 
                    FetchAll::countBooking(12)
                ]
            ],
            "revenue"   => [
                ""              => "",
                "data"          => [
                    FetchAll::countSalesPermonth(1), 
                    FetchAll::countSalesPermonth(2), 
                    FetchAll::countSalesPermonth(3), 
                    FetchAll::countSalesPermonth(4), 
                    FetchAll::countSalesPermonth(5), 
                    FetchAll::countSalesPermonth(6), 
                    FetchAll::countSalesPermonth(7), 
                    FetchAll::countSalesPermonth(8), 
                    FetchAll::countSalesPermonth(9), 
                    FetchAll::countSalesPermonth(10), 
                    FetchAll::countSalesPermonth(11), 
                    FetchAll::countSalesPermonth(12)
                ]
            ]
        ];
    }

    public static function countBooking($month) {
        return DB::table('booking')
            ->whereMonth('event_date', $month)
            ->count();
    }

    public static function countSalesPermonth($month) {
        return DB::table('booking')
            ->whereMonth('event_date', $month)
            ->sum('total_price');
    }
}
