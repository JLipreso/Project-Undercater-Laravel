<?php

namespace App\Http\Controllers\inquiry;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Send extends Controller
{
    public static function send(Request $request) {
        $sourcce = DB::table('inquiry')->insert([
            'name'          => $request['name'],
            'email'         => $request['email'],
            'subject'       => $request['subject'],
            'message'       => $request['message']
        ]);
        
        if($sourcce) {
            return [
                "success"   => true,
                "message"   => "Message sent."
            ];
        }
        else {
            return [
                "success"   => false,
                "message"   => "Fail to send, try again later."
            ];
        }
    }
}
