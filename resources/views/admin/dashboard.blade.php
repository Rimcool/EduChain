<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-6">Admin Dashboard</h1>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-blue-50 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold text-blue-900">Total Users</h3>
                        <p class="text-3xl font-bold text-blue-600">1,234</p>
                    </div>
                    <div class="bg-green-50 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold text-green-900">Total Verifications</h3>
                        <p class="text-3xl font-bold text-green-600">5,678</p>
                    </div>
                    <div class="bg-yellow-50 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold text-yellow-900">Fake Degrees Caught</h3>
                        <p class="text-3xl font-bold text-yellow-600">12</p>
                    </div>
                    <div class="bg-purple-50 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold text-purple-900">Universities</h3>
                        <p class="text-3xl font-bold text-purple-600">113</p>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold mb-4">Recent Activity</h3>
                        <div class="space-y-2">
                            <div class="flex justify-between text-sm">
                                <span>University approved: COMSATS</span>
                                <span class="text-gray-500">2 min ago</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span>Degree verified: REAL (A+)</span>
                                <span class="text-gray-500">5 min ago</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span>University pending: ABC University</span>
                                <span class="text-gray-500">10 min ago</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold mb-4">Universities Pending Approval</h3>
                        <div class="space-y-2">
                            <div class="flex justify-between text-sm">
                                <span>XYZ University</span>
                                <span class="text-blue-600">View</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span>DEF College</span>
                                <span class="text-blue-600">View</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>