<x-app-layout>
<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');

* {
  font-family: 'Inter', sans-serif;
}

.main-container {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  min-height: 100vh;
  position: relative;
  overflow: hidden;
}

.main-container::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background:
    radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
    radial-gradient(circle at 80% 20%, rgba(255, 119, 198, 0.3) 0%, transparent 50%),
    radial-gradient(circle at 40% 40%, rgba(120, 219, 255, 0.3) 0%, transparent 50%);
  animation: float 20s ease-in-out infinite;
}

@keyframes float {
  0%, 100% { transform: translateY(0px) rotate(0deg); }
  33% { transform: translateY(-20px) rotate(1deg); }
  66% { transform: translateY(-10px) rotate(-1deg); }
}

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

@keyframes gradientShift {
  0%, 100% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
}

.section-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 32px;
  padding-bottom: 20px;
  border-bottom: 2px solid rgba(99, 102, 241, 0.1);
  position: relative;
}

.section-header::after {
  content: '';
  position: absolute;
  bottom: -2px;
  left: 0;
  width: 120px;
  height: 2px;
  background: linear-gradient(90deg, #6366f1, #8b5cf6);
  border-radius: 1px;
}

.section-title {
  background: linear-gradient(135deg, #1f2937, #374151);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  font-weight: 800;
  font-size: 1.75rem;
  display: flex;
  align-items: center;
  gap: 12px;
}

.add-btn {
  background: linear-gradient(135deg, #3b82f6, #1d4ed8);
  color: white;
  padding: 16px 32px;
  border-radius: 16px;
  font-weight: 600;
  font-size: 1rem;
  transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  border: none;
  cursor: pointer;
  position: relative;
  overflow: hidden;
  box-shadow: 0 8px 24px rgba(59, 130, 246, 0.3);
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 8px;
}

.add-btn::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
  transition: left 0.5s ease;
}

.add-btn:hover::before {
  left: 100%;
}

.add-btn:hover {
  transform: translateY(-3px) scale(1.02);
  box-shadow: 0 16px 40px rgba(59, 130, 246, 0.4);
}

.success-alert {
  background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(5, 150, 105, 0.05));
  border: 2px solid rgba(16, 185, 129, 0.2);
  border-radius: 16px;
  padding: 20px;
  margin-bottom: 32px;
  display: flex;
  align-items: center;
  gap: 16px;
  color: #065f46;
  font-weight: 600;
  position: relative;
  overflow: hidden;
}

.success-alert::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 6px;
  height: 100%;
  background: linear-gradient(135deg, #10b981, #059669);
}

.table-container {
  border-radius: 24px;
  overflow: hidden;
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
  background: rgba(255, 255, 255, 0.9);
  backdrop-filter: blur(20px);
  border: 1px solid rgba(255, 255, 255, 0.3);
  margin-bottom: 40px;
}

.table-header {
  background: linear-gradient(135deg, #f8fafc, #e2e8f0);
  position: relative;
}

.table-header::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  height: 3px;
  background: linear-gradient(90deg, #6366f1, #8b5cf6, #06b6d4);
}

.table-header th {
  padding: 24px;
  font-weight: 700;
  color: #374151;
  text-transform: uppercase;
  letter-spacing: 0.05em;
  font-size: 0.875rem;
}

.table-row {
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  border-bottom: 1px solid rgba(0, 0, 0, 0.05);
  position: relative;
}

.table-row:hover {
  background: linear-gradient(135deg, rgba(99, 102, 241, 0.05), rgba(139, 92, 246, 0.05));
  transform: scale(1.01);
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
}

.table-cell {
  padding: 20px 24px;
  vertical-align: middle;
}

.criteria-icon {
  width: 48px;
  height: 48px;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-size: 1.25rem;
  margin-right: 16px;
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
}

.pedagogik { background: linear-gradient(135deg, #3b82f6, #1e40af); }
.kepribadian { background: linear-gradient(135deg, #10b981, #047857); }
.professional { background: linear-gradient(135deg, #f59e0b, #d97706); }
.sosial { background: linear-gradient(135deg, #8b5cf6, #7c3aed); }

.weight-badge {
  background: linear-gradient(135deg, #6366f1, #4f46e5);
  color: white;
  padding: 8px 16px;
  border-radius: 20px;
  font-weight: 700;
  font-size: 0.875rem;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  box-shadow: 0 8px 16px rgba(99, 102, 241, 0.3);
  position: relative;
  overflow: hidden;
}

.weight-badge::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
  transition: left 0.5s ease;
}

.weight-badge:hover::before {
  left: 100%;
}

.action-btn {
  padding: 12px 20px;
  border-radius: 10px;
  font-weight: 600;
  font-size: 0.875rem;
  transition: all 0.3s ease;
  border: none;
  cursor: pointer;
  margin: 0 4px;
  position: relative;
  overflow: hidden;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 8px;
}

.action-btn::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
  transition: left 0.4s ease;
}

.action-btn:hover::before {
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

.component-name {
  font-weight: 600;
  color: #1f2937;
  margin-bottom: 4px;
}

.component-description {
  font-size: 0.875rem;
  color: #6b7280;
}

.criteria-badge {
  background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(139, 92, 246, 0.1));
  border: 1px solid rgba(99, 102, 241, 0.2);
  color: #4f46e5;
  padding: 6px 12px;
  border-radius: 12px;
  font-size: 0.75rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.05em;
}

.floating-elements {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  pointer-events: none;
  z-index: 1;
}

.floating-circle {
  position: absolute;
  border-radius: 50%;
  background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
  animation: floatUpDown 8s ease-in-out infinite;
}

.floating-circle:nth-child(1) {
  width: 80px;
  height: 80px;
  top: 15%;
  left: 15%;
  animation-delay: 0s;
}

.floating-circle:nth-child(2) {
  width: 120px;
  height: 120px;
  top: 70%;
  right: 20%;
  animation-delay: 3s;
}

.floating-circle:nth-child(3) {
  width: 60px;
  height: 60px;
  bottom: 25%;
  left: 70%;
  animation-delay: 6s;
}

@keyframes floatUpDown {
  0%, 100% { transform: translateY(0px) rotate(0deg); }
  50% { transform: translateY(-30px) rotate(180deg); }
}

@media (max-width: 768px) {
  .content-card {
    margin: 16px;
    padding: 24px;
    border-radius: 24px;
  }

  .section-title {
    font-size: 1.5rem;
  }

  .table-container {
    border-radius: 16px;
  }

  .section-header {
    flex-direction: column;
    gap: 16px;
    align-items: stretch;
  }

  .add-btn {
    justify-content: center;
  }
}
</style>

<div class="main-container">
  <div class="floating-elements">
    <div class="floating-circle"></div>
    <div class="floating-circle"></div>
    <div class="floating-circle"></div>
  </div>

  <!-- Main Content -->
  <div class="mx-auto px-6 py-12 relative z-10">
    <div class="content-card">
      <div class="text-gray-900">

        <!-- Success Message -->
        @if(session('success'))
          <div class="success-alert">
            <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0">
              <i class="fas fa-check text-white text-sm"></i>
            </div>
            <div>
              <h4 class="font-bold text-green-800">Berhasil!</h4>
              <p class="text-green-700">{{ session('success') }}</p>
            </div>
          </div>
        @endif

        <!-- Kriteria Table -->
        <div class="section-header">
          <h3 class="section-title">
            <i class="fas fa-list-check text-blue-600"></i>
            Kriteria Evaluasi
          </h3>
          <a href="#" class="add-btn">
            <i class="fas fa-plus"></i>
            Tambah Kriteria
          </a>
        </div>

        <div class="table-container">
          <table class="min-w-full">
            <thead class="table-header">
              <tr>
                <th class="text-left">No</th>
                <th class="text-left">Nama Kriteria</th>
                <th class="text-center">Bobot</th>
                <th class="text-center">Tindakan</th>
              </tr>
            </thead>
            <tbody>
              <tr class="table-row">
                <td class="table-cell">
                  <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                    1
                  </div>
                </td>
                <td class="table-cell">
                  <div class="flex items-center">
                    <div class="criteria-icon pedagogik">
                      <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <div>
                      <div class="component-name">Pedagogik</div>
                      <div class="component-description">Kemampuan mengelola pembelajaran peserta didik</div>
                    </div>
                  </div>
                </td>
                <td class="table-cell text-center">
                  <div class="weight-badge">
                    <i class="fas fa-percentage"></i>
                    40%
                  </div>
                </td>
                <td class="table-cell text-center">
                  <div class="flex justify-center space-x-2">
                    <a href="#" class="action-btn edit-btn">
                      <i class="fas fa-edit"></i>Edit
                    </a>
                    <button type="button" class="action-btn delete-btn" onclick="confirmDelete('Pedagogik')">
                      <i class="fas fa-trash"></i>Hapus
                    </button>
                  </div>
                </td>
              </tr>

              <tr class="table-row">
                <td class="table-cell">
                  <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                    2
                  </div>
                </td>
                <td class="table-cell">
                  <div class="flex items-center">
                    <div class="criteria-icon kepribadian">
                      <i class="fas fa-user-check"></i>
                    </div>
                    <div>
                      <div class="component-name">Kepribadian</div>
                      <div class="component-description">Kepribadian yang mantap, stabil, dewasa, arif, dan berwibawa</div>
                    </div>
                  </div>
                </td>
                <td class="table-cell text-center">
                  <div class="weight-badge">
                    <i class="fas fa-percentage"></i>
                    30%
                  </div>
                </td>
                <td class="table-cell text-center">
                  <div class="flex justify-center space-x-2">
                    <a href="#" class="action-btn edit-btn">
                      <i class="fas fa-edit"></i>Edit
                    </a>
                    <button type="button" class="action-btn delete-btn" onclick="confirmDelete('Kepribadian')">
                      <i class="fas fa-trash"></i>Hapus
                    </button>
                  </div>
                </td>
              </tr>

              <tr class="table-row">
                <td class="table-cell">
                  <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                    3
                  </div>
                </td>
                <td class="table-cell">
                  <div class="flex items-center">
                    <div class="criteria-icon professional">
                      <i class="fas fa-briefcase"></i>
                    </div>
                    <div>
                      <div class="component-name">Profesional</div>
                      <div class="component-description">Kemampuan penguasaan materi pembelajaran secara luas dan mendalam</div>
                    </div>
                  </div>
                </td>
                <td class="table-cell text-center">
                  <div class="weight-badge">
                    <i class="fas fa-percentage"></i>
                    20%
                  </div>
                </td>
                <td class="table-cell text-center">
                  <div class="flex justify-center space-x-2">
                    <a href="#" class="action-btn edit-btn">
                      <i class="fas fa-edit"></i>Edit
                    </a>
                    <button type="button" class="action-btn delete-btn" onclick="confirmDelete('Profesional')">
                      <i class="fas fa-trash"></i>Hapus
                    </button>
                  </div>
                </td>
              </tr>

              <tr class="table-row">
                <td class="table-cell">
                  <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                    4
                  </div>
                </td>
                <td class="table-cell">
                  <div class="flex items-center">
                    <div class="criteria-icon sosial">
                      <i class="fas fa-users"></i>
                    </div>
                    <div>
                      <div class="component-name">Sosial</div>
                      <div class="component-description">Kemampuan pendidik berkomunikasi dan bergaul secara efektif</div>
                    </div>
                  </div>
                </td>
                <td class="table-cell text-center">
                  <div class="weight-badge">
                    <i class="fas fa-percentage"></i>
                    10%
                  </div>
                </td>
                <td class="table-cell text-center">
                  <div class="flex justify-center space-x-2">
                    <a href="#" class="action-btn edit-btn">
                      <i class="fas fa-edit"></i>Edit
                    </a>
                    <button type="button" class="action-btn delete-btn" onclick="confirmDelete('Sosial')">
                      <i class="fas fa-trash"></i>Hapus
                    </button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Komponen Table -->
        <div class="section-header">
          <h3 class="section-title">
            <i class="fas fa-puzzle-piece text-purple-600"></i>
            Komponen Evaluasi
          </h3>
          <a href="#" class="add-btn">
            <i class="fas fa-plus"></i>
            Tambah Komponen
          </a>
        </div>

        <div class="table-container">
          <table class="min-w-full">
            <thead class="table-header">
              <tr>
                <th class="text-left">No</th>
                <th class="text-left">Kriteria</th>
                <th class="text-left">Nama Komponen</th>
                <th class="text-center">Bobot</th>
                <th class="text-center">Tindakan</th>
              </tr>
            </thead>
            <tbody>
              <!-- Pedagogik Components -->
              <tr class="table-row">
                <td class="table-cell">
                  <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                    1
                  </div>
                </td>
                <td class="table-cell">
                  <div class="criteria-badge">Pedagogik</div>
                </td>
                <td class="table-cell">
                  <div class="component-name">Bahan Ajar</div>
                  <div class="component-description">Kualitas dan kelengkapan bahan pembelajaran</div>
                </td>
                <td class="table-cell text-center">
                  <div class="weight-badge">
                    <i class="fas fa-percentage"></i>
                    30%
                  </div>
                </td>
                <td class="table-cell text-center">
                  <div class="flex justify-center space-x-2">
                    <a href="#" class="action-btn edit-btn">
                      <i class="fas fa-edit"></i>Edit
                    </a>
                    <button type="button" class="action-btn delete-btn" onclick="confirmDelete('Bahan Ajar')">
                      <i class="fas fa-trash"></i>Hapus
                    </button>
                  </div>
                </td>
              </tr>

              <tr class="table-row">
                <td class="table-cell">
                  <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                    2
                  </div>
                </td>
                <td class="table-cell">
                  <div class="criteria-badge">Pedagogik</div>
                </td>
                <td class="table-cell">
                  <div class="component-name">Ketepatan Waktu</div>
                  <div class="component-description">Kehadiran dan ketepatan waktu dalam mengajar</div>
                </td>
                <td class="table-cell text-center">
                  <div class="weight-badge">
                    <i class="fas fa-percentage"></i>
                    30%
                  </div>
                </td>
                <td class="table-cell text-center">
                  <div class="flex justify-center space-x-2">
                    <a href="#" class="action-btn edit-btn">
                      <i class="fas fa-edit"></i>Edit
                    </a>
                    <button type="button" class="action-btn delete-btn" onclick="confirmDelete('Ketepatan Waktu')">
                      <i class="fas fa-trash"></i>Hapus
                    </button>
                  </div>
                </td>
              </tr>

              <!-- Kepribadian Components -->
              <tr class="table-row">
                <td class="table-cell">
                  <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                    3
                  </div>
                </td>
                <td class="table-cell">
                  <div class="criteria-badge" style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(5, 150, 105, 0.1)); border-color: rgba(16, 185, 129, 0.2); color: #047857;">Kepribadian</div>
                </td>
                <td class="table-cell">
                  <div class="component-name">Mengumpulkan Administrasi Guru</div>
                  <div class="component-description">Kelengkapan dan ketepatan administrasi pembelajaran</div>
                </td>
                <td class="table-cell text-center">
                  <div class="weight-badge">
                    <i class="fas fa-percentage"></i>
                    40%
                  </div>
                </td>
                <td class="table-cell text-center">
                  <div class="flex justify-center space-x-2">
                    <a href="#" class="action-btn edit-btn">
                      <i class="fas fa-edit"></i>Edit
                    </a>
                    <button type="button" class="action-btn delete-btn" onclick="confirmDelete('Administrasi Guru')">
                      <i class="fas fa-trash"></i>Hapus
                    </button>
                  </div>
                </td>
              </tr>

              <!-- Professional Components -->
              <tr class="table-row">
                <td class="table-cell">
                  <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                    4
                  </div>
                </td>
                <td class="table-cell">
                  <div class="criteria-badge" style="background: linear-gradient(135deg, rgba(245, 158, 11, 0.1), rgba(217, 119, 6, 0.1)); border-color: rgba(245, 158, 11, 0.2); color: #d97706;">Profesional</div>
                </td>
                <td class="table-cell">
                  <div class="component-name">Produktivitas dan Kreativitas</div>
                  <div class="component-description">Inovasi dalam metode pembelajaran dan hasil karya</div>
                </td>
                <td class="table-cell text-center">
                  <div class="weight-badge">
                    <i class="fas fa-percentage"></i>
                    35%
                  </div>
                </td>
                <td class="table-cell text-center">
                  <div class="flex justify-center space-x-2">
                    <a href="#" class="action-btn edit-btn">
                      <i class="fas fa-edit"></i>Edit
                    </a>
                    <button type="button" class="action-btn delete-btn" onclick="confirmDelete('Produktivitas dan Kreativitas')">
                      <i class="fas fa-trash"></i>Hapus
                    </button>
                  </div>
                </td>
              </tr>

              <tr class="table-row">
                <td class="table-cell">
                  <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                    5
                  </div>
                </td>
                <td class="table-cell">
                  <div class="criteria-badge" style="background: linear-gradient(135deg, rgba(245, 158, 11, 0.1), rgba(217, 119, 6, 0.1)); border-color: rgba(245, 158, 11, 0.2); color: #d97706;">Profesional</div>
                </td>
                <td class="table-cell">
                  <div class="component-name">Pengembangan Diri</div>
                  <div class="component-description">Partisipasi dalam pelatihan dan pengembangan profesional</div>
                </td>
                <td class="table-cell text-center">
                  <div class="weight-badge">
                    <i class="fas fa-percentage"></i>
                    25%
                  </div>
                </td>
                <td class="table-cell text-center">
                  <div class="flex justify-center space-x-2">
                    <a href="#" class="action-btn edit-btn">
                      <i class="fas fa-edit"></i>Edit
                    </a>
                    <button type="button" class="action-btn delete-btn" onclick="confirmDelete('Pengembangan Diri')">
                      <i class="fas fa-trash"></i>Hapus
                    </button>
                  </div>
                </td>
              </tr>

              <!-- Social Components -->
              <tr class="table-row">
                <td class="table-cell">
                  <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                    6
                  </div>
                </td>
                <td class="table-cell">
                  <div class="criteria-badge" style="background: linear-gradient(135deg, rgba(139, 92, 246, 0.1), rgba(124, 58, 237, 0.1)); border-color: rgba(139, 92, 246, 0.2); color: #7c3aed;">Sosial</div>
                </td>
                <td class="table-cell">
                  <div class="component-name">Komunikasi dengan Siswa</div>
                  <div class="component-description">Kemampuan berkomunikasi efektif dengan peserta didik</div>
                </td>
                <td class="table-cell text-center">
                  <div class="weight-badge">
                    <i class="fas fa-percentage"></i>
                    50%
                  </div>
                </td>
                <td class="table-cell text-center">
                  <div class="flex justify-center space-x-2">
                    <a href="#" class="action-btn edit-btn">
                      <i class="fas fa-edit"></i>Edit
                    </a>
                    <button type="button" class="action-btn delete-btn" onclick="confirmDelete('Komunikasi dengan Siswa')">
                      <i class="fas fa-trash"></i>Hapus
                    </button>
                  </div>
                </td>
              </tr>

              <tr class="table-row">
                <td class="table-cell">
                  <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                    7
                  </div>
                </td>
                <td class="table-cell">
                  <div class="criteria-badge" style="background: linear-gradient(135deg, rgba(139, 92, 246, 0.1), rgba(124, 58, 237, 0.1)); border-color: rgba(139, 92, 246, 0.2); color: #7c3aed;">Sosial</div>
                </td>
                <td class="table-cell">
                  <div class="component-name">Kerjasama Tim</div>
                  <div class="component-description">Kolaborasi dengan sesama guru dan staff sekolah</div>
                </td>
                <td class="table-cell text-center">
                  <div class="weight-badge">
                    <i class="fas fa-percentage"></i>
                    30%
                  </div>
                </td>
                <td class="table-cell text-center">
                  <div class="flex justify-center space-x-2">
                    <a href="#" class="action-btn edit-btn">
                      <i class="fas fa-edit"></i>Edit
                    </a>
                    <button type="button" class="action-btn delete-btn" onclick="confirmDelete('Kerjasama Tim')">
                      <i class="fas fa-trash"></i>Hapus
                    </button>
                  </div>
                </td>
              </tr>

              <tr class="table-row">
                <td class="table-cell">
                  <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                    8
                  </div>
                </td>
                <td class="table-cell">
                  <div class="criteria-badge">Pedagogik</div>
                </td>
                <td class="table-cell">
                  <div class="component-name">Metode Pembelajaran</div>
                  <div class="component-description">Variasi dan efektivitas metode pembelajaran yang digunakan</div>
                </td>
                <td class="table-cell text-center">
                  <div class="weight-badge">
                    <i class="fas fa-percentage"></i>
                    40%
                  </div>
                </td>
                <td class="table-cell text-center">
                  <div class="flex justify-center space-x-2">
                    <a href="#" class="action-btn edit-btn">
                      <i class="fas fa-edit"></i>Edit
                    </a>
                    <button type="button" class="action-btn delete-btn" onclick="confirmDelete('Metode Pembelajaran')">
                      <i class="fas fa-trash"></i>Hapus
                    </button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Summary Cards -->
        <div class="grid md:grid-cols-2 gap-8 mt-12">
          <div class="p-8 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl border border-blue-200">
            <div class="flex items-center justify-between mb-6">
              <h4 class="text-xl font-bold text-gray-800">Total Kriteria</h4>
              <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center">
                <i class="fas fa-list-check text-white text-lg"></i>
              </div>
            </div>
            <div class="text-3xl font-bold text-blue-600 mb-2">4</div>
            <p class="text-gray-600 text-sm">Kriteria evaluasi aktif</p>
            <div class="mt-4 text-xs text-gray-500">
              Total bobot: <span class="font-semibold text-blue-600">100%</span>
            </div>
          </div>

          <div class="p-8 bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl border border-purple-200">
            <div class="flex items-center justify-between mb-6">
              <h4 class="text-xl font-bold text-gray-800">Total Komponen</h4>
              <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center">
                <i class="fas fa-puzzle-piece text-white text-lg"></i>
              </div>
            </div>
            <div class="text-3xl font-bold text-purple-600 mb-2">8</div>
            <p class="text-gray-600 text-sm">Komponen evaluasi terdefinisi</p>
            <div class="mt-4 grid grid-cols-2 gap-2 text-xs">
              <div class="text-gray-500">Pedagogik: <span class="font-semibold text-blue-600">3 komponen</span></div>
              <div class="text-gray-500">Kepribadian: <span class="font-semibold text-green-600">1 komponen</span></div>
              <div class="text-gray-500">Profesional: <span class="font-semibold text-orange-600">2 komponen</span></div>
              <div class="text-gray-500">Sosial: <span class="font-semibold text-purple-600">2 komponen</span></div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<!-- Enhanced JavaScript -->
<script>
// Add smooth scrolling between tables
function scrollToTable(tableId) {
  document.getElementById(tableId).scrollIntoView({
    behavior: 'smooth',
    block: 'start'
  });
}

// Auto-calculate total percentages (you can extend this)
function calculateTotalPercentage() {
  const criteriaWeights = [40, 30, 20, 10];
  const totalCriteria = criteriaWeights.reduce((a, b) => a + b, 0);

  console.log(`Total kriteria bobot: ${totalCriteria}%`);

  // You can add validation logic here
  if (totalCriteria !== 100) {
    console.warn('Warning: Total bobot kriteria tidak sama dengan 100%');
  }
}

// Initialize calculations
calculateTotalPercentage();

// Add loading animation for dynamic content
function showLoading() {
  const loadingDiv = document.createElement('div');
  loadingDiv.className = 'flex items-center justify-center py-8';
  loadingDiv.innerHTML = `
    <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
    <span class="ml-2 text-gray-600">Memuat data...</span>
  `;
  return loadingDiv;
}
</script>
</x-app-layout>
