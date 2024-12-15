<?php

namespace App\Http\Controllers\users_system;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Delete extends Controller
{
    public static function delete(Request $request) {
        $deleted = DB::table('users_system')->where('dataid', $request['dataid'])->delete();
        if($deleted) {
            return [
                "success"   => true,
                "message"   => "Staff deleted succesfully"
            ];
        }
        else {
            return [
                "success"   => false,
                "message"   => "Fail to delete staff, try again later."
            ];
        }
    }
}
