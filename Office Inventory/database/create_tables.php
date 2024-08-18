<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kantor";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk membuat tabel Pegawai
$sqlPegawai = "CREATE TABLE Pegawai (
    ID_Pegawai INT AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(50) NOT NULL,
    Password VARCHAR(255) NOT NULL,
    Nama VARCHAR(100) NOT NULL,
    Alamat VARCHAR(255),
    Nomor_Telepon VARCHAR(15),
    Jenis_Kelamin VARCHAR(10)
)";

// Eksekusi query
if ($conn->query($sqlPegawai) === TRUE) {
    echo "Tabel Pegawai berhasil dibuat<br>";
} else {
    echo "Error: " . $sqlPegawai . "<br>" . $conn->error;
}

// Tutup koneksi
$conn->close();

?>
