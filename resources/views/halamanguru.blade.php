<x-app-layout>
    <!-- Card Guru -->
    <div class="bg-white shadow-md p-6 border-l-8 border-yellow-400 mb-10 flex gap-6 items-center">
        <div class="w-24 h-24 rounded-full bg-blue-600 flex items-center justify-center shadow-lg border-4 border-yellow-300">
            <i class="fa-solid fa-user text-white text-3xl"></i>
        </div>
        <div class="space-y-1">
            <h2 class="text-2xl font-bold text-gray-900">{{ $teacher->name }}</h2>
            <div class="flex items-center gap-2 text-yellow-700 text-sm">
                <i class="fa-solid fa-graduation-cap text-yellow-500"></i>
                <span class="font-medium">Gelar:</span>
                <span class="text-gray-800">{{ $teacher->degree }}</span>
            </div>
            <div class="flex items-center gap-2 text-blue-700 text-sm">
                <i class="fa-solid fa-book-open text-blue-500"></i>
                <span class="font-medium">Mapel:</span>
                <span class="text-gray-800">{{ $teacher->subject }}</span>
            </div>
        </div>
    </div>

    <!-- TABEL UTAMA -->
    <div class=" bg-white rounded-xl shadow p-4 mb-20">
        <table class="w-full text-sm text-left border border-gray-300">
            <thead class="bg-yellow-300 text-gray-900 font-bold text-center">
                <tr>
                    <th class="border px-2 py-1">No</th>
                    <th class="border px-2 py-1">Komponen</th>
                    <th class="border px-2 py-1">Bobot</th>
                    <th class="border px-2 py-1">Skala / Instrumen</th>
                    <th class="border px-2 py-1">Nilai</th>
                    <th class="border px-2 py-1">Kategori</th>
                    <th class="border px-2 py-1">ALL</th>
                </tr>
            </thead>
            <tbody>

                <!-- KATEGORI PEDAGOGIS -->
                <tr class="bg-yellow-100 font-bold text-blue-800 text-center">
                    <td colspan="7" class="py-2">PEDAGOGIS</td>
                </tr>
                <tr>
                    <td class="border px-2 py-1 text-center">1</td>
                    <td class="border px-2 py-1">
                        Hasil Supervisi Pra Mengajar
                        <ul class="list-disc ml-4 text-xs">
                            <li>Modul Ajar</li>
                            <li>Bahan Ajar</li>
                            <li>Instrumen Penilaian</li>
                        </ul>
                    </td>
                    <td class="border px-2 py-1 text-center">H<br>3</td>
                    <td class="border px-2 py-1 text-xs text-center">Hasil Supervisi Terbaik<br>Skala: 5 = 90% Ke Atas</td>
                    <td class="border px-2 py-1 text-center">5</td>
                    <td class="border px-2 py-1 text-center">38%</td>
                    <td class="border px-2 py-1 text-center" rowspan="3">40%</td>
                </tr>
                <tr>
                    <td class="border px-2 py-1 text-center">2</td>
                    <td class="border px-2 py-1">
                        Hasil Supervisi KBM
                        <ul class="list-disc ml-4 text-xs">
                            <li>Pembukaan, Penyampaian Materi</li>
                            <li>Manajemen Kelas</li>
                            <li>Penampilan Guru</li>
                        </ul>
                    </td>
                    <td class="border px-2 py-1 text-center">H<br>3</td>
                    <td class="border px-2 py-1 text-xs text-center">Hasil Supervisi Terbaik</td>
                    <td class="border px-2 py-1 text-center">5</td>
                    <td class="border px-2 py-1 text-center">38%</td>
                </tr>
                <tr>
                    <td class="border px-2 py-1 text-center">3</td>
                    <td class="border px-2 py-1">Ketepatan Waktu Administrasi</td>
                    <td class="border px-2 py-1 text-center">M<br>2</td>
                    <td class="border px-2 py-1 text-xs text-center">Laporan Bulanan</td>
                    <td class="border px-2 py-1 text-center">5</td>
                    <td class="border px-2 py-1 text-center">25%</td>
                </tr>

                <!-- KATEGORI PROFESIONAL -->
                <tr class="bg-yellow-100 font-bold text-blue-800 text-center">
                    <td colspan="7" class="py-2">PROFESIONAL</td>
                </tr>
                <tr>
                    <td class="border px-2 py-1 text-center">4</td>
                    <td class="border px-2 py-1">Internalisasi & School Branding</td>
                    <td class="border px-2 py-1 text-center">H<br>3</td>
                    <td class="border px-2 py-1 text-center">Wawancara Harian</td>
                    <td class="border px-2 py-1 text-center">5</td>
                    <td class="border px-2 py-1 text-center">30%</td>
                    <td class="border px-2 py-1 text-center" rowspan="4">30%</td>
                </tr>
                <tr>
                    <td class="border px-2 py-1 text-center">5</td>
                    <td class="border px-2 py-1">Improvement & Skill Teaching</td>
                    <td class="border px-2 py-1 text-center">H<br>3</td>
                    <td class="border px-2 py-1 text-center">IDP</td>
                    <td class="border px-2 py-1 text-center">5</td>
                    <td class="border px-2 py-1 text-center">30%</td>
                </tr>
                <tr>
                    <td class="border px-2 py-1 text-center">6</td>
                    <td class="border px-2 py-1">Produktivitas & Kreativitas</td>
                    <td class="border px-2 py-1 text-center">M<br>2</td>
                    <td class="border px-2 py-1 text-center">Branding Website</td>
                    <td class="border px-2 py-1 text-center">5</td>
                    <td class="border px-2 py-1 text-center">20%</td>
                </tr>
                <tr>
                    <td class="border px-2 py-1 text-center">7</td>
                    <td class="border px-2 py-1">Tugas Rutin Non KBM</td>
                    <td class="border px-2 py-1 text-center">M<br>2</td>
                    <td class="border px-2 py-1 text-center">Laporan Pejabat</td>
                    <td class="border px-2 py-1 text-center">5</td>
                    <td class="border px-2 py-1 text-center">20%</td>
                </tr>

                <!-- KATEGORI SOSIAL -->
                <tr class="bg-yellow-100 font-bold text-blue-800 text-center">
                    <td colspan="7" class="py-2">SOSIAL</td>
                </tr>
                <tr>
                    <td class="border px-2 py-1 text-center">16</td>
                    <td class="border px-2 py-1">Hubungan Sosial</td>
                    <td class="border px-2 py-1 text-center">M<br>2</td>
                    <td class="border px-2 py-1 text-center">Sosiogram</td>
                    <td class="border px-2 py-1 text-center">5</td>
                    <td class="border px-2 py-1 text-center">28.6%</td>
                    <td class="border px-2 py-1 text-center" rowspan="3">10%</td>
                </tr>
                <tr>
                    <td class="border px-2 py-1 text-center">17</td>
                    <td class="border px-2 py-1">Kepanitiaan & Kontribusi</td>
                    <td class="border px-2 py-1 text-center">H<br>3</td>
                    <td class="border px-2 py-1 text-center">Penilaian PJ</td>
                    <td class="border px-2 py-1 text-center">5</td>
                    <td class="border px-2 py-1 text-center">43%</td>
                </tr>
                <tr>
                    <td class="border px-2 py-1 text-center">18</td>
                    <td class="border px-2 py-1">Rapat & Kegiatan Yayasan</td>
                    <td class="border px-2 py-1 text-center">M<br>2</td>
                    <td class="border px-2 py-1 text-center">Rekap Hadir</td>
                    <td class="border px-2 py-1 text-center">5</td>
                    <td class="border px-2 py-1 text-center">29%</td>
                </tr>
            </tbody>
        </table>
    </div>
</x-app-layout>
