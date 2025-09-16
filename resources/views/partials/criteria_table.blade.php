<div class="section-header">
  <h3 class="section-title">
    <i class="fas fa-list-check text-blue-600"></i>
    Kriteria Evaluasi
  </h3>
  <a href="{{ route('criteria.create') }}" class="add-btn action-btn">
    <i class="fas fa-plus"></i>
    Tambah Kriteria
  </a>
</div>

<div class="table-container overflow-auto 2xl:overflow-hidden">
  <table class="min-w-full" id="criterias">
    <thead class="table-header">
      <tr>
        <th class="text-left">No</th>
        <th class="text-left">Nama Kriteria</th>
        <th class="text-center">Bobot</th>
        <th class="text-center">Tindakan</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1 ?>
      @foreach($criterias as $data)
      <tr class="table-row">
        <td class="p-6">
          <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center text-white font-bold text-sm">
            {{ $loop->iteration }}
          </div>
        </td>
        <td class="flex items-center gap-4 p-6">
          <div class="w-12 h-12 p-4 bg-gradient-to-br text-white rounded-xl flex items-center justify-center" style="background:{{ $data->style }}">
            <i class="{{ $data->icon }}"></i>
          </div>
          <div class="min-w-60">
            <div class="component-name">{{ $data->name }}</div>
            <div class="component-description">{{ $data->description }}</div>
          </div>
        </td>
        <td class="p-6 text-center">
          <div class="weight-badge">
            <i class="fas fa-percentage"></i>
            {{ $data->weight }}%
          </div>
        </td>
        <td class="p-6 text-center">
          <div class="flex justify-center space-x-2">
            <a href="{{ route('criteria.edit', ['id' => $data->id]) }}" class="action-btn edit-btn">
              <i class="fas fa-edit"></i> Edit
            </a>
            <form action="{{ route('criteria.destroy', $data->id) }}" method="POST" style="display:inline;">
              @csrf
              @method('DELETE')
              <button type="submit" class="action-btn delete-btn" onclick="return confirm('Are you sure you want to delete this criteria?')">
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
