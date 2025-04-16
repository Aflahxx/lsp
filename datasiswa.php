<?php
include '../config/koneksi.php';

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

$query = mysqli_query($conn, "SELECT * FROM users WHERE role = 'siswa'");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kelola Data Siswa</title>
  <style>
    :root {
      --primary: #6a11cb;
      --primary-light: #2575fc;
      --background: #f5f7fa;
      --text-dark: #2c3e50;
      --text-light: #7f8c8d;
      --danger: #e74c3c;
      --danger-dark: #c0392b;
      --white: #ffffff;
      --card-shadow: rgba(0, 0, 0, 0.1);
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background: var(--background);
      color: var(--text-dark);
    }

    .navbar {
      background: linear-gradient(to right, var(--primary), var(--primary-light));
      padding: 20px;
      color: var(--white);
      box-shadow: 0 4px 12px var(--card-shadow);
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
    }

    .navbar img {
      position: absolute;
      left: 20px;
      top: 50%;
      transform: translateY(-50%);
      width: 40px;
      height: 40px;
    }

    .navbar h1 {
      font-size: 26px;
      font-weight: 700;
    }

    .container {
      max-width: 1100px;
      margin: 50px auto;
      background: var(--white);
      padding: 40px;
      border-radius: 16px;
      box-shadow: 0 10px 30px var(--card-shadow);
    }

    .btn {
      padding: 10px 18px;
      background: linear-gradient(to right, var(--primary), var(--primary-light));
      color: var(--white);
      border: none;
      border-radius: 8px;
      text-decoration: none;
      font-size: 14px;
      font-weight: 600;
      margin-right: 8px;
      cursor: pointer;
      transition: all 0.3s ease;
      display: inline-block;
    }

    .btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px var(--card-shadow);
    }

    .btn-hapus {
      background: var(--danger);
    }

    .btn-hapus:hover {
      background: var(--danger-dark);
    }

    .btn-tambah {
      margin-bottom: 20px;
      display: inline-block;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      padding: 16px 14px;
      text-align: left;
      vertical-align: middle;
    }

    th {
      background: linear-gradient(to right, var(--primary), var(--primary-light));
      color: var(--white);
      font-weight: 600;
      border: none;
    }

    tr {
      border-bottom: 1px solid #eee;
      transition: background-color 0.3s;
    }

    tr:nth-child(even) {
      background-color: #fdfdff;
    }

    tr:hover {
      background-color: #f0f6ff;
    }

    .foto-siswa {
      width: 60px;
      height: 60px;
      border-radius: 8px;
      object-fit: cover;
      box-shadow: 0 2px 8px var(--card-shadow);
      transition: transform 0.3s;
    }

    .foto-siswa:hover {
      transform: scale(1.05);
    }

  </style>
</head>
<body>

<div class="navbar">
  <img src="smk4.png" alt="Icon Siswa">
  <h1>Kelola Data Siswa</h1>
</div>

<div class="container">
  <a href="dashboard.php" class="btn">&larr; Kembali ke Dashboard</a>
  <a href="tambah_siswa.php" class="btn btn-tambah">+ Tambah Siswa</a>

  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Foto</th>
        <th>Nama</th>
        <th>Username</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no = 1;
      while ($row = mysqli_fetch_assoc($query)) {
        $foto = !empty($row['foto']) ? '../uploads/' . $row['foto'] : 'default.png';
        echo "<tr>
                <td>{$no}</td>
                <td><img src='{$foto}' alt='Foto Siswa' class='foto-siswa'></td>
                <td>{$row['nama']}</td>
                <td>{$row['username']}</td>
                <td>
                  <a href='edit_siswa.php?id={$row['user_id']}' class='btn'>Edit</a>
                  <a href='hapus_siswa.php?id={$row['user_id']}' class='btn btn-hapus' onclick='return confirm(\"Yakin ingin menghapus siswa ini?\")'>Hapus</a>
                </td>
              </tr>";
        $no++;
      }
      ?>
    </tbody>
  </table>
</div>

</body>
</html>
