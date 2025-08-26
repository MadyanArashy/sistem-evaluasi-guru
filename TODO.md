# Implementasi Foreign Key teacher_id dan Redirect Logic

## ✅ Tugas yang Telah Diselesaikan:

### 1. Database Migration
- [x] Membuat migration `2025_08_12_000000_add_teacher_id_to_users_table.php`
- [x] Menambahkan kolom `teacher_id` (nullable foreign key) ke tabel users
- [x] Menambahkan foreign key constraint ke tabel teachers
- [x] Migration telah dijalankan

### 2. Model Updates
- [x] Memperbarui `app/Models/User.php`:
  - Menambahkan `teacher_id` ke properti `$fillable`
  - Menambahkan method `teacher()` untuk relationship ke model Teacher

- [x] Memperbarui `app/Models/Teacher.php`:
  - Menambahkan method `users()` untuk relationship ke model User

### 3. Controller Logic
- [x] Memperbarui `app/Http/Controllers/TeacherController.php`:
  - Menambahkan import `Illuminate\Support\Facades\Auth`
  - Memodifikasi method `index()` untuk mengecek:
    - Jika user memiliki role 'guru' DAN memiliki `teacher_id`
    - Redirect ke `teacher.show/{id}` dengan `teacher_id` user tersebut
    - Jika tidak, tampilkan halaman index_teacher normal
  - Memodifikasi method `show()` untuk membatasi akses guru hanya ke data mereka sendiri
  - Membatasi akses untuk method `create()`, `store()`, `edit()`, `update()`, `destroy()` untuk user dengan role 'guru'

### 4. Form User Creation dengan Dropdown Guru
- [x] Memperbarui `app/Http/Controllers/AdminUsercontroller.php`:
  - Menambahkan import `App\Models\Teacher`
  - Memodifikasi method `create()` untuk mengambil semua data teacher
  - Memodifikasi method `store()` untuk validasi dan penyimpanan `teacher_id`
  
- [x] Memperbarui `resources/views/create_user.blade.php`:
  - Menambahkan dropdown pilihan guru yang hanya muncul ketika role 'guru' dipilih
  - Menambahkan JavaScript untuk menampilkan/sembunyikan dropdown guru

### 5. View Restrictions for Guru Users
- [x] Memperbarui `resources/views/view_teacher.blade.php`:
  - Menyembunyikan tombol "Evaluasi Baru" untuk user dengan role 'guru'
  - Menyembunyikan tombol aksi (Edit Evaluasi, Cetak Laporan) untuk user dengan role 'guru'

## 🔧 Cara Penggunaan:

1. **Untuk membuat user guru dengan teacher tertentu:**
   - Akses form pembuatan user
   - Pilih role 'guru'
   - Dropdown pilihan guru akan muncul
   - Pilih guru yang ingin dihubungkan dengan user
   - Simpan data

2. **Untuk user dengan role 'guru' yang memiliki teacher_id:**
   - User akan otomatis di-redirect ke halaman detail teacher mereka ketika mengakses `/teachers`
   - Hanya dapat melihat data guru mereka sendiri
   - Tidak dapat mengakses fitur tambah, edit, hapus guru
   - Tombol aksi akan disembunyikan

3. **Untuk user dengan role lain (admin/evaluator):**
   - Akan melihat halaman index_teacher normal dengan semua data guru
   - Dapat mengakses semua fitur seperti biasa

## 🚀 Testing:
- Membuat user dengan role 'guru' dan memilih teacher dari dropdown
- Login sebagai user dengan role 'guru' yang memiliki `teacher_id` terisi
- Akses `/teachers` - harus redirect ke `/teacher/show/{teacher_id}`
- Coba akses teacher lain - harus redirect ke teacher sendiri
- Coba akses fitur create/edit/delete - harus diblokir
- Login sebagai user dengan role 'guru' tanpa `teacher_id` - tetap melihat index
- Login sebagai admin/evaluator - tetap melihat index normal dengan semua fitur

## 📝 Catatan:
- Foreign key `teacher_id` bersifat nullable, sehingga user bisa dibuat tanpa teacher_id
- Relationship telah dibuat di kedua model (User dan Teacher)
- Redirect logic hanya berlaku untuk user dengan role 'guru' yang memiliki teacher_id
- Dropdown guru hanya muncul ketika role 'guru' dipilih pada form pembuatan user
- User guru hanya dapat melihat data mereka sendiri dan tidak dapat melakukan operasi CRUD pada data guru
