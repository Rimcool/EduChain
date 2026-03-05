<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-6">Universities Pending Approval</h1>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">University</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Applied</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <!-- Sample data - replace with actual data from database -->
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">XYZ University</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">contact@xyz.edu.pk</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2024-03-02</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="#" class="text-green-600 hover:text-green-900 mr-2">Approve</a>
                                    <a href="#" class="text-red-600 hover:text-red-900">Reject</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                /* The closing `</div>` tag `</div>` is closing the `<div>` element that contains the
                table displaying universities pending approval. This helps in maintaining the
                structure and hierarchy of the HTML elements within the Laravel Blade template file. */
                </div>
            </div>
        </div>
    </div>
</x-app-layout>