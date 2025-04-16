<?php
include '../config/koneksi.php';

if (!isset($_GET['id'])) {
  echo "<script>alert('ID siswa tidak ditemukan.'); window.location.href='kelola_absen.php';</script>";
  exit;
}

$user_id = mysqli_real_escape_string($conn, $_GET['id']);
$siswa = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE user_id = '$user_id' AND role = 'siswa'"));

if (!$siswa) {
  echo "<script>alert('Data siswa tidak ditemukan.'); window.location.href='kelola_absen.php';</script>";
  exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $tanggal = $_POST['tanggal'];
  $status = $_POST['status'];

  // Cek apakah data untuk tanggal tersebut sudah ada
  $cek = mysqli_query($conn, "SELECT * FROM absensi WHERE user_id = '$user_id' AND tanggal = '$tanggal'");
  if (mysqli_num_rows($cek) > 0) {
    echo "<script>alert('Absensi untuk tanggal tersebut sudah ada.'); window.location.href='kelola_absen.php';</script>";
    exit;
  }

  $insert = mysqli_query($conn, "INSERT INTO absensi (user_id, tanggal, status) VALUES ('$user_id', '$tanggal', '$status')");

  if ($insert) {
    echo "<script>alert('Data absensi berhasil ditambahkan.'); window.location.href='kelola_absen.php';</script>";
  } else {
    echo "<script>alert('Gagal menambahkan data absensi.');</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Absensi</title>
  <style>
    body { font-family: Arial; background: #f4f4f4; padding: 30px; }
    .form-container {
      max-width: 500px;
      background: white;
      padding: 25px;
      margin: auto;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    h2 { margin-bottom: 20px; }
    input, select {
      width: 100%;
      padding: 10px;
      margin-top: 10px;
    }
    button {
      margin-top: 20px;
      padding: 10px 15px;
      background-color: #28a745;
      border: none;
      color: white;
      cursor: pointer;
      border-radius: 6px;
    }
    a {
      display: inline-block;
      margin-top: 20px;
      text-decoration: none;
      color: #007bff;
    }
  </style>
</head>
<body>

<div class="form-container">
  <h2>Tambah Absensi - <?= $siswa['nama'] ?> (<?= $siswa['username'] ?>)</h2>
  <form method="POST">
    <label for="tanggal">Tanggal:</label>
    <input type="date" name="tanggal" required>

    <label for="status">Status Kehadiran:</label>
    <select name="status" required>
      <option value="hadir">Hadir</option>
      <option value="izin">Izin</option>
      <option value="sakit">Sakit</option>
      <option value="alpha">Alpha</option>
    </select>

    <button type="submit">Simpan Absensi</button>
  </form>
  <a href="kelola_absen.php">← Kembali</a>
</div>

</body>
</html>
