<x-guest-layout>
    <div class="flex flex-col min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-black">
        <!-- Header -->
        <div class="relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-green-900/20 via-blue-900/20 to-purple-900/20"></div>
            <div class="px-4 sm:px-6 lg:px-8 py-8">
                <div class="text-center">
                    <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-4 drop-shadow-2xl">
                        EduChain Dashboard
                    </h1>
                    <p class="text-lg md:text-xl text-gray-300 mb-6 font-medium">
                        Real-time verification statistics and network activity
                    </p>
                    <div class="text-sm text-gray-400 font-medium">
                        Last updated: {{ now()->format('M d, Y H:i') }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="w-full px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-gradient-to-br from-green-900/60 to-transparent backdrop-blur-sm rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-semibold text-green-300 uppercase tracking-wide">Total Users</p>
                            <p class="text-3xl font-extrabold text-white mt-1">{{ number_format($stats['total_users']) }}</p>
                        </div>
                        <div class="bg-green-600/30 p-4 rounded-full shadow-lg">
                            <svg class="w-8 h-8 text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-blue-900/60 to-transparent backdrop-blur-sm rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-semibold text-blue-300 uppercase tracking-wide">Today's Verifications</p>
                            <p class="text-3xl font-extrabold text-white mt-1">{{ number_format($stats['today_verifications']) }}</p>
                        </div>
                        <div class="bg-blue-600/30 p-4 rounded-full shadow-lg">
                            <svg class="w-8 h-8 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-red-900/60 to-transparent backdrop-blur-sm rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-semibold text-red-300 uppercase tracking-wide">Fakes Caught</p>
                            <p class="text-3xl font-extrabold text-white mt-1">{{ number_format($stats['fake_caught']) }}</p>
                        </div>
                        <div class="bg-red-600/30 p-4 rounded-full shadow-lg">
                            <svg class="w-8 h-8 text-red-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-purple-900/60 to-transparent backdrop-blur-sm rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-semibold text-purple-300 uppercase tracking-wide">Universities on Chain</p>
                            <p class="text-3xl font-extrabold text-white mt-1">{{ number_format($stats['universities_on_chain']) }}</p>
                        </div>
                        <div class="bg-purple-600/30 p-4 rounded-full shadow-lg">
                            <svg class="w-8 h-8 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- Recent Verifications -->
                <div class="bg-gradient-to-br from-gray-900/80 to-gray-800/80 backdrop-blur-sm rounded-xl shadow-xl">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
                            <span>🔍</span> Recent Verifications
                        </h3>
                        <div class="space-y-4">
                            @foreach($recent_verifications as $verification)
                                <div class="bg-gradient-to-r from-gray-800/50 to-transparent rounded-lg p-4 transition-all duration-300">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <h4 class="font-semibold text-white text-lg">{{ $verification->student_name }}</h4>
                                            <p class="text-sm text-gray-300 mt-1">{{ $verification->degree_title }} • {{ $verification->university?->name ?? 'Unknown' }}</p>
                                            <p class="text-xs text-gray-500 mt-2">Code: <span class="font-mono">{{ $verification->code }}</span> • {{ $verification->created_at->format('M d, Y H:i') }}</p>
                                        </div>
                                        <div class="text-right">
                                            <span class="px-3 py-1 text-xs font-bold rounded-full uppercase tracking-wide
                                                @if($verification->result === 'real') 
                                                    bg-green-600/90 text-white shadow-lg
                                                @elseif($verification->result === 'fake') 
                                                    bg-red-600/90 text-white shadow-lg
                                                @else 
                                                    bg-yellow-600/90 text-white shadow-lg
                                                @endif">
                                                {{ ucfirst($verification->result) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="bg-gradient-to-br from-gray-900/80 to-gray-800/80 backdrop-blur-sm rounded-xl shadow-xl">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
                            <span>📊</span> Recent Activity
                        </h3>
                        <div class="space-y-4">
                            @foreach($recent_activity as $activity)
                                <div class="bg-gradient-to-r from-gray-800/50 to-transparent rounded-lg p-4 transition-all duration-300">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <h4 class="font-semibold text-white">{{ $activity->action }}</h4>
                                            <p class="text-sm text-gray-300 mt-1">{{ $activity->description }}</p>
                                            <p class="text-xs text-gray-500 mt-2">{{ $activity->created_at->format('M d, Y H:i') }}</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-xs text-gray-400 font-mono">{{ $activity->user?->name ?? 'System' }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions & Alerts -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Quick Actions -->
                <div class="bg-gradient-to-br from-gray-900/80 to-gray-800/80 backdrop-blur-sm rounded-xl shadow-xl p-6 flex flex-col">
                    <h3 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
                        <span>⚡</span> Quick Actions
                    </h3>
                    <div class="space-y-3 flex-1">
                        <a href="{{ route('login') }}" 
                           class="flex items-center gap-3 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white py-3 px-4 rounded-lg transition-all duration-300 transform hover:-translate-y-1 shadow-lg">
                            <span>🔐</span> Login to Dashboard
                        </a>
                        <a href="{{ route('verify') }}" 
                           class="flex items-center gap-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white py-3 px-4 rounded-lg transition-all duration-300 transform hover:-translate-y-1 shadow-lg">
                            <span>🔍</span> Verify a Degree
                        </a>
                        <a href="{{ route('register') }}" 
                           class="flex items-center gap-3 bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white py-3 px-4 rounded-lg transition-all duration-300 transform hover:-translate-y-1 shadow-lg">
                            <span>📝</span> Create Account
                        </a>
                        <a href="{{ route('universities') }}" 
                           class="flex items-center gap-3 bg-gradient-to-r from-yellow-600 to-yellow-700 hover:from-yellow-700 hover:to-yellow-800 text-white py-3 px-4 rounded-lg transition-all duration-300 transform hover:-translate-y-1 shadow-lg">
                            <span>🎓</span> Browse Universities
                        </a>
                    </div>
                </div>

                <!-- Pending Approvals -->
                <div class="bg-gradient-to-br from-yellow-900/30 to-transparent backdrop-blur-sm rounded-xl shadow-xl p-6 flex flex-col min-h-[280px]">
                    <h3 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
                        <span>⏳</span> Network Status
                    </h3>
                    <div class="text-center py-8 flex-1 flex flex-col justify-center">
                        <div class="text-4xl font-bold text-yellow-400 mb-2">{{ $stats['pending_universities'] }}</div>
                        <p class="text-gray-300 mb-6">universities pending approval</p>
                        <a href="{{ route('login') }}" 
                           class="inline-flex items-center gap-2 bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 px-6 rounded-lg transition-all duration-300 transform hover:-translate-y-1 shadow-lg mx-auto">
                            <span>📋</span> Review Pending
                        </a>
                    </div>
                </div>

                <!-- Fraud Alerts -->
                <div class="bg-gradient-to-br from-red-900/30 to-transparent backdrop-blur-sm rounded-xl shadow-xl p-6 flex flex-col min-h-[280px]">
                    <h3 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
                        <span>🚨</span> Security Status
                    </h3>
                    <div class="text-center py-8 flex-1 flex flex-col justify-center">
                        <div class="text-4xl font-bold text-red-400 mb-2">{{ $stats['fraud_alerts'] }}</div>
                        <p class="text-gray-300 mb-6">active fraud alerts</p>
                        <a href="{{ route('login') }}" 
                           class="inline-flex items-center gap-2 bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-6 rounded-lg transition-all duration-300 transform hover:-translate-y-1 shadow-lg mx-auto">
                            <span>👁️</span> View Security Center
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>