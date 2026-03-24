<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-400 leading-tight">
            {{ __('Pending Universities') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-white">University Accounts Pending Approval</h3>
                        <a href="{{ route('admin') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Back to Dashboard
                        </a>
                    </div>

                    @if($pending->isEmpty())
                        <div class="text-center py-8">
                            <p class="text-gray-400">No university accounts pending approval.</p>
                        </div>
                    @else
                        <div class="bg-gray-700 rounded-lg overflow-hidden">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-600">
                                    <thead class="bg-gray-600">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">University</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Contact</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Registered</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-gray-700 divide-y divide-gray-600">
                                        @foreach($pending as $user)
                                            <tr class="hover:bg-gray-600">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div>
                                                        <div class="text-sm font-medium text-white">{{ $user->university_name }}</div>
                                                        <div class="text-sm text-gray-400">{{ $user->email }}</div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-white">{{ $user->name }}</div>
                                                    <div class="text-sm text-gray-400">{{ $user->phone ?? 'Not provided' }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                                    {{ $user->created_at->format('M d, Y H:i') }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                                    <form action="{{ route('admin.universities.approve', $user->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        <button type="submit" class="text-green-400 hover:text-green-300">
                                                            Approve
                                                        </button>
                                                    </form>
                                                    <span class="text-gray-500">|</span>
                                                    <form action="{{ route('admin.universities.blacklist', $user->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        <button type="submit" class="text-red-400 hover:text-red-300">
                                                            Blacklist
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>