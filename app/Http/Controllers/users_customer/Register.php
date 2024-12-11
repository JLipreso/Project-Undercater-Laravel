<?php

namespace App\Http\Controllers\users_customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Register extends Controller
{
    public static function register(Request $request) {
        if($request['firstname'] == '') {
            return [
                "success"   => false,
                "message"   => "Firstname is required"
            ];
        }
        else if($request['lastname'] == '') {
            return [
                "success"   => false,
                "message"   => "Lastname is required"
            ];
        }
        else if($request['email'] == '') {
            return [
                "success"   => false,
                "message"   => "Email is required"
            ];
        }
        else if($request['password'] == '') {
            return [
                "success"   => false,
                "message"   => "Password is required"
            ];
        }
        else if($request['confirm_password'] == '') {
            return [
                "success"   => false,
                "message"   => "Please confirm your password"
            ];
        }
        else if($request['confirm_password'] !== $request['password']) {
            return [
                "success"   => false,
                "message"   => "Password doesn't match"
            ];
        }
        else if($request['contact'] == '') {
            return [
                "success"   => false,
                "message"   => "Mobile number is required"
            ];
        }
        else if(Register::isEmailExist($request['email'])) {
            return [
                "success"   => false,
                "message"   => "Someone is already using your email."
            ];
        }
        else {

            $token      = \App\Http\Controllers\utility\Token::create();

            $source     = DB::table('users_customer')->insert([
                "firstname"     => $request['firstname'],
                "lastname"      => $request['lastname'],
                "email"         => $request['email'],
                "password"      => $request['password'],
                "contact"       => $request['contact'],
                "token"         => $token
            ]);

            if($source) {
                return [
                    "success"   => true,
                    "message"   => "Account successfully created."
                ];
            }
            else {
                return [
                    "success"   => false,
                    "message"   => "Incorrect email or password"
                ];
            }
        }
    }

    public static function isEmailExist($email) {
        $source = DB::table('users_customer')->where('email', $email)->count();
        if($source > 0) {
            return true;
        }
        else {
            return false;
        }
    }
}
