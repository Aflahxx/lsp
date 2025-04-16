<?php
include '../config/koneksi.php';

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

$query_siswa_absen = mysqli_query($conn, "
  SELECT DISTINCT users.user_id, users.nama, users.username 
  FROM absensi 
  JOIN users ON absensi.user_id = users.user_id 
  WHERE users.role = 'siswa'
  ORDER BY users.nama ASC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kelola Absensi</title>
  <style>
    :root {
      --primary-dark: #2c3e50;
      --primary-light: #ecf0f1;
      --accent: #e67e22;
      --secondary-accent: #16a085;
      --gray-light: #bdc3c7;
      --text-dark: #34495e;
      --text-light: #fff;
      --border-color: #d5dbe1;
      --hover-primary: #34495e;
      --hover-accent: #e26a00;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background-color: var(--primary-light);
      padding: 30px;
      font-size: 16px;
      color: var(--text-dark);
    }

    .container {
      max-width: 1200px;
      margin: auto;
      background-color: var(--text-light);
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }

    h2 {
      color: var(--primary-dark);
      margin-bottom: 25px;
      font-size: 32px;
      font-weight: bold;
      text-transform: uppercase;
    }

    h3 {
      color: var(--text-dark);
      font-size: 22px;
      margin: 20px 0;
      font-weight: 600;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      padding: 14px 20px;
      text-align: left;
      border: 1px solid var(--border-color);
    }

    th {
      background-color: var(--primary-dark);
      color: var(--text-light);
    }

    tr:nth-child(even) {
      background-color: var(--primary-light);
    }

    hr {
      margin: 40px 0;
      border: none;
      border-top: 1px solid var(--border-color);
    }

    .back {
      display: inline-block;
      margin-bottom: 25px;
      background-color: var(--primary-dark);
      color: var(--text-light);
      padding: 12px 25px;
      border-radius: 6px;
      font-weight: 500;
      text-decoration: none;
      text-transform: uppercase;
      font-size: 14px;
      transition: all 0.3s;
    }

    .back:hover {
      background-color: var(--hover-primary);
    }

    .btn {
      display: inline-block;
      padding: 12px 20px;
      margin-top: 15px;
      margin-right: 10px;
      background-color: var(--accent);
      color: var(--text-light);
      text-decoration: none;
      border-radius: 6px;
      font-size: 14px;
      transition: background 0.3s ease, transform 0.2s ease;
    }

    .btn:hover {
      background-color: var(--hover-accent);
      transform: translateY(-2px);
    }

    .btn-edit {
      background-color: #f39c12;
    }

    .btn-edit:hover {
      background-color: #e26a00;
    }

    .btn-hapus {
      background-color: var(--danger);
    }

    .btn-hapus:hover {
      background-color: #c0392b;
    }

    .btn-cetak {
      background-color: var(--secondary-accent);
    }

    .btn-cetak:hover {
      background-color: #1c8c72;
    }

    p.gray {
      color: #7f8c8d;
      font-style: italic;
    }

    @media print {
      .no-print, .btn, .back {
        display: none;
      }
    }
  </style>
</head>
<body>

<div class="container">
  <a href="dashboard.php" class="back no-print">← Kembali ke Dashboard</a>
  <h2>Riwayat Absensi Semua Siswa</h2>

  <button onclick="printSemua()" class="btn btn-cetak no-print">🖨️ Cetak Semua Data</button>

  <div id="area-absensi">
    <?php
    $no = 1;
    while ($siswa = mysqli_fetch_assoc($query_siswa_absen)) {
      echo "<div class='siswa-box' id='siswa-{$siswa['user_id']}'>";
      echo "<h3>{$no}. {$siswa['nama']} ({$siswa['username']})</h3>";
      echo "<a href='tambah_absen.php?id={$siswa['user_id']}' class='btn no-print'>+ Tambah Absensi</a>";
      echo "<button onclick=\"printPerSiswa('siswa-{$siswa['user_id']}')\" class='btn btn-cetak no-print'>Cetak Laporan</button>";

      $user_id = $siswa['user_id'];
      $absensi = mysqli_query($conn, "SELECT * FROM absensi WHERE user_id = '$user_id' ORDER BY tanggal DESC");

      if (mysqli_num_rows($absensi) > 0) {
        echo "<table>
                <thead>
                  <tr>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th class='no-print'>Aksi</th>
                  </tr>
                </thead>
                <tbody>";
        while ($row = mysqli_fetch_assoc($absensi)) {
          echo "<tr>
                  <td>{$row['tanggal']}</td>
                  <td>{$row['status']}</td>
                  <td class='no-print'>
                    <a href='edit_absen.php?id={$row['id']}' class='btn btn-edit'>Edit</a>
                    <a href='hapus_absen.php?id={$row['id']}' class='btn btn-hapus' onclick=\"return confirm('Yakin ingin menghapus data ini?')\">Hapus</a>
                  </td>
                </tr>";
        }
        echo "</tbody></table>";
      } else {
        echo "<p class='gray'>Belum ada data absensi.</p>";
      }

      echo "</div><hr>";
      $no++;
    }

    if ($no === 1) {
      echo "<p class='gray'>Belum ada data absensi siswa.</p>";
    }
    ?>
  </div>
</div>

<script>
  function printSemua() {
    window.print();
  }

  function printPerSiswa(id) {
    var originalContent = document.body.innerHTML;
    var printContent = document.getElementById(id).innerHTML;

    document.body.innerHTML = printContent;
    window.print();
    document.body.innerHTML = originalContent;
    location.reload();
  }
</script>

</body>
</html>
