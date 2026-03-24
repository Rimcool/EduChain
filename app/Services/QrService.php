<?php

namespace App\Services;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrService
{
    public function generate(string $url, int $size = 200)
    {
        return QrCode::size($size)->generate($url);
    }
}