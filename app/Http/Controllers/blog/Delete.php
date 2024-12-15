<?php

namespace App\Http\Controllers\blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Delete extends Controller
{
    public static function delete(Request $request) {
        $deleted = DB::table('blogs')->where('dataid', $request['dataid'])->delete();
        if($deleted) {
            return [
                "success"   => true,
                "message"   => "Blog deleted created"
            ];
        }
        else {
            return [
                "success"   => false,
                "message"   => "Fail to delete blog, try again later."
            ];
        }
    }
}
