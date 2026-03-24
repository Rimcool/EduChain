<x-guest-layout>
    <div class="min-h-screen bg-gray-900">
        <!-- Header -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center">
                <h1 class="text-4xl font-bold text-white mb-4">Recognized Universities</h1>
                <p class="text-gray-400 text-lg">All HEC-recognized universities in Pakistan</p>
            </div>
        </div>

        <!-- Search and Filter -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">
            <div class="bg-gray-800 rounded-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Search University</label>
                        <input type="text" id="search-input" placeholder="Search by name..." class="w-full bg-gray-700 border-gray-600 rounded-md px-3 py-2 text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Filter by Province</label>
                        <select id="province-filter" class="w-full bg-gray-700 border-gray-600 rounded-md px-3 py-2 text-white">
                            <option value="">All Provinces</option>
                            <option value="Punjab">Punjab</option>
                            <option value="Sindh">Sindh</option>
                            <option value="Khyber Pakhtunkhwa">Khyber Pakhtunkhwa</option>
                            <option value="Balochistan">Balochistan</option>
                            <option value="Islamabad">Islamabad</option>
                            <option value="Azad Kashmir">Azad Kashmir</option>
                            <option value="Gilgit-Baltistan">Gilgit-Baltistan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Filter by Sector</label>
                        <select id="sector-filter" class="w-full bg-gray-700 border-gray-600 rounded-md px-3 py-2 text-white">
                            <option value="">All Sectors</option>
                            <option value="Public">Public</option>
                            <option value="Private">Private</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Universities Grid -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
            <div id="universities-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($universities as $university)
                    <div class="university-card bg-gray-800 rounded-lg p-6 hover:bg-gray-700 transition duration-300 cursor-pointer" 
                         data-name="{{ $university->name }}"
                         data-province="{{ $university->province }}"
                         data-sector="{{ $university->sector }}">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <h3 class="text-lg font-semibold text-white mb-1">{{ $university->name }}</h3>
                                <p class="text-gray-400 text-sm">{{ $university->city }}, {{ $university->province }}</p>
                            </div>
                            <div class="flex space-x-2">
                                @if($university->is_hec_recognized)
                                    <span class="px-2 py-1 text-xs bg-blue-900 text-blue-300 rounded-full">HEC Recognized</span>
                                @endif
                                @if($university->is_on_educhain)
                                    <span class="px-2 py-1 text-xs bg-green-900 text-green-300 rounded-full">On EduChain</span>
                                @endif
                            </div>
                        </div>
                        <div class="text-sm text-gray-400">
                            <p><strong>Category:</strong> {{ $university->category }}</p>
                            <p><strong>Sector:</strong> {{ $university->sector }}</p>
                            @if($university->established_since)
                                <p><strong>Established:</strong> {{ $university->established_since }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $universities->links() }}
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search-input');
            const provinceFilter = document.getElementById('province-filter');
            const sectorFilter = document.getElementById('sector-filter');
            const cards = document.querySelectorAll('.university-card');

            function filterUniversities() {
                const searchTerm = searchInput.value.toLowerCase();
                const provinceValue = provinceFilter.value;
                const sectorValue = sectorFilter.value;

                cards.forEach(card => {
                    const name = card.dataset.name.toLowerCase();
                    const province = card.dataset.province;
                    const sector = card.dataset.sector;

                    const matchesSearch = name.includes(searchTerm);
                    const matchesProvince = !provinceValue || province === provinceValue;
                    const matchesSector = !sectorValue || sector === sectorValue;

                    if (matchesSearch && matchesProvince && matchesSector) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            }

            searchInput.addEventListener('input', filterUniversities);
            provinceFilter.addEventListener('change', filterUniversities);
            sectorFilter.addEventListener('change', filterUniversities);
        });
    </script>
</x-guest-layout>