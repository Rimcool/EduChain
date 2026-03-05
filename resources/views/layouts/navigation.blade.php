<nav class="navbar fixed top-0 w-full z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <span class="text-2xl font-bold text-white terminal-text">EduChain</span>
                    <span class="ml-2 text-xs text-gray-400 border border-gray-600 px-2 py-1 rounded">BETA</span>
                </div>

                <!-- Primary Navigation -->
                <div class="hidden md:ml-8 md:flex md:space-x-8">
                    @auth
                        @if(auth()->user()->role === 'super_admin')
                            <a href="{{ route('admin') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium link-hover">Admin</a>
                        @elseif(auth()->user()->role === 'university')
                            <a href="{{ route('portal') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium link-hover">Portal</a>
                        @elseif(auth()->user()->role === 'student')
                            <a href="{{ route('student.dashboard') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium link-hover">My Degree</a>
                        @else
                            <a href="{{ route('verify') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium link-hover">Verify</a>
                            <a href="{{ route('verify.history') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium link-hover">History</a>
                        @endif
                    @else
                        <a href="{{ route('home') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium link-hover">Home</a>
                        <a href="{{ route('universities') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium link-hover">Universities</a>
                    @endauth
                </div>
            </div>

            <div class="flex items-center space-x-4">
                <!-- Auth Links -->
                @guest
                    <a href="{{ route('login') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Login</a>
                    <a href="{{ route('register') }}" class="bg-gradient-to-r from-green-500 to-cyan-500 hover:from-green-600 hover:to-cyan-600 text-white px-4 py-2 rounded-md text-sm font-semibold transition-all duration-200 transform hover:scale-105">Get Started</a>
                @else
                    <!-- User Menu -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                            <span>{{ auth()->user()->name }}</span>
                            <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-gray-800 border border-gray-700 rounded-md shadow-lg py-1 z-50" style="display: none;">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 cursor-not-allowed opacity-50">Profile (Coming Soon)</a>
                            <form method="POST" action="{{ route('logout') }}" class="block">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-300 hover:bg-gray-700">Logout</button>
                            </form>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
    </div>
</nav>

<!-- Mobile menu, show/hide based on menu state. -->
<div class="md:hidden" id="mobile-menu">
    <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
        @auth
            @if(auth()->user()->role === 'super_admin')
                <a href="{{ route('admin') }}" class="text-gray-300 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Admin</a>
            @elseif(auth()->user()->role === 'university')
                <a href="{{ route('portal') }}" class="text-gray-300 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Portal</a>
            @elseif(auth()->user()->role === 'student')
                <a href="{{ route('student.dashboard') }}" class="text-gray-300 hover:text-white block px-3 py-2 rounded-md text-base font-medium">My Degree</a>
            @else
                <a href="{{ route('verify') }}" class="text-gray-300 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Verify</a>
                <a href="{{ route('verify.history') }}" class="text-gray-300 hover:text-white block px-3 py-2 rounded-md text-base font-medium">History</a>
            @endif
        @else
            <a href="{{ route('home') }}" class="text-gray-300 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Home</a>
            <a href="{{ route('universities') }}" class="text-gray-300 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Universities</a>
        @endauth
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuButton = document.querySelector('[aria-controls="mobile-menu"]');
    const mobileMenu = document.getElementById('mobile-menu');

    if (mobileMenuButton) {
        mobileMenuButton.addEventListener('click', function() {
            const expanded = this.getAttribute('aria-expanded') === 'true' || false;
            this.setAttribute('aria-expanded', !expanded);
            mobileMenu.classList.toggle('hidden');
        });
    }
});
</script>