<x-app-layout>
<style>
.header-title {
  color: white;
  font-size: 2rem;
  font-weight: 800;
  text-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  background: linear-gradient(135deg, #ffffff, #e5e7eb);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.search-filter-section {
  display: flex;
  flex-direction: column;
  gap: 16px;
  margin-bottom: 32px;
  padding: 24px;
  background: linear-gradient(135deg, rgba(248, 250, 252, 0.8), rgba(241, 245, 249, 0.6));
  border-radius: 20px;
  border: 1px solid rgba(99, 102, 241, 0.1);
}

@media (min-width: 640px) {
  .search-filter-section {
    flex-direction: row;
    align-items: center;
  }
}

.search-input {
  flex: 1;
  padding: 16px 20px;
  border-radius: 12px;
  border: 2px solid rgba(99, 102, 241, 0.1);
  background: rgba(255, 255, 255, 0.9);
  backdrop-filter: blur(10px);
  font-size: 1rem;
  transition: all 0.3s ease;
  position: relative;
}

.search-input:focus {
  outline: none;
  border-color: #6366f1;
  box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
  transform: translateY(-2px);
}

.filter-select {
  padding: 16px 20px;
  border-radius: 12px;
  border: 2px solid rgba(99, 102, 241, 0.1);
  background: rgba(255, 255, 255, 0.9);
  backdrop-filter: blur(10px);
  cursor: pointer;
  transition: all 0.3s ease;
  min-width: 200px;
}

.filter-select:focus {
  outline: none;
  border-color: #6366f1;
  box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
}

.pagination-section {
  margin-top: 32px;
  padding: 24px;
  background: linear-gradient(135deg, rgba(248, 250, 252, 0.8), rgba(241, 245, 249, 0.6));
  border-radius: 20px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 16px;
}

.pagination-info span {
  color: #374151;
  font-weight: 700;
}

.pagination-controls {
  display: flex;
  gap: 8px;
  align-items: center;
}

.pagination-btn {
  padding: 12px 16px;
  border-radius: 10px;
  border: 2px solid rgba(99, 102, 241, 0.1);
  background: rgba(255, 255, 255, 0.9);
  color: #374151;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  min-width: 44px;
  text-align: center;
  text-decoration: none;
}

.pagination-btn:hover {
  background: linear-gradient(135deg, #3b82f6, #1d4ed8);
  color: white;
  border-color: transparent;
  transform: translateY(-2px);
  box-shadow: 0 8px 16px rgba(99, 102, 241, 0.3);
}

.pagination-btn.active {
  background: linear-gradient(135deg, #3b82f6, #1d4ed8);
  color: white;
  border-color: transparent;
  box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
}

.pagination-btn:disabled {
  opacity: 0.5;
  cursor: not-allowed;
  pointer-events: none;
}

.time-badge {
  display: inline-block;
  padding: 8px 16px;
  background: linear-gradient(135deg, #e24040, #bc2828);
  color: white;
  border-radius: 20px;
  font-size: 0.875rem;
  font-weight: 600;
}

@media (max-width: 768px) {
  .search-filter-section {
    padding: 16px;
  }

  .pagination-section {
    flex-direction: column;
    text-align: center;
  }
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes ripple {
  to {
    transform: scale(2);
    opacity: 0;
  }
}
</style>

<!-- Main Content -->
<div class="mx-auto px-2 py-12 relative z-10">
  <div class="content-card">
    <div class="text-gray-900">

      <!-- Section Header -->
      <div class="section-header">
        <h3 class="section-title">
          <i class="fas fa-chalkboard-teacher text-blue-600"></i>
          Aktivitas Terkini
        </h3>
      </div>

      <!-- Success Message -->
      @if(session('success'))
        @include('partials.success')
      @endif

      <!-- Search and Filter Section -->
      <div class="search-filter-section">
        <div class="relative flex-1">
          <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 text-lg"></i>
          <input type="text" id="searchInput" placeholder="Cari berdasarkan nama, deskripsi, atau tipe..."
            class="search-input pl-12" />
        </div>
        <div class="relative">
          <i class="fas fa-filter absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
          <select id="filterByType" class="filter-select pl-12">
            <option value="" selected>Semua Tipe</option>
            @foreach($activities->pluck('type')->unique() as $type)
              <option value="{{ $type }}">{{ $type }}</option>
            @endforeach
          </select>
        </div>
      </div>

      <!-- Activities Table -->
      <div class="table-container">
        <table class="min-w-full table-fixed" id="activityTable">
          <colgroup>
            <col style="width: 8%">
            <col style="width: 20%">
            <col style="width: 45%">
            <col style="width: 15%">
            <col style="width: 12%">
          </colgroup>
          <thead class="table-header">
            <tr>
              <th class="text-left px-6 py-4">No</th>
              <th class="text-left px-6 py-4">Nama</th>
              <th class="text-left px-6 py-4">Deskripsi</th>
              <th class="text-center px-6 py-4">Tipe</th>
              <th class="text-center px-6 py-4">Pelaku</th>
              <th class="text-center px-6 py-4">Waktu</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($activities as $index => $data)
              <tr class="table-row">
                <td class="px-6 py-4 align-top">
                  <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                    {{ $index + 1 }}
                  </div>
                </td>
                <td class="px-6 py-4 align-top">
                  <div class="font-bold text-gray-900 break-words">{{ $data->name }}</div>
                </td>
                <td class="px-6 py-4 align-top">
                  <div class="text-gray-900 break-words leading-relaxed">{{ $data->description }}</div>
                </td>
                <td class="px-6 py-4 text-center align-top">
                  <span class="weight-badge whitespace-nowrap">{{ $data->type }}</span>
                </td>
                <td class="px-6 py-4 text-center align-top">
                  <span class="score-badge whitespace-nowrap">
                    @if(isset($data->user))
                    {{ $data->user->name ?? $data->user_id }}
                    @else
                    {{ $data->user_id }}
                    @endif
                  </span>
                </td>
                <td class="px-6 py-4 text-center align-top">
                  <span class="time-badge whitespace-nowrap">{{ $data->created_at }}</span>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <!-- Pagination Section -->
      {{-- <div class="pagination-section">
        @if(method_exists($activities, 'total'))
          <!-- For paginated results -->
          <div class="pagination-info">
            Menampilkan <span>{{ $activities->firstItem() }}</span> sampai <span>{{ $activities->lastItem() }}</span> dari <span>{{ $activities->total() }}</span> aktivitas
          </div>
          <div class="pagination-controls">
            @if($activities->onFirstPage())
              <button class="pagination-btn" disabled>
                <i class="fas fa-chevron-left mr-1"></i>
                Sebelumnya
              </button>
            @else
              <a href="{{ $activities->previousPageUrl() }}" class="pagination-btn">
                <i class="fas fa-chevron-left mr-1"></i>
                Sebelumnya
              </a>
            @endif

            @foreach($activities->getUrlRange(1, $activities->lastPage()) as $page => $url)
              @if($page == $activities->currentPage())
                <button class="pagination-btn active">{{ $page }}</button>
              @else
                <a href="{{ $url }}" class="pagination-btn">{{ $page }}</a>
              @endif
            @endforeach

            @if($activities->hasMorePages())
              <a href="{{ $activities->nextPageUrl() }}" class="pagination-btn">
                Selanjutnya
                <i class="fas fa-chevron-right ml-1"></i>
              </a>
            @else
              <button class="pagination-btn" disabled>
                Selanjutnya
                <i class="fas fa-chevron-right ml-1"></i>
              </button>
            @endif
          </div>
        @else
          <!-- For regular collections -->
          <div class="pagination-info">
            Menampilkan <span>1</span> sampai <span>{{ $activities->count() }}</span> dari <span>{{ $activities->count() }}</span> aktivitas
          </div>
          <div class="pagination-controls">
            <button class="pagination-btn" disabled>
              <i class="fas fa-chevron-left mr-1"></i>
              Sebelumnya
            </button>
            <button class="pagination-btn active">1</button>
            <button class="pagination-btn" disabled>
              Selanjutnya
              <i class="fas fa-chevron-right ml-1"></i>
            </button>
          </div>
        @endif
      </div> --}}
       <div class="pagination-container">
          {{ $activities->appends(request()->query())->links('custom.pagination') }}
        </div>
    </div>
  </div>
</div>

<!-- Enhanced JavaScript for Search and Filter -->
{{-- <script>
document.addEventListener('DOMContentLoaded', function() {
  // Enhanced search functionality
  const searchInput = document.getElementById('searchInput');
  const filterSelect = document.getElementById('filterByType');

  if (searchInput) {
    searchInput.addEventListener('keyup', function () {
      const searchValue = this.value.toLowerCase();
      const rows = document.querySelectorAll('#activityTable tbody tr');
      let visibleCount = 0;

      rows.forEach((row, index) => {
        const cells = row.querySelectorAll('td');
        let found = false;

        // Search in name, description, type, and user columns
        for (let i = 1; i < cells.length; i++) {
          if (cells[i].textContent.toLowerCase().includes(searchValue)) {
            found = true;
            break;
          }
        }

        if (found) {
          row.style.display = '';
          row.style.animation = `fadeIn 0.3s ease ${index * 0.1}s both`;
          visibleCount++;
        } else {
          row.style.display = 'none';
        }
      });

      // Update pagination info
      updatePaginationInfo(visibleCount);
    });
  }

  // Enhanced filter functionality
  if (filterSelect) {
    filterSelect.addEventListener('change', function () {
      const filterValue = this.value.toLowerCase();
      const rows = document.querySelectorAll('#activityTable tbody tr');
      let visibleCount = 0;

      rows.forEach((row, index) => {
        const typeCell = row.querySelectorAll('td')[3];
        const type = typeCell ? typeCell.textContent.toLowerCase() : '';
        const shouldShow = !filterValue || type.includes(filterValue);

        if (shouldShow) {
          row.style.display = '';
          row.style.animation = `fadeIn 0.3s ease ${index * 0.1}s both`;
          visibleCount++;
        } else {
          row.style.display = 'none';
        }
      });

      updatePaginationInfo(visibleCount);
    });
  }

  // Update pagination info
  function updatePaginationInfo(count) {
    const paginationInfo = document.querySelector('.pagination-info');
    if (paginationInfo) {
      paginationInfo.innerHTML = `Menampilkan <span>1</span> sampai <span>${Math.min(10, count)}</span> dari <span>${count}</span> aktivitas`;
    }
  }

  // Pagination button interactions
  document.querySelectorAll('.pagination-btn').forEach(btn => {
    btn.addEventListener('click', function(e) {
      // Only add ripple effect, don't prevent navigation for links
      if (this.tagName === 'BUTTON') {
        // Remove active class from all buttons
        document.querySelectorAll('.pagination-btn').forEach(b => b.classList.remove('active'));

        // Add active class to clicked button (if it's a number)
        if (!isNaN(this.textContent.trim())) {
          this.classList.add('active');
        }
      }

      // Add ripple effect
      const ripple = document.createElement('div');
      ripple.style.position = 'absolute';
      ripple.style.background = 'rgba(255, 255, 255, 0.5)';
      ripple.style.borderRadius = '50%';
      ripple.style.transform = 'scale(0)';
      ripple.style.animation = 'ripple 0.6s linear';
      ripple.style.left = '50%';
      ripple.style.top = '50%';
      ripple.style.width = ripple.style.height = '100px';
      ripple.style.marginLeft = ripple.style.marginTop = '-50px';
      ripple.style.pointerEvents = 'none';

      this.style.position = 'relative';
      this.style.overflow = 'hidden';
      this.appendChild(ripple);

      setTimeout(() => {
        if (ripple.parentNode) {
          ripple.remove();
        }
      }, 600);
    });
  });
});
</script> --}}
</x-app-layout>
