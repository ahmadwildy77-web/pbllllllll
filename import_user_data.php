<?php
require 'vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

$mahasiswaData = [
    [36245578001, 'Budi Santoso', 'budi.santoso@mahasiswa.ac.id', 'Aktif'],
    [36245578002, 'Siti Aminah', 'siti.aminah@mahasiswa.ac.id', 'Aktif'],
    [36245578003, 'Ahmad Rian', 'ahmad.rian@mahasiswa.ac.id', 'Non-Aktif'],
    [36245578004, 'Dewi Lestari', 'dewi.lestari@mahasiswa.ac.id', 'Aktif'],
    [36245578005, 'Eko Prasetyo', 'eko.prasetyo@mahasiswa.ac.id', 'Aktif'],
    [36245578006, 'Fany Indah', 'fany.indah@mahasiswa.ac.id', 'Aktif'],
    [36245578007, 'Gita Gutawa', 'gita.gutawa@mahasiswa.ac.id', 'Aktif'],
    [36245578008, 'Hendra Wijaya', 'hendra.wijaya@mahasiswa.ac.id', 'Aktif'],
    [36245578009, 'Irfan Hakim', 'irfan.hakim@mahasiswa.ac.id', 'Aktif'],
    [36245578010, 'Joko Widodo', 'joko.widodo@mahasiswa.ac.id', 'Aktif'],
    [36245578011, 'Kiki Amalia', 'kiki.amalia@mahasiswa.ac.id', 'Aktif'],
    [36245578012, 'Lukman Sardi', 'lukman.sardi@mahasiswa.ac.id', 'Aktif'],
    [36245578013, 'Maya Septha', 'maya.septha@mahasiswa.ac.id', 'Aktif'],
    [36245578014, 'Naufal Azhar', 'naufal.azhar@mahasiswa.ac.id', 'Aktif'],
    [36245578015, 'Oki Setiana', 'oki.setiana@mahasiswa.ac.id', 'Aktif'],
    [36245578016, 'Putri Titian', 'putri.titian@mahasiswa.ac.id', 'Aktif'],
    [36245578017, 'Qory Sandioriva', 'qory.sandioriva@mahasiswa.ac.id', 'Aktif'],
    [36245578018, 'Rafi Ahmad', 'rafi.ahmad@mahasiswa.ac.id', 'Aktif'],
    [36245578019, 'Sisca Kohl', 'sisca.kohl@mahasiswa.ac.id', 'Aktif'],
    [36245578020, 'Taufik Hidayat', 'taufik.hidayat@mahasiswa.ac.id', 'Aktif'],
    [36245578021, 'Umairah Hasan', 'umairah.hasan@mahasiswa.ac.id', 'Aktif'],
    [36245578022, 'Vina Panduwinata', 'vina.panduwinata@mahasiswa.ac.id', 'Aktif'],
    [36245578023, 'Wawan Febrianto', 'wawan.febrianto@mahasiswa.ac.id', 'Aktif'],
    [36245578024, 'Xavier Marks', 'xavier.marks@mahasiswa.ac.id', 'Aktif'],
    [36245578025, 'Yusuf Mansur', 'yusuf.mansur@mahasiswa.ac.id', 'Aktif']
];

foreach ($mahasiswaData as $m) {
    User::updateOrCreate(
        ['email' => $m[2]],
        [
            'nim_nip' => $m[0],
            'name' => $m[1],
            'password' => Hash::make($m[0]), // PASSWORD = NIM
            'status_akun' => $m[3],
            'role' => 'mahasiswa'
        ]
    );
}
echo "25 Akun mahasiswa berhasil ditambahkan ke tabel users dengan Password = NIM.\n";

// Execute the rest of the SQL for nilai_akademik and asesmen_non_akademik
$sql = "
DROP TABLE IF EXISTS nilai_akademik;
CREATE TABLE nilai_akademik (
    nim BIGINT PRIMARY KEY,
    alpro INT, sim INT, smbd INT, desain_uiux INT, desain_grafis INT, binggris INT,
    ppl INT, arsikom INT, pemweb INT, struktur_data INT, pemweb_lanjut INT,
    elektronika_dasar_dan_sensoring INT, insis INT, komdatjar INT, aplikasi_mobile INT,
    manajemen_proyek INT, teknologi_dan_keamanan_platform INT, iot INT, data_mining INT,
    kriptografi INT, sistem_terdistribusi INT, kecerdasan_buatan INT
);

INSERT INTO nilai_akademik VALUES 
(36245578001, 93, 79, 72, 85, 83, 87, 75, 75, 88, 88, 67, 86, 66, 88, 94, 66, 85, 97, 76, 86, 89, 91),
(36245578002, 92, 80, 79, 67, 71, 85, 73, 82, 68, 89, 78, 73, 90, 66, 84, 92, 71, 72, 78, 81, 68, 66),
(36245578003, 70, 68, 93, 82, 90, 98, 74, 78, 95, 79, 72, 78, 87, 85, 80, 82, 88, 90, 89, 93, 79, 65),
(36245578004, 89, 71, 73, 88, 65, 72, 88, 75, 81, 72, 97, 69, 92, 71, 73, 72, 76, 98, 97, 87, 88, 86),
(36245578005, 91, 65, 78, 67, 65, 69, 90, 78, 91, 73, 79, 79, 90, 77, 96, 96, 68, 94, 87, 79, 93, 77),
(36245578006, 96, 71, 86, 92, 66, 70, 92, 92, 84, 94, 75, 92, 89, 97, 65, 91, 77, 67, 70, 72, 91, 73),
(36245578007, 97, 88, 79, 96, 96, 88, 76, 66, 67, 81, 66, 66, 92, 87, 96, 97, 65, 83, 66, 90, 96, 70),
(36245578008, 96, 68, 75, 81, 88, 69, 98, 70, 86, 75, 80, 97, 73, 70, 80, 93, 67, 84, 83, 90, 67, 83),
(36245578009, 84, 96, 71, 97, 82, 65, 75, 92, 89, 87, 95, 94, 71, 80, 90, 66, 65, 76, 69, 96, 73, 83),
(36245578010, 80, 67, 84, 88, 97, 88, 75, 72, 84, 89, 89, 93, 82, 82, 66, 80, 97, 68, 97, 78, 85, 84),
(36245578011, 72, 71, 67, 81, 97, 76, 86, 86, 94, 72, 91, 91, 98, 85, 94, 97, 92, 97, 69, 83, 68, 81),
(36245578012, 92, 94, 93, 70, 88, 93, 95, 97, 85, 96, 87, 97, 67, 82, 89, 95, 67, 88, 96, 86, 87, 66),
(36245578013, 91, 66, 90, 81, 97, 73, 93, 90, 89, 88, 77, 71, 84, 65, 72, 80, 78, 76, 87, 79, 92, 98),
(36245578014, 66, 96, 87, 86, 89, 86, 86, 70, 79, 97, 72, 69, 68, 70, 96, 94, 80, 77, 94, 83, 81, 83),
(36245578015, 92, 90, 90, 87, 73, 76, 65, 65, 98, 96, 89, 65, 80, 69, 86, 93, 67, 76, 90, 80, 86, 93),
(36245578016, 78, 92, 69, 94, 69, 76, 80, 90, 90, 85, 97, 94, 87, 74, 69, 98, 95, 74, 83, 96, 65, 69),
(36245578017, 68, 80, 88, 80, 66, 92, 96, 91, 84, 88, 76, 97, 97, 76, 67, 65, 97, 74, 93, 77, 76, 95),
(36245578018, 66, 87, 81, 90, 72, 93, 90, 74, 90, 98, 71, 68, 75, 93, 89, 85, 74, 73, 88, 82, 96, 88),
(36245578019, 87, 96, 76, 77, 87, 89, 94, 81, 84, 89, 86, 77, 83, 76, 83, 76, 73, 71, 92, 78, 95, 83),
(36245578020, 80, 69, 76, 89, 85, 87, 80, 78, 95, 69, 87, 93, 75, 82, 76, 73, 74, 81, 71, 77, 73, 91),
(36245578021, 66, 69, 93, 83, 72, 65, 86, 81, 71, 89, 68, 70, 95, 83, 91, 74, 90, 83, 67, 77, 92, 84),
(36245578022, 92, 72, 65, 67, 77, 92, 89, 97, 70, 96, 85, 80, 85, 75, 83, 84, 82, 78, 79, 95, 65, 67),
(36245578023, 80, 87, 75, 76, 74, 96, 80, 72, 76, 88, 92, 72, 92, 90, 72, 92, 92, 91, 81, 73, 97, 84),
(36245578024, 77, 92, 93, 77, 70, 82, 69, 89, 66, 74, 94, 69, 97, 65, 82, 96, 75, 85, 90, 89, 86, 91),
(36245578025, 77, 97, 98, 65, 85, 70, 92, 81, 69, 95, 69, 67, 87, 74, 74, 83, 81, 85, 78, 73, 65, 77);

DROP TABLE IF EXISTS asesmen_non_akademik;
CREATE TABLE asesmen_non_akademik (
    nim BIGINT PRIMARY KEY,
    bakat_porseni INT,
    skala_binggris_ipec INT,
    pengalaman_lomba INT,
    minat_mempelajari INT,
    link_sertifikat VARCHAR(255) NULL
);

INSERT INTO asesmen_non_akademik VALUES 
(36245578001, 0, 1, 1, 1),
(36245578002, 0, 2, 0, 1),
(36245578003, 1, 2, 1, 1),
(36245578004, 1, 3, 0, 0),
(36245578005, 0, 5, 1, 1),
(36245578006, 0, 4, 1, 1),
(36245578007, 1, 3, 0, 1),
(36245578008, 1, 1, 1, 1),
(36245578009, 1, 3, 1, 1),
(36245578010, 1, 1, 0, 1),
(36245578011, 1, 2, 1, 1),
(36245578012, 0, 3, 0, 0),
(36245578013, 0, 3, 0, 1),
(36245578014, 0, 1, 1, 1),
(36245578015, 1, 2, 1, 1),
(36245578016, 1, 2, 0, 0),
(36245578017, 0, 1, 1, 1),
(36245578018, 1, 1, 1, 1),
(36245578019, 0, 1, 0, 1),
(36245578020, 1, 3, 1, 0),
(36245578021, 0, 1, 0, 1),
(36245578022, 1, 2, 1, 1),
(36245578023, 1, 2, 0, 1),
(36245578024, 1, 3, 1, 0),
(36245578025, 1, 3, 0, 0);
";

DB::unprepared($sql);
echo "Tabel nilai_akademik dan asesmen_non_akademik berhasil dibuat & diisi datanya!\n";
