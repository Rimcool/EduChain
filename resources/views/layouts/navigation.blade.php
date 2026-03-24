<nav class="bg-gradient-to-r from-green-600 via-blue-600 to-purple-600 shadow-xl border-b border-white/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <a href="{{ route('home') }}" class="text-white font-bold text-xl tracking-tight bg-white/10 px-4 py-2 rounded-lg backdrop-blur-sm border border-white/20 hover:bg-white/20 transition-all duration-300">
                        🚀 EduChain
                    </a>
                </div>
                <div class="hidden md:ml-8 md:flex md:space-x-6">
                    @auth
                        @if(auth()->user()->role === 'super_admin')
                            <a href="{{ route('admin') }}" class="text-white/90 hover:text-white px-4 py-2 rounded-md text-sm font-medium bg-white/5 hover:bg-white/10 transition-all duration-300 border border-white/10 hover:border-white/20">
                                📊 Admin Dashboard
                            </a>
                        @elseif(auth()->user()->role === 'university')
                            <a href="{{ route('portal') }}" class="text-white/90 hover:text-white px-4 py-2 rounded-md text-sm font-medium bg-white/5 hover:bg-white/10 transition-all duration-300 border border-white/10 hover:border-white/20">
                                🎓 University Portal
                            </a>
                        @elseif(auth()->user()->role === 'student')
                            <a href="{{ route('student.dashboard') }}" class="text-white/90 hover:text-white px-4 py-2 rounded-md text-sm font-medium bg-white/5 hover:bg-white/10 transition-all duration-300 border border-white/10 hover:border-white/20">
                                🎖️ My Degree
                            </a>
                        @else
                            <a href="{{ route('verify') }}" class="text-white/90 hover:text-white px-4 py-2 rounded-md text-sm font-medium bg-white/5 hover:bg-white/10 transition-all duration-300 border border-white/10 hover:border-white/20">
                                ✅ Verify Degree
                            </a>
                            <a href="{{ route('history') }}" class="text-white/90 hover:text-white px-4 py-2 rounded-md text-sm font-medium bg-white/5 hover:bg-white/10 transition-all duration-300 border border-white/10 hover:border-white/20">
                                📚 Verification History
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
            <div class="flex items-center space-x-3">
                @guest
                    <a href="{{ route('login') }}" class="text-white/90 hover:text-white px-4 py-2 rounded-md text-sm font-medium bg-white/10 hover:bg-white/20 transition-all duration-300 border border-white/20 hover:border-white/30">
                        🔐 Login
                    </a>
                    <a href="{{ route('register') }}" class="bg-gradient-to-r from-green-500 to-blue-500 hover:from-green-600 hover:to-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 border border-white/30">
                        🚀 Register
                    </a>
                @else
                    <div class="flex items-center space-x-3">
                        <span class="text-white/90 text-sm font-medium bg-white/10 px-3 py-1.5 rounded-md border border-white/20">
                            👤 {{ auth()->user()->name }}
                        </span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-white/90 hover:text-white px-4 py-2 rounded-md text-sm font-medium bg-white/10 hover:bg-white/20 transition-all duration-300 border border-white/20 hover:border-white/30">
                                🔒 Logout
                            </button>
                        </form>
                    </div>
                @endguest
            </div>
        </div>
    </div>
</nav>
