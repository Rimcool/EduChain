<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-400 leading-tight">
            {{ __('Verification Result') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="text-center mb-8">
                        <h1 class="text-3xl font-bold text-white">Degree Verification Result</h1>
                        <p class="text-gray-400 mt-2">Verification Code: {{ $verification->code }}</p>
                    </div>

                    @php
                        $statusClass = '';
                        $statusText = '';
                        $layers = json_decode($verification->checks, true);
                        
                        switch($verification->result) {
                            case 'real':
                                $statusClass = 'bg-green-900 border-green-700';
                                $statusText = '✅ VERIFIED';
                                break;
                            case 'fake':
                                $statusClass = 'bg-red-900 border-red-700';
                                $statusText = '❌ FAKE';
                                break;
                            case 'unconfirmed':
                                $statusClass = 'bg-yellow-900 border-yellow-700';
                                $statusText = '⚠️ UNCONFIRMED';
                                break;
                        }
                    @endphp

                    <div class="border {{ $statusClass }} rounded-lg p-6 mb-6">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-2xl font-bold">{{ $statusText }}</h2>
                            <div class="text-right">
                                <p class="text-sm text-gray-400">Score: {{ $verification->score }}/100</p>
                                <p class="text-xs text-gray-500">Verified at: {{ $verification->created_at->format('M d, Y H:i') }}</p>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div class="bg-gray-700 p-4 rounded">
                                <h3 class="font-semibold text-white mb-2">Student Information</h3>
                                <p><strong>Name:</strong> {{ $verification->student_name }}</p>
                                <p><strong>Roll Number:</strong> {{ $verification->roll_number }}</p>
                                <p><strong>Degree:</strong> {{ $verification->degree_title }}</p>
                                <p><strong>University:</strong> {{ $verification->university_name }}</p>
                                <p><strong>Year:</strong> {{ $verification->graduation_year }}</p>
                            </div>
                            
                            <div class="bg-gray-700 p-4 rounded">
                                <h3 class="font-semibold text-white mb-2">Verification Details</h3>
                                <p><strong>Reason:</strong> {{ $verification->reason }}</p>
                                <p><strong>Hash:</strong> {{ $verification->degree_hash }}</p>
                                <p><strong>Transaction:</strong> {{ $verification->tx_hash ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <div class="bg-gray-700 p-4 rounded">
                            <h3 class="font-semibold text-white mb-2">Verification Layers</h3>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                                @foreach($layers as $key => $value)
                                    <div class="flex items-center justify-between p-2 bg-gray-800 rounded">
                                        <span class="text-sm">{{ ucfirst(str_replace('_', ' ', $key)) }}</span>
                                        <span class="{{ $value ? 'text-green-400' : 'text-red-400' }}">
                                            {{ $value ? '✓' : '✗' }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="/verify/{{ $verification->code }}/pdf" 
                           class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-center">
                            Download PDF Certificate
                        </a>
                        
                        <button onclick="shareResult()" 
                                class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                            Share Result
                        </button>
                        
                        <a href="/verify" 
                           class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded text-center">
                            Verify Another
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function shareResult() {
            const url = `${window.location.origin}/check/{{ $verification->code }}`;
            if (navigator.share) {
                navigator.share({
                    title: 'Degree Verification Result',
                    text: 'Check this degree verification result:',
                    url: url
                });
            } else {
                navigator.clipboard.writeText(url).then(() => {
                    alert('Verification link copied to clipboard!');
                });
            }
        }
    </script>
</x-app-layout>