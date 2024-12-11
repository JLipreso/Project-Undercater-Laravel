<?php

namespace App\Http\Controllers\utility;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * 
 * \App\Http\Controllers\utility\Token::create();
 */

class Token extends Controller
{
    public static function create() {

        $DATE   = date('m').date('d').date('Y').date('h').date('i').date('s');
        $CHAR   = str_shuffle("1234567890abcdefghijklmnopqrstuvwxyzABCDEFJHIJKLMNOPQRSTUVWXYZ-_@|*()");

        return substr($CHAR, 0, 32);
    }
}
