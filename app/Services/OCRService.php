<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Config;

class OCRService
{
    /**
     * Extract text from an uploaded image file
     */
    public function extractText(UploadedFile $image): string
    {
        try {
            $service = Config::get('ocr.default', 'sample');
            
            switch ($service) {
                case 'google_vision':
                    return $this->extractWithGoogleVision($image);
                case 'aws_textract':
                    return $this->extractWithAWSTextract($image);
                case 'azure_computer_vision':
                    return $this->extractWithAzureCV($image);
                case 'tesseract':
                    return $this->extractWithTesseract($image);
                default:
                    return $this->getSampleText();
            }
            
        } catch (\Exception $e) {
            Log::error('OCR Service Error: ' . $e->getMessage());
            throw new \Exception('Failed to process image for text extraction');
        }
    }

    /**
     * Parse extracted text to extract degree information
     */
    public function parseDegreeData(string $text): array
    {
        $text = strtoupper($text);
        $lines = explode("\n", $text);
        
        $data = [
            'student_name' => '',
            'roll_number' => '',
            'degree_title' => '',
            'university_name' => '',
            'graduation_year' => ''
        ];

        foreach ($lines as $line) {
            $line = trim($line);
            
            // Extract student name with multiple patterns
            if (preg_match('/STUDENT NAME[:\s]+(.+)/i', $line, $matches)) {
                $data['student_name'] = trim(preg_replace('/[^A-Za-z\s]/', '', $matches[1]));
            } elseif (preg_match('/NAME[:\s]+(.+)/i', $line, $matches) && empty($data['student_name'])) {
                $data['student_name'] = trim(preg_replace('/[^A-Za-z\s]/', '', $matches[1]));
            } elseif (preg_match('/^[A-Z][A-Z\s]{2,}$/i', $line) && strlen($line) > 3 && empty($data['student_name'])) {
                // Fallback: assume long lines with only letters might be names
                $data['student_name'] = trim($line);
            }
            
            // Extract roll number with multiple patterns
            if (preg_match('/ROLL NUMBER[:\s]+(.+)/i', $line, $matches)) {
                $data['roll_number'] = trim($matches[1]);
            } elseif (preg_match('/REGISTRATION[:\s]+(.+)/i', $line, $matches)) {
                $data['roll_number'] = trim($matches[1]);
            } elseif (preg_match('/ROLL[:\s]+(.+)/i', $line, $matches)) {
                $data['roll_number'] = trim($matches[1]);
            }
            
            // Extract degree title with multiple patterns
            if (preg_match('/BACHELOR OF SCIENCE/i', $line)) {
                $data['degree_title'] = 'Bachelor of Science in Computer Science';
            } elseif (preg_match('/BACHELOR OF ENGINEERING/i', $line)) {
                $data['degree_title'] = 'Bachelor of Engineering';
            } elseif (preg_match('/MASTER OF SCIENCE/i', $line)) {
                $data['degree_title'] = 'Master of Science';
            } elseif (preg_match('/DOCTOR OF PHILOSOPHY/i', $line)) {
                $data['degree_title'] = 'Doctor of Philosophy';
            } elseif (preg_match('/B\.?S\.?\s+(.+)/i', $line, $matches)) {
                $data['degree_title'] = 'Bachelor of Science in ' . trim($matches[1]);
            } elseif (preg_match('/B\.?E\.?\s+(.+)/i', $line, $matches)) {
                $data['degree_title'] = 'Bachelor of Engineering in ' . trim($matches[1]);
            }
            
            // Extract university name with multiple patterns
            if (preg_match('/UNIVERSITY OF (.+)/i', $line, $matches)) {
                $data['university_name'] = 'University of ' . trim($matches[1]);
            } elseif (preg_match('/(.+) UNIVERSITY/i', $line, $matches)) {
                $data['university_name'] = trim($matches[1]) . ' University';
            } elseif (preg_match('/(.+) COLLEGE/i', $line, $matches)) {
                $data['university_name'] = trim($matches[1]) . ' College';
            }
            
            // Extract graduation year with multiple patterns
            if (preg_match('/DEGREE AWARDED[:\s]+(\d{4})/i', $line, $matches)) {
                $data['graduation_year'] = $matches[1];
            } elseif (preg_match('/SESSION[:\s]+(\d{4})-(\d{4})/i', $line, $matches)) {
                $data['graduation_year'] = $matches[2];
            } elseif (preg_match('/GRADUATED[:\s]+(\d{4})/i', $line, $matches)) {
                $data['graduation_year'] = $matches[1];
            } elseif (preg_match('/(\d{4})/i', $line, $matches)) {
                $year = $matches[1];
                if ($year >= 1947 && $year <= date('Y')) {
                    $data['graduation_year'] = $year;
                }
            }
        }

        return $data;
    }

    /**
     * Get sample text for demonstration purposes
     */
    private function getSampleText(): string
    {
        return "UNIVERSITY OF EXAMPLE
FACULTY OF ENGINEERING
Bachelor of Science in Computer Science
Student Name: John Doe
Roll Number: CS2020001
Registration Number: 2020-BCS-001
Date of Birth: 01/01/2000
Session: 2016-2020
CGPA: 3.8/4.0
Degree Awarded: 2020
University Code: UET001";
    }

    /**
     * Extract text using Google Cloud Vision API
     */
    private function extractWithGoogleVision(UploadedFile $image): string
    {
        // TODO: Implement Google Cloud Vision API integration
        // This would require the google/cloud-vision package
        return $this->getSampleText();
    }

    /**
     * Extract text using AWS Textract
     */
    private function extractWithAWSTextract(UploadedFile $image): string
    {
        // TODO: Implement AWS Textract integration
        // This would require the aws/aws-sdk-php package
        return $this->getSampleText();
    }

    /**
     * Extract text using Azure Computer Vision
     */
    private function extractWithAzureCV(UploadedFile $image): string
    {
        // TODO: Implement Azure Computer Vision API integration
        return $this->getSampleText();
    }

    /**
     * Extract text using Tesseract OCR
     */
    private function extractWithTesseract(UploadedFile $image): string
    {
        // TODO: Implement Tesseract OCR integration
        // This would require the thiagoalessio/tesseract-ocr package
        return $this->getSampleText();
    }

    /**
     * Validate extracted data
     */
    public function validateData(array $data): array
    {
        $errors = [];
        
        if (empty($data['student_name'])) {
            $errors[] = 'Student name not found in the document';
        }
        
        if (empty($data['degree_title'])) {
            $errors[] = 'Degree title not found in the document';
        }
        
        if (empty($data['university_name'])) {
            $errors[] = 'University name not found in the document';
        }
        
        if (empty($data['graduation_year']) || !is_numeric($data['graduation_year'])) {
            $errors[] = 'Valid graduation year not found in the document';
        }
        
        return $errors;
    }
}