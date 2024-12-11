<?php

namespace App\Http\Controllers\users_customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mail;

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
                Register::sendEmail($request['email'], $token);
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

    public static function sendEmail($email, $token) {

        try {
            $subject    = "Please verify your email address";
            $href       = env('APP_URL') . "registration-verified/" . $token;
            $content    = '<div style="font-family: sans-serif; width: 100%;height: 100%;background: #e8eff1;position: absolute;">
                            <div style="display: block;margin: 40px auto 0px auto; max-width: 500px;min-height: 300px;background-color: white;position: relative;border-bottom: 10px solid #ff3131;">
                                <img style="width: 100%;" src="https://student.jlipreso.com/undercater-assets/footer-design.png"/>
                                <img style="display: block;margin: 0 auto;width: 160px;" src="https://student.jlipreso.com/undercater-assets/logo.png"/>
                                <div style="padding: 0px 24px 24px 24px;font-size: 13px;line-height: 1.7;">
                                    <h3 style="text-align: center;">UnderCater Restaurant</h3>
                                    <p>Dear Recipient: '.$email.',</p>
                                    <p>Thank you for registering with UnderCater Restaurant! To complete your registration, please click the link below to verify your email address:</p>
                                    <p><a href="'.$href.'">Click here to verify your email</a></p>
                                    <p>If you did not sign up for an account, please ignore this email.</p>
                                    <p>Warm regards,<br>The UnderCater Restaurant Team</p>;
                                </div>
                            </div>
                        </div>';
            Mail::html($content, function ($message) use($email, $subject) { $message->to($email)->subject($subject); });
        }
        catch(\Exception $e) {
            return [
                "success"   => false,
                "message"   => $e->getMessage()
            ]; 
        }
        
    }
}
