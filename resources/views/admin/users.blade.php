<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-400 leading-tight">
            {{ __('Manage Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-white">Users</h3>
                        <a href="{{ route('admin') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Back to Dashboard
                        </a>
                    </div>

                    <div class="bg-gray-700 rounded-lg overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-600">
                                <thead class="bg-gray-600">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">User</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Role</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-gray-700 divide-y divide-gray-600">
                                    @foreach($users as $user)
                                        <tr class="hover:bg-gray-600">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div>
                                                    <div class="text-sm font-medium text-white">{{ $user->name }}</div>
                                                    <div class="text-sm text-gray-400">{{ $user->email }}</div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 py-1 text-xs rounded-full
                                                    @if($user->role === 'super_admin') bg-purple-900 text-purple-300
                                                    @elseif($user->role === 'university') bg-blue-900 text-blue-300
                                                    @elseif($user->role === 'student') bg-green-900 text-green-300
                                                    @else bg-gray-600 text-gray-300 @endif">
                                                    {{ ucfirst($user->role) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 py-1 text-xs rounded-full
                                                    @if($user->status === 'active') bg-green-900 text-green-300
                                                    @elseif($user->status === 'suspended') bg-red-900 text-red-300
                                                    @else bg-yellow-900 text-yellow-300 @endif">
                                                    {{ ucfirst($user->status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                                @if($user->status === 'active')
                                                    <form action="{{ route('admin.users.suspend', $user->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        <button type="submit" class="text-red-400 hover:text-red-300">
                                                            Suspend
                                                        </button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('admin.users.activate', $user->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        <button type="submit" class="text-green-400 hover:text-green-300">
                                                            Activate
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
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>