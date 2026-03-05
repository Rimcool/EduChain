<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\University;
use App\Models\IssuedDegree;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VerifyDegreeTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create a test user with recruiter role
        $this->user = User::factory()->create([
            'role' => 'recruiter',
        ]);

        // Create a test university
        $this->university = University::create([
            'name' => 'Test University',
            'category' => 'General',
            'established_since' => 2000,
            'is_on_educhain' => true,
            'is_blacklisted' => false,
            'location' => 'Test City',
            'email' => 'test@university.com',
        ]);
    }

    public function test_degree_verification_with_valid_data()
    {
        // Create an issued degree for testing
        $issuedDegree = IssuedDegree::create([
            'student_name' => 'John Doe',
            'roll_number' => 'CS2020001',
            'degree_title' => 'Bachelor of Science in Computer Science',
            'university_name' => 'Test University',
            'graduation_year' => 2020,
            'degree_hash' => 'test_hash_123',
        ]);

        $response = $this->actingAs($this->user)
            ->post('/verify/check', [
                'student_name' => 'John Doe',
                'roll_number' => 'CS2020001',
                'degree_title' => 'Bachelor of Science in Computer Science',
                'university_name' => 'Test University',
                'graduation_year' => 2020,
            ]);

        $response->assertStatus(200);
        $response->assertJson([
            'result' => 'fake',
            'score' => 5,
        ]);
    }

    public function test_degree_verification_with_university_not_on_educhain()
    {
        // Create university not on EduChain
        $university = University::create([
            'name' => 'Non EduChain University',
            'category' => 'General',
            'established_since' => 2010,
            'is_on_educhain' => false,
            'is_blacklisted' => false,
            'location' => 'Test City',
            'email' => 'nonchain@university.com',
        ]);

        $response = $this->actingAs($this->user)
            ->post('/verify/check', [
                'student_name' => 'Jane Doe',
                'roll_number' => 'CS2021001',
                'degree_title' => 'Bachelor of Science in Computer Science',
                'university_name' => 'Non EduChain University',
                'graduation_year' => 2021,
            ]);

        $response->assertStatus(200);
        $response->assertJson([
            'result' => 'unconfirmed',
            'score' => 65,
        ]);
    }

    public function test_degree_verification_with_blacklisted_university()
    {
        // Create blacklisted university
        $blacklistedUniversity = University::create([
            'name' => 'Blacklisted University',
            'category' => 'General',
            'established_since' => 2015,
            'is_on_educhain' => false,
            'is_blacklisted' => true,
            'location' => 'Test City',
            'email' => 'blacklisted@university.com',
        ]);

        $response = $this->actingAs($this->user)
            ->post('/verify/check', [
                'student_name' => 'Fake Student',
                'roll_number' => 'FAKE001',
                'degree_title' => 'Fake Degree',
                'university_name' => 'Blacklisted University',
                'graduation_year' => 2022,
            ]);

        $response->assertStatus(200);
        $response->assertJson([
            'result' => 'fake',
            'score' => 0,
        ]);
    }

    public function test_degree_verification_with_future_graduation_year()
    {
        $response = $this->actingAs($this->user)
            ->post('/verify/check', [
                'student_name' => 'Future Student',
                'roll_number' => 'FUTURE001',
                'degree_title' => 'Future Degree',
                'university_name' => 'Test University',
                'graduation_year' => date('Y') + 1, // Future year
            ]);

        $response->assertStatus(302); // Redirect due to validation error
    }

    public function test_ocr_endpoint_requires_authentication()
    {
        $response = $this->post('/verify/ocr', []);
        $response->assertStatus(302); // Redirect to login
    }

    public function test_ocr_endpoint_with_valid_image()
    {
        // Create a test image file
        $image = \Illuminate\Http\UploadedFile::fake()->image('degree.jpg');

        $response = $this->actingAs($this->user)
            ->post('/verify/ocr', [
                'image' => $image,
            ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'data' => [
                'student_name',
                'roll_number',
                'degree_title',
                'university_name',
                'graduation_year',
            ],
            'extracted_text',
        ]);
    }

    public function test_verify_route_requires_authentication()
    {
        $response = $this->get('/verify');
        $response->assertStatus(302); // Redirect to login
    }

    public function test_verify_route_with_authenticated_user()
    {
        $response = $this->actingAs($this->user)
            ->get('/verify');

        $response->assertStatus(200);
        $response->assertViewIs('verify.index');
    }
}