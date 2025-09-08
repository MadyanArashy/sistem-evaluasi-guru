<!-- Users Table -->
<div class="section-header">
  <h3 class="section-title">
    <i class="fas fa-users-cog text-blue-600"></i>
    Data Semester
  </h3>
  <a href="{{ route('semester.create') }}" class="add-btn">
    <i class="fas fa-plus"></i>
    Tambah Semester
  </a>
</div>

<div class="table-container overflow-auto xl:overflow-hidden">
  <table class="min-w-full" id="semesters">
    <thead class="table-header">
      <tr>
        <th class="text-left">No</th>
        <th class="text-left">Semester</th>
        <th class="text-center">Tahun Ajaran</th>
        <th class="text-center">Tindakan</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($semesters as $data)
      <tr class="table-row">
      <td class="p-6">
        <div class="w-8 h-8 bg-pink-500 rounded-lg flex items-center justify-center text-white font-bold text-sm">
          {{ $loop->iteration }}
        </div>
      </td>
      <td class="flex items-center gap-2 p-6">
      <div class="w-12 h-12 p-3 bg-gradient-to-br from-pink-500 to-purple-600 rounded-xl flex items-center justify-center">
        <i class="fa-solid fa-calendar-days text-white"></i>
      </div>
      <div class="min-w-[150px]">
        <div class="component-name font-semibold">
          {{ $data->semester == 1 ? 'Ganjil' : 'Genap' }}
        </div>
      </div>
    </td>
      <td class="p-6 text-center">
        {{ $data->tahun_ajaran }}
      </td>
      <td class="p-6 text-center">
        <div class="flex justify-center space-x-2">
          <form action="{{ route('semester.destroy', $data->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="action-btn delete-btn"
              onclick="return confirm('Are you sure you want to delete this semester?')">
              <i class="fas fa-trash"></i> Hapus
            </button>
          </form>
        </div>
      </td>
    </tr>
    @endforeach
    </tbody>
  </table>
</div>
