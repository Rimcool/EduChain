<?php

return [

    /*
    |--------------------------------------------------------------------------
    | OCR Service Configuration
    |--------------------------------------------------------------------------
    |
    | This configuration file allows you to configure the OCR service used for
    | extracting text from degree certificate images. You can choose between
    | different OCR providers or use the built-in sample service for testing.
    |
    */

    'default' => env('OCR_SERVICE', 'sample'),

    'services' => [

        'sample' => [
            'driver' => 'sample',
            'description' => 'Sample OCR service for demonstration purposes',
        ],

        'google_vision' => [
            'driver' => 'google_vision',
            'api_key' => env('GOOGLE_VISION_API_KEY'),
            'project_id' => env('GOOGLE_VISION_PROJECT_ID'),
        ],

        'aws_textract' => [
            'driver' => 'aws_textract',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
        ],

        'azure_computer_vision' => [
            'driver' => 'azure_computer_vision',
            'endpoint' => env('AZURE_CV_ENDPOINT'),
            'key' => env('AZURE_CV_KEY'),
        ],

        'tesseract' => [
            'driver' => 'tesseract',
            'path' => env('TESSERACT_PATH', '/usr/bin/tesseract'),
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | OCR Processing Settings
    |--------------------------------------------------------------------------
    |
    | Configure how OCR processing should work, including timeouts, retry logic,
    | and file size limits.
    |
    */

    'processing' => [
        'timeout' => env('OCR_TIMEOUT', 30),
        'max_file_size' => env('OCR_MAX_FILE_SIZE', 10240), // 10MB
        'supported_formats' => ['jpg', 'jpeg', 'png', 'pdf'],
        'retry_attempts' => env('OCR_RETRY_ATTEMPTS', 3),
    ],

    /*
    |--------------------------------------------------------------------------
    | Text Parsing Settings
    |--------------------------------------------------------------------------
    |
    | Configure how the extracted text should be parsed to extract degree
    | information. You can customize the regex patterns and parsing logic.
    |
    */

    'parsing' => [
        'name_patterns' => [
            '/STUDENT NAME[:\s]+(.+)/i',
            '/NAME[:\s]+(.+)/i',
            '/^[A-Z][A-Z\s]{2,}$/i',
        ],
        'roll_patterns' => [
            '/ROLL NUMBER[:\s]+(.+)/i',
            '/REGISTRATION[:\s]+(.+)/i',
            '/ROLL[:\s]+(.+)/i',
        ],
        'degree_patterns' => [
            '/BACHELOR OF SCIENCE/i',
            '/BACHELOR OF ENGINEERING/i',
            '/MASTER OF SCIENCE/i',
            '/DOCTOR OF PHILOSOPHY/i',
            '/B\.?S\.?\s+(.+)/i',
            '/B\.?E\.?\s+(.+)/i',
        ],
        'university_patterns' => [
            '/UNIVERSITY OF (.+)/i',
            '/(.+) UNIVERSITY/i',
            '/(.+) COLLEGE/i',
        ],
        'year_patterns' => [
            '/DEGREE AWARDED[:\s]+(\d{4})/i',
            '/SESSION[:\s]+(\d{4})-(\d{4})/i',
            '/GRADUATED[:\s]+(\d{4})/i',
            '/(\d{4})/i',
        ],
    ],

];