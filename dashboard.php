<?php
include '../config/koneksi.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$query = mysqli_query($conn, "SELECT nama FROM users WHERE user_id = '$user_id'");
$data = mysqli_fetch_assoc($query);
$nama_siswa = $data['nama'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Siswa</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background-color: #e9ecef;
      min-height: 100vh;
      color: #495057;
    }

    .navbar {
      background: linear-gradient(45deg, #007bff, #6f42c1);
      padding: 20px 30px;
      color: white;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      border-radius: 0 0 20px 20px;
    }

    .navbar .left {
      display: flex;
      align-items: center;
      gap: 20px;
    }

    .logo {
      width: 50px;
      height: 50px;
      object-fit: cover;
      border-radius: 50%;
    }

    .navbar h1 {
      font-size: 28px;
      font-weight: 600;
    }

    .user-info {
      display: flex;
      align-items: center;
      gap: 20px;
    }

    .user-info span {
      font-weight: 500;
      font-size: 18px;
      text-transform: capitalize;
    }

    .navbar a {
      color: white;
      text-decoration: none;
      font-weight: 500;
      font-size: 16px;
      padding: 10px 18px;
      background-color: rgba(255, 255, 255, 0.2);
      border-radius: 50px;
      transition: background-color 0.3s;
    }

    .navbar a:hover {
      background-color: rgba(255, 255, 255, 0.4);
    }

    .container {
      max-width: 1200px;
      margin: 50px auto;
      padding: 30px;
    }

    .card {
      background-color: #ffffff;
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
      margin-bottom: 40px;
      transition: transform 0.3s ease-in-out;
    }

    .card:hover {
      transform: translateY(-10px);
    }

    .card h2 {
      color: #333;
      font-size: 28px;
      margin-bottom: 20px;
    }

    .card p {
      color: #6c757d;
      font-size: 17px;
      line-height: 1.8;
    }

    .btn {
      display: inline-block;
      margin-top: 25px;
      padding: 15px 25px;
      background: linear-gradient(45deg, #007bff, #28a745);
      color: white;
      border: none;
      border-radius: 50px;
      font-size: 18px;
      text-decoration: none;
      text-align: center;
      box-shadow: 0 6px 15px rgba(0, 123, 255, 0.2);
      transition: background 0.3s, transform 0.2s ease-in-out;
    }

    .btn:hover {
      background: linear-gradient(45deg, #28a745, #007bff);
      transform: translateY(-3px);
    }

    @media (max-width: 768px) {
      .container {
        padding: 15px;
      }

      .card {
        padding: 25px;
      }

      .navbar {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
      }

      .user-info {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
      }
    }
  </style>
</head>
<body>

<div class="navbar">
  <div class="left">
    
    <h1>Dashboard Siswa</h1>
  </div>
  <div class="user-info">
    <span><?= htmlspecialchars($nama_siswa) ?></span>
    <a href="../auth/logout.php">Logout</a>
  </div>
</div>

<div class="container">
  <div class="card">
    <h2>Selamat Datang!</h2>
    <p>Selamat datang di dashboard absensi. Silakan isi daftar hadir untuk hari ini dengan menekan tombol di bawah ini. Pastikan data yang Anda masukkan sudah benar.</p>
    <a href="absen.php" class="btn">Isi Absensi Hari Ini</a>
  </div>
</div>

</body>
</html>
