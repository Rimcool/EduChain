<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-6">Bulk Import Degrees</h1>
                
                <form action="/portal/bulk" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">CSV File</label>
                        <input type="file" name="csv_file" accept=".csv" required
                               class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <p class="mt-2 text-sm text-gray-500">
                            Upload a CSV file with columns: student_name, roll_number, degree_title, graduation_year
                        </p>
                    </div>
                    
                    <div>
                        <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Import Degrees
                        </button>
                    </div>
                </form>
                
                <div class="mt-8">
                    <h2 class="text-lg font-semibold mb-4">CSV Format Example:</h2>
                    <pre class="bg-gray-100 p-4 rounded-lg overflow-x-auto">
student_name,roll_number,degree_title,graduation_year
John Doe,CS12345,BS Computer Science,2024
Jane Smith,CS12346,BS Software Engineering,2024
Ahmed Khan,CS12347,BS Information Technology,2024
                    </pre>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>