<x-app-layout>
<style>
@keyframes gradientShift {
  0%, 100% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
}

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

.section-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 32px;
  padding-bottom: 20px;
  border-bottom: 2px solid rgba(37, 99, 235, 0.1);
  position: relative;
}

.section-header::after {
  content: '';
  position: absolute;
  bottom: -2px;
  left: 0;
  width: 100%;
  height: 2px;
  background: linear-gradient(90deg, #2563eb, #0ea5e9);
  border-radius: 1px;
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

.score-badge::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
  transition: left 0.5s ease;
}

.score-badge:hover::before {
  left: 100%;
}

.edit-btn {
  background: linear-gradient(135deg, #f59e0b, #d97706);
  color: white;
  box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
}

.edit-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(245, 158, 11, 0.4);
}

.delete-btn {
  background: linear-gradient(135deg, #ef4444, #dc2626);
  color: white;
  box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
}

.delete-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(239, 68, 68, 0.4);
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

.pagination-info {
  color: #6b7280;
  font-weight: 500;
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

@media (max-width: 768px) {
  .content-card {
    margin: 16px;
    padding: 24px;
    border-radius: 24px;
  }

  .search-filter-section {
    padding: 16px;
  }

  .pagination-section {
    flex-direction: column;
    text-align: center;
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
            Manajemen Data Guru
          </h3>
          <a href="{{ route('teacher.create') }}" class="add-btn">
            <i class="fas fa-plus mr-2"></i> Tambah Guru Baru
          </a>
        </div>

        <!-- Success Message -->
        @if(session('success'))
          @include('partials.success')
        @endif

        <!-- Search and Filter Section -->
        <div class="search-filter-section">
          <div class="relative flex-1">
            <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 text-lg"></i>
            <input type="text" id="searchInput" placeholder="Cari berdasarkan nama, gelar, atau mata pelajaran..."
              class="search-input pl-12" />
          </div>
          <div class="relative">
            <i class="fas fa-filter absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            <select id="filterMapel" class="filter-select pl-12">
              <option value="" selected>Semua Mata Pelajaran</option>
              @foreach($teachers->unique('subject')->pluck('subject') as $subject)
              <option value="{{ $subject }}">{{ $subject }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <!-- Teachers Table -->
        <div class="table-container overflow-auto xl:overflow-hidden">
          <table class="min-w-full" id="guruTable">
            <thead class="table-header">
              <tr>
                <th class="text-left">No</th>
                <th class="text-left">Profil Guru</th>
                <th class="text-left">Kualifikasi</th>
                <th class="text-left">Bidang Keahlian</th>
                @if(Auth::user()->role !== 'guru')
                <th class="text-center">Performa</th>
                <th class="text-center">Tindakan</th>
                @endif
              </tr>
            </thead>
            <tbody>
              <?php $no = 1 ?>
              @foreach ($teachers as $data)
                <tr class="table-row">
                  <td class="p-6">
                    <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                      {{ $no++ }}
                    </div>
                  </td>
                  <td class="p-6">
                    <div class="flex items-center space-x-4">
                      <div class="w-12 h-12 p-4 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                        {{ substr($data->name, 0, 1) }}
                      </div>
                      <div>
                        <p class="text-lg font-bold text-gray-900 block">{{ $data->name }}</p>
                        <div class="text-sm text-gray-500 flex items-center mt-1">
                          Guru Profesional
                        </div>
                      </div>
                    </div>
                  </td>
                  <td class="p-6">
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-gradient-to-r from-purple-100 to-indigo-100 text-purple-800 border border-purple-200">
                      <i class="fas fa-graduation-cap mr-2"></i>
                      {{ $data->degree }}
                    </span>
                  </td>
                  <td class="p-6">
                    <div class="flex items-center space-x-3">
                      <div class="w-12 h-12 p-4 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-book text-white"></i>
                      </div>
                      <div>
                        <div class="font-bold text-gray-900">{{ $data->subject }}</div>
                        <div class="text-sm text-gray-500">Mata Pelajaran</div>
                      </div>
                    </div>
                  </td>
                  @if(Auth::user()->role !== 'guru')
                  <td class="p-6 text-center">
                    <div class="score-badge">
                      <i class="fas fa-star mr-1"></i>
                      <span class="evalScore">
                        {{ $scores[$data->id] ?? '0.00' }}
                      </span>
                    </div>
                  </td>
                  <td class="p-6 text-center">
                    <div class="flex justify-center space-x-2">
                      <a href="{{ route('teacher.show', ['id' => $data->id]) }}" class="action-btn detail-btn">
                        <i class="fas fa-eye mr-1"></i>Detail
                      </a>
                      @if(Auth::user()->role !== 'evaluator')
                      <a href="{{ route('teacher.edit', $data->id) }}" class="action-btn edit-btn">
                        <i class="fas fa-edit mr-1"></i>Edit
                      </a>
                      <form action="{{ route('teacher.destroy', $data->id) }}" method="POST"
                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus guru ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="action-btn delete-btn">
                          <i class="fas fa-trash mr-1"></i>Hapus
                        </button>
                      </form>
                      @endif
                    </div>
                  </td>
                  @endif
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <!-- Pagination Section -->
        <div class="pagination-section">
          <div class="pagination-info">
            Menampilkan <span>1</span> sampai <span>10</span> dari <span>35</span> guru
          </div>
          <div class="pagination-controls">
            <button class="pagination-btn">
              <i class="fas fa-chevron-left mr-1"></i>
              Sebelumnya
            </button>
            <button class="pagination-btn active">1</button>
            <button class="pagination-btn">2</button>
            <button class="pagination-btn">3</button>
            <button class="pagination-btn">4</button>
            <button class="pagination-btn">
              Selanjutnya
              <i class="fas fa-chevron-right ml-1"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
</div>

<!-- Enhanced JavaScript for Search and Filter -->
<script>
// Enhanced Pagination System with Search and Filter Integration
class TeacherTablePagination {
  constructor() {
    this.currentPage = 1;
    this.itemsPerPage = 10;
    this.allRows = [];
    this.filteredRows = [];
    this.init();
  }

  init() {
    // Get all table rows and store them
    this.allRows = Array.from(document.querySelectorAll('#guruTable tbody tr'));
    this.filteredRows = [...this.allRows];

    // Initialize pagination
    this.updateDisplay();
    this.setupEventListeners();
  }

  setupEventListeners() {
    // Search functionality
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
      searchInput.addEventListener('keyup', (e) => {
        this.handleSearch(e.target.value);
      });
    }

    // Filter functionality
    const filterSelect = document.getElementById('filterMapel');
    if (filterSelect) {
      filterSelect.addEventListener('change', (e) => {
        this.handleFilter(e.target.value);
      });
    }

    // Pagination button events
    this.setupPaginationEvents();
  }

  handleSearch(searchValue) {
    const searchTerm = searchValue.toLowerCase().trim();

    this.filteredRows = this.allRows.filter(row => {
      if (!searchTerm) return true;

      const cells = row.querySelectorAll('td');
      // Search in name (index 1), degree (index 2), and subject (index 3) columns
      for (let i = 1; i <= 3; i++) {
        if (cells[i] && cells[i].textContent.toLowerCase().includes(searchTerm)) {
          return true;
        }
      }
      return false;
    });

    // Apply current filter if exists
    const currentFilter = document.getElementById('filterMapel')?.value;
    if (currentFilter) {
      this.applySubjectFilter(currentFilter);
    }

    this.currentPage = 1; // Reset to first page
    this.updateDisplay();
  }

  handleFilter(filterValue) {
    // Start with search-filtered results
    const searchTerm = document.getElementById('searchInput')?.value.toLowerCase().trim();

    if (searchTerm) {
      this.filteredRows = this.allRows.filter(row => {
        const cells = row.querySelectorAll('td');
        for (let i = 1; i <= 3; i++) {
          if (cells[i] && cells[i].textContent.toLowerCase().includes(searchTerm)) {
            return true;
          }
        }
        return false;
      });
    } else {
      this.filteredRows = [...this.allRows];
    }

    // Apply subject filter
    this.applySubjectFilter(filterValue);

    this.currentPage = 1; // Reset to first page
    this.updateDisplay();
  }

  applySubjectFilter(filterValue) {
    if (!filterValue) return;

    const filterTerm = filterValue.toLowerCase();
    this.filteredRows = this.filteredRows.filter(row => {
      const subjectCell = row.querySelectorAll('td')[3];
      return subjectCell && subjectCell.textContent.toLowerCase().includes(filterTerm);
    });
  }

  updateDisplay() {
    this.hideAllRows();
    this.showCurrentPageRows();
    this.updatePaginationInfo();
    this.updatePaginationControls();
  }

  hideAllRows() {
    this.allRows.forEach(row => {
      row.style.display = 'none';
    });
  }

  showCurrentPageRows() {
    const startIndex = (this.currentPage - 1) * this.itemsPerPage;
    const endIndex = startIndex + this.itemsPerPage;
    const rowsToShow = this.filteredRows.slice(startIndex, endIndex);

    rowsToShow.forEach((row, index) => {
      row.style.display = '';
      row.style.animation = `fadeIn 0.3s ease ${index * 0.1}s both`;

      // Update row numbers
      const numberCell = row.querySelector('td:first-child .w-8');
      if (numberCell) {
        numberCell.textContent = startIndex + index + 1;
      }
    });
  }

  updatePaginationInfo() {
    const totalItems = this.filteredRows.length;
    const startItem = totalItems === 0 ? 0 : (this.currentPage - 1) * this.itemsPerPage + 1;
    const endItem = Math.min(this.currentPage * this.itemsPerPage, totalItems);

    const paginationInfo = document.querySelector('.pagination-info');
    if (paginationInfo) {
      paginationInfo.innerHTML = `
        Menampilkan <span>${startItem}</span> sampai <span>${endItem}</span> dari <span>${totalItems}</span> guru
      `;
    }
  }

  updatePaginationControls() {
    const totalPages = Math.ceil(this.filteredRows.length / this.itemsPerPage);
    const paginationControls = document.querySelector('.pagination-controls');

    if (!paginationControls) return;

    // Clear existing controls
    paginationControls.innerHTML = '';

    // Previous button
    const prevBtn = this.createPaginationButton('prev', 'Sebelumnya', this.currentPage <= 1);
    prevBtn.innerHTML = '<i class="fas fa-chevron-left mr-1"></i>Sebelumnya';
    paginationControls.appendChild(prevBtn);

    // Page number buttons
    const { startPage, endPage } = this.calculatePageRange(totalPages);

    // First page and ellipsis
    if (startPage > 1) {
      paginationControls.appendChild(this.createPaginationButton('page', '1', false, 1));
      if (startPage > 2) {
        const ellipsis = document.createElement('span');
        ellipsis.textContent = '...';
        ellipsis.className = 'px-3 py-2 text-gray-500';
        paginationControls.appendChild(ellipsis);
      }
    }

    // Page range buttons
    for (let i = startPage; i <= endPage; i++) {
      const pageBtn = this.createPaginationButton('page', i.toString(), false, i);
      if (i === this.currentPage) {
        pageBtn.classList.add('active');
      }
      paginationControls.appendChild(pageBtn);
    }

    // Last page and ellipsis
    if (endPage < totalPages) {
      if (endPage < totalPages - 1) {
        const ellipsis = document.createElement('span');
        ellipsis.textContent = '...';
        ellipsis.className = 'px-3 py-2 text-gray-500';
        paginationControls.appendChild(ellipsis);
      }
      paginationControls.appendChild(this.createPaginationButton('page', totalPages.toString(), false, totalPages));
    }

    // Next button
    const nextBtn = this.createPaginationButton('next', 'Selanjutnya', this.currentPage >= totalPages);
    nextBtn.innerHTML = 'Selanjutnya<i class="fas fa-chevron-right ml-1"></i>';
    paginationControls.appendChild(nextBtn);
  }

  calculatePageRange(totalPages) {
    const maxVisiblePages = 5;
    let startPage = Math.max(1, this.currentPage - Math.floor(maxVisiblePages / 2));
    let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

    // Adjust if we're near the end
    if (endPage - startPage + 1 < maxVisiblePages) {
      startPage = Math.max(1, endPage - maxVisiblePages + 1);
    }

    return { startPage, endPage };
  }

  createPaginationButton(type, text, disabled = false, pageNumber = null) {
    const button = document.createElement('button');
    button.textContent = text;
    button.className = 'pagination-btn';

    if (disabled) {
      button.disabled = true;
      button.classList.add('opacity-50', 'cursor-not-allowed');
      button.style.pointerEvents = 'none';
    }

    button.addEventListener('click', () => {
      if (disabled) return;

      this.addRippleEffect(button);

      switch (type) {
        case 'prev':
          if (this.currentPage > 1) {
            this.currentPage--;
            this.updateDisplay();
          }
          break;
        case 'next':
          const totalPages = Math.ceil(this.filteredRows.length / this.itemsPerPage);
          if (this.currentPage < totalPages) {
            this.currentPage++;
            this.updateDisplay();
          }
          break;
        case 'page':
          if (pageNumber && pageNumber !== this.currentPage) {
            this.currentPage = pageNumber;
            this.updateDisplay();
          }
          break;
      }
    });

    return button;
  }

  addRippleEffect(button) {
    const ripple = document.createElement('div');
    const rect = button.getBoundingClientRect();
    const size = Math.max(rect.width, rect.height);

    ripple.style.width = ripple.style.height = size + 'px';
    ripple.style.left = '50%';
    ripple.style.top = '50%';
    ripple.style.transform = 'translate(-50%, -50%) scale(0)';
    ripple.className = 'ripple';

    button.style.position = 'relative';
    button.style.overflow = 'hidden';
    button.appendChild(ripple);

    // Animate ripple
    requestAnimationFrame(() => {
      ripple.style.transform = 'translate(-50%, -50%) scale(2)';
      ripple.style.opacity = '0';
    });

    setTimeout(() => {
      if (ripple.parentNode) {
        ripple.remove();
      }
    }, 600);
  }

  setupPaginationEvents() {
    // This method is called during init, but actual event setup
    // is handled in updatePaginationControls() for dynamic buttons
  }
}

// CSS for animations and ripple effect
const paginationStyles = document.createElement('style');
paginationStyles.textContent = `
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

  .ripple {
    position: absolute;
    background: rgba(255, 255, 255, 0.5);
    border-radius: 50%;
    pointer-events: none;
    transition: transform 0.6s ease, opacity 0.6s ease;
  }

  .pagination-btn:disabled {
    background: #f3f4f6 !important;
    color: #9ca3af !important;
    cursor: not-allowed;
    transform: none !important;
    box-shadow: none !important;
  }

  .pagination-btn:disabled:hover {
    background: #f3f4f6 !important;
    color: #9ca3af !important;
    transform: none !important;
    box-shadow: none !important;
  }

  .pagination-controls {
    flex-wrap: wrap;
    gap: 8px;
  }

  @media (max-width: 640px) {
    .pagination-controls {
      justify-content: center;
    }

    .pagination-btn {
      min-width: 40px;
      padding: 8px 12px;
      font-size: 14px;
    }
  }
`;
document.head.appendChild(paginationStyles);

// Initialize pagination when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
  // Wait a bit to ensure all elements are rendered
  setTimeout(() => {
    const pagination = new TeacherTablePagination();

    // Make it globally accessible for debugging
    window.teacherPagination = pagination;
  }, 100);
});

// Handle dynamic content updates (if you're loading data via AJAX)
function refreshPagination() {
  if (window.teacherPagination) {
    window.teacherPagination.init();
  }
}
</script>
</x-app-layout>
