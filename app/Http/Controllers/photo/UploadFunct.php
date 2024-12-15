<?php

namespace App\Http\Controllers\photo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * 
 */

class UploadFunct extends Controller
{
    public static function upload(Request $request) {

        $ext            = $request['image']->extension();
        $path           = $request['image']->path();
        $file           = $request['image']->getRealPath();
        $size           = $request['image']->getSize();

        $reference_id  	= \App\Http\Controllers\utility\ReferenceID::create("IMG");
        $ftpcon 		= ftp_connect(env("FTP_HOSTNAME")) or die('Error connecting to ftp server...');
        $ftplogin 		= ftp_login($ftpcon, env("FTP_USERNAME"), env("FTP_PASSWORD"));
        $filepath 	    = $reference_id . '.' .$ext;

        if (ftp_put($ftpcon, "public_html/" . $filepath, $_FILES['image']['tmp_name'], FTP_BINARY)) {
            return [
                "success"       => true,
                "reference_id"  => $reference_id,
                "message"       => "Upload successfully",
                "data"          => [
                    "filepath"      => $filepath,
                    "fullpath"      => env("FTP_DIRECTORY") . $filepath
                ]
            ];
        }
        else {
            return [
                "success"       => false,
                "reference_id"  => $reference_id,
                "message"       => "Fail to upload",
                "data"          => []
            ];
        }
    }
}
