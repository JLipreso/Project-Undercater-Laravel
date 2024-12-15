<?php

namespace App\Http\Controllers\inquiry;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Delete extends Controller
{
    public static function delete(Request $request) {
        $deleted = DB::table('inquiry')->where('dataid', $request['dataid'])->delete();
        if($deleted) {
            return [
                "success"   => true,
                "message"   => "Inquiry deleted created"
            ];
        }
        else {
            return [
                "success"   => false,
                "message"   => "Fail to delete inquiry, try again later."
            ];
        }
    }
}
