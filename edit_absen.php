<?php
include '../config/koneksi.php';

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if (!isset($_GET['id'])) {
  echo "ID absensi tidak ditemukan.";
  exit;
}

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM absensi WHERE id = '$id'");

if (mysqli_num_rows($query) == 0) {
  echo "Data absensi tidak ditemukan.";
  exit;
}

$data = mysqli_fetch_assoc($query);

if (isset($_POST['submit'])) {
  $tanggal = $_POST['tanggal'];
  $status = $_POST['status'];

  $update = mysqli_query($conn, "UPDATE absensi SET tanggal = '$tanggal', status = '$status' WHERE id = '$id'");

  if ($update) {
    header("Location: kelola_absen.php");
    exit;
  } else {
    echo "Gagal mengupdate data.";
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Absensi</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #eafaf1;
      padding: 30px;
    }

    .container {
      background: #ffffff;
      padding: 30px;
      max-width: 500px;
      margin: auto;
      border-radius: 12px;
      box-shadow: 0 6px 20px rgba(0, 128, 0, 0.1);
      border-top: 6px solid #28a745;
    }

    h2 {
      color: #28a745;
      margin-bottom: 25px;
      text-align: center;
    }

    label {
      display: block;
      margin-top: 10px;
      font-weight: 600;
      color: #2e7d32;
    }

    input, select {
      width: 100%;
      padding: 10px;
      margin-top: 6px;
      margin-bottom: 18px;
      border: 1px solid #a5d6a7;
      border-radius: 6px;
      font-size: 15px;
    }

    input:focus, select:focus {
      outline: none;
      border-color: #66bb6a;
      box-shadow: 0 0 5px rgba(102, 187, 106, 0.4);
    }

    button {
      background-color: #28a745;
      color: white;
      padding: 12px 25px;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      width: 100%;
    }

    button:hover {
      background-color: #218838;
    }

    .back {
      display: inline-block;
      margin-top: 15px;
      text-decoration: none;
      color: #28a745;
      font-weight: bold;
    }

    .back:hover {
      color: #1e7e34;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>Edit Data Absensi</h2>
  <form method="post">
    <label for="tanggal">Tanggal</label>
    <input type="date" id="tanggal" name="tanggal" value="<?= $data['tanggal'] ?>" required>

    <label for="status">Status</label>
    <select id="status" name="status" required>
      <option value="Hadir" <?= $data['status'] == 'Hadir' ? 'selected' : '' ?>>Hadir</option>
      <option value="Izin" <?= $data['status'] == 'Izin' ? 'selected' : '' ?>>Izin</option>
      <option value="Sakit" <?= $data['status'] == 'Sakit' ? 'selected' : '' ?>>Sakit</option>
      <option value="Alpha" <?= $data['status'] == 'Alpha' ? 'selected' : '' ?>>Alpha</option>
    </select>

    <button type="submit" name="submit">Simpan Perubahan</button>
  </form>
  <a href="kelola_absen.php" class="back">← Kembali</a>
</div>

</body>
</html>