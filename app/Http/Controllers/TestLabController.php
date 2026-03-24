<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Verification;

class TestLabController extends Controller
{
    /**
     * Display the test lab dashboard
     */
    public function index()
    {
        // Abort in production
        if (app()->environment('production')) {
            abort(403, 'Test lab not available in production.');
        }

        $testVerifications = Verification::where('is_test', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.testlab', compact('testVerifications'));
    }
}