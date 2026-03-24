<x-guest-layout>
    <div class="min-h-screen bg-gray-900 py-12">
        <div class="max-w-md mx-auto bg-gray-800 rounded-lg shadow-xl p-6">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-green-400">EduChain</h1>
                <p class="text-gray-400 mt-2">Account Pending Approval</p>
            </div>

            <div class="bg-yellow-900 border border-yellow-700 rounded-lg p-4 mb-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-yellow-400">
                            Your university account is pending approval from an administrator.
                        </p>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <p class="text-gray-400 mb-4">
                    You will receive an email notification once your account has been approved.
                </p>
                <p class="text-sm text-gray-500">
                    This process usually takes 1-2 business days.
                </p>
            </div>

            <div class="mt-8 flex justify-center">
                <a href="{{ route('home') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                    Return to Home
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>