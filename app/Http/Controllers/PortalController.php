<?php

namespace App\Http\Controllers;

use App\Models\IssuedDegree;
use App\Models\University;
use App\Services\HashService;
use Illuminate\Http\Request;

class PortalController extends Controller
{
    public function index()
    {
        $degrees = IssuedDegree::where('university_name', 'like', '%' . auth()->user()->university_name . '%')
            ->latest()->get();

        return view('portal.index', compact('degrees'));
    }

    public function issue(Request $request)
    {
        $data = $request->validate([
            'student_name'    => 'required|string|max:255',
            'roll_number'     => 'required|string|max:100',
            'degree_title'    => 'required|string|max:255',
            'graduation_year' => 'required|digits:4',
        ]);

        $data['university_name'] = auth()->user()->university_name;

        $hasher = new HashService();
        $hash   = $hasher->generate($data);

        IssuedDegree::create([
            ...$data,
            'degree_hash' => $hash,
            'tx_hash'     => '0xEDU' . strtoupper(substr($hash, 0, 16)),
            'issued_at'   => now(),
        ]);

        University::findByName($data['university_name'])
            ?->update(['is_on_educhain' => true]);

        return response()->json(['success' => true, 'hash' => $hash]);
    }
}