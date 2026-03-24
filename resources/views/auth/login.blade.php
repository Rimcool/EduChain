<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-black py-12 relative overflow-hidden">
        <!-- Animated background -->
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-20 left-10 w-96 h-96 bg-green-500/5 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute top-40 right-10 w-80 h-80 bg-blue-500/5 rounded-full blur-3xl animate-pulse delay-1000"></div>
            <div class="absolute bottom-20 left-1/3 w-72 h-72 bg-purple-500/5 rounded-full blur-3xl animate-pulse delay-500"></div>
        </div>

        <div class="max-w-md mx-auto relative z-10">
            <!-- Floating particles -->
            <div class="absolute -top-4 -left-4 w-4 h-4 bg-green-400/20 rounded-full animate-bounce"></div>
            <div class="absolute -top-8 -right-4 w-3 h-3 bg-blue-400/20 rounded-full animate-bounce delay-500"></div>
            <div class="absolute -bottom-4 -left-8 w-2 h-2 bg-purple-400/20 rounded-full animate-bounce delay-1000"></div>

            <div class="bg-gradient-to-br from-gray-800/80 to-gray-900/80 backdrop-blur-xl rounded-2xl shadow-2xl border border-white/10 p-8">
                <div class="text-center mb-8">
                    <div class="flex justify-center mb-4">
                        <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-blue-500 rounded-full flex items-center justify-center shadow-2xl">
                            <span class="text-2xl">🚀</span>
                        </div>
                    </div>
                    <h1 class="text-4xl font-bold bg-gradient-to-r from-green-400 via-blue-400 to-purple-400 bg-clip-text text-transparent">
                        EduChain
                    </h1>
                    <p class="text-gray-300 mt-2 text-lg">Verify Degrees. Trust Results.</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-medium text-gray-300">
                            📧 Email Address
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-400">✉️</span>
                            </div>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                                class="block w-full pl-10 pr-4 py-3 bg-gray-700/50 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300 hover:bg-gray-700/70" 
                                placeholder="Enter your email">
                        </div>
                        @error('email')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="password" class="block text-sm font-medium text-gray-300">
                            🔒 Password
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-400">🔑</span>
                            </div>
                            <input id="password" type="password" name="password" required autocomplete="current-password"
                                class="block w-full pl-10 pr-4 py-3 bg-gray-700/50 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300 hover:bg-gray-700/70" 
                                placeholder="Enter your password">
                        </div>
                        @error('password')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <a class="text-sm text-green-400 hover:text-green-300 transition-colors duration-300 flex items-center gap-2" href="{{ route('register') }}">
                            <span>🆕</span> Don't have an account?
                        </a>
                        <a class="text-sm text-blue-400 hover:text-blue-300 transition-colors duration-300" href="#">
                            Forgot Password?
                        </a>
                    </div>

                    <div class="space-y-4">
                        <button type="submit" 
                            class="w-full bg-gradient-to-r from-green-600 via-blue-600 to-purple-600 hover:from-green-700 hover:via-blue-700 hover:to-purple-700 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-300 transform hover:-translate-y-1 hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-green-500/50">
                            🔐 Log In
                        </button>
                        
                        <div class="text-center text-gray-400 text-xs">
                            Secure login with blockchain verification
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
