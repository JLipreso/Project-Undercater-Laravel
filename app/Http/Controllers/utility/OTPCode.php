<?php

namespace App\Http\Controllers\utility;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * \App\Http\Controllers\utility\OTPCode::create();
 */

class OTPCode extends Controller
{
    public static function create() {
        return rand(100000,999999);
    }
}
