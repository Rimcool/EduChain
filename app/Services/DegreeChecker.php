<?php

namespace App\Services;

use App\Models\University;
use App\Models\IssuedDegree;
use App\Models\Verification;

class DegreeChecker
{
    public function __construct(private HashService $hasher) {}

    public function check(array $data, int $userId): Verification
    {
        // ── LAYER 1: HEC Database ──────────────────────────
        $university = University::findByName($data['university_name']);

        if (!$university) {
            return $this->save($data, $userId, [
                'result' => 'fake',
                'score'  => 0,
                'reason' => '"' . $data['university_name'] . '" is not recognized by HEC. This institution does not legally exist in Pakistan.',
                'layers' => [
                    ['pass' => false, 'name' => 'HEC Database',   'msg' => 'University not found in HEC database of 266 accredited institutions', 'grade' => 'F'],
                    ['pass' => null,  'name' => 'Temporal Check',  'msg' => 'Skipped', 'grade' => '—'],
                    ['pass' => null,  'name' => 'Degree Type',     'msg' => 'Skipped', 'grade' => '—'],
                    ['pass' => null,  'name' => 'Blockchain',      'msg' => 'Skipped', 'grade' => '—'],
                ],
            ]);
        }

        if ($university->is_blacklisted) {
            return $this->save($data, $userId, [
                'result' => 'fake',
                'score'  => 0,
                'reason' => $university->name . ' is blacklisted by HEC. Degrees from this institution are not valid.',
                'layers' => [
                    ['pass' => false, 'name' => 'HEC Database',  'msg' => 'University is on HEC blacklist', 'grade' => 'F'],
                    ['pass' => null,  'name' => 'Temporal Check', 'msg' => 'Skipped', 'grade' => '—'],
                    ['pass' => null,  'name' => 'Degree Type',    'msg' => 'Skipped', 'grade' => '—'],
                    ['pass' => null,  'name' => 'Blockchain',     'msg' => 'Skipped', 'grade' => '—'],
                ],
            ]);
        }

        $layers = [
            ['pass' => true, 'name' => 'HEC Database', 'msg' => 'University confirmed: ' . $university->name, 'grade' => 'A+'],
        ];

        // ── LAYER 2: Temporal Check ────────────────────────
        $gradYear    = (int) $data['graduation_year'];
        $established = (int) ($university->established_since ?? 1947);

        if ($gradYear > (int) date('Y')) {
            $layers[] = ['pass' => false, 'name' => 'Temporal Check', 'msg' => 'Graduation year ' . $gradYear . ' is in the future', 'grade' => 'F'];
            $layers[] = ['pass' => null,  'name' => 'Degree Type', 'msg' => 'Skipped', 'grade' => '—'];
            $layers[] = ['pass' => null,  'name' => 'Blockchain',  'msg' => 'Skipped', 'grade' => '—'];
            return $this->save($data, $userId, ['result'=>'fake','score'=>0,'reason'=>'Graduation year '.$gradYear.' is in the future.','layers'=>$layers]);
        }

        if ($gradYear < $established + 2) {
            $layers[] = ['pass' => false, 'name' => 'Temporal Check', 'msg' => 'University established ' . $established . ' — impossible to graduate in ' . $gradYear, 'grade' => 'F'];
            $layers[] = ['pass' => null,  'name' => 'Degree Type', 'msg' => 'Skipped', 'grade' => '—'];
            $layers[] = ['pass' => null,  'name' => 'Blockchain',  'msg' => 'Skipped', 'grade' => '—'];
            return $this->save($data, $userId, ['result'=>'fake','score'=>0,'reason'=>$university->name.' established '.$established.'. Cannot have issued degree in '.$gradYear.'.','layers'=>$layers]);
        }

        $layers[] = ['pass' => true, 'name' => 'Temporal Check', 'msg' => 'University operating since ' . $established . ', year ' . $gradYear . ' valid', 'grade' => 'A+'];

        // ── LAYER 3: Degree Type ───────────────────────────
        $degreeCheck = $this->checkDegreeType($data['degree_title'], $university->category ?? '');

        if (!$degreeCheck['allowed']) {
            $layers[] = ['pass' => false, 'name' => 'Degree Type', 'msg' => $degreeCheck['reason'], 'grade' => 'F'];
            $layers[] = ['pass' => null,  'name' => 'Blockchain',  'msg' => 'Skipped', 'grade' => '—'];
            return $this->save($data, $userId, ['result'=>'fake','score'=>0,'reason'=>$degreeCheck['reason'],'layers'=>$layers]);
        }

        $layers[] = ['pass' => true, 'name' => 'Degree Type', 'msg' => 'Degree type consistent with university category', 'grade' => 'A'];

        // ── LAYER 4: Blockchain ────────────────────────────
        $hash   = $this->hasher->generate($data);
        $issued = IssuedDegree::where('degree_hash', $hash)->first();

        if ($issued) {
            $layers[] = ['pass' => true, 'name' => 'Blockchain', 'msg' => 'Hash match confirmed — university issued this degree', 'grade' => 'A+'];
            return $this->save($data, $userId, [
                'result' => 'real',
                'score'  => 100,
                'reason' => 'CONFIRMED: ' . $university->name . ' verified this degree was issued to ' . $data['student_name'] . '.',
                'layers' => $layers,
            ]);
        }

        if ($university->is_on_educhain) {
            $layers[] = ['pass' => false, 'name' => 'Blockchain', 'msg' => $university->name . ' is on EduChain but has NO record of this degree', 'grade' => 'F'];
            return $this->save($data, $userId, [
                'result' => 'fake',
                'score'  => 5,
                'reason' => 'FRAUDULENT: ' . $university->name . ' is on EduChain but has no record of this degree.',
                'layers' => $layers,
            ]);
        }

        $layers[] = ['pass' => null, 'name' => 'Blockchain', 'msg' => $university->name . ' has not joined EduChain yet', 'grade' => 'B'];
        return $this->save($data, $userId, [
            'result' => 'unconfirmed',
            'score'  => 65,
            'reason' => 'UNCONFIRMED: University is HEC accredited but has not joined EduChain. Cannot confirm or deny this specific degree.',
            'layers' => $layers,
        ]);
    }

    private function checkDegreeType(string $title, string $category): array
    {
        $title    = strtolower($title);
        $category = strtolower($category);

        $rules = [
            'medical'     => ['cannot' => ['computer science', 'software', 'business administration', 'engineering']],
            'agriculture' => ['cannot' => ['medicine', 'surgery', 'mbbs', 'computer science', 'software']],
            'law'         => ['cannot' => ['medicine', 'engineering', 'computer science']],
        ];

        foreach ($rules as $cat => $rule) {
            if (str_contains($category, $cat)) {
                foreach ($rule['cannot'] as $banned) {
                    if (str_contains($title, $banned)) {
                        return [
                            'allowed' => false,
                            'reason'  => 'A ' . ucfirst($cat) . ' university cannot issue a "' . $title . '" degree',
                        ];
                    }
                }
            }
        }

        return ['allowed' => true, 'reason' => ''];
    }

    private function save(array $data, int $userId, array $outcome): Verification
    {
        return Verification::create([
            'user_id'      => $userId,
            'student_name' => $data['student_name'],
            'roll_number'  => $data['roll_number'],
            'degree_title' => $data['degree_title'],
            'university_name' => $data['university_name'],
            'graduation_year' => $data['graduation_year'],
            'degree_hash'  => $this->hasher->generate($data),
            'result'       => $outcome['result'],
            'score'        => $outcome['score'],
            'checks'       => json_encode($outcome['layers']),
            'reason'       => $outcome['reason'],
            'code'         => 'EDU-' . strtoupper(substr(md5(uniqid()), 0, 8)),
        ]);
    }
}