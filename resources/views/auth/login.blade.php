
    {{-- <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3 bg-[#0058b1] hover:bg-[#004494] transition duration-300">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form> --}}
<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100 relative overflow-hidden">

        <!-- Background removed as requested -->

        <!-- Card -->
        <div class="w-full max-w-5xl flex flex-col md:flex-row overflow-hidden rounded-[25px] shadow-[0_12px_40px_rgba(0,0,0,0.15)] bg-white relative z-10">

            <!-- Login Section -->
            <div class="flex-1 p-10">
                <div class="text-center">
                    <img src="{{ asset('images/pesat.jpg') }}" alt="Logo SMK Pesat" 
                         class="max-w-[90px] mx-auto mb-5 drop-shadow-lg">
                    <h2 class="text-3xl text-[#0058b1] font-extrabold tracking-wide">SMK PESAT</h2>
                    <p class="text-gray-500 mb-8 text-sm">Sistem Evaluasi Guru</p>
                </div>
                
                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf
                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-gray-700 font-semibold mb-1">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" 
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl text-[15px] focus:outline-none focus:border-[#0058b1] focus:ring-2 focus:ring-[#0058b1]/40 transition bg-white/95" 
                            required autofocus autocomplete="username"/>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="relative">
                        <label for="password" class="block text-gray-700 font-semibold mb-1">Password</label>
                        <div class="relative">
                            <input id="password" type="password" name="password" 
                                class="w-full px-4 py-3 pr-10 border-2 border-gray-200 rounded-xl text-[15px] focus:outline-none focus:border-[#0058b1] focus:ring-2 focus:ring-[#0058b1]/40 transition bg-white/95"
                                required autocomplete="current-password"/>
                            <button type="button" 
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-[#0058b1] transition-colors"
                                onclick="togglePasswordVisibility()">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-between mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                            <span class="ms-2 text-sm text-gray-600">Remember me</span>
                        </label>
                        <a href="#" class="underline text-sm text-gray-600 hover:text-gray-900">Lupa Password?</a>
                    </div>

                    <button type="submit" id="loginButton"
                        class="w-full bg-gradient-to-r from-[#0058b1] to-[#004494] text-white py-3 text-[16px] font-bold tracking-wide rounded-xl shadow-md hover:shadow-lg hover:from-[#004494] hover:to-[#003377] hover:scale-[1.01] transition-all duration-300">
                        Login
                    </button>

                    <div class="text-center text-sm mt-3">
                        <a href="#" class="text-[#0058b1] hover:underline">Buat Akun</a>
                    </div>
                </form>
            </div>

            <!-- Info Section -->
            <div class="flex-1 bg-gradient-to-b from-[#0058b1] to-[#004494] text-white flex flex-col justify-center items-center p-10 relative overflow-hidden">
                <div class="absolute -top-20 -right-20 w-[300px] h-[300px] bg-yellow-400/20 rounded-full blur-3xl"></div>
                
                <img src="{{ asset('images/3siswa.png') }}" alt="Gambar Siswa" 
                     class="max-w-[230px] mt-2 mb-8 z-10 animate-float">
                <h2 class="text-2xl font-bold mb-2 z-10">Halo, Admin!</h2>
                <p class="text-base leading-relaxed z-10 opacity-90">Silakan login untuk mengakses<br>Dashboard Evaluasi Guru SMK Pesat.</p>
            </div>
        </div>
    </div>

    <!-- Animasi kustom -->
    <style>
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        .animate-float { animation: float 5s ease-in-out infinite; }
    </style>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.querySelector('#password + button i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }

        // Form submission loading animation
        document.querySelector('form').addEventListener('submit', function(e) {
            const button = document.getElementById('loginButton');
            button.disabled = true;
            button.textContent = 'Logging in...';
            button.classList.add('opacity-75');
        });
    </script>
</x-guest-layout>
