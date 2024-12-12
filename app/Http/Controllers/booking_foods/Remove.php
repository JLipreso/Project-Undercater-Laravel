<?php

namespace App\Http\Controllers\booking_foods;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * 
 */

class Remove extends Controller
{
    public static function remove($dataid) {
        return DB::table("booking_foods")->where("dataid", $dataid)->delete();
    }
}
