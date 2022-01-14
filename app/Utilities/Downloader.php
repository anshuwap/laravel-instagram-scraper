<?php

namespace App\Utilities;

use Illuminate\Support\Facades\Response ;
use Illuminate\Support\Facades\Storage;

class Downloader
{


    public static function downloadFile(string $url ,string $mediaID ,string $mideaType)
    {
        if($mideaType == 'video') 
            $filePath = storage_path('app/uploads/') . $mediaID . '.' . uniqid() . '.mp4';
        
        if ($mideaType == 'image')
            $filePath = storage_path('app/uploads/') . $mediaID . '.' . uniqid() . '.png';
        


        // Initialize the cURL session
        $ch = curl_init($url);


        // Open file
        $fp = fopen($filePath, 'wb');

        // It set an option for a cURL transfer
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        // Perform a cURL session
        curl_exec($ch);

        // Closes a cURL session and frees all resources
        curl_close($ch);

        // Close file
        fclose($fp);

        return basename($filePath);
    }

}