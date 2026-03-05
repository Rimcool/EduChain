<?php

namespace App\Services;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrService
{
    public function generate(string $text, int $size = 200): string
    {
        return QrCode::size($size)->generate($text);
    }
}