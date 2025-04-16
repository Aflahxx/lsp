<?php
include '../config/koneksi.php';

$nama = $_POST['nama'];
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$role = $_POST['role']; // role siswa atau guru

// Validasi role
if ($role !== 'siswa' && $role !== 'guru') {
    echo "<script>alert('Role tidak valid.');window.location.href='register.php';</script>";
    exit;
}

// Cek apakah username sudah dipakai
$cek = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
if (mysqli_num_rows($cek) > 0) {
    echo "<script>alert('Username sudah digunakan');window.location.href='register.php';</script>";
    exit;
}

// Simpan ke database
$query = mysqli_query($conn, "INSERT INTO users (nama, username, password, role) VALUES ('$nama', '$username', '$password', '$role')");

if ($query) {
    echo "<script>alert('Registrasi berhasil! Silakan login.');window.location.href='login.php';</script>";
} else {
    echo "<script>alert('Registrasi gagal!');window.location.href='register.php';</script>";
}
?>
