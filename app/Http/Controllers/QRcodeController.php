<?php

namespace App\Http\Controllers;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRcodeController extends Controller
{
    public static function generate ($reservationInfo) {

        $filename = 'qrcode_' . uniqid() . '.png';
        $qrCodePath = storage_path('app/public/qrcodes/'.$filename);
        
        QrCode::format('png')->size(300)->generate($reservationInfo, $qrCodePath);
        return $qrCodePath;
    	
    }
}
