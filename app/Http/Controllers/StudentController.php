<?php

namespace App\Http\Controllers;

use App\Services\DegreeChecker;
use App\Services\HashService;
use App\Models\StudentCredential;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    protected $checker;
    protected $hasher;

    public function __construct(DegreeChecker $checker, HashService $hasher)
    {
        $this->checker = $checker;
        $this->hasher = $hasher;
    }

    public function index()
    {
        $credential = StudentCredential::where('user_id', Auth::id())->first();
        return view('student.dashboard', compact('credential'));
    }

    public function claim(Request $request)
    {
        $request->validate([
            'student_name' => 'required|string|max:255',
            'roll_number' => 'required|string|max:100',
            'degree_title' => 'required|string|max:255',
            'university_name' => 'required|string|max:255',
            'graduation_year' => 'required|digits:4',
        ]);

        $data = $request->all();
        $result = $this->checker->check($data, Auth::id());
        $hash = $this->hasher->generate($data);

        $slug = Str::slug($data['student_name']) . '-' . 
                strtolower(str_replace(['/', '-', ' '], '', $data['roll_number']));

        $credential = StudentCredential::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'student_name' => $data['student_name'],
                'roll_number' => $data['roll_number'],
                'degree_title' => $data['degree_title'],
                'university_name' => $data['university_name'],
                'graduation_year' => $data['graduation_year'],
                'degree_hash' => $hash,
                'status' => $result->result,
                'public_slug' => $slug,
                'verification_code' => $result->code,
            ]
        );

        return response()->json([
            'result' => $result->result,
            'score' => $result->score,
            'badge_url' => route('badge', $slug),
        ]);
    }

    public function badge()
    {
        $credential = StudentCredential::where('user_id', Auth::id())->firstOrFail();
        return view('student.badge', compact('credential'));
    }
}