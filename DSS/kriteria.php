<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "dbkenaikanpangkat");

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mengambil data alternatif dari tabel tbAlternatif
$queryAlternatif = "SELECT idAlternatif, namaKaryawan FROM tbAlternatif";
$resultAlternatif = $conn->query($queryAlternatif);

// Query untuk mengambil data kriteria dan bobot dari tabel tbKriteria
$queryKriteria = "SELECT * FROM tbKriteria";
$resultKriteria = $conn->query($queryKriteria);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kriteria</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        /* Sidebar Styling */
        .sidebar {
            background-color: #2c3e50;
            color: #ecf0f1;
            font-size: 16px;
        }

        .sidebar h3 {
            font-size: 1.5rem;
        }

        .nav-link {
            font-weight: 500;
            padding: 10px 20px;
            transition: background-color 0.3s ease;
        }

        .nav-link:hover {
            background-color: black;
            color: #fff;
            border-radius: 5px;
        }

        .nav-link.active {
            background-color: #17a2b8;
            color: #fff;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        /* Card Box Styling */
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        /* Body Padding */
        main {
            padding-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block bg-primary sidebar text-white vh-100">
                <div class="position-sticky pt-3">
                    <h3 class="text-center py-3">DSS Kenaikan Jabatan</h3>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="dashboard.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="alternatif.php">Alternatif</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white active" href="kriteria.php">Kriteria</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="hasil.php">Hasil</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <!-- Kriteria Form Section -->
                <section id="kriteria" class="pt-4">
                    <h2>Kriteria</h2>
                    <form method="POST" action="proses_kriteria.php" class="mt-4">
                        <!-- Pilihan Alternatif -->
                        <div class="mb-3">
                            <label for="alternatif" class="form-label">Pilih Alternatif</label>
                            <select class="form-select" id="alternatif" name="alternatif" required>
                                <option value="">-- Pilih Alternatif --</option>
                                <?php
                                if ($resultAlternatif->num_rows > 0) {
                                    while ($row = $resultAlternatif->fetch_assoc()) {
                                        echo "<option value='{$row['idAlternatif']}'>{$row['namaKaryawan']}</option>";
                                    }
                                } else {
                                    echo "<option value=''>Data tidak tersedia</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <!-- Riwayat Pendidikan -->
                        <div class="mb-3">
                            <label for="pendidikan" class="form-label">Riwayat Pendidikan Terakhir</label>
                            <select class="form-select" id="pendidikan" name="pendidikan" required>
                                <option value="">-- Pilih Pendidikan --</option>
                                <option value="1">SMA</option>
                                <option value="2">Diploma 1-3</option>
                                <option value="3">D4/S1</option>
                                <option value="4">Magister dan di atasnya</option>
                            </select>
                        </div>

                        <!-- Lama Bekerja -->
                        <div class="mb-3">
                            <label for="lama_bekerja" class="form-label">Lama Bekerja (dalam bulan)</label>
                            <input type="number" class="form-control" id="lama_bekerja" name="lama_bekerja" min="0" required>
                        </div>

                        <!-- Jumlah Proyek Diselesaikan -->
                        <div class="mb-3">
                            <label for="proyek" class="form-label">Jumlah Proyek yang Diselesaikan Setahun Terakhir</label>
                            <input type="number" class="form-control" id="proyek" name="proyek" min="0" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-danger">Batal</button>
                    </form>
                </section>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
$conn->close();
?>
