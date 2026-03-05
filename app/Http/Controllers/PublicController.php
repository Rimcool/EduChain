<?php

namespace App\Http\Controllers;

use App\Models\{University, Verification, StudentCredential, IssuedDegree};

class PublicController extends Controller
{
    public function landing()
    {
        return view('landing');
    }

    public function universities()
    {
        $universities = University::where('is_hec_recognized', true)
            ->orderBy('name')->paginate(24);
        return view('pages.universities', compact('universities'));
    }

    public function result(string $code)
    {
        $v = Verification::where('code', $code)->firstOrFail();
        return view('verify.result', compact('v'));
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
            'verifications_today'    => Verification::whereDate('created_at', today())->count(),
            'fakes_caught'           => Verification::where('result','fake')->count(),
            'universities_on_chain'  => University::where('is_on_educhain',true)->count(),
            'total_verifications'    => Verification::count(),
        ]);
    }

    public function uniSearch()
    {
        $q    = request('q', '');
        $unis = University::where('name','like',"%{$q}%")
                    ->where('is_hec_recognized', true)
                    ->limit(8)
                    ->pluck('name');
        return response()->json($unis);
    }

    public function publicVerify()
    {
        return view('verify.public');
    }
}