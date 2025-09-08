<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EvalComponent;
use App\Models\Criteria;

class EvalComponentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      EvalComponent::query()->createMany([
        [
          "criteria_id" => 1,
          "name" => "Pengumpulan Administrasi Guru",
          "weight" => 25,
          "description" => "Ketepatan Waktu Mengumpulkan Administrasi Guru"
        ],
        [
          "criteria_id" => 1,
          "name" => "Hasil Supervisi Pra-Mengajar",
          "weight" => 37,
          "description" => "Kelengkapan modul ajar, bahan ajar, instrumen penilaian"
        ],
        [
          "criteria_id" => 1,
          "name" => "Hasil Supervisi KBM",
          "weight" => 38,
          "description" => "Pembukaan dan penutupan KBM, Kegiatan inti yang meliputi penyajian materi, delivery, manajemen kelas dan penampilan guru"
        ],
        [
          "criteria_id" => 2,
          "name" => "Internalisasi dan Pemahaman",
          "weight" => 30,
          "description" => "Visi, Value, Motto, Identitas dan School Branding. Dinilai dari wawancara dan pengamatan harian."
        ],
        [
          "criteria_id" => 2,
          "name" => "Tugas Rutin Non-KBM",
          "weight" => 20,
          "description" => "Memiliki dokumen rencana pelaksanaan tugas tambahan, memiliki catatan pelaksanaan tugas tambahan, memiliki laporan hasil pelaksanaan tugas tambahan, memperoleh penilaian kinerja sangat baik dari pejabat struktural"
        ],
        [
          "criteria_id" => 2,
          "name" => "SKILL OF TEACHING",
          "weight" => 30,
          "description" => "IMPROVEMENT AND DEVELOPING SKILL OF TEACHING"
        ],
        [
          "criteria_id" => 2,
          "name" => "Produktifitas dan kreativitas",
          "weight" => 20,
          "description" => "tulisan inspirasi, branding sekolah, siswa, rekan kerja"
        ],
        [
          "criteria_id" => 3,
          "name" => "Tingkat Kehadiran",
          "weight" => 19,
          "description" => "Seberapa sering hadir di sekolah"
        ],
        [
          "criteria_id" => 3,
          "name" => "Performance",
          "weight" => 19,
          "description" => "Kelengkapan dan kerapihan pakaian"
        ],
        [
          "criteria_id" => 3,
          "name" => "Tingkat Keterlambatan",
          "weight" => 19,
          "description" => "Ketepatan waktu saat datang ke sekolah"
        ],
        [
          "criteria_id" => 3,
          "name" => "Surat Teguran",
          "weight" => 19,
          "description" => "Surat Teguran dan atau Surat Peringatan"
        ],
        [
          "criteria_id" => 3,
          "name" => "Kemampuan Al-Qur'an",
          "weight" => 13,
          "description" => "Kemampuan membaca atau menghafal Al-Qur'an"
        ],
        [
          "criteria_id" => 3,
          "name" => "Kemampuan As-Maul Husna",
          "weight" => 13,
          "description" => "Kemampuan menghafal asma'ul husna / menghafal do'a keseharian"
        ],
        [
          "criteria_id" => 4,
          "name" => "Hubungan Sosial",
          "weight" => 28,
          "description" => "Hubungan dengan komunitas sekolah"
        ],
        [
          "criteria_id" => 4,
          "name" => "Keikutsertaan rapat",
          "weight" => 29,
          "description" => "Keikutsertaan mengikuti kegiatan / rapat dinas internal di sekolah dan yayasan"
        ],
        [
          "criteria_id" => 4,
          "name" => "Keterlibatan Kegiatan",
          "weight" => 43,
          "description" => "Keterlibatan di kepanitiaan dan kontribusi pada kegiatan di sekolah/yayasan"
        ],
      ]);
    }
}
