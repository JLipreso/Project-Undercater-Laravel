<?php

namespace App\Http\Controllers\booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * \App\Http\Controllers\booking\Translate::bookingStatus($status);
 * \App\Http\Controllers\booking\Translate::bookingLocation($type);
 */

class Translate extends Controller
{
    public static function bookingStatus($status) {
        if($status == 0) {
            return [
                "key"       => $status,
                "value"     => "Draft"
            ];
        }
        else if($status == 1) {
            return [
                "key"       => $status,
                "value"     => "Pending"
            ];
        }
        else if($status == 2) {
            return [
                "key"       => $status,
                "value"     => "Approved"
            ];
        }
        else if($status == 3) {
            return [
                "key"       => $status,
                "value"     => "Declined"
            ];
        }
        else if($status == 4) {
            return [
                "key"       => $status,
                "value"     => "Cancelled"
            ];
        }
        else {
            return [
                "key"       => $status,
                "value"     => "Unknown"
            ];
        }
    }

    public static function bookingLocation($type) {
        if($type == 'IN') {
            return [
                "key"       => $type,
                "value"     => "Restaurant venue"
            ];
        }
        else if($type == 'OUT') {
            return [
                "key"       => $type,
                "value"     => "Customer's choice"
            ];
        }
        else {
            return [
                "key"       => $type,
                "value"     => "Unknown"
            ];
        }
    }
}
