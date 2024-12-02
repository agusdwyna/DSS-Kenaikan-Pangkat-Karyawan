<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "dbkenaikanpangkat");

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
$alternatif = $_POST['alternatif'];
$pendidikan = $_POST['pendidikan'];
$lama_bekerja = $_POST['lama_bekerja'];
$proyek = $_POST['proyek'];

// Ambil bobot kriteria dari tabel tbKriteria
$bobot_query = "SELECT * FROM tbKriteria";
$bobot_result = $conn->query($bobot_query);

// Membuat array untuk menyimpan bobot
$bobot = [];
while ($row = $bobot_result->fetch_assoc()) {
    $bobot[$row['namaKriteria']] = $row['bobot'];
}

// Normalisasi data
$max_values = [
    'Lama Bekerja' => 60,  // Nilai maksimal untuk kriteria lama bekerja
    'Riwayat Pendidikan' => 4,  // Nilai maksimal untuk kriteria pendidikan
    'Proyek Diselesaikan' => 12  // Nilai maksimal untuk kriteria proyek
];

// Menghitung nilai kriteria berdasarkan input
$nilai_pendidikan = ($pendidikan == 1) ? 1 : ($pendidikan == 2 ? 2 : ($pendidikan == 3 ? 3 : 4));
$nilai_lama_bekerja = ($lama_bekerja < 6) ? 1 : (($lama_bekerja <= 24) ? 2 : (($lama_bekerja <= 48) ? 3 : 4));
$nilai_proyek = ($proyek < 5) ? 1 : (($proyek <= 10) ? 2 : 3);

// Perhitungan SAW menggunakan bobot yang diambil dari database
$nilai_preferensi = 
    ($nilai_lama_bekerja / $max_values['Lama Bekerja'] * $bobot['Lama Bekerja']) +
    ($nilai_pendidikan / $max_values['Riwayat Pendidikan'] * $bobot['Riwayat Pendidikan']) +
    ($nilai_proyek / $max_values['Proyek Diselesaikan'] * $bobot['Proyek Diselesaikan']);

// Simpan hasil perhitungan ke dalam tabel tbHasil
$stmt = $conn->prepare("INSERT INTO tbHasil (idAlternatif, nilaiPreferensi) VALUES (?, ?)");
$stmt->bind_param("id", $alternatif, $nilai_preferensi);
$stmt->execute();

// Redirect ke halaman kriteria.php atau hasil.php untuk menampilkan hasil
header("Location: hasil.php");
exit();

$conn->close();
?>
