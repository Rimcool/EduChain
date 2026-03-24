<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-400 leading-tight">
            {{ __('Degree Verification') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-semibold text-white mb-4">Verify a Degree</h3>
                            <form id="verify-form">
                                @csrf
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-300">Student Name</label>
                                        <input type="text" name="student_name" class="mt-1 block w-full bg-gray-700 border-gray-600 rounded-md shadow-sm text-white" required>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-300">Roll Number</label>
                                        <input type="text" name="roll_number" class="mt-1 block w-full bg-gray-700 border-gray-600 rounded-md shadow-sm text-white" required>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-300">Degree Title</label>
                                        <input type="text" name="degree_title" class="mt-1 block w-full bg-gray-700 border-gray-600 rounded-md shadow-sm text-white" required>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-300">University Name</label>
                                        <input type="text" name="university_name" id="university-input" class="mt-1 block w-full bg-gray-700 border-gray-600 rounded-md shadow-sm text-white" required>
                                        <div id="university-suggestions" class="mt-2 bg-gray-700 rounded-md hidden"></div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-300">Graduation Year</label>
                                        <input type="number" name="graduation_year" class="mt-1 block w-full bg-gray-700 border-gray-600 rounded-md shadow-sm text-white" min="1947" max="{{ date('Y') }}" required>
                                    </div>
                                    <div>
                                        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                            Verify Degree
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-white mb-4">Results</h3>
                            <div id="result-container" class="hidden">
                                <div id="result-content" class="bg-gray-700 rounded-lg p-4">
                                    <!-- Results will be displayed here -->
                                </div>
                                <div class="mt-4 flex space-x-2">
                                    <button id="download-pdf" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded hidden">
                                        Download PDF
                                    </button>
                                    <button id="share-result" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded hidden">
                                        Share Result
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // University autocomplete
        const universityInput = document.getElementById('university-input');
        const suggestionsDiv = document.getElementById('university-suggestions');

        universityInput.addEventListener('input', async function() {
            const query = this.value;
            if (query.length < 2) {
                suggestionsDiv.classList.add('hidden');
                return;
            }

            try {
                const response = await fetch(`/api/universities/search?q=${encodeURIComponent(query)}`);
                const universities = await response.json();
                
                suggestionsDiv.innerHTML = '';
                if (universities.length > 0) {
                    suggestionsDiv.classList.remove('hidden');
                    universities.forEach(university => {
                        const div = document.createElement('div');
                        div.className = 'p-2 hover:bg-gray-600 cursor-pointer text-white';
                        div.textContent = university;
                        div.onclick = () => {
                            universityInput.value = university;
                            suggestionsDiv.classList.add('hidden');
                        };
                        suggestionsDiv.appendChild(div);
                    });
                } else {
                    suggestionsDiv.classList.add('hidden');
                }
            } catch (error) {
                console.error('Error fetching universities:', error);
            }
        });

        // Close suggestions when clicking outside
        document.addEventListener('click', function(e) {
            if (!universityInput.contains(e.target) && !suggestionsDiv.contains(e.target)) {
                suggestionsDiv.classList.add('hidden');
            }
        });

        // Form submission
        document.getElementById('verify-form').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const data = Object.fromEntries(formData);

            try {
                const response = await fetch('/verify/check', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();
                displayResult(result);
            } catch (error) {
                console.error('Error:', error);
            }
        });

        function displayResult(result) {
            const container = document.getElementById('result-container');
            const content = document.getElementById('result-content');
            const downloadBtn = document.getElementById('download-pdf');
            const shareBtn = document.getElementById('share-result');

            container.classList.remove('hidden');

            let statusClass = '';
            let statusText = '';
            
            switch(result.result) {
                case 'real':
                    statusClass = 'bg-green-900 border-green-700';
                    statusText = '✅ VERIFIED';
                    downloadBtn.classList.remove('hidden');
                    shareBtn.classList.remove('hidden');
                    break;
                case 'fake':
                    statusClass = 'bg-red-900 border-red-700';
                    statusText = '❌ FAKE';
                    downloadBtn.classList.add('hidden');
                    shareBtn.classList.add('hidden');
                    break;
                case 'unconfirmed':
                    statusClass = 'bg-yellow-900 border-yellow-700';
                    statusText = '⚠️ UNCONFIRMED';
                    downloadBtn.classList.add('hidden');
                    shareBtn.classList.add('hidden');
                    break;
            }

            content.innerHTML = `
                <div class="border ${statusClass} rounded-lg p-4">
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="text-lg font-semibold">${statusText}</h4>
                        <span class="text-sm text-gray-400">Score: ${result.score}/100</span>
                    </div>
                    <div class="space-y-2">
                        <p><strong>Reason:</strong> ${result.reason}</p>
                        <div class="grid grid-cols-2 gap-2 text-sm">
                            ${Object.entries(result.layers).map(([key, value]) => `
                                <div class="flex justify-between">
                                    <span>${key}:</span>
                                    <span class="${value ? 'text-green-400' : 'text-red-400'}">${value ? '✓' : '✗'}</span>
                                </div>
                            `).join('')}
                        </div>
                        <div class="mt-4 p-3 bg-gray-800 rounded">
                            <p class="text-sm"><strong>Verification Code:</strong> ${result.code}</p>
                            <p class="text-xs text-gray-400">Share this code for verification</p>
                        </div>
                    </div>
                </div>
            `;

            downloadBtn.onclick = () => {
                window.open(`/verify/${result.code}/pdf`, '_blank');
            };

            shareBtn.onclick = () => {
                const url = `${window.location.origin}/check/${result.code}`;
                navigator.clipboard.writeText(url).then(() => {
                    alert('Verification link copied to clipboard!');
                });
            };
        }
    </script>
</x-app-layout>