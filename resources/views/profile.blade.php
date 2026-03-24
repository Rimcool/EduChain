<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-400 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-white mb-6">Update Profile</h3>
                    
                    @if(session('success'))
                        <div class="bg-green-900 border border-green-700 text-green-100 px-4 py-3 rounded mb-6">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('profile') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">Name</label>
                                <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" 
                                       class="w-full bg-gray-700 border-gray-600 rounded-md px-3 py-2 text-white">
                                @error('name')
                                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                                <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" 
                                       class="w-full bg-gray-700 border-gray-600 rounded-md px-3 py-2 text-white">
                                @error('email')
                                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">Phone</label>
                                <input type="text" name="phone" value="{{ old('phone', auth()->user()->phone) }}" 
                                       class="w-full bg-gray-700 border-gray-600 rounded-md px-3 py-2 text-white">
                                @error('phone')
                                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">Password (leave blank to keep current)</label>
                                <input type="password" name="password" 
                                       class="w-full bg-gray-700 border-gray-600 rounded-md px-3 py-2 text-white">
                                @error('password')
                                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">Confirm Password</label>
                                <input type="password" name="password_confirmation" 
                                       class="w-full bg-gray-700 border-gray-600 rounded-md px-3 py-2 text-white">
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded">
                                Update Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>