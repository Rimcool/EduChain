<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-400 leading-tight">
            {{ __('Manage Universities') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-white">Universities</h3>
                        <a href="{{ route('admin') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Back to Dashboard
                        </a>
                    </div>

                    <div class="bg-gray-700 rounded-lg overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-600">
                                <thead class="bg-gray-600">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">University</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Location</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-gray-700 divide-y divide-gray-600">
                                    @foreach($universities as $university)
                                        <tr class="hover:bg-gray-600">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div>
                                                    <div class="text-sm font-medium text-white">{{ $university->name }}</div>
                                                    <div class="text-sm text-gray-400">{{ $university->category }}</div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-white">{{ $university->city }}, {{ $university->province }}</div>
                                                <div class="text-sm text-gray-400">{{ $university->sector }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center space-x-2">
                                                    <span class="px-2 py-1 text-xs rounded-full
                                                        @if($university->is_on_educhain) bg-green-900 text-green-300
                                                        @elseif($university->is_blacklisted) bg-red-900 text-red-300
                                                        @else bg-gray-600 text-gray-300 @endif">
                                                        @if($university->is_on_educhain)
                                                            On EduChain
                                                        @elseif($university->is_blacklisted)
                                                            Blacklisted
                                                        @else
                                                            Not on EduChain
                                                        @endif
                                                    </span>
                                                    @if($university->is_hec_recognized)
                                                        <span class="px-2 py-1 text-xs rounded-full bg-blue-900 text-blue-300">HEC Recognized</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                                @if($university->is_blacklisted)
                                                    <form action="{{ route('admin.universities.unblacklist', $university->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        <button type="submit" class="text-green-400 hover:text-green-300">
                                                            Remove from Blacklist
                                                        </button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('admin.universities.blacklist', $university->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        <button type="submit" class="text-red-400 hover:text-red-300">
                                                            Blacklist
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="px-6 py-4 border-t border-gray-600">
                            {{ $universities->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>