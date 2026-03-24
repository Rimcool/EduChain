<?php

namespace App\Http\Controllers;

use App\Services\DegreeChecker;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function __construct(private DegreeChecker $checker) {}

    public function verify(Request $request)
    {
        $data = $request->validate([
            'student_name'    => 'required|string|max:255',
            'roll_number'     => 'required|string|max:100',
            'degree_title'    => 'required|string|max:255',
            'university_name' => 'required|string|max:255',
            'graduation_year' => 'required|digits:4|integer|min:1947|max:'.date('Y'),
        ]);

        $result = $this->checker->check($data, $request->api_key_user_id);

        return response()->json([
            'result' => $result->result,
            'score'  => $result->score,
            'reason' => $result->reason,
            'code'   => $result->code,
        ]);
    }

    public function result(string $code)
    {
        $v = \App\Models\Verification::where('code', $code)->firstOrFail();
        return response()->json([
            'student_name'    => $v->student_name,
            'roll_number'     => $v->roll_number,
            'degree_title'    => $v->degree_title,
            'university_name' => $v->university_name,
            'graduation_year' => $v->graduation_year,
            'result'          => $v->result,
            'score'           => $v->score,
            'reason'          => $v->reason,
            'verified_at'     => $v->created_at,
        ]);
    }

    public function usage(Request $request)
    {
        $apiKey = \App\Models\ApiKey::where('user_id', $request->api_key_user_id)->first();
        return response()->json([
            'monthly_limit'      => $apiKey->monthly_limit,
            'usage_this_month'   => $apiKey->usage_this_month,
            'remaining'          => $apiKey->monthly_limit - $apiKey->usage_this_month,
            'last_used_at'       => $apiKey->last_used_at,
        ]);
    }
}