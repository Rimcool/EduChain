<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">Degree Verification</h1>
                <p class="text-lg text-gray-600 dark:text-gray-300">Verify any degree using our blockchain-powered system</p>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
                <!-- Form Section -->
                <div class="p-8">
                    <form id="verify-form" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="student_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        Student Name
                                    </span>
                                </label>
                                <input type="text" name="student_name" id="student_name" required
                                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all duration-200"
                                       placeholder="Enter full name">
                            </div>

                            <div>
                                <label for="roll_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        Roll Number
                                    </span>
                                </label>
                                <input type="text" name="roll_number" id="roll_number" required
                                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all duration-200"
                                       placeholder="Enter roll number">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="degree_title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                        </svg>
                                        Degree Title
                                    </span>
                                </label>
                                <input type="text" name="degree_title" id="degree_title" required
                                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-purple-500 focus:border-purple-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all duration-200"
                                       placeholder="Enter degree title">
                            </div>

                            <div>
                                <label for="graduation_year" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        Graduation Year
                                    </span>
                                </label>
                                <input type="number" name="graduation_year" id="graduation_year" required min="1947" max="{{ date('Y') }}"
                                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all duration-200"
                                       placeholder="e.g., 2020">
                            </div>
                        </div>

                        <div>
                            <label for="university_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                    University Name
                                </span>
                            </label>
                            <div class="relative">
                                <input type="text" name="university_name" id="university_name" required
                                       class="w-full px-4 py-3 pr-10 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all duration-200"
                                       placeholder="Start typing to search universities...">
                                <div id="university-suggestions" class="absolute z-10 w-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg mt-1 hidden max-h-40 overflow-y-auto shadow-lg">
                                    <!-- Suggestions will be populated here -->
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                    class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-gradient-to-r from-green-500 to-cyan-500 hover:from-green-600 hover:to-cyan-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200 transform hover:scale-105 shadow-lg">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                Verify Degree
                            </button>
                        </div>
                    </form>

                    <div id="result-container" class="mt-8 hidden">
                        <div class="border border-gray-600 rounded-lg p-6">
                            <div id="result-content">
                                <!-- Result will be populated here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('verify-form');
            const universityInput = document.getElementById('university_name');
            const suggestionsContainer = document.getElementById('university-suggestions');
            const resultContainer = document.getElementById('result-container');
            const resultContent = document.getElementById('result-content');

            // University search functionality
            universityInput.addEventListener('input', debounce(async function() {
                const query = this.value.trim();
                if (query.length < 2) {
                    suggestionsContainer.classList.add('hidden');
                    return;
                }

                try {
                    const response = await fetch(`/api/universities/search?q=${encodeURIComponent(query)}`);
                    const universities = await response.json();

                    if (universities.length > 0) {
                        suggestionsContainer.innerHTML = universities.map(university => `
                            <button type="button" class="block w-full text-left px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 hover:text-gray-900 dark:hover:text-white border-b border-gray-200 dark:border-gray-600 last:border-b-0"
                                    onclick="selectUniversity('${university}')">
                                ${university}
                            </button>
                        `).join('');
                        suggestionsContainer.classList.remove('hidden');
                    } else {
                        suggestionsContainer.classList.add('hidden');
                    }
                } catch (error) {
                    console.error('Error fetching universities:', error);
                    suggestionsContainer.classList.add('hidden');
                }
            }, 300));

            // Close suggestions when clicking outside
            document.addEventListener('click', function(e) {
                if (!universityInput.contains(e.target) && !suggestionsContainer.contains(e.target)) {
                    suggestionsContainer.classList.add('hidden');
                }
            });

            // Form submission
            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                resultContainer.classList.add('hidden');
                resultContent.innerHTML = '<div class="flex justify-center items-center py-8"><div class="animate-spin rounded-full h-8 w-8 border-b-2 border-green-500"></div><span class="ml-3 text-gray-600 dark:text-gray-300">Verifying...</span></div>';

                try {
                    const formData = new FormData(form);
                    const response = await fetch('/verify/check', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(Object.fromEntries(formData))
                    });

                    const result = await response.json();
                    displayResult(result);
                } catch (error) {
                    console.error('Error:', error);
                    resultContent.innerHTML = `
                        <div class="text-center py-8">
                            <div class="text-red-500 mb-4">
                                <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Error</h3>
                            <p class="text-gray-600 dark:text-gray-300">An error occurred while verifying. Please try again.</p>
                        </div>
                    `;
                    resultContainer.classList.remove('hidden');
                }
            });

            function selectUniversity(university) {
                universityInput.value = university;
                suggestionsContainer.classList.add('hidden');
            }

            function displayResult(result) {
                let badgeClass = '';
                let badgeText = '';
                let icon = '';
                let iconColor = '';

                switch(result.result) {
                    case 'real':
                        badgeClass = 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300';
                        badgeText = 'VERIFIED';
                        icon = 'M5 13l4 4L19 7';
                        iconColor = 'text-green-500';
                        break;
                    case 'fake':
                        badgeClass = 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300';
                        badgeText = 'FAKE';
                        icon = 'M6 18L18 6M6 6l12 12';
                        iconColor = 'text-red-500';
                        break;
                    case 'unconfirmed':
                        badgeClass = 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300';
                        badgeText = 'UNCONFIRMED';
                        icon = 'M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z';
                        iconColor = 'text-yellow-500';
                        break;
                }

                resultContent.innerHTML = `
                    <div class="text-center">
                        <div class="mb-4">
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold ${badgeClass}">
                                <svg class="w-4 h-4 mr-2 ${iconColor}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="${icon}"></path>
                                </svg>
                                ${badgeText}
                            </span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                <div class="text-2xl font-bold text-green-600 dark:text-green-400">${result.score}/100</div>
                                <div class="text-sm text-gray-600 dark:text-gray-300">Verification Score</div>
                            </div>
                            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                <div class="text-lg font-semibold text-gray-900 dark:text-white">${result.student_name}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-300">Student Name</div>
                            </div>
                            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                <div class="text-lg font-semibold text-gray-900 dark:text-white">${result.degree_title}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-300">Degree</div>
                            </div>
                        </div>

                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg mb-6">
                            <h4 class="font-semibold text-gray-900 dark:text-white mb-2">Verification Details</h4>
                            <p class="text-gray-700 dark:text-gray-300">${result.reason}</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                <div class="text-sm text-gray-600 dark:text-gray-300 mb-1">University</div>
                                <div class="text-gray-900 dark:text-white font-medium">${result.university_name}</div>
                            </div>
                            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                <div class="text-sm text-gray-600 dark:text-gray-300 mb-1">Roll Number</div>
                                <div class="text-gray-900 dark:text-white font-medium">${result.roll_number}</div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                <div class="text-sm text-gray-600 dark:text-gray-300 mb-1">Graduation Year</div>
                                <div class="text-gray-900 dark:text-white font-medium">${result.graduation_year}</div>
                            </div>
                            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                <div class="text-sm text-gray-600 dark:text-gray-300 mb-1">Verification Code</div>
                                <div class="text-gray-900 dark:text-white font-mono font-medium">${result.code}</div>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="/check/${result.code}"
                               class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-lg text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                View Public Result
                            </a>
                            <a href="/verify/${result.code}/pdf"
                               class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-gradient-to-r from-green-500 to-cyan-500 hover:from-green-600 hover:to-cyan-600 transition-all duration-200">
                                Download PDF
                            </a>
                        </div>
                    </div>
                `;

                resultContainer.classList.remove('hidden');
            }

            function debounce(func, wait) {
                let timeout;
                return function executedFunction(...args) {
                    const later = () => {
                        clearTimeout(timeout);
                        func(...args);
                    };
                    clearTimeout(timeout);
                    timeout = setTimeout(later, wait);
                };
            }
        });

        window.selectUniversity = function(university) {
            document.getElementById('university_name').value = university;
            document.getElementById('university-suggestions').classList.add('hidden');
        };
    </script>
</x-app-layout>