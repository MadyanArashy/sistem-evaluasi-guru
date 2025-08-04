<x-guest-layout>
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

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form> --}}

        <div class="bg-white rounded-[15px] shadow-[0_8px_30px_rgba(0,0,0,0.1)] flex overflow-hidden flex-col md:flex-row">

            <!-- Login Section -->
            <div class="flex-1 p-10 bg-white">
                <img src="{{ asset('images/pesat.jpg') }}" alt="Logo SMK Pesat" class="max-w-[120px] mx-auto mb-8">
                <h2 class="text-3xl text-[#0058b1] font-bold mb-6 text-center">Selamat Datang!</h2>
                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf
                    <!-- Email -->
                     <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="w-full px-4 py-3 border-2 border-gray-200 rounded-[12px] text-[15px] focus:outline-none focus:border-[#0058b1] transition duration-300"
                            type="email"
                            name="email"
                            :value="old('email')"
                            required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />

                        <x-text-input id="password" class="w-full px-4 py-3 border-2 border-gray-200 rounded-[12px] text-[15px] focus:outline-none focus:border-[#0058b1] transition duration-300"
                                        type="password"
                                        name="password"
                                        required autocomplete="current-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <button type="submit"
                        class="w-full bg-[#0058b1] text-white py-3 text-[16px] font-semibold rounded-[12px] hover:bg-[#004494] hover:-translate-y-0.5 transition duration-300">
                        Login
                    </button>
                </form>
            </div>

            <!-- Register Section -->
            <div class="bg-[#0058b1] text-white flex flex-col justify-start items-center p-10 relative text-center overflow-hidden">
                <div class="absolute -top-[50%] -right-[50%] w-[200px] h-[200px] bg-yellow-400 opacity-10 rounded-full"></div>
                <img src="{{ asset('images/3siswa.png') }}" alt="Gambar Siswa" class="max-w-[250px] mt-2 mb-8 z-10">
                <h2 class="text-2xl font-bold mb-2 z-10">Hello, Admin!</h2>
                <p class="text-base leading-relaxed z-10">Silakan login untuk mengakses dashboard Evaluasi Guru SMK Pesat.</p>
            </div>

        </div>

</x-guest-layout>
