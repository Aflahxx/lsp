<?php
include '../config/koneksi.php';
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

// Ambil data user berdasarkan username
$query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
$user = mysqli_fetch_assoc($query);

// Verifikasi user dan password
if ($user && password_verify($password, $user['password'])) {
    // Set session sesuai data user
    $_SESSION['user_id'] = $user['user_id']; // sudah diperbaiki dari 'id' menjadi 'user_id'
    $_SESSION['role'] = $user['role'];
    $_SESSION['nama'] = $user['nama'];

    // Redirect sesuai role
    if ($user['role'] == 'guru') {
        header("Location: ../guru/dashboard.php");
        exit;
    } elseif ($user['role'] == 'siswa') {
        header("Location: ../siswa/dashboard.php");
        exit;
    } else {
        echo "<script>alert('Role tidak dikenali.'); window.location.href='login.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('Login gagal. Username atau password salah!'); window.location.href='login.php';</script>";
    exit;
}
?>
