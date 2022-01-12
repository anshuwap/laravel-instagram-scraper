<?php

namespace App\Utilities;

use Illuminate\Support\Facades\Response ;

class Downloader
{


    public static function downloadFile(string $url ,string $type)
    {
        dd(Response::download($url));
    }

}