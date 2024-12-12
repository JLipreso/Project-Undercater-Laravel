<?php

namespace App\Http\Controllers\booking_addons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * /booking_addons/remove/{dataid}
 */

class Remove extends Controller
{
    public static function remove($dataid) {
        return DB::table("booking_addons")->where("dataid", $dataid)->delete();
    }
}
