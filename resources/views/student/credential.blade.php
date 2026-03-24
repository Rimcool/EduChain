<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Claim Your Degree') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Claim Degree Form -->
                    <div class="bg-gradient-to-r from-purple-500 to-pink-500 text-white p-8 rounded-lg mb-8">
                        <h3 class="text-2xl font-bold mb-4">Claim Your Digital Credential</h3>
                        <p class="opacity-90 mb-6">Upload your degree certificate to receive your blockchain-verified digital credential.</p>
                        
                        <form action="{{ route('student.credential.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                            @csrf
                            
                            <div>
                                <label for="degree_file" class="block text-sm font-medium mb-2">Upload Degree Certificate</label>
                                <input type="file" name="degree_file" id="degree_file" accept=".pdf,.jpg,.jpeg,.png" required
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-white file:text-purple-700 hover:file:bg-gray-100">
                                <p class="text-xs text-purple-200 mt-1">Accepted formats: PDF, JPG, PNG (Max 5MB)</p>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="university_name" class="block text-sm font-medium mb-2">University Name</label>
                                    <input type="text" name="university_name" id="university_name" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                </div>
                                
                                <div>
                                    <label for="degree_name" class="block text-sm font-medium mb-2">Degree Name</label>
                                    <input type="text" name="degree_name" id="degree_name" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label for="graduation_date" class="block text-sm font-medium mb-2">Graduation Date</label>
                                    <input type="date" name="graduation_date" id="graduation_date" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                </div>
                                
                                <div>
                                    <label for="student_id" class="block text-sm font-medium mb-2">Student ID</label>
                                    <input type="text" name="student_id" id="student_id" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                </div>
                                
                                <div>
                                    <label for="cgpa" class="block text-sm font-medium mb-2">CGPA</label>
                                    <input type="number" name="cgpa" id="cgpa" step="0.01" min="0" max="4.0"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                </div>
                            </div>

                            <div class="flex items-center space-x-4">
                                <input type="checkbox" id="terms" name="terms" required class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                <label for="terms" class="text-sm">
                                    I agree to the terms and conditions and confirm that the uploaded document is authentic.
                                </label>
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" 
                                    class="bg-white text-purple-600 hover:bg-gray-100 font-semibold py-2 px-6 rounded-full transition duration-300 transform hover:scale-105">
                                    Submit for Verification
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- How it works -->
                    <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">How It Works</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="text-center">
                                <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <span class="text-purple-600 dark:text-purple-300 text-xl">📄</span>
                                </div>
                                <h4 class="font-medium mb-2">1. Upload Document</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-300">Submit your degree certificate in PDF or image format</p>
                            </div>
                            
                            <div class="text-center">
                                <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <span class="text-purple-600 dark:text-purple-300 text-xl">🔍</span>
                                </div>
                                <h4 class="font-medium mb-2">2. Verification</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-300">Our system verifies the authenticity using AI and blockchain</p>
                            </div>
                            
                            <div class="text-center">
                                <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <span class="text-purple-600 dark:text-purple-300 text-xl">✅</span>
                                </div>
                                <h4 class="font-medium mb-2">3. Get Credential</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-300">Receive your verified digital credential with QR code</p>
                            </div>
                        </div>
                    </div>

                    <!-- Status Section -->
                    <div class="mt-8 bg-white dark:bg-gray-700 p-6 rounded-lg border border-gray-200 dark:border-gray-600">
                        <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">Your Credentials Status</h3>
                        <div class="space-y-4">
                            <!-- This would be populated with actual credentials from the database -->
                            <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-600 rounded-lg">
                                <div>
                                    <h4 class="font-medium">Bachelor of Science in Computer Science</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-300">University of Example - 2023</p>
                                </div>
                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                    Verified
                                </span>
                            </div>
                            
                            <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-600 rounded-lg">
                                <div>
                                    <h4 class="font-medium">Master of Business Administration</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-300">Example Business School - 2025</p>
                                </div>
                                <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">
                                    Pending
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>