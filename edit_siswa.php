<?php
include '../config/koneksi.php';

$id = $_GET['id'];

// Ambil data siswa
$siswa = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE user_id = '$id' AND LOWER(role) = 'siswa'"));
if (!$siswa) {
  echo "<script>alert('Data siswa tidak ditemukan.'); window.location.href='datasiswa.php';</script>";
  exit;
}

// Proses update data siswa
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama = mysqli_real_escape_string($conn, $_POST['nama']);
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  // Proses upload foto
  $fotoBaru = $_FILES['foto']['name'];
  $foto_tmp = $_FILES['foto']['tmp_name'];
  $foto_path = '../uploads/' . $fotoBaru;

  // Mulai query update
  if (!empty($password)) {
    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $query = "UPDATE users SET nama = '$nama', username = '$username', password = '$hashed'";
  } else {
    $query = "UPDATE users SET nama = '$nama', username = '$username'";
  }

  // Jika ada foto baru diupload
  if (!empty($fotoBaru)) {
    // Hapus foto lama jika ada
    if (!empty($siswa['foto']) && file_exists('../uploads/' . $siswa['foto'])) {
      unlink('../uploads/' . $siswa['foto']);
    }
    // Pindahkan foto baru ke folder uploads
    move_uploaded_file($foto_tmp, $foto_path);
    $query .= ", foto = '$fotoBaru'";
  }

  $query .= " WHERE user_id = '$id'";

  if (mysqli_query($conn, $query)) {
    echo "<script>alert('Data siswa berhasil diperbarui.'); window.location.href='datasiswa.php';</script>";
    exit;
  } else {
    echo "<script>alert('Gagal memperbarui data: " . mysqli_error($conn) . "');</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Data Siswa</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background: linear-gradient(135deg, #1f4037, #99f2c8);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 40px 20px;
    }

    .form-container {
      background: white;
      padding: 40px;
      border-radius: 16px;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
      max-width: 500px;
      width: 100%;
      border-top: 8px solid #27ae60;
      animation: fadeIn 1s ease;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    h2 {
      text-align: center;
      margin-bottom: 30px;
      color: #2c3e50;
      font-weight: 700;
    }

    label {
      margin-top: 15px;
      display: block;
      color: #34495e;
      font-weight: 600;
      font-size: 14px;
    }

    input[type="text"],
    input[type="password"],
    input[type="file"] {
      width: 100%;
      padding: 12px;
      margin-top: 8px;
      border: 1px solid #ccc;
      border-radius: 8px;
      transition: border-color 0.3s;
      font-size: 14px;
    }

    input[type="text"]:focus,
    input[type="password"]:focus,
    input[type="file"]:focus {
      border-color: #27ae60;
      outline: none;
    }

    button {
      width: 100%;
      padding: 14px;
      margin-top: 25px;
      background-color: #27ae60;
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: background-color 0.3s ease, transform 0.2s;
    }

    button:hover {
      background-color: #219150;
      transform: translateY(-2px);
    }

    a {
      display: block;
      text-align: center;
      margin-top: 20px;
      color: #27ae60;
      text-decoration: none;
      font-weight: 600;
      transition: color 0.3s;
    }

    a:hover {
      color: #1e8449;
    }

    img {
      margin-top: 15px;
      max-width: 120px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      display: block;
    }

    /* Responsive */
    @media (max-width: 600px) {
      .form-container {
        padding: 30px 20px;
      }
    }
  </style>
</head>
<body>

<div class="form-container">
  <h2>Edit Data Siswa</h2>
  <form method="POST" enctype="multipart/form-data">
    <label for="nama">Nama Lengkap</label>
    <input type="text" name="nama" id="nama" value="<?= htmlspecialchars($siswa['nama']) ?>" required>

    <label for="username">Username</label>
    <input type="text" name="username" id="username" value="<?= htmlspecialchars($siswa['username']) ?>" required>

    <label for="password">Password (isi jika ingin mengganti)</label>
    <input type="password" name="password" id="password" placeholder="Biarkan kosong jika tidak ingin mengganti">

    <label for="foto">Foto Siswa</label>
    <input type="file" name="foto" id="foto">
    <?php if (!empty($siswa['foto'])): ?>
      <img src="../uploads/<?= htmlspecialchars($siswa['foto']) ?>" alt="Foto Siswa">
    <?php endif; ?>

    <button type="submit">💾 Simpan Perubahan</button>
    <a href="datasiswa.php">← Kembali ke Data Siswa</a>
  </form>
</div>

</body>
</html>
