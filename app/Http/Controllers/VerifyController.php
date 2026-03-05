<?php

namespace App\Http\Controllers;

use App\Services\{DegreeChecker, PdfService};
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
            'graduation_year' => 'required|digits:4|integer|min:1947|max:'.date('Y'),
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

    public function bulk(Request $request)
    {
        $request->validate(['file' => 'required|file|mimes:csv,txt']);

        $rows    = array_map('str_getcsv', file($request->file('file')->path()));
        $headers = array_shift($rows);
        $results = [];

        foreach ($rows as $row) {
            if (count($row) < 5) continue;

            $data = [
                'student_name'    => $row[0] ?? '',
                'university_name' => $row[1] ?? '',
                'degree_title'    => $row[2] ?? '',
                'roll_number'     => $row[3] ?? '',
                'graduation_year' => $row[4] ?? '',
            ];

            $result    = $this->checker->check($data, auth()->id());
            $results[] = [
                'student_name' => $data['student_name'],
                'university'   => $data['university_name'],
                'result'       => $result->result,
                'score'        => $result->score,
                'code'         => $result->code,
            ];
        }

        return response()->json(['results' => $results]);
    }

    public function pdf(string $code)
    {
        $v = Verification::where('code', $code)
               ->where('user_id', auth()->id())
               ->firstOrFail();

        $pdf = app(PdfService::class)->certificate($v);
        return $pdf->download('EduChain-' . $code . '.pdf');
    }

    public function history()
    {
        $verifications = Verification::where('user_id', auth()->id())
            ->latest()
            ->paginate(10);
        
        return view('verify.history', compact('verifications'));
    }

    public function publicResult(string $code)
    {
        $v = Verification::where('code', $code)->firstOrFail();
        return view('verify.result', compact('v'));
    }

    public function ocr(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $image = $request->file('image');
        $ocrService = app(\App\Services\OCRService::class);
        
        try {
            $extractedText = $ocrService->extractText($image);
            $parsedData = $ocrService->parseDegreeData($extractedText);
            $validationErrors = $ocrService->validateData($parsedData);

            return response()->json([
                'success' => empty($validationErrors),
                'data' => $parsedData,
                'errors' => $validationErrors,
                'extracted_text' => $extractedText,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Failed to process image: ' . $e->getMessage(),
            ], 500);
        }
    }
}