# SISTEM EVALUASI GURU

Aplikasi **Sistem Evaluasi Guru** berfungsi sebagai aplikasi berbasis web yang memudahkan evaluator dalam menilai kinerja guru berdasarkan standar dari dinas pendidikan.

## About Us

Kami adalah tim kecil yang berfokus pada pengembangan sistem untuk meningkatkan efisiensi operasional sekolah.  
Berbasis di Bogor, Jawa Barat, kami berkomitmen untuk berkontribusi dalam pengembangan pendidikan Indonesia melalui solusi berbasis teknologi.

## Requirements

- PHP 8+
- Composer 2.9+
- Node 24+
- MySQL / MariaDB

## Installation (Local)

1. Clone Repository
   ```bash
   git clone https://github.com/MadyanArashy/sistem-evaluasi-guru
   cd sistem-evaluasi-guru
   ```

2. Install Composer Packages

   ```bash
   composer install
   ```

3. Install Node Packages

   ```bash
   npm install
   ```

   (Optional) Build Production Assets

   ```bash
   npm run build
   ```

4. Setup Environment

   ```bash
   cp .env.example .env
   ```

5. Generate Application Key

   ```bash
   php artisan key:generate
   ```

6. Configure Database
   Edit file `.env` dan sesuaikan:

   ```env
   DB_DATABASE=your_database
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

7. Run Migration

   ```bash
   php artisan migrate
   ```

8. Run Development Server

   ```bash
   php artisan serve
   ```

Aplikasi dapat diakses di:

```
http://127.0.0.1:8000
```

## Features

* Manajemen data guru
* Penilaian berbasis indikator
* Rekap hasil evaluasi
* Sistem autentikasi pengguna
* Dashboard evaluator

## Project Structure

* `app/` → Logic aplikasi
* `routes/` → Routing web
* `resources/views/` → Tampilan (Blade)
* `database/` → Migrasi & seed
* `public/` → Asset publik

## Scripts

```bash
npm run dev     # Development build
npm run build   # Production build
```

## Contributing

1. Fork repository
2. Buat branch baru (`feature/nama-fitur`)
3. Commit perubahan
4. Push ke branch
5. Buat Pull Request

## License

Proyek ini menggunakan lisensi MIT.

```
```
