<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden mb-8">
                <div class="p-8">
                    <div class="flex justify-between items-center">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Verification History</h1>
                            <p class="text-gray-600 dark:text-gray-300 mt-2">Track all your degree verifications</p>
                        </div>
                        <div class="flex space-x-4">
                            <a href="{{ route('verify') }}" 
                               class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 transition-all duration-200 transform hover:scale-105 shadow-lg">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                New Verification
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Section -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
                <div class="p-8">
                    @if($verifications->isEmpty())
                        <!-- Empty State -->
                        <div class="text-center py-16">
                            <div class="text-gray-400 dark:text-gray-500 mb-6">
                                <svg class="w-20 h-20 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">No verifications yet</h3>
                            <p class="text-gray-600 dark:text-gray-300 mb-8 max-w-md mx-auto">Start by verifying your first degree. Your verification history will appear here.</p>
                            <a href="{{ route('verify') }}" 
                               class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-gradient-to-r from-green-500 to-blue-500 hover:from-green-600 hover:to-blue-600 transition-all duration-200 transform hover:scale-105">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                                Verify Your First Degree
                            </a>
                        </div>
                    @else
                        <!-- Verification Cards -->
                        <div class="grid gap-6">
                            @foreach($verifications as $verification)
                                <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-6 hover:shadow-lg transition-all duration-200 border border-gray-200 dark:border-gray-600">
                                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-4 mb-3">
                                                <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                                    {{ substr($verification->student_name, 0, 2) }}
                                                </div>
                                                <div>
                                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $verification->student_name }}</h3>
                                                    <p class="text-sm text-gray-600 dark:text-gray-300">{{ $verification->roll_number }}</p>
                                                </div>
                                            </div>
                                            
                                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                                                <div>
                                                    <span class="text-gray-500 dark:text-gray-400">University:</span>
                                                    <span class="ml-2 font-medium text-gray-900 dark:text-white">{{ $verification->university_name }}</span>
                                                </div>
                                                <div>
                                                    <span class="text-gray-500 dark:text-gray-400">Degree:</span>
                                                    <span class="ml-2 font-medium text-gray-900 dark:text-white">{{ $verification->degree_title }}</span>
                                                </div>
                                                <div>
                                                    <span class="text-gray-500 dark:text-gray-400">Year:</span>
                                                    <span class="ml-2 font-medium text-gray-900 dark:text-white">{{ $verification->graduation_year }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="flex flex-col items-end gap-4">
                                            <!-- Result Badge -->
                                            @php
                                                $badgeClass = '';
                                                $badgeText = '';
                                                $badgeIcon = '';
                                                switch($verification->result) {
                                                    case 'real': 
                                                        $badgeClass = 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300';
                                                        $badgeText = 'VERIFIED';
                                                        $badgeIcon = 'M5 13l4 4L19 7';
                                                        break;
                                                    case 'fake': 
                                                        $badgeClass = 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300';
                                                        $badgeText = 'FAKE';
                                                        $badgeIcon = 'M6 18L18 6M6 6l12 12';
                                                        break;
                                                    case 'unconfirmed': 
                                                        $badgeClass = 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300';
                                                        $badgeText = 'UNCONFIRMED';
                                                        $badgeIcon = 'M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z';
                                                        break;
                                                }
                                            @endphp
                                            
                                            <div class="flex items-center gap-3">
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold {{ $badgeClass }}">
                                                    <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $badgeIcon }}"></path>
                                                    </svg>
                                                    {{ $badgeText }}
                                                </span>
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-200 dark:bg-gray-600 text-gray-800 dark:text-gray-200">
                                                    Score: {{ $verification->score }}/100
                                                </span>
                                            </div>
                                            
                                            <!-- Actions -->
                                            <div class="flex gap-3">
                                                <a href="{{ route('verify.public', $verification->code) }}" 
                                                   class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                    </svg>
                                                    View Details
                                                </a>
                                                <a href="{{ route('verify.pdf', $verification->code) }}" 
                                                   class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-green-600 hover:bg-green-700 rounded-lg transition-colors">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                    </svg>
                                                    Download PDF
                                                </a>
                                            </div>
                                            
                                            <!-- Verification Code -->
                                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                                Code: <span class="font-mono font-medium text-gray-700 dark:text-gray-300">{{ $verification->code }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-8">
                            {{ $verifications->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>