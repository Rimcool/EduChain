<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-400 leading-tight">
            {{ __('My Degree') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    @if($credential)
                        <div class="text-center mb-8">
                            <h1 class="text-3xl font-bold text-white">Your Verified Degree</h1>
                            <p class="text-gray-400 mt-2">Status: 
                                <span class="px-3 py-1 rounded-full text-sm font-medium
                                    @if($credential->status === 'verified') bg-green-900 text-green-300
                                    @elseif($credential->status === 'fake') bg-red-900 text-red-300
                                    @else bg-yellow-900 text-yellow-300 @endif">
                                    {{ ucfirst($credential->status) }}
                                </span>
                            </p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            <div class="bg-gray-700 p-6 rounded-lg">
                                <h3 class="text-lg font-semibold text-white mb-4">Degree Information</h3>
                                <div class="space-y-2">
                                    <p><strong>Name:</strong> {{ $credential->student_name }}</p>
                                    <p><strong>Roll Number:</strong> {{ $credential->roll_number }}</p>
                                    <p><strong>Degree:</strong> {{ $credential->degree_title }}</p>
                                    <p><strong>University:</strong> {{ $credential->university_name }}</p>
                                    <p><strong>Year:</strong> {{ $credential->graduation_year }}</p>
                                </div>
                            </div>
                            
                            <div class="bg-gray-700 p-6 rounded-lg">
                                <h3 class="text-lg font-semibold text-white mb-4">Verification Details</h3>
                                <div class="space-y-2">
                                    <p><strong>Hash:</strong> {{ $credential->degree_hash }}</p>
                                    <p><strong>Code:</strong> {{ $credential->verification_code }}</p>
                                    <p><strong>Public URL:</strong></p>
                                    <p class="text-sm text-gray-300 break-all">{{ route('badge', $credential->public_slug) }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="{{ route('badge', $credential->public_slug) }}" 
                               class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded text-center">
                                View Public Badge
                            </a>
                            
                            <a href="/verify/{{ $credential->verification_code }}" 
                               class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-center">
                                View Verification
                            </a>
                        </div>
                    @else
                        <div class="text-center">
                            <h3 class="text-xl font-semibold text-white mb-4">Claim Your Degree</h3>
                            <p class="text-gray-400 mb-6">Verify your degree to get a shareable badge</p>
                            
                            <form id="claim-form" class="space-y-4">
                                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
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
                                        <input type="text" name="university_name" class="mt-1 block w-full bg-gray-700 border-gray-600 rounded-md shadow-sm text-white" required>
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-300">Graduation Year</label>
                                        <input type="number" name="graduation_year" class="mt-1 block w-full bg-gray-700 border-gray-600 rounded-md shadow-sm text-white" min="1947" max="{{ date('Y') }}" required>
                                    </div>
                                </div>
                                
                                <div class="flex justify-center">
                                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded">
                                        Claim Degree
                                    </button>
                                </div>
                            </form>

                            <div id="claim-result" class="hidden mt-6 p-4 bg-gray-700 rounded-lg">
                                <!-- Result will be displayed here -->
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        @if(!$credential)
        document.getElementById('claim-form').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const data = Object.fromEntries(formData);

            try {
                const response = await fetch('/my-degree/claim', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();
                displayClaimResult(result);
            } catch (error) {
                console.error('Error:', error);
            }
        });

        function displayClaimResult(result) {
            const container = document.getElementById('claim-result');
            container.classList.remove('hidden');

            let statusClass = '';
            let statusText = '';
            
            switch(result.result) {
                case 'real':
                    statusClass = 'bg-green-900 border-green-700';
                    statusText = '✅ VERIFIED';
                    break;
                case 'fake':
                    statusClass = 'bg-red-900 border-red-700';
                    statusText = '❌ FAKE';
                    break;
                case 'unconfirmed':
                    statusClass = 'bg-yellow-900 border-yellow-700';
                    statusText = '⚠️ UNCONFIRMED';
                    break;
            }

            container.innerHTML = `
                <div class="border ${statusClass} rounded-lg p-4">
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="text-lg font-semibold">${statusText}</h4>
                        <span class="text-sm text-gray-400">Score: ${result.score}/100</span>
                    </div>
                    <div class="text-center">
                        <p class="text-gray-300 mb-4">Your degree has been verified successfully!</p>
                        <a href="${result.badge_url}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded inline-block">
                            View Your Badge
                        </a>
                    </div>
                </div>
            `;
        }
        @endif
    </script>
</x-app-layout>