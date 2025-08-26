<x-app-layout>
    <div class="relative z-10 max-w-lg mx-auto bg-white rounded-3xl shadow-xl p-8 mt-10">
        <!-- Header -->
        <div class="flex flex-col items-center mb-8">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-4 rounded-full mb-3 shadow-md">
                <i class="fas fa-user-plus text-white text-3xl"></i>
            </div>
            <h2 class="text-3xl font-bold text-gray-800">Tambah User Baru</h2>
            <p class="text-gray-500 text-sm mt-1">Isi form di bawah untuk menambahkan user baru</p>
        </div>

        <!-- Form -->
        <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            @php
                $inputWrapper = "flex items-center border border-gray-300 rounded-xl px-4 py-2 bg-white 
                                focus-within:border-blue-500 focus-within:ring-2 focus-within:ring-blue-200 transition-all";
                $inputClass = "w-full border-none outline-none bg-transparent text-gray-700 placeholder-gray-400";
            @endphp

            <!-- Nama -->
            <div>
                <label class="block mb-2 font-semibold text-gray-700">Nama</label>
                <div class="{{ $inputWrapper }}">
                    <i class="fas fa-user text-blue-500 mr-3"></i>
                    <input type="text" name="name" placeholder="Masukkan nama" class="{{ $inputClass }}" required />
                </div>
            </div>

            <!-- Email -->
            <div>
                <label class="block mb-2 font-semibold text-gray-700">Email</label>
                <div class="{{ $inputWrapper }}">
                    <i class="fas fa-envelope text-blue-500 mr-3"></i>
                    <input type="email" name="email" placeholder="Masukkan email" class="{{ $inputClass }}" required />
                </div>
            </div>

            <!-- Password -->
            <div>
                <label class="block mb-2 font-semibold text-gray-700">Password</label>
                <div class="{{ $inputWrapper }}">
                    <i class="fas fa-lock text-blue-500 mr-3"></i>
                    <input type="password" name="password" placeholder="Masukkan password" class="{{ $inputClass }}" required />
                </div>
            </div>

            <!-- Role -->
            <div>
                <label class="block mb-2 font-semibold text-gray-700">Role</label>
                <div class="{{ $inputWrapper }}">
                    <i class="fas fa-user-tag text-blue-500 mr-3"></i>
                    <select name="role" id="roleSelect" class="{{ $inputClass }} appearance-none" required>
                        <option value="">Pilih role</option>
                        <option value="admin">Admin</option>
                        <option value="guru">Guru</option>
                        <option value="evaluator">Evaluator</option>
                    </select>
                </div>
            </div>

            <!-- Teacher Selection (only shown when role is guru) -->
            <div id="teacherSelection" class="hidden">
                <label class="block mb-2 font-semibold text-gray-700">Pilih Guru</label>
                <div class="{{ $inputWrapper }}">
                    <i class="fas fa-chalkboard-teacher text-blue-500 mr-3"></i>
                    <select name="teacher_id" class="{{ $inputClass }} appearance-none">
                        <option value="">Pilih guru (opsional)</option>
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->name }} - {{ $teacher->subject }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Tombol Simpan -->
            <button type="submit"
                    class="w-full flex items-center justify-center bg-gradient-to-r from-blue-500 to-blue-700 
                           text-white py-3 rounded-xl font-semibold shadow-md hover:shadow-lg 
                           transform hover:-translate-y-0.5 transition-all duration-300">
                <i class="fas fa-save mr-2"></i> Simpan Data User
            </button>

            <!-- JavaScript to show/hide teacher selection -->
            <script>
                document.getElementById('roleSelect').addEventListener('change', function() {
                    const teacherSelection = document.getElementById('teacherSelection');
                    if (this.value === 'guru') {
                        teacherSelection.classList.remove('hidden');
                    } else {
                        teacherSelection.classList.add('hidden');
                    }
                });
            </script>
        </form>
    </div>
</x-app-layout>
