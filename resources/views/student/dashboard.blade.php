<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Student Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Section -->
            <div class="bg-gradient-to-r from-blue-600 via-teal-500 to-green-500 text-white rounded-2xl shadow-xl mb-8 overflow-hidden">
                <div class="p-8">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-3xl font-bold mb-2">Welcome back, {{ Auth::user()->name }}!</h1>
                            <p class="text-blue-100">Student Account • Ready to verify your credentials</p>
                        </div>
                        <div class="hidden md:block">
                            <div class="text-right">
                                <p class="text-sm opacity-80">Member Since</p>
                                <p class="text-lg font-semibold">{{ Auth::user()->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Quick Actions -->
                <div class="lg:col-span-2">
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-6 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            Quick Actions
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Verify Degree Card -->
                            <a href="{{ route('verify') }}" class="group bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900 dark:to-blue-800 rounded-lg p-6 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 border border-blue-200 dark:border-blue-700">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h4 class="font-semibold text-gray-800 dark:text-white group-hover:text-blue-600 transition-colors">Verify Degree</h4>
                                        <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">Check degree authenticity</p>
                                    </div>
                                    <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center text-white group-hover:bg-blue-600 transition-colors">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="mt-4 flex items-center text-xs text-blue-600 font-medium">
                                    <span>Start verification</span>
                                    <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </div>
                            </a>

                            <!-- Verification History Card -->
                            <a href="{{ route('verify.history') }}" class="group bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900 dark:to-green-800 rounded-lg p-6 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 border border-green-200 dark:border-green-700">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h4 class="font-semibold text-gray-800 dark:text-white group-hover:text-green-600 transition-colors">Verification History</h4>
                                        <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">View past verifications</p>
                                    </div>
                                    <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center text-white group-hover:bg-green-600 transition-colors">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="mt-4 flex items-center text-xs text-green-600 font-medium">
                                    <span>View history</span>
                                    <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </div>
                            </a>

                            <!-- Claim Degree Card -->
                            <a href="{{ route('student.claim') }}" class="group bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-900 dark:to-purple-800 rounded-lg p-6 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 border border-purple-200 dark:border-purple-700">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h4 class="font-semibold text-gray-800 dark:text-white group-hover:text-purple-600 transition-colors">Claim Your Degree</h4>
                                        <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">Get your digital credential</p>
                                    </div>
                                    <div class="w-12 h-12 bg-purple-500 rounded-full flex items-center justify-center text-white group-hover:bg-purple-600 transition-colors">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="mt-4 flex items-center text-xs text-purple-600 font-medium">
                                    <span>Claim now</span>
                                    <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </div>
                            </a>

                            <!-- View Badge Card -->
                            <a href="{{ route('student.badge') }}" class="group bg-gradient-to-br from-orange-50 to-orange-100 dark:from-orange-900 dark:to-orange-800 rounded-lg p-6 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 border border-orange-200 dark:border-orange-700">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h4 class="font-semibold text-gray-800 dark:text-white group-hover:text-orange-600 transition-colors">View Your Badge</h4>
                                        <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">Shareable credential badge</p>
                                    </div>
                                    <div class="w-12 h-12 bg-orange-500 rounded-full flex items-center justify-center text-white group-hover:bg-orange-600 transition-colors">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.54 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.784.57-1.838-.197-1.539-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.783-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="mt-4 flex items-center text-xs text-orange-600 font-medium">
                                    <span>View badge</span>
                                    <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 mt-8">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-6 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Recent Activity
                        </h3>
                        
                        <div class="space-y-4">
                            <div class="flex items-center space-x-4 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center">
                                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-medium text-gray-900 dark:text-white">Degree Verification</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">Verify your degree credentials with our blockchain-based system</p>
                                </div>
                                <a href="{{ route('verify') }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 font-medium text-sm">
                                    Get Started →
                                </a>
                            </div>
                            
                            <div class="flex items-center space-x-4 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-full flex items-center justify-center">
                                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-medium text-gray-900 dark:text-white">Claim Your Degree</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">Get your digital credential and shareable badge</p>
                                </div>
                                <a href="{{ route('student.claim') }}" class="text-purple-600 hover:text-purple-800 dark:text-purple-400 dark:hover:text-purple-300 font-medium text-sm">
                                    Claim Now →
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Account Information -->
                <div class="lg:col-span-1">
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 sticky top-8">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-6 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Account Information
                        </h3>
                        
                        <div class="space-y-4">
                            <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-300">Email Address</p>
                                    <p class="font-medium text-gray-900 dark:text-white mt-1">{{ Auth::user()->email }}</p>
                                </div>
                                <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                    </svg>
                                </div>
                            </div>

                            <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-300">Account Role</p>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300 mt-1">
                                        {{ ucfirst(Auth::user()->role) }}
                                    </span>
                                </div>
                                <div class="w-8 h-8 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                    </svg>
                                </div>
                            </div>

                            <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-300">Account Status</p>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300 mt-1">
                                        {{ ucfirst(Auth::user()->status) }}
                                    </span>
                                </div>
                                <div class="w-8 h-8 bg-purple-100 dark:bg-purple-900 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                    </svg>
                                </div>
                            </div>

                            <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-300">Member Since</p>
                                    <p class="font-medium text-gray-900 dark:text-white mt-1">{{ Auth::user()->created_at->format('M d, Y') }}</p>
                                </div>
                                <div class="w-8 h-8 bg-orange-100 dark:bg-orange-900 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Stats -->
                        <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-600">
                            <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-4">Quick Stats</h4>
                            <div class="grid grid-cols-2 gap-4 text-center">
                                <div>
                                    <p class="text-2xl font-bold text-blue-600">{{ Auth::user()->verifications()->count() }}</p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">Verifications</p>
                                </div>
                                <div>
                                    <p class="text-2xl font-bold text-green-600">0</p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">Credentials</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>