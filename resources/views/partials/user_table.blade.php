<!-- Users Table -->
<div class="section-header">
  <h3 class="section-title">
    <i class="fas fa-users-cog text-blue-600"></i>
    Data Users
  </h3>
  <a href="{{ route('user.create') }}" class="add-btn">
    <i class="fas fa-plus"></i>
    Tambah User
  </a>
</div>

<div class="table-container overflow-auto xl:overflow-hidden">
  <table class="min-w-full" id="users">
    <thead class="table-header">
      <tr>
        <th class="text-left">No</th>
        <th class="text-left">Nama</th>
        <th class="text-center">Role</th>
        <th class="text-center">Pembuatan Akun</th>
        <th class="text-center">Tindakan</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $data)
      <tr class="table-row">
      <td class="p-6">
        <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center text-white font-bold text-sm">
          {{ $loop->iteration }}
        </div>
      </td>
      <td class="flex items-center gap-2 p-6">
      <div class="w-12 h-12 p-3 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-xl flex items-center justify-center">
        <i class="fas fa-user text-white"></i>
      </div>
      <div class="min-w-[150px]">
        <div class="component-name font-semibold">{{ $data->name }}</div>
        <div class="component-description text-gray-500">{{ $data->id }}</div>
      </div>
    </td>
    <td class="p-6 text-center w-32">
      <div class="weight-badge inline-flex items-center gap-1">
        <i class="fas fa-user-tag"></i>
        {{ $data->role }}
      </div>
    </td>
      <td class="p-6 text-center">
        {{ $data->created_at->format('d M Y') }}
      </td>
      <td class="p-6 text-center">
        <div class="flex justify-center space-x-2">
          <a href="{{ route('user.edit', $data->id) }}" class="action-btn edit-btn">
            <i class="fas fa-edit"></i>Edit
          </a>
          <form action="{{ route('user.destroy', $data->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="action-btn delete-btn"
              onclick="return confirm('Are you sure you want to delete this user?')">
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
