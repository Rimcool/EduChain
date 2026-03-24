<?php

namespace App\Http\Controllers;

use App\Models\{University, Verification, StudentCredential, IssuedDegree};

class PublicController extends Controller
{
    public function landing()
    {
        return view('landing');
    }

    public function dashboard()
    {
        // Get stats for public dashboard
        $stats = [
            'total_users' => \App\Models\User::count(),
            'today_verifications' => \App\Models\Verification::whereDate('created_at', today())->count(),
            'fake_caught' => \App\Models\Verification::where('result', 'fake')->count(),
            'universities_on_chain' => \App\Models\University::where('is_on_educhain', true)->count(),
            'pending_universities' => \App\Models\User::where('role', 'university')->where('status', 'pending')->count(),
            'fraud_alerts' => \App\Models\FraudAlert::where('status', 'new')->where('search_count', '>=', 5)->count(),
        ];

        // Get recent verifications (public data only)
        $recent_verifications = \App\Models\Verification::latest()
            ->take(5)
            ->get();

        // Get recent activity (public data only)
        $recent_activity = \App\Models\ActivityLog::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('pages.dashboard', compact('stats', 'recent_verifications', 'recent_activity'));
    }

    public function universities()
    {
        $universities = University::where('is_hec_recognized', true)
            ->orderBy('name')->paginate(24);
        return view('pages.universities', compact('universities'));
    }

    public function result(string $code)
    {
        $verification = Verification::where('code', $code)->firstOrFail();
        return view('verify.result', compact('verification'));
    }

    public function badge(string $slug)
    {
        $credential = StudentCredential::where('public_slug', $slug)->firstOrFail();
        $credential->increment('view_count');
        return view('student.badge', compact('credential'));
    }

    public function statsJson()
    {
        return response()->json([
            'verifications_today' => Verification::whereDate('created_at', today())->count(),
            'fakes_caught' => Verification::where('result', 'fake')->count(),
            'universities_on_chain' => University::where('is_on_educhain', true)->count(),
            'total_verifications' => Verification::count(),
        ]);
    }

    public function uniSearch()
    {
        $q = request('q', '');
        $unis = University::where('name', 'like', "%{$q}%")
                    ->where('is_hec_recognized', true)
                    ->limit(8)
                    ->pluck('name');
        return response()->json($unis);
    }
}