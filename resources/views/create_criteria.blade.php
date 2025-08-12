<x-app-layout>
  <div class="min-h-screen flex items-center justify-center px-4 relative z-10">
    <div class="content-card w-full max-w-2xl p-10 shadow-xl border border-white/20">

      <!-- Judul -->
      <div class="flex flex-row items-center justify-center mb-10 gap-3">
        <i class="fas fa-user-tie text-indigo-600 text-3xl"></i>
        <h2 class="section-title text-white text-3xl m-0 leading-none">Form Pembuatan Kriteria</h2>
      </div>

      <!-- Form -->
      <form action="{{ route('criteria.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <!-- Pilih Icon dan Warna -->
        @include('partials.color_icon')

        <!-- Input Nama Kriteria -->
        <div>
          <label for="name" class="block text-sm font-medium text-indigo-700 mb-2">Nama Kriteria</label>
          <div class="relative">
            <x-text-input type="text" id="name" placeholder="Contoh: pedagogik, profesional"
              class="w-full pl-10 pr-4 py-2 border border-indigo-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
              name="name"/>
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
              <i class="fa-solid fa-medal text-indigo-400"></i>
            </div>
          </div>
        </div>

        <!-- Input Deskripsi Kriteria -->
        <div>
          <label for="description" class="block text-sm font-medium text-indigo-700 mb-2">Deskripsi</label>
          <div class="relative">
            <x-text-input type="text" id="description" placeholder="Contoh: pedagogik, profesional"
              class="w-full pl-10 pr-4 py-2 border border-indigo-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
              name="description"/>
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
              <i class="fa-solid fa-book-bookmark text-indigo-400"></i>
            </div>
          </div>
        </div>

        <!-- Input Mata Pelajaran -->
        <div>
          <label for="weight" class="block text-sm font-medium text-indigo-700 mb-2">Bobot nilai</label>
          <div class="relative">
            <x-text-input type="number" id="weight" name="weight" placeholder="Bobot persen nilai" min="0"
              class="w-full pl-10 pr-4 py-2 border border-indigo-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
              <i class="fa-solid fa-percent text-indigo-400"></i>
            </div>
          </div>
        </div>

        <!-- Tombol Simpan -->
        <button type="submit" class="detail-btn w-full py-3 text-lg">
          <i class="fas fa-save mr-2"></i> Simpan Data Kriteria
        </button>
      </form>
    </div>
  </div>
</x-app-layout>
