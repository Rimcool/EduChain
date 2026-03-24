<x-guest-layout>
    <div class="min-h-screen bg-gray-900 py-12">
        <div class="max-w-md mx-auto bg-gray-800 rounded-lg shadow-xl p-6">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-green-400">EduChain</h1>
                <p class="text-gray-400 mt-2">Create your account</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-4">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full bg-gray-700 border-gray-600 text-white" type="text" name="name" :value="old('name')" required autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full bg-gray-700 border-gray-600 text-white" type="email" name="email" :value="old('email')" required />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full bg-gray-700 border-gray-600 text-white" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full bg-gray-700 border-gray-600 text-white" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <x-input-label for="role" :value="__('I am a')" />
                    <select name="role" id="role" class="block mt-1 w-full bg-gray-700 border-gray-600 text-white rounded-md" required>
                        <option value="">Select your role</option>
                        <option value="recruiter">Recruiter / HR</option>
                        <option value="university">University Admin</option>
                        <option value="student">Student</option>
                    </select>
                    <x-input-error :messages="$errors->get('role')" class="mt-2" />
                </div>

                <div class="mb-4" id="university-field" style="display: none;">
                    <x-input-label for="university_name" :value="__('University Name')" />
                    <x-text-input id="university_name" class="block mt-1 w-full bg-gray-700 border-gray-600 text-white" type="text" name="university_name" />
                    <x-input-error :messages="$errors->get('university_name')" class="mt-2" />
                </div>

                <div class="mb-4" id="company-field" style="display: none;">
                    <x-input-label for="company_name" :value="__('Company Name')" />
                    <x-text-input id="company_name" class="block mt-1 w-full bg-gray-700 border-gray-600 text-white" type="text" name="company_name" />
                    <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
                </div>

                <div class="flex items-center justify-between mb-6">
                    <a class="text-sm text-green-400 hover:text-green-300" href="{{ route('login') }}">
                        Already have an account? Login
                    </a>
                </div>

                <div class="flex items-center justify-end">
                    <x-primary-button class="w-full bg-green-600 hover:bg-green-700">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('role').addEventListener('change', function() {
            const universityField = document.getElementById('university-field');
            const companyField = document.getElementById('company-field');
            
            universityField.style.display = 'none';
            companyField.style.display = 'none';
            
            if (this.value === 'university') {
                universityField.style.display = 'block';
            } else if (this.value === 'recruiter') {
                companyField.style.display = 'block';
            }
        });
    </script>
</x-guest-layout>