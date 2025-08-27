<x-app-layout>
  <div class="min-h-screen flex items-center justify-center px-4 relative z-10">
    <div class="content-card w-full max-w-2xl p-10 shadow-xl border border-white/20">

      <!-- Judul -->
      <div class="flex items-center justify-center mb-10 gap-3">
        <i class="fa-solid fa-table-cells text-indigo-700 text-3xl"></i>
        <h2 class="section-title text-indigo-400 text-3xl m-0 leading-none">Form Tambah Komponen</h2>
      </div>

      <!-- Form -->
      <form action="{{ route('component.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Input Kriteria -->
        <div>
          <label for="criteriaSelect" class="block text-sm font-medium text-indigo-700 mb-2">Kriteria</label>
          <div class="relative">
            <select id="criteriaSelect" name="criteria_id"
              class="border-indigo-400 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm cursor-pointer w-full pl-10 pr-4 py-2 border focus:outline-none focus:ring-2">
             @foreach($criterias as $data)
              <option value="{{ $data->id }}"
                data-textcolor="{{ trim(explode(',', str_replace(')', '', $data->style))[1]) }}">
                {{ $data->name }}
              </option>

            @endforeach

            </select>
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
              <i class="fa-solid fa-key text-white" id="criteriaIcon"></i>
            </div>
          </div>
        </div>

        <!-- Input Nama Guru -->
        <div>
          <label for="name" class="block text-sm font-medium text-indigo-700 mb-2">Nama Komponen</label>
          <div class="relative">
            <x-text-input type="text" id="name" placeholder="Nama lengkap komponen"
              class="w-full pl-10 pr-4 py-2 border border-indigo-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
              name="name"/>
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
              <i class="fa-solid fa-table-cells text-indigo-400"></i>
            </div>
          </div>
        </div>

        <!-- Input Deskripsi -->
        <div>
          <label for="description" class="block text-sm font-medium text-indigo-700 mb-2">Deskripsi</label>
          <div class="relative">
            <x-text-input type="text" id="description" name="description" placeholder="Penjelasan komponen"
              class="w-full pl-10 pr-4 py-2 border border-indigo-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
              <i class="fa-solid fa-book-bookmark text-indigo-400"></i>
            </div>
          </div>
        </div>

        <!-- Input Bobot Per Kriteria -->
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
          <i class="fas fa-save mr-2"></i> Simpan Data Komponen
        </button>
      </form>
    </div>
  </div>
  <script>
  document.addEventListener('DOMContentLoaded', function () {
    const select = document.getElementById('criteriaSelect');
    const icon = document.getElementById('criteriaIcon');

    function applySelectedTextColor() {
      const selectedOption = select.options[select.selectedIndex];
      const textColor = selectedOption.dataset.textcolor;
      select.style.color = textColor;
      icon.style.color = textColor;
    }

    applySelectedTextColor();
    select.addEventListener('change', applySelectedTextColor);
  });


  </script>
</x-app-layout>
