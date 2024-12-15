<?php

namespace App\Http\Controllers\booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * booking/initBooking?user_dataid=1&event_dataid=23
 * booking/placeReservation?booking_dataid=&first_name=&last_name=&email=&phone=
 */

class Book extends Controller
{
    public static function init(Request $request) {
        if(Book::isInitExist($request['user_dataid'])) {
            $last_dataid        = DB::table('booking')
                                    ->select('dataid')
                                    ->where([
                                        ['user_dataid', $request['user_dataid']],
                                        ['status', '0']
                                    ])
                                    ->get()[0]->dataid;
            return [
                "success"       => true,
                "message"       => "Init exist",
                "last_dataid"   => $last_dataid
            ];
        }
        else {
            $source = DB::table("booking")->insertGetId([
                "user_dataid"           => $request['user_dataid'],
                "event_dataid"          => $request['event_dataid'],
                "event_pax_price"       => $request['pax_price'],

                "event_date"            => $request['event_date'],
                "event_start_time"      => $request['event_start_time'],
                "event_end_time"        => $request['event_end_time'],
                
                "status"                => 0,
                "created_at"            => date("Y-m-d h:i:s")
            ]);

            if($source) {
                return [
                    "success"       => true,
                    "message"       => "Booking initialized successfully.",
                    "last_dataid"   => $source
                ];
            }
            else {
                return [
                    "success"   => false,
                    "message"   => "Fail to initialized booking, try again later."
                ];
            }
        }
    }

    public static function isInitExist($user_dataid) {
        $counts = DB::table('booking')
        ->where([
            ['user_dataid', $user_dataid],
            ['status', 0]
        ])
        ->count();

        if($counts > 0) {
            return true;
        }
        else {
            return false;
        }
    }

    public static function themeAndPacks(Request $request) {
        if(empty($request['event_theme_dataid'])) {
            return [
                "success"   => false,
                "message"   => "Theme is required"
            ];
        }
        else if(empty($request['event_location'])) {
            return [
                "success"   => false,
                "message"   => "Location is required"
            ];
        }
        else if(empty($request['event_pax'])) {
            return [
                "success"   => false,
                "message"   => "Number of pax is required"
            ];
        }
        else if(intval($request['event_pax']) < 20 ) {
            return [
                "success"   => false,
                "message"   => "At least 20 pax is required"
            ];
        }
        else {
            $source = DB::table('booking')
                ->where([
                    ['user_dataid', $request['user_dataid']],
                    ['status', '0']
                ])
                ->update([
                    "event_theme_dataid"    => $request['event_theme_dataid'],
                    "event_location"        => $request['event_location'],
                    "event_pax"             => $request['event_pax'],
                    "event_cost"            => $request['event_cost']
                ]);
            
            if($source) {
                return [
                    "success"   => true,
                    "message"   => "Updated successfully"
                ];
            }
            else {
                return [
                    "success"   => true,
                    "message"   => "No changes made"
                ];
            }
        }
    }

    public static function placeReservation(Request $request) {
        $placed = DB::table("booking")
            ->where([
                ["dataid", $request['booking_dataid']],
                ["status", "0"]
            ])
            ->update([
                "first_name"    => $request['first_name'],
                "last_name"     => $request['last_name'],
                "email"         => $request['email'],
                "phone"         => $request['phone'],
                "total_price"   => $request['total_price'],
                "status"        => "1"
            ]);
        
        if($placed) {
            return [
                "success"   => true,
                "message"   => "Placed successfully."
            ];
        }
        else {
            return [
                "success"   => false,
                "message"   => "Fail to place booking."
            ];
        }
    }
}

