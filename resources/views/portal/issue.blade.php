<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-6">Issue Degree</h1>
                
                <form action="/portal/issue" method="POST" class="space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Student Name</label>
                            <input type="text" name="student_name" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Roll Number</label>
                            <input type="text" name="roll_number" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Degree Title</label>
                            <input type="text" name="degree_title" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Graduation Year</label>
                            <input type="number" name="graduation_year" required min="1947" max="{{ date('Y') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">University Name</label>
                        <input type="text" name="university_name" value="{{ auth()->user()->university_name }}" readonly
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100">
                    </div>
                    
                    <div>
                        <button type="submit"
                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Issue Degree on Blockchain
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>