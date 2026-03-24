<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Verification;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        $verifications = Verification::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('history', compact('verifications'));
    }
}