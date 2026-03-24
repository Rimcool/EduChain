<?php

namespace App\Services;

use App\Models\Verification;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfService
{
    public function certificate(Verification $verification)
    {
        return Pdf::loadView('verify.certificate', compact('verification'));
    }
}