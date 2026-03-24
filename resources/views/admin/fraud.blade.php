<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-400 leading-tight">
            {{ __('Fraud Alerts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-white">Fraud Alerts</h3>
                        <a href="{{ route('admin') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Back to Dashboard
                        </a>
                    </div>

                    @if($alerts->isEmpty())
                        <div class="text-center py-8">
                            <p class="text-gray-400">No fraud alerts at this time.</p>
                        </div>
                    @else
                        <div class="bg-gray-700 rounded-lg overflow-hidden">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-600">
                                    <thead class="bg-gray-600">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">University</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Search Count</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Last Updated</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-gray-700 divide-y divide-gray-600">
                                        @foreach($alerts as $alert)
                                            <tr class="hover:bg-gray-600">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-medium text-white">{{ $alert->university_name_searched }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="px-2 py-1 text-xs rounded-full bg-red-900 text-red-300">
                                                        {{ $alert->search_count }} searches
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="px-2 py-1 text-xs rounded-full
                                                        @if($alert->status === 'new') bg-yellow-900 text-yellow-300
                                                        @elseif($alert->status === 'reviewed') bg-blue-900 text-blue-300
                                                        @else bg-red-900 text-red-300 @endif">
                                                        {{ ucfirst($alert->status) }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                                    {{ $alert->updated_at->format('M d, Y H:i') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="px-6 py-4 border-t border-gray-600">
                                {{ $alerts->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>