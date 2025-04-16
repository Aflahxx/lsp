<?php
include '../config/koneksi.php';

if (!isset($_GET['id'])) {
  echo "<script>alert('ID tidak ditemukan.'); window.location.href='kelola_absen.php';</script>";
  exit;
}

$id = mysqli_real_escape_string($conn, $_GET['id']);

// Cek apakah data absensi dengan ID tersebut ada
$cek = mysqli_query($conn, "SELECT * FROM absensi WHERE id = '$id'");
if (mysqli_num_rows($cek) == 0) {
  echo "<script>alert('Data absensi tidak ditemukan.'); window.location.href='kelola_absen.php';</script>";
  exit;
}

// Hapus data absensi berdasarkan ID
$hapus_absen = mysqli_query($conn, "DELETE FROM absensi WHERE id = '$id'");

if ($hapus_absen) {
  echo "<script>alert('Data absensi berhasil dihapus.'); window.location.href='kelola_absen.php';</script>";
} else {
  echo "<script>alert('Gagal menghapus data absensi: " . mysqli_error($conn) . "'); window.location.href='kelola_absen.php';</script>";
}
?>
