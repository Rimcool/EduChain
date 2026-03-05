<?php

namespace App\Http\Controllers;

use App\Models\{IssuedDegree, University};
use App\Services\{HashService, ActivityLogger};
use Illuminate\Http\Request;

class PortalController extends Controller
{
    public function index()
    {
        $uniName = auth()->user()->university_name;
        $degrees = IssuedDegree::where('university_name', 'like', "%{$uniName}%")
                    ->latest()->get();

        $stats = [
            'total'        => $degrees->count(),
            'this_month'   => $degrees->where('created_at', '>=', now()->startOfMonth())->count(),
            'verified_count'=> \App\Models\Verification::where('university_name','like',"%{$uniName}%")->count(),
        ];

        return view('portal.index', compact('degrees', 'stats'));
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

        // Check for duplicate
        if (IssuedDegree::where('degree_hash', $hash)->exists()) {
            return response()->json(['error' => 'This degree has already been issued.'], 409);
        }

        $degree = IssuedDegree::create([
            ...$data,
            'degree_hash' => $hash,
            'tx_hash'     => '0xEDU' . strtoupper(substr($hash, 0, 16)),
            'issued_at'   => now(),
        ]);

        University::findByName($data['university_name'])
            ?->update(['is_on_educhain' => true]);

        ActivityLogger::record(auth()->id(), 'degree_issued',
            'Issued degree for ' . $data['student_name'], $data);

        return response()->json(['success' => true, 'tx_hash' => $degree->tx_hash]);
    }

    public function bulk(Request $request)
    {
        $request->validate(['file' => 'required|file|mimes:csv,txt']);

        $rows    = array_map('str_getcsv', file($request->file('file')->path()));
        $headers = array_shift($rows);
        $issued  = 0;
        $skipped = 0;
        $hasher  = new HashService();
        $uniName = auth()->user()->university_name;

        foreach ($rows as $row) {
            if (count($row) < 4) continue;
            $data = [
                'student_name'    => $row[0],
                'roll_number'     => $row[1],
                'degree_title'    => $row[2],
                'graduation_year' => $row[3],
                'university_name' => $uniName,
            ];

            $hash = $hasher->generate($data);
            if (IssuedDegree::where('degree_hash', $hash)->exists()) {
                $skipped++;
                continue;
            }

            IssuedDegree::create([
                ...$data,
                'degree_hash' => $hash,
                'tx_hash'     => '0xEDU' . strtoupper(substr($hash, 0, 16)),
                'issued_at'   => now(),
            ]);
            $issued++;
        }

        return response()->json([
            'issued'  => $issued,
            'skipped' => $skipped,
            'message' => "{$issued} degrees issued, {$skipped} duplicates skipped.",
        ]);
    }

    public function degrees()
    {
        $uniName = auth()->user()->university_name;
        $degrees = IssuedDegree::where('university_name', 'like', "%{$uniName}%")
                    ->latest()->paginate(20);
        return view('portal.degrees', compact('degrees'));
    }
}