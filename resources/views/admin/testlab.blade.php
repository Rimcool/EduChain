<x-app-layout>
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">🧪 EduChain Test Lab</h1>
                <p class="text-lg text-gray-600 dark:text-gray-300">Click any scenario to see how the result screen looks</p>
            </div>

            <!-- Test Scenarios Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($testVerifications as $verification)
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-xl transition-shadow duration-300">
                        <div class="p-6">
                            <!-- Test Scenario Label -->
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    {{ $verification->test_scenario }}
                                </h3>
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300 text-sm font-medium rounded-full">
                                    Test Scenario
                                </span>
                            </div>

                            <!-- Degree Information -->
                            <div class="space-y-3 mb-6">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600 dark:text-gray-400">Student:</span>
                                    <span class="font-medium text-gray-900 dark:text-white">{{ $verification->student_name }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600 dark:text-gray-400">University:</span>
                                    <span class="font-medium text-gray-900 dark:text-white">{{ $verification->university_name }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600 dark:text-gray-400">Degree:</span>
                                    <span class="font-medium text-gray-900 dark:text-white">{{ $verification->degree_title }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600 dark:text-gray-400">Roll No:</span>
                                    <span class="font-medium text-gray-900 dark:text-white">{{ $verification->roll_number }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600 dark:text-gray-400">Year:</span>
                                    <span class="font-medium text-gray-900 dark:text-white">{{ $verification->graduation_year }}</span>
                                </div>
                            </div>

                            <!-- Expected Result -->
                            <div class="mb-6">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-600 dark:text-gray-400">Expected Result:</span>
                                    <span class="px-3 py-1 bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300 text-sm font-medium rounded-full">
                                        {{ ucfirst($verification->result) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Action Button -->
                            <div class="flex justify-end">
                                <a href="{{ route('verify.result', $verification->code) }}"
                                   class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-gradient-to-r from-green-500 to-cyan-500 hover:from-green-600 hover:to-cyan-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200 transform hover:scale-105 shadow-lg">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    View Result Screen
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Instructions -->
            <div class="mt-12 bg-gray-50 dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">How to Use the Test Lab</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-sm text-gray-700 dark:text-gray-300">
                    <div>
                        <h3 class="font-medium text-gray-900 dark:text-white mb-2">1. View Test Results</h3>
                        <p>Click any scenario card to see how the verification result screen looks for different test cases.</p>
                    </div>
                    <div>
                        <h3 class="font-medium text-gray-900 dark:text-white mb-2">2. Test Different Scenarios</h3>
                        <p>Each scenario represents a different verification outcome: fully verified, partially verified, fake university, or real university with fake degree.</p>
                    </div>
                    <div>
                        <h3 class="font-medium text-gray-900 dark:text-white mb-2">3. Development Testing</h3>
                        <p>Use these scenarios to test your UI changes, verify the result display logic, and ensure the test mode banner appears correctly.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>