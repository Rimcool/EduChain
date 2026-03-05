<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-6">Issued Degrees</h1>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Roll Number</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Degree</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Year</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Blockchain Hash</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Verifications</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <!-- Sample data - replace with actual data from database -->
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">2024-03-02</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">John Doe</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">CS12345</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">BS Computer Science</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">2024</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-mono">0xEDU4F7554EDE...</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">5</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>