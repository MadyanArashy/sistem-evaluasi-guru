# TODO: Implementasi PDF Report untuk View Teacher

## Status: Hampir Selesai

### Yang Sudah Dilakukan:
- [x] Tambah route `/teacher/report/{id}` di `routes/web.php`
- [x] Tambah method `report()` di `TeacherController.php`
- [x] Update button "Cetak Laporan" di `view_teacher.blade.php` untuk link ke route PDF
- [x] Buat view PDF di `resources/views/pdf/teacher_report.blade.php`
- [x] Tambah import facade PDF di controller

### Yang Perlu Dilakukan:
- [ ] Install package `barryvdh/laravel-dompdf`:
  ```
  composer require barryvdh/laravel-dompdf
  ```
  (Installation gagal karena koneksi internet, perlu diulang)

- [ ] Publish config jika diperlukan:
  ```
  php artisan vendor:publish --provider="Barryvdh\DomPDF\ServiceProvider"
  ```

- [ ] Test fungsi PDF dengan mengklik button "Cetak Laporan"

### Catatan:
- PDF akan didownload otomatis dengan nama `laporan_guru_[nama_guru].pdf`
- View PDF sudah dioptimasi untuk format PDF dengan CSS sederhana
- Data yang ditampilkan sama dengan view teacher, termasuk skor evaluasi

### Jika Ada Masalah:
- Pastikan package terinstall dengan benar
- Cek log Laravel untuk error
- Verifikasi bahwa view PDF dapat diakses
