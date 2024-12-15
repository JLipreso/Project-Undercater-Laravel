<?php

namespace App\Http\Controllers\marketing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Delete extends Controller
{
    public static function delete(Request $request) {
        $deleted = DB::table('marketing')->where('dataid', $request['dataid'])->delete();
        if($deleted) {
            return [
                "success"   => true,
                "message"   => "Marketing deleted succesfully"
            ];
        }
        else {
            return [
                "success"   => false,
                "message"   => "Fail to delete marketing, try again later."
            ];
        }
    }
}
