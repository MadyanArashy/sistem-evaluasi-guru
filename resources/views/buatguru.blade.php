<x-app-layout>
  <style>
  .content-card {
  background: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(25px);
  border-radius: 32px;
  border: 1px solid rgba(255, 255, 255, 0.3);
  box-shadow:
    0 20px 40px rgba(0, 0, 0, 0.1),
    inset 0 1px 0 rgba(255, 255, 255, 0.5);
  margin: 32px;
  padding: 40px;
  position: relative;
  overflow: hidden;
  }

.content-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(90deg, #6366f1, #8b5cf6, #06b6d4, #10b981);
  background-size: 400% 400%;
  animation: gradientShift 3s ease infinite;
}
  </style>
  <div class="gradient-bg">
    <div class="floating-elements">
      <div class="floating-circle"></div>
      <div class="floating-circle"></div>
      <div class="floating-circle"></div>
    </div>

    <div class="min-h-screen flex items-center justify-center px-4 relative z-10">
      <div class="content-card w-full max-w-2xl p-10 shadow-xl border border-white/20">

        <!-- Judul -->
        <div class="flex items-center justify-center mb-10 gap-3">
          <i class="fas fa-user-tie text-white text-3xl"></i>
          <h2 class="section-title text-white text-3xl">Form Tambah Guru</h2>
        </div>

        <!-- Form -->
        <form action="{{ route('teacher.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
          @csrf

          <!-- Input Nama Guru -->
          <div>
            <label for="name" class="block text-sm font-medium text-indigo-700 mb-2">Nama Guru</label>
            <div class="relative">
              <x-text-input type="text" id="name" placeholder="Nama lengkap guru"
                class="w-full pl-10 pr-4 py-2 border border-indigo-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                name="name"/>
              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <i class="fas fa-user text-indigo-400"></i>
              </div>
            </div>
          </div>

          <!-- Input Gelar -->
          <div>
            <label for="degree" class="block text-sm font-medium text-indigo-700 mb-2">Gelar</label>
            <div class="relative">
              <x-text-input type="text" id="degree" name="degree" placeholder="Contoh: S.Pd, M.Kom"
                class="w-full pl-10 pr-4 py-2 border border-indigo-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <i class="fas fa-graduation-cap text-indigo-400"></i>
              </div>
            </div>
          </div>

          <!-- Input Mata Pelajaran -->
          <div>
            <label for="subject" class="block text-sm font-medium text-indigo-700 mb-2">Mata Pelajaran</label>
            <div class="relative">
              <x-text-input type="text" id="subject" name="subject" placeholder="Mata pelajaran yang diajarkan"
                class="w-full pl-10 pr-4 py-2 border border-indigo-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <i class="fas fa-book text-indigo-400"></i>
              </div>
            </div>
          </div>

          <!-- Tombol Simpan -->
          <button type="submit" class="detail-btn w-full py-3 text-lg">
            <i class="fas fa-save mr-2"></i> Simpan Data Guru
          </button>
        </form>
      </div>
    </div>
  </div>
</x-app-layout>
