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
                "value"                 => "0.00"
            ],
            [
                "label"                 => "Total Users",
                "value"                 => "0.00"
            ],
            [
                "label"                 => "Total Staff",
                "value"                 => "0.00"
            ],
            [
                "label"                 => "Total Pending",
                "value"                 => "0.00"
            ],
            [
                "label"                 => "Total Approve",
                "value"                 => "0.00"
            ],
            [
                "label"                 => "Total Cancel",
                "value"                 => "0.00"
            ],
            [
                "label"                 => "Total Event Room",
                "value"                 => "0.00"
            ],
            [
                "label"                 => "Total Blogs Room",
                "value"                 => "0.00"
            ],
            [
                "label"                 => "Total Menu Foods",
                "value"                 => "0.00"
            ],
            [
                "label"                 => "Total Menu Categories",
                "value"                 => "0.00"
            ],
            [
                "label"                 => "Total Add-ons",
                "value"                 => "0.00"
            ],
            [
                "label"                 => "Total Inventory",
                "value"                 => "0.00"
            ],
        ];
    }
}
