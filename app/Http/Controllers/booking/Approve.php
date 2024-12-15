<?php

namespace App\Http\Controllers\booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mail;

/**
 * booking/approve?booking_dataid=1
 */

class Approve extends Controller
{
    public static function approve(Request $request) {

        $booking_dataid     = $request['booking_dataid'];
        $email              = $request['email'];
        $book_event         = $request['book_event'];

        $approved = DB::table('booking')
            ->where([
                ["dataid", $booking_dataid],
                ["status", 1]
            ])
            ->update([
                "status"    => 2
            ]);
        
        if($approved) {
            Approve::sendEmail($email, $book_event);
            return [
                "success"   => true,
                "message"   => "Booking approved successfully"
            ];
        }
        else {
            return [
                "success"   => false,
                "message"   => "Fail to approve booking, try again later."
            ];
        }
    }

    public static function sendEmail($email, $book_event) {

        try {
            $subject    = "Your Appointment has been Approved";
            $content    = '<div style="font-family: sans-serif; width: 100%;height: 100%;background: #e8eff1;position: absolute;">
                                <div style="display: block;margin: 40px auto 0px auto; max-width: 500px;min-height: 300px;background-color: white;position: relative;border-bottom: 10px solid #ff3131;">
                                    <img style="width: 100%;" src="https://student.jlipreso.com/undercater-assets/footer-design.png"/>
                                    <img style="display: block;margin: 0 auto;width: 160px;" src="https://student.jlipreso.com/undercater-assets/logo.png"/>
                                    <div style="padding: 0px 24px 24px 24px;font-size: 13px;line-height: 1.7;">
                                        <h3 style="text-align: center;">UnderCater Restaurant</h3>
                                        <p><strong>Dear '.$email.',</strong></p>
                                        <br/>
                                        <p>Your booking for the event: <strong>'.$book_event.'</strong> has been approved.</p>
                                        <p>Please visit our website for more details about your appointment, or contact us if you have any questions.</p>
                                        <p>Thank you for choosing UnderCater Restaurant.<br/>We look forward to serving you!</p>
                                        <p>Warm regards,<br>The UnderCater Restaurant Team</p>
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
