<?php
include '../config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nama = $_POST['nama'];
  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // aman
  $role = 'siswa';

  // Proses upload foto
  $foto = $_FILES['foto']['name'];
  $tmp = $_FILES['foto']['tmp_name'];
  $folder = '../uploads/';

  $fotobaru = uniqid() . '-' . $foto;

  if (move_uploaded_file($tmp, $folder . $fotobaru)) {
    $query = mysqli_query($conn, "INSERT INTO users (nama, username, password, role, foto) VALUES ('$nama', '$username', '$password', '$role', '$fotobaru')");

    if ($query) {
      echo "<script>alert('Data siswa berhasil ditambahkan.'); window.location.href='datasiswa.php';</script>";
    } else {
      echo "<script>alert('Gagal menambahkan data.');</script>";
    }
  } else {
    echo "<script>alert('Gagal upload foto.');</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Siswa Baru</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #ece9e6, #ffffff);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .form-container {
      background: #ffffff;
      padding: 40px;
      border-radius: 16px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 450px;
      transition: all 0.3s ease;
    }

    .form-container:hover {
      transform: translateY(-3px);
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
    }

    h2 {
      text-align: center;
      margin-bottom: 30px;
      font-weight: 600;
      color: #333;
    }

    label {
      font-weight: 500;
      color: #555;
      margin-bottom: 8px;
      display: block;
    }

    input[type="text"],
    input[type="password"],
    input[type="file"] {
      width: 100%;
      padding: 12px 15px;
      margin-bottom: 20px;
      border: 1px solid #ddd;
      border-radius: 8px;
      background-color: #f9f9f9;
      transition: border-color 0.3s;
    }

    input:focus {
      border-color: #6c63ff;
      background-color: #fff;
      outline: none;
    }

    button {
      background-color: #6c63ff;
      color: white;
      border: none;
      padding: 14px;
      border-radius: 8px;
      width: 100%;
      font-size: 16px;
      font-weight: 500;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    button:hover {
      background-color: #574b90;
    }

    a {
      display: block;
      text-align: center;
      margin-top: 20px;
      color: #6c63ff;
      text-decoration: none;
      transition: color 0.3s;
    }

    a:hover {
      color: #574b90;
    }
  </style>
</head>
<body>

<div class="form-container">
  <h2>Tambah Siswa Baru</h2>
  <form method="POST" action="" enctype="multipart/form-data">
    <label>Nama Lengkap</label>
    <input type="text" name="nama" required>

    <label>Username</label>
    <input type="text" name="username" required>

    <label>Password</label>
    <input type="password" name="password" required>

    <label>Foto Profil</label>
    <input type="file" name="foto" accept="image/*" required>

    <button type="submit">Simpan Data</button>
    <a href="datasiswa.php">← Kembali ke Data Siswa</a>
  </form>
</div>

</body>
</html>
