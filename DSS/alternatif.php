<?php
// Koneksi ke database
$host = 'localhost'; 
$username = 'root';  
$password = '';      
$dbname = 'dbkenaikanpangkat';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['add'])) {
    $namaKaryawan = $_POST['namaKaryawan'];
    $departemen = $_POST['departemen'];
    $sql = "INSERT INTO tbAlternatif (namaKaryawan, departemen) VALUES ('$namaKaryawan', '$departemen')";
    if ($conn->query($sql) === TRUE) {
        // Menggunakan JavaScript untuk menampilkan notifikasi sukses
        echo "<script type='text/javascript'>
                alert('Data berhasil ditambahkan!');
                window.location.href = 'alternatif.php'; // Redirect ke halaman alternatif.php
              </script>";
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

// Fungsi untuk menghapus data
if (isset($_GET['delete'])) {
    $idAlternatif = $_GET['delete'];
    $sql = "DELETE FROM tbAlternatif WHERE idAlternatif = $idAlternatif";
    if ($conn->query($sql) === TRUE) {
        // Menampilkan pesan sukses menggunakan JavaScript
        echo "<script type='text/javascript'>
                alert('Data berhasil dihapus!');
                window.location.href = 'alternatif.php'; // Redirect ke halaman alternatif.php
              </script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Fungsi untuk mengedit data
if (isset($_GET['edit'])) {
    $idAlternatif = $_GET['edit'];
    $sql = "SELECT * FROM tbAlternatif WHERE idAlternatif = $idAlternatif";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
}

// Update data setelah diubah
if (isset($_POST['update'])) {
    $idAlternatif = $_POST['idAlternatif'];
    $namaKaryawan = $_POST['namaKaryawan'];
    $departemen = $_POST['departemen'];
    $sql = "UPDATE tbAlternatif SET namaKaryawan='$namaKaryawan', departemen='$departemen' WHERE idAlternatif=$idAlternatif";
    if ($conn->query($sql) === TRUE) {
        // Redirect setelah update untuk menghindari data terduplikasi saat refresh
        header("Location: alternatif.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
// Mengambil data dari tabel tbAlternatif
$sql = "SELECT * FROM tbAlternatif";
$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Alternatif - DSS Kenaikan Jabatan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }

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

    .card {
      border: none;
      border-radius: 10px;

      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    

    main {
      padding-top: 20px;
    }

    /* Menghapus efek hover pada tombol */
    .btn:hover {
      background-color: initial;
      color: initial;
    }

    /* Notifikasi */
    #notification {
      position: fixed;
      top: 20px;
      right: 20px;
      z-index: 1000;
      display: none;
    }
  </style>
</head>

<body>
  <div class="container-fluid">
    <div class="row">
      <nav class="col-md-3 col-lg-2 d-md-block bg-primary sidebar text-white vh-100">
        <div class="position-sticky pt-3">
          <h3 class="text-center py-3">DSS Kenaikan Jabatan</h3>
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link text-white" href="dashboard.php">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white active" href="alternatif.php">Alternatif</a>
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

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <section id="alternatif" class="pt-4">
          <h2>Alternatif</h2>
          
          <!-- Form untuk menambah data -->
          <div class="card mt-4">
            <div class="card-body">
              <h5 class="card-title">Tambah Alternatif</h5>
              <form method="POST" action="alternatif.php">
                <div class="mb-3">
                  <label for="namaKaryawan" class="form-label">Nama Karyawan</label>
                  <input type="text" class="form-control" id="namaKaryawan" name="namaKaryawan" required>
                </div>
                <div class="mb-3">
                  <label for="departemen" class="form-label">Departemen</label>
                  <select id="departemen" name="departemen" class="form-control" required>
                    <option value="Graphic Designer">Graphic Designer</option>
                    <option value="Backend Developer">Backend Developer</option>
                    <option value="Frontend Developer">Frontend Developer</option>
                    <option value="IT Support">IT Support</option>
                </select>
                </div>
                <button type="submit" name="add" class="btn btn-primary">Tambah</button>
                <button type="reset" class="btn btn-danger">Batal</button>
              </form>
            </div>
          </div>

          <!-- Form untuk edit data (jika ada) -->
          <?php if (isset($data)) { ?>
          <div class="card mt-4">
            <div class="card-body">
              <h5 class="card-title">Edit Alternatif</h5>
              <form method="POST" action="alternatif.php">
                <input type="hidden" name="idAlternatif" value="<?= $data['idAlternatif'] ?>">
                <div class="mb-3">
                  <label for="namaKaryawan" class="form-label">Nama Karyawan</label>
                  <input type="text" class="form-control" id="namaKaryawan" name="namaKaryawan" value="<?= $data['namaKaryawan'] ?>" required>
                </div>
                <div class="mb-3">
                  <label for="departemen" class="form-label">Departemen</label>
                  <input type="text" class="form-control" id="departemen" name="departemen" value="<?= $data['departemen'] ?>" required>
                </div>
                <button type="submit" name="update" class="btn btn-warning">Update</button>
              </form>
            </div>
          </div>
          <?php } ?>

          <!-- Tabel Alternatif -->
          <div class="card mt-4">
            <div class="card-body">
              <h5 class="card-title">Data Alternatif</h5>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>ID Alternatif</th>
                    <th>Nama Karyawan</th>
                    <th>Departemen</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      echo "<tr>
                              <td>" . $row['idAlternatif'] . "</td>
                              <td>" . $row['namaKaryawan'] . "</td>
                              <td>" . $row['departemen'] . "</td>
                              <td>
                                <a href='alternatif.php?edit=" . $row['idAlternatif'] . "' class='btn btn-warning btn-sm'>Edit</a>
                                <a href='alternatif.php?delete=" . $row['idAlternatif'] . "' class='btn btn-danger btn-sm'>Hapus</a>
                              </td>
                            </tr>";
                    }
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

  <!-- Notifikasi -->
  <div id="notification" class="alert alert-success" style="display: none;">
    Data berhasil diproses!
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript">
    function showNotification(message) {
      var notification = document.getElementById('notification');
      notification.textContent = message;
      notification.style.display = 'block';
      setTimeout(function() {
        notification.style.display = 'none';
      }, 3000); // Menghilangkan notifikasi setelah 3 detik
    }

    // Menampilkan notifikasi sukses saat data berhasil ditambahkan
    <?php if (isset($data) && isset($_POST['add'])) { ?>
      showNotification('Data berhasil ditambahkan!');
    <?php } ?>

    // Menampilkan notifikasi sukses saat data berhasil dihapus
    <?php if (isset($_GET['delete'])) { ?>
      showNotification('Data berhasil dihapus!');
    <?php } ?>
  </script>
</body>

</html>

<?php
$conn->close();
?>
