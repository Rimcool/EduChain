<?php

namespace App\Http\Controllers;

use App\Services\DegreeChecker;
use App\Models\Verification;
use Illuminate\Http\Request;

class VerifyController extends Controller
{
    public function __construct(private DegreeChecker $checker) {}

    public function index()
    {
        return view('verify.index');
    }

    public function check(Request $request)
    {
        $data = $request->validate([
            'student_name'    => 'required|string|max:255',
            'roll_number'     => 'required|string|max:100',
            'degree_title'    => 'required|string|max:255',
            'university_name' => 'required|string|max:255',
            'graduation_year' => 'required|digits:4|integer|min:1947|max:' . date('Y'),
        ]);

        $result = $this->checker->check($data, auth()->id());

        return response()->json([
            'result' => $result->result,
            'score'  => $result->score,
            'reason' => $result->reason,
            'layers' => json_decode($result->checks, true),
            'code'   => $result->code,
        ]);
    }

    public function show(string $code)
    {
        $v = Verification::where('code', $code)->firstOrFail();
        return view('verify.result', compact('v'));
    }
}