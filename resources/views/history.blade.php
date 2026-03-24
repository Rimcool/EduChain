<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-400 leading-tight">
            {{ __('Verification History') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-white">Your Verification History</h3>
                        <a href="{{ route('verify') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            New Verification
                        </a>
                    </div>

                    @if($verifications->isEmpty())
                        <div class="text-center py-8">
                            <p class="text-gray-400">No verifications found.</p>
                        </div>
                    @else
                        <div class="bg-gray-700 rounded-lg overflow-hidden">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-600">
                                    <thead class="bg-gray-600">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Student</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Degree</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Result</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Date</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-gray-700 divide-y divide-gray-600">
                                        @foreach($verifications as $verification)
                                            <tr class="hover:bg-gray-600">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div>
                                                        <div class="text-sm font-medium text-white">{{ $verification->student_name }}</div>
                                                        <div class="text-sm text-gray-400">{{ $verification->university_name }}</div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-white">{{ $verification->degree_title }}</div>
                                                    <div class="text-sm text-gray-400">Roll: {{ $verification->roll_number }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="px-2 py-1 text-xs rounded-full
                                                        @if($verification->result === 'real') bg-green-900 text-green-300
                                                        @elseif($verification->result === 'fake') bg-red-900 text-red-300
                                                        @else bg-yellow-900 text-yellow-300 @endif">
                                                        {{ ucfirst($verification->result) }}
                                                    </span>
                                                    <div class="text-xs text-gray-400 mt-1">Score: {{ $verification->score }}/100</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                                    {{ $verification->created_at->format('M d, Y H:i') }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                                    <a href="{{ route('verify.show', $verification->code) }}" class="text-blue-400 hover:text-blue-300">
                                                        View
                                                    </a>
                                                    <a href="{{ route('verify.pdf', $verification->code) }}" class="text-green-400 hover:text-green-300">
                                                        PDF
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="px-6 py-4 border-t border-gray-600">
                                {{ $verifications->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>