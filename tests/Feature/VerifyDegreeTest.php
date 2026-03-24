<?php

namespace Tests\Feature;

use App\Models\University;
use App\Models\IssuedDegree;
use App\Models\Verification;
use App\Services\DegreeChecker;
use App\Services\HashService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VerifyDegreeTest extends TestCase
{
    use RefreshDatabase;

    private DegreeChecker $checker;
    private HashService $hasher;

    protected function setUp(): void
    {
        parent::setUp();
        $this->hasher = new HashService();
        $this->checker = new DegreeChecker($this->hasher);
    }

    public function test_instant_verification_flow()
    {
// Create a test university
$university = University::create([
    'name' => 'Test University',
    'location' => 'Test City',
    'email' => 'test@university.edu',
    'category' => 'general',
    'established_since' => 1990,
    'is_blacklisted' => false,
    'is_on_educhain' => true,
]);

// Add to HEC database
$hecUniversities = [
    'Test University',
    'Another University', // For other test cases
];
foreach ($hecUniversities as $name) {
    \App\Models\University::create([
        'name' => $name,
        'location' => 'Test City',
        'email' => strtolower(str_replace(' ', '', $name)) . '@university.edu',
        'category' => 'general',
        'established_since' => 1990,
        'is_blacklisted' => false,
        'is_on_educhain' => true,
    ]);
}

        // Test case 1: Fake university (not in HEC database)
        $fakeData = [
            'student_name' => 'John Doe',
            'roll_number' => '12345',
            'degree_title' => 'Bachelor of Science',
            'university_name' => 'Nonexistent University',
            'graduation_year' => '2020',
        ];

        $result = $this->checker->check($fakeData);
        $this->assertEquals('fake', $result->result);
        $this->assertEquals(0, $result->score);
        $this->assertStringContainsString('not recognized by HEC', $result->reason);

        // Test case 2: Valid university but fake degree (not on EduChain)
        $validData = [
            'student_name' => 'Jane Smith',
            'roll_number' => '67890',
            'degree_title' => 'Bachelor of Engineering',
            'university_name' => 'Test University',
            'graduation_year' => '2020',
        ];

$result = $this->checker->check($validData);
// Debug: Check what result we're actually getting
// echo "Result: " . $result->result . "\n";
// echo "Score: " . $result->score . "\n";
// echo "Reason: " . $result->reason . "\n";
$this->assertEquals('fake', $result->result);
        $this->assertEquals(5, $result->score);
        $this->assertStringContainsString('FRAUDULENT', $result->reason);

        // Test case 3: Real degree (exists on EduChain)
        $realData = [
            'student_name' => 'Alice Johnson',
            'roll_number' => '11223',
            'degree_title' => 'Bachelor of Medicine',
            'university_name' => 'Test University',
            'graduation_year' => '2020',
        ];

        // Create a real issued degree
        $hash = $this->hasher->generate($realData);
        IssuedDegree::create([
            'degree_hash' => $hash,
            'university_id' => $university->id,
            'student_name' => $realData['student_name'],
            'roll_number' => $realData['roll_number'],
            'degree_title' => $realData['degree_title'],
            'graduation_year' => $realData['graduation_year'],
            'issued_at' => now(),
        ]);

        $result = $this->checker->check($realData);
        $this->assertEquals('real', $result->result);
        $this->assertEquals(100, $result->score);
        $this->assertStringContainsString('CONFIRMED', $result->reason);

        // Test case 4: Temporal check failure (future year)
        $futureData = [
            'student_name' => 'Bob Brown',
            'roll_number' => '44556',
            'degree_title' => 'Bachelor of Science',
            'university_name' => 'Test University',
            'graduation_year' => (string)(date('Y') + 1),
        ];

        $result = $this->checker->check($futureData);
        $this->assertEquals('fake', $result->result);
        $this->assertEquals(0, $result->score);
        $this->assertStringContainsString('is in the future', $result->reason);

        // Test case 5: Temporal check failure (university too young)
        $youngData = [
            'student_name' => 'Charlie Green',
            'roll_number' => '77889',
            'degree_title' => 'Bachelor of Science',
            'university_name' => 'Test University',
            'graduation_year' => '1985', // University established in 1990
        ];

        $result = $this->checker->check($youngData);
        $this->assertEquals('fake', $result->result);
        $this->assertEquals(0, $result->score);
        $this->assertStringContainsString('established', $result->reason);

        // Test case 6: Degree type mismatch
        $mismatchData = [
            'student_name' => 'Diana White',
            'roll_number' => '99001',
            'degree_title' => 'Bachelor of Medicine',
            'university_name' => 'Test University',
            'graduation_year' => '2020',
        ];

        // Change university to medical category
        $university->update(['category' => 'medical']);
        $result = $this->checker->check($mismatchData);
        $this->assertEquals('fake', $result->result);
        $this->assertEquals(0, $result->score);
        $this->assertStringContainsString('cannot issue', $result->reason);

        $this->assertEquals(6, Verification::count(), 'Should have created 6 verification records');
    }

    public function test_public_verification_endpoint()
    {
        // Create a test university first
        University::create([
            'name' => 'Test University',
            'location' => 'Test City',
            'email' => 'test@university.edu',
            'category' => 'general',
            'established_since' => 1990,
            'is_blacklisted' => false,
            'is_on_educhain' => true,
        ]);

        $this->post('/api/verify/public', [
            'student_name' => 'Test User',
            'roll_number' => '12345',
            'degree_title' => 'Bachelor of Science',
            'university_name' => 'Test University',
            'graduation_year' => '2020',
        ])->assertStatus(200)
        ->assertJsonStructure([
            'result',
            'score',
            'reason',
            'layers',
            'code',
        ]);
    }

    public function test_animated_scanning_matches_verification_layers()
    {
        $data = [
            'student_name' => 'Animated Test',
            'roll_number' => '54321',
            'degree_title' => 'Bachelor of Science',
            'university_name' => 'Test University',
            'graduation_year' => '2020',
        ];

        $result = $this->checker->check($data);

// Should have exactly 4 layers matching the animated scanning
$layers = json_decode($result->checks, true);
$this->assertCount(4, $layers);

        $this->assertEquals('HEC Database', $layers[0]['name']);
        $this->assertEquals('Temporal Check', $layers[1]['name']);
        $this->assertEquals('Degree Type', $layers[2]['name']);
        $this->assertEquals('Blockchain', $layers[3]['name']);
    }
}