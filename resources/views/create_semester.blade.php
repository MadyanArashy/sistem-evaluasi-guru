<x-app-layout>
    <div class="relative z-10 max-w-lg mx-auto bg-white rounded-3xl shadow-xl p-8 mt-10">
        <!-- Header -->
        <div class="flex flex-col items-center mb-8">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-4 rounded-full mb-3 shadow-md">
                <i class="fa-solid fa-school text-white text-3xl"></i>
            </div>
            <h2 class="text-3xl font-bold text-gray-800">Tambah Semester Baru</h2>
            <p class="text-gray-500 text-sm mt-1">Isi form di bawah untuk menambahkan semester baru</p>
        </div>

        <!-- Form -->
        <form action="{{ route('semester.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            @php
                $inputWrapper =
                  "flex items-center border border-gray-300 rounded-xl px-4 py-2 bg-white
                  focus-within:border-blue-500 focus-within:ring-2 focus-within:ring-blue-200 transition-all";
                $inputClass =
                  "w-full border-none outline-none bg-transparent text-gray-700 placeholder-gray-400";
            @endphp
            <!-- Tahun Ajaran -->
            <div>
              <label class="block mb-2 font-semibold text-gray-700">Tahun Ajaran</label>
              <div class="{{ $inputWrapper }}">
                <i class="fas fa-calendar-alt text-blue-500 mr-3"></i>
                <select name="tahun_ajaran" class="{{ $inputClass }} appearance-none" required>
                  <option value="">Pilih Tahun Ajaran</option>
                  @for ($year = 2024; $year <= 2030; $year++)
                    <option value="{{ $year }}-{{ $year+1 }}">
                      {{ $year }} - {{ $year+1 }}
                    </option>
                  @endfor
                </select>
              </div>
            </div>

            <!-- Semester -->
            <div>
              <label class="block mb-2 font-semibold text-gray-700">Semester</label>
              <div class="{{ $inputWrapper }}">
                <i class="fas fa-user-tag text-blue-500 mr-3"></i>
                <select name="semester" id="semesterSelect" class="{{ $inputClass }} appearance-none" required>
                  <option value="">Pilih semester</option>
                  <option value="1">Ganjil</option>
                  <option value="2">Genap</option>
                </select>
              </div>
            </div>

            <!-- Tombol Simpan -->
            <button type="submit"
                    class="w-full flex items-center justify-center bg-gradient-to-r from-blue-500 to-blue-700
                           text-white py-3 rounded-xl font-semibold shadow-md hover:shadow-lg
                           transform hover:-translate-y-0.5 transition-all duration-300">
                <i class="fas fa-save mr-2"></i> Simpan Data Semester
            </button>
        </form>
    </div>
</x-app-layout>
