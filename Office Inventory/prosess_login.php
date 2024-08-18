<?php
session_start();

// Membersihkan session sebelumnya
unset($_SESSION['admin']);
unset($_SESSION['pegawai']);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kantor";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM Pegawai WHERE Username='$username' AND Password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if ($username == 'admin') {
            $_SESSION['admin'] = $row['Username'];
            header("Location: dashboard.php");
            exit(); // Penting untuk memastikan tidak ada output setelah header
        } else {
            $_SESSION['pegawai'] = $row['Username'];
            header("Location: dashboard_pegawai.php");
            exit(); // Penting untuk memastikan tidak ada output setelah header
        }
    } else {
        // Jika login gagal
        $_SESSION['login_error'] = "Username atau password salah.";
        header("Location: login.php");
        exit(); // Penting untuk memastikan tidak ada output setelah header
    }
}

$conn->close();
?>
