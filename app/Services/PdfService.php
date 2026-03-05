<?php

namespace App\Services;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Verification;

class PdfService
{
    public function certificate(Verification $verification)
    {
        return Pdf::loadView('verify.certificate', compact('verification'))
                  ->setPaper('a4', 'portrait');
    }
}