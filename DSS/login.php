<?php
// Koneksi ke database
$servername = "localhost";  
$username = "root";      
$password = "";           
$dbname = "dbkenaikanpangkat";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Proses login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk mengecek username dan password
    $sql = "SELECT * FROM tbuser WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);  
    $stmt->execute();
    $result = $stmt->get_result();

    // Jika data ditemukan, redirect ke dashboard.php
    if ($result->num_rows > 0) {
        session_start();
        $_SESSION['username'] = $username;  // Simpan username ke session
        header("Location: dashboard.php");  // Redirect ke dashboard
        exit();
    } else {
        $error_message = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<body>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow-lg" style="width: 300px;">
            <h2 class="text-center mb-4">Login Admin</h2>
            <form name="form-login" id="form-login" method="post" action="">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Masukan username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukan password" required>
                </div>

                <?php
                // Tampilkan pesan error jika ada
                if (isset($error_message)) {
                    echo '<div class="alert alert-danger" role="alert">' . $error_message . '</div>';
                }
                ?>

                <button type="submit" class="btn btn-primary w-100">Login</button>
                <p class="fs-6 text-center mt-3">@DSSbyKelompok4</p>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
