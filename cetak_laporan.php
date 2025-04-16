<?php
include '../config/koneksi.php';

if (!isset($_GET['id'])) {
  echo "ID siswa tidak ditemukan.";
  exit;
}

$user_id = $_GET['id'];

// Ambil data siswa
$siswa = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE user_id = '$user_id' AND role = 'siswa'"));

if (!$siswa) {
  echo "Data siswa tidak ditemukan.";
  exit;
}

// Ambil data absensi siswa
$query_absen = mysqli_query($conn, "SELECT * FROM absensi WHERE user_id = '$user_id' ORDER BY tanggal ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Laporan Absensi</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 30px;
      color: #333;
    }

    h2, h3 {
      text-align: center;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 30px;
    }

    th, td {
      border: 1px solid #aaa;
      padding: 10px;
      text-align: left;
    }

    th {
      background-color: #007bff;
      color: white;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    .info {
      margin-top: 20px;
    }
  </style>
</head>
<body onload="window.print()">

  <h2>Laporan Absensi Siswa</h2>
  <h3><?php echo $siswa['nama']; ?> (<?php echo $siswa['username']; ?>)</h3>

  <div class="info">
    <strong>Tanggal Cetak:</strong> <?php echo date('d-m-Y'); ?>
  </div>

  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if (mysqli_num_rows($query_absen) > 0) {
        $no = 1;
        while ($absen = mysqli_fetch_assoc($query_absen)) {
          echo "<tr>
                  <td>{$no}</td>
                  <td>{$absen['tanggal']}</td>
                  <td>{$absen['status']}</td>
                </tr>";
          $no++;
        }
      } else {
        echo "<tr><td colspan='3' style='text-align:center;'>Belum ada data absensi.</td></tr>";
      }
      ?>
    </tbody>
  </table>

</body>
</html>
