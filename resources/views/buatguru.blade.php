<x-app-layout>
    <div class="flex items-center justify-center min-h-screen bg-gray-50 px-4">
        <div class="w-full max-w-xl bg-white p-10 rounded-2xl shadow-xl border border-blue-200 ml-[260px]">
            <!-- Judul -->
            <div class="flex items-center justify-center mb-8 gap-3">
                <i class="fas fa-user-tie text-blue-600 text-2xl"></i>
                <h2 class="text-3xl font-bold text-blue-600">Form Tambah Guru</h2>
            </div>

            <!-- Form -->
            <form action="{{ route('teacher.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Input Nama Guru -->
                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-blue-700 mb-2">Nama Guru</label>
                    <div class="relative">
                        <x-text-input type="text" id="name" placeholder="Nama lengkap guru"
                            class="w-full pl-10 pr-4 py-2 border border-blue-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            name="name"/>
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <i class="fas fa-user text-blue-400"></i>
                        </div>
                    </div>
                </div>

                <!-- Input Gelar -->
                <div class="mb-6">
                    <label for="degree" class="block text-sm font-medium text-blue-700 mb-2">Gelar</label>
                    <div class="relative">
                        <x-text-input type="text" id="degree" placeholder="Contoh: S.Pd, M.Kom"
                            class="w-full pl-10 pr-4 py-2 border border-blue-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            name="degree"/>
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <i class="fas fa-graduation-cap text-blue-400"></i>
                        </div>
                    </div>
                </div>

                <!-- Input Mata Pelajaran -->
                <div class="mb-8">
                    <label for="subject" class="block text-sm font-medium text-yellow-700 mb-2">Mata Pelajaran</label>
                    <div class="relative">
                        <x-text-input type="text" id="subject" placeholder="Mata pelajaran yang diajarkan"
                            class="w-full pl-10 pr-4 py-2 border border-yellow-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500"
                            name="subject"/>
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <i class="fas fa-book text-yellow-400"></i>
                        </div>
                    </div>
                </div>

                <!-- Tombol Simpan -->
                <button type="submit"
                    class="w-full bg-blue-600 text-white font-semibold py-2.5 rounded-lg hover:bg-sky-500 transition duration-200">
                    <i class="fas fa-save mr-2"></i> Simpan
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
