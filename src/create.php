<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Enkripsi kata sandi
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Validasi panjang nama
    if (strlen($name) < 2 || strlen($name) > 50) {
        $_SESSION['error_msg'] = "Nama harus memiliki panjang antara 2 dan 50 karakter.";
        header("Location: create.html?error=1");
        exit();
    }

    // Validasi format email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error_msg'] = "Format email tidak valid.";
        header("Location: create.html?error=1");
        exit();
    }

    // Validasi keamanan password (minimal 8 karakter)
    if (strlen($password) < 8) {
        $_SESSION['error_msg'] = "Password harus terdiri dari minimal 8 karakter.";
        header("Location: create.html?error=1");
        exit();
    }

    // Periksa apakah email sudah terdaftar
    $stmt = $koneksi->prepare("SELECT email_penyewa FROM daftar_akun WHERE email_penyewa = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Jika email sudah terdaftar
        $_SESSION['email_exists'] = true;
        $stmt->close();
        header("Location: create.html");
        exit();
    } else {
        $_SESSION['email_exists'] = false;
    }

    $stmt->close();

    // Menggunakan prepared statement untuk memasukkan data
    $stmt = $koneksi->prepare("INSERT INTO `daftar_akun` (`nama_penyewa`, `email_penyewa`, `password_penyewa`) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $hashed_password);

    // Jika terjadi kesalahan, tampilkan pesan error di halaman create.html
    if ($stmt->execute()) {
        // Jika berhasil, arahkan ke halaman success.html
        header("Location: createsuccess.html");
        exit();
    } else {
        $_SESSION['error_msg'] = "Terjadi kesalahan. Silakan coba lagi.";
        header("Location: create.html?error=1");
        exit();
    }

    $stmt->close();
    $koneksi->close();
} else {
    header("Location: create.html");
    exit();
}
?>
