<?php

namespace App\Http\Controllers\users_system;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Update extends Controller
{
    public static function update(Request $request) {
        if(empty($request['dataid'])) {
            return [
                "success"   => false,
                "message"   => "Staff ID is undefined"
            ];
        }
        else if(empty($request['first_name'])) {
            return [
                "success"   => false,
                "message"   => "First name is required"
            ];
        }
        else if(empty($request['last_name'])) {
            return [
                "success"   => false,
                "message"   => "Last name is required"
            ];
        }
        else if(empty($request['email'])) {
            return [
                "success"   => false,
                "message"   => "Email is required"
            ];
        }
        else if(empty($request['password'])) {
            return [
                "success"   => false,
                "message"   => "Password is required"
            ];
        }
        else if(empty($request['role'])) {
            return [
                "success"   => false,
                "message"   => "Role is required"
            ];
        }
        else if(empty($request['contact'])) {
            return [
                "success"   => false,
                "message"   => "Contact number is required"
            ];
        }
        else {
            $created = DB::table('users_system')
            ->where('dataid', $request['dataid'])
            ->update([
                "first_name"    => $request['first_name'],
                "last_name"     => $request['last_name'],
                "email"         => $request['email'],
                "contact"       => $request['contact'],
                "password"      => $request['password'],
                "role"          => $request['role'],
                "status"        => $request['status']
            ]);
            if($created) {
                return [
                    "success"   => true,
                    "message"   => "Staff successfully created"
                ];
            }
            else {
                return [
                    "success"   => false,
                    "message"   => "Fail to create staff, try again later."
                ];
            }
        }
    }
}
