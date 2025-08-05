<x-app-layout>
  <!-- Content -->
  <div class="ml-[250px] mt-[100px] p-8">
    <div class="bg-white rounded-xl shadow-lg p-6">
      <div class="flex justify-between items-center mb-6">
        <h5 class="text-lg font-semibold text-gray-700">
          <i class="fas fa-table mr-2 text-purple-600"></i>
          Data Guru
        </h5>
        <a href="{{ route('teacher.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
          <i class="fas fa-plus mr-2"></i>
          Tambah Guru
        </a>
      </div>
      
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Nama Guru
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Gelar
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Mata Pelajaran
              </th>
              <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Skor Evaluasi
              </th>
              <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Aksi
              </th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <!-- Data Guru 1 -->
            <tr class="hover:bg-gray-50 transition-colors">
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="flex-shrink-0 h-8 w-8">
                    <i class="fas fa-user-tie text-blue-500 text-lg"></i>
                  </div>
                  <div class="ml-4">
                    <div class="text-sm font-medium text-blue-600 font-semibold">Siti Rahayu</div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">Dr., M.Pd</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="flex-shrink-0 h-8 w-8">
                    <i class="fas fa-book text-blue-500 text-lg"></i>
                  </div>
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">Matematika</div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-center">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                  4.5
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-center">
                <div class="flex justify-center space-x-2">
                  <a href="{{ route('teacher.create') }}" class="text-yellow-600 hover:text-yellow-900 font-medium text-sm bg-yellow-50 hover:bg-yellow-100 px-3 py-1 rounded-md transition-colors">
                    <i class="fas fa-edit mr-1"></i>
                    Edit
                  </a>
                  <a href="{{ route('teacher.create') }}" class="text-red-600 hover:text-red-900 font-medium text-sm bg-red-50 hover:bg-red-100 px-3 py-1 rounded-md transition-colors">
                    <i class="fas fa-trash mr-1"></i>
                    Hapus
                  </a>
                </div>
              </td>
            </tr>

            <!-- Data Guru 2 -->
            <tr class="hover:bg-gray-50 transition-colors">
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="flex-shrink-0 h-8 w-8">
                    <i class="fas fa-user-tie text-green-500 text-lg"></i>
                  </div>
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">Budi Santoso</div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">S.Pd</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="flex-shrink-0 h-8 w-8">
                    <i class="fas fa-flask text-green-500 text-lg"></i>
                  </div>
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">IPA (Fisika)</div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-center">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                  3.8
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-center">
                <div class="flex justify-center space-x-2">
                  <a href="{{ route('teacher.create') }}" class="text-yellow-600 hover:text-yellow-900 font-medium text-sm bg-yellow-50 hover:bg-yellow-100 px-3 py-1 rounded-md transition-colors">
                    <i class="fas fa-edit mr-1"></i>
                    Edit
                  </a>
                  <a href="{{ route('teacher.create') }}" class="text-red-600 hover:text-red-900 font-medium text-sm bg-red-50 hover:bg-red-100 px-3 py-1 rounded-md transition-colors">
                    <i class="fas fa-trash mr-1"></i>
                    Hapus
                  </a>
                </div>
              </td>
            </tr>

            <!-- Data Guru 3 -->
            <tr class="hover:bg-gray-50 transition-colors">
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="flex-shrink-0 h-8 w-8">
                    <i class="fas fa-user-tie text-purple-500 text-lg"></i>
                  </div>
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">Ani Wijaya</div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">M.Hum</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="flex-shrink-0 h-8 w-8">
                    <i class="fas fa-globe text-purple-500 text-lg"></i>
                  </div>
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">Bahasa Indonesia</div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-center">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                  4.2
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-center">
                <div class="flex justify-center space-x-2">
                  <a href="{{ route('teacher.create') }}" class="text-yellow-600 hover:text-yellow-900 font-medium text-sm bg-yellow-50 hover:bg-yellow-100 px-3 py-1 rounded-md transition-colors">
                    <i class="fas fa-edit mr-1"></i>
                    Edit
                  </a>
                  <a href="{{ route('teacher.create') }}" class="text-red-600 hover:text-red-900 font-medium text-sm bg-red-50 hover:bg-red-100 px-3 py-1 rounded-md transition-colors">
                    <i class="fas fa-trash mr-1"></i>
                    Hapus
                  </a>
                </div>
              </td>
            </tr>

            <!-- Data Guru 4 -->
            <tr class="hover:bg-gray-50 transition-colors">
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="flex-shrink-0 h-8 w-8">
                    <i class="fas fa-user-tie text-red-500 text-lg"></i>
                  </div>
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">Dewi Lestari</div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">S.Sn</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="flex-shrink-0 h-8 w-8">
                    <i class="fas fa-palette text-red-500 text-lg"></i>
                  </div>
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">Seni Budaya</div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-center">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                  3.5
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-center">
                <div class="flex justify-center space-x-2">
                  <a href="{{ route('teacher.create') }}" class="text-yellow-600 hover:text-yellow-900 font-medium text-sm bg-yellow-50 hover:bg-yellow-100 px-3 py-1 rounded-md transition-colors">
                    <i class="fas fa-edit mr-1"></i>
                    Edit
                  </a>
                  <a href="{{ route('teacher.create') }}" class="text-red-600 hover:text-red-900 font-medium text-sm bg-red-50 hover:bg-red-100 px-3 py-1 rounded-md transition-colors">
                    <i class="fas fa-trash mr-1"></i>
                    Hapus
                  </a>
                </div>
              </td>
            </tr>

            <!-- Data Guru 5 -->
            <tr class="hover:bg-gray-50 transition-colors">
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="flex-shrink-0 h-8 w-8">
                    <i class="fas fa-user-tie text-orange-500 text-lg"></i>
                  </div>
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">Ahmad Fauzi</div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">S.Pd</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="flex-shrink-0 h-8 w-8">
                    <i class="fas fa-dumbbell text-orange-500 text-lg"></i>
                  </div>
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">Pendidikan Jasmani</div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-center">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                  4.0
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-center">
                <div class="flex justify-center space-x-2">
                  <a href="{{ route('teacher.create') }}" class="text-yellow-600 hover:text-yellow-900 font-medium text-sm bg-yellow-50 hover:bg-yellow-100 px-3 py-1 rounded-md transition-colors">
                    <i class="fas fa-edit mr-1"></i>
                    Edit
                  </a>
                  <a href="{{ route('teacher.create') }}" class="text-red-600 hover:text-red-900 font-medium text-sm bg-red-50 hover:bg-red-100 px-3 py-1 rounded-md transition-colors">
                    <i class="fas fa-trash mr-1"></i>
                    Hapus
                  </a>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</x-app-layout>
