<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "dbkenaikanpangkat");

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mengambil data karyawan dan nilai preferensi dari tabel tbAlternatif dan tbHasil
$queryHasil = "SELECT a.namaKaryawan, h.nilaiPreferensi 
               FROM tbAlternatif a
               JOIN tbHasil h ON a.idAlternatif = h.idAlternatif
               ORDER BY h.nilaiPreferensi DESC";

$resultHasil = $conn->query($queryHasil);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Penilaian</title>
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

        /* Main Content Styling */
        main {
            padding-top: 20px;
        }

        /* Table Styling */
        .table-container {
            margin-top: 20px;
        }

        table th,
        table td {
            vertical-align: middle;
        }

        .card {
            border: none;
            border-radius: 10px;
           
            transition: transform 0.3s ease, box-shadow 0.3s ease;
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
                            <a class="nav-link text-white" href="kriteria.php">Kriteria</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white active" href="hasil.php">Hasil</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <section class="table-container">
                    <h2>Hasil Penilaian</h2>
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered ">
                                <thead>
                                    <tr>
                                        <th>Rank</th>
                                        <th>Nama Karyawan</th>
                                        <th>Nilai Preferensi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($resultHasil->num_rows > 0) {
                                        $rank = 1;
                                        while ($row = $resultHasil->fetch_assoc()) {
                                            echo "<tr>
                                                    <td>{$rank}</td>
                                                    <td>{$row['namaKaryawan']}</td>
                                                    <td>{$row['nilaiPreferensi']}</td>
                                                  </tr>";
                                            $rank++;
                                        }
                                    } else {
                                        echo "<tr><td colspan='3'>Tidak ada data hasil penilaian</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
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
