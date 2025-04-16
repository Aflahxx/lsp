<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Absensi Siswa</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background-color: #f4f6f8;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      color: #333;
    }

    .container {
      background-color: #ffffff;
      padding: 40px 30px;
      border-radius: 15px;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
      text-align: center;
      width: 90%;
      max-width: 400px;
    }

    h1 {
      font-size: 28px;
      margin-bottom: 15px;
      color: #2c3e50;
    }

    p {
      margin-bottom: 30px;
      font-size: 15px;
      color: #555;
    }

    .btn {
      display: inline-block;
      padding: 12px 25px;
      margin: 8px 5px;
      border: none;
      border-radius: 8px;
      font-size: 15px;
      font-weight: 600;
      cursor: pointer;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .btn-primary {
      background-color: #3498db;
      color: white;
    }

    .btn-primary:hover {
      background-color: #2980b9;
    }

    .btn-secondary {
      background-color: #2ecc71;
      color: white;
    }

    .btn-secondary:hover {
      background-color: #27ae60;
    }
  </style>
</head>
<body>

  <div class="container">
    <h1>Selamat Datang!</h1>
    <p>Silakan login atau daftar akun untuk melanjutkan ke absensi siswa.</p>
    <a href="auth/login.php" class="btn btn-primary">Login</a>
    <a href="auth/register.php" class="btn btn-secondary">Daftar</a>
  </div>

</body>
</html>
