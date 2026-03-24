<?php

namespace App\Http\Controllers;

use App\Services\DegreeChecker;
use App\Models\Verification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyController extends Controller
{
    protected $checker;

    public function __construct(DegreeChecker $checker)
    {
        $this->checker = $checker;
    }

    public function index()
    {
        return view('verify.index');
    }

    public function check(Request $request)
    {
        $request->validate([
            'student_name' => 'required|string|max:255',
            'roll_number' => 'required|string|max:100',
            'degree_title' => 'required|string|max:255',
            'university_name' => 'required|string|max:255',
            'graduation_year' => 'required|digits:4|integer|min:1947|max:' . date('Y'),
        ]);

        $result = $this->checker->check($request->all(), Auth::id());

        return response()->json([
            'result' => $result->result,
            'score' => $result->score,
            'reason' => $result->reason,
            'layers' => json_decode($result->checks, true),
            'code' => $result->code,
        ]);
    }

    public function bulk(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt',
        ]);

        $rows = array_map('str_getcsv', file($request->file('file')->path()));
        $headers = array_shift($rows);
        $results = [];

        foreach ($rows as $row) {
            if (count($row) < 5) continue;

            $data = [
                'student_name' => $row[0] ?? '',
                'university_name' => $row[1] ?? '',
                'degree_title' => $row[2] ?? '',
                'roll_number' => $row[3] ?? '',
                'graduation_year' => $row[4] ?? '',
            ];

            $result = $this->checker->check($data, Auth::id());
            $results[] = [
                'student_name' => $data['student_name'],
                'university' => $data['university_name'],
                'result' => $result->result,
                'score' => $result->score,
                'code' => $result->code,
            ];
        }

        return response()->json(['results' => $results]);
    }

    public function pdf(string $code)
    {
        $verification = Verification::where('code', $code)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('verify.certificate', compact('verification'));
        
        return $pdf->download('EduChain-' . $code . '.pdf');
    }

    public function show(string $code)
    {
        $verification = Verification::where('code', $code)->firstOrFail();
        return view('verify.result', compact('verification'));
    }
}