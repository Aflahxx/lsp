<?php
include '../config/koneksi.php';

$id = $_GET['id'];

// Cek apakah ID valid dan milik siswa
$cek = mysqli_query($conn, "SELECT * FROM users WHERE user_id = '$id' AND role = 'siswa'");
if (mysqli_num_rows($cek) == 0) {
  echo "<script>alert('Siswa tidak ditemukan.'); window.location.href='datasiswa.php';</script>";
  exit;
}

// Hapus data absensi terlebih dahulu
mysqli_query($conn, "DELETE FROM absensi WHERE user_id = '$id'");

// Hapus data siswa
$hapus = mysqli_query($conn, "DELETE FROM users WHERE user_id = '$id'");

if ($hapus) {
  echo "<script>alert('Data siswa dan absensinya berhasil dihapus.'); window.location.href='datasiswa.php';</script>";
} else {
  echo "<script>alert('Gagal menghapus data siswa.'); window.location.href='datasiswa.php';</script>";
}
?>
