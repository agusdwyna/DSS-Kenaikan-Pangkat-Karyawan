<?php
// Koneksi ke database
$host = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "dbkenaikanpangkat"; 

$conn = new mysqli($host, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk menghitung jumlah alternatif
$query_alternatif = "SELECT COUNT(*) AS jumlah_alternatif FROM tbalternatif";
$result_alternatif = $conn->query($query_alternatif);
$row_alternatif = $result_alternatif->fetch_assoc();
$jumlah_alternatif = $row_alternatif['jumlah_alternatif'];

// Query untuk menghitung jumlah hasil
$query_hasil = "SELECT COUNT(*) AS jumlah_hasil FROM tbHasil";
$result_hasil = $conn->query($query_hasil);
$row_hasil = $result_hasil->fetch_assoc();
$jumlah_hasil = $row_hasil['jumlah_hasil'];

// Tutup koneksi
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <!-- Bootstrap CSS -->
   
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    html, body {
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
        background-color: #17a2b8; /* Cyan/Aqua */
        color: #fff; /* Putih */
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

    footer {
    position: fixed;
    bottom: 10px;
    left: 10px;
    font-size: 12px;
    color: rgba(255, 255, 255, 0.7); /* Putih dengan transparansi */
    padding: 5px 10px;
    border-radius: 5px;
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
              <a class="nav-link text-white active" href="dashboard.php">
                <i class="fas fa-tachometer-alt"></i> Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="alternatif.php">Alternatif</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="kriteria.php">Kriteria</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="hasil.php">Hasil</a>
            </li>
          </ul>
        </div>
      </nav>

      <!-- Main Content -->
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <!-- Dashboard Section -->
        <section id="dashboard" class="pt-4">
          <h2>Dashboard Admin</h2>
          <h5>Selamat Datang di DSS Kenaikan Jabatan</h5>
          <div class="row mt-4">
            <!-- Card Jumlah Alternatif -->
            <div class="col-md-4">
              <div class="card bg-success text-white">
                <div class="card-body">
                  <h5 class="card-title">Jumlah Alternatif</h5>
                  <p class="card-text display-4"><?php echo $jumlah_alternatif?></p>
                </div>
              </div>
            </div>
            <!-- Card Jumlah Kriteria -->
            <div class="col-md-4">
              <div class="card bg-warning text-white">
                <div class="card-body">
                  <h5 class="card-title">Jumlah Pengajuan</h5>
                  <p class="card-text display-4"><?php echo $jumlah_hasil?></p>
                </div>
              </div>
            </div>
          </div>
        </section>
      </main>
    </div>
  </div>
  <footer>
  Copyright @Kelompok4
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  
</body>

</html>

