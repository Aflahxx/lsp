<?php
include '../config/koneksi.php';

$user_id = $_SESSION['user_id'];
$tanggal = date('Y-m-d');

// Cek apakah sudah absen
$cek = mysqli_query($conn, "SELECT * FROM absensi WHERE user_id='$user_id' AND tanggal='$tanggal'");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Form Absensi</title>
  <style>
    body {
      background-color: #f0f4f8;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    form {
      background-color: white;
      padding: 30px 40px;
      border-radius: 12px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
      max-width: 400px;
      width: 100%;
      text-align: center;
    }

    form label {
      font-weight: 600;
      display: block;
      margin-bottom: 8px;
      text-align: left;
    }

    form select {
      width: 100%;
      padding: 10px;
      border-radius: 8px;
      border: 1px solid #ccc;
      margin-bottom: 20px;
      font-size: 16px;
    }

    form button {
      padding: 10px 20px;
      background-color: #28a745;
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    form button:hover {
      background-color: #218838;
    }

    .message {
      font-size: 18px;
      font-weight: 500;
      color: #dc3545;
      text-align: center;
      padding: 20px;
      background-color: white;
      border-radius: 12px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    }
  </style>
</head>
<body>

<?php
if (mysqli_num_rows($cek) > 0) {
    echo "<div class='message'>Kamu sudah absen hari ini!</div>";
} else {
?>
  <form method="POST" action="proses_absen.php">
    <input type="hidden" name="tanggal" value="<?= $tanggal ?>">
    <label>Status:</label>
    <select name="status">
      <option value="Hadir">Hadir</option>
      <option value="Izin">Izin</option>
      <option value="Sakit">Sakit</option>
      <option value="Alpha">Alpha</option>
    </select>
    <button type="submit">Kirim Absensi</button>
  </form>
<?php } ?>

</body>
</html>
