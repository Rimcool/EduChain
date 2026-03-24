<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-400 leading-tight">
            {{ __('University Portal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="bg-gray-700 p-6 rounded-lg">
                            <h3 class="text-lg font-semibold text-white mb-2">Total Degrees Issued</h3>
                            <p class="text-3xl font-bold text-green-400">{{ $stats['total'] }}</p>
                        </div>
                        <div class="bg-gray-700 p-6 rounded-lg">
                            <h3 class="text-lg font-semibold text-white mb-2">This Month</h3>
                            <p class="text-3xl font-bold text-blue-400">{{ $stats['this_month'] }}</p>
                        </div>
                        <div class="bg-gray-700 p-6 rounded-lg">
                            <h3 class="text-lg font-semibold text-white mb-2">Verified Count</h3>
                            <p class="text-3xl font-bold text-purple-400">{{ $stats['verified_count'] }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <div>
                            <h3 class="text-lg font-semibold text-white mb-4">Issue New Degree</h3>
                            <form id="issue-form" class="space-y-4">
                                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-300">Student Name</label>
                                        <input type="text" name="student_name" class="mt-1 block w-full bg-gray-600 border-gray-500 rounded-md shadow-sm text-white" required>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-300">Roll Number</label>
                                        <input type="text" name="roll_number" class="mt-1 block w-full bg-gray-600 border-gray-500 rounded-md shadow-sm text-white" required>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-300">Degree Title</label>
                                        <input type="text" name="degree_title" class="mt-1 block w-full bg-gray-600 border-gray-500 rounded-md shadow-sm text-white" required>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-300">Graduation Year</label>
                                        <input type="number" name="graduation_year" class="mt-1 block w-full bg-gray-600 border-gray-500 rounded-md shadow-sm text-white" min="1947" max="{{ date('Y') }}" required>
                                    </div>
                                </div>
                                
                                <div class="flex justify-between">
                                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                        Issue Degree
                                    </button>
                                    <label class="flex items-center space-x-2 cursor-pointer">
                                        <input type="file" id="bulk-file" class="hidden" accept=".csv,.txt">
                                        <span class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                            Upload CSV
                                        </span>
                                    </label>
                                </div>
                            </form>

                            <div id="issue-result" class="mt-4 hidden p-4 bg-gray-700 rounded-lg">
                                <!-- Result will be displayed here -->
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold text-white mb-4">Recent Issuances</h3>
                            <div class="space-y-4">
                                @foreach($degrees->take(5) as $degree)
                                    <div class="bg-gray-700 p-4 rounded-lg">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h4 class="font-semibold text-white">{{ $degree->student_name }}</h4>
                                                <p class="text-sm text-gray-400">{{ $degree->degree_title }} • {{ $degree->university_name }}</p>
                                                <p class="text-xs text-gray-500">Roll: {{ $degree->roll_number }} • Year: {{ $degree->graduation_year }}</p>
                                            </div>
                                            <div class="text-right">
                                                <p class="text-xs text-gray-400">{{ $degree->created_at->format('M d, Y') }}</p>
                                                <p class="text-xs text-green-400 font-mono">{{ substr($degree->tx_hash, 0, 12) }}...</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            
                            <div class="mt-4 text-center">
                                <a href="{{ route('portal.degrees') }}" class="text-green-400 hover:text-green-300 text-sm">
                                    View All Degrees →
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('issue-form').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const data = Object.fromEntries(formData);

            try {
                const response = await fetch('/portal/issue', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();
                displayIssueResult(result);
            } catch (error) {
                console.error('Error:', error);
            }
        });

        document.getElementById('bulk-file').addEventListener('change', async function(e) {
            const file = e.target.files[0];
            if (!file) return;

            const formData = new FormData();
            formData.append('file', file);

            try {
                const response = await fetch('/portal/bulk', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: formData
                });

                const result = await response.json();
                displayBulkResult(result);
            } catch (error) {
                console.error('Error:', error);
            }
        });

        function displayIssueResult(result) {
            const container = document.getElementById('issue-result');
            container.classList.remove('hidden');

            if (result.success) {
                container.innerHTML = `
                    <div class="border border-green-700 bg-green-900 rounded-lg p-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="font-semibold text-green-300">Degree Issued Successfully!</h4>
                                <p class="text-sm text-green-200">Transaction Hash: ${result.tx_hash}</p>
                            </div>
                            <svg class="w-6 h-6 text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                    </div>
                `;
            } else {
                container.innerHTML = `
                    <div class="border border-red-700 bg-red-900 rounded-lg p-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="font-semibold text-red-300">Error</h4>
                                <p class="text-sm text-red-200">${result.error}</p>
                            </div>
                            <svg class="w-6 h-6 text-red-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                    </div>
                `;
            }
        }

        function displayBulkResult(result) {
            const container = document.getElementById('issue-result');
            container.classList.remove('hidden');

            container.innerHTML = `
                <div class="border border-blue-700 bg-blue-900 rounded-lg p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <h4 class="font-semibold text-blue-300">Bulk Upload Complete</h4>
                            <p class="text-sm text-blue-200">${result.message}</p>
                        </div>
                        <svg class="w-6 h-6 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                </div>
            `;
        }
    </script>
</x-app-layout>