<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login - Absensi Siswa</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background-color: #f4f6f8;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .login-box {
      background-color: #ffffff;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      width: 90%;
      max-width: 400px;
      text-align: center;
    }

    h2 {
      margin-bottom: 25px;
      color: #1e88e5;
      font-weight: 600;
    }

    .form-group {
      margin-bottom: 20px;
      text-align: left;
    }

    label {
      display: block;
      margin-bottom: 6px;
      color: #333333;
      font-weight: 500;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 12px;
      border: 1.5px solid #cfd8dc;
      border-radius: 8px;
      font-size: 14px;
      transition: 0.3s;
      background-color: #f9fafb;
    }

    input:focus {
      border-color: #1e88e5;
      background-color: #ffffff;
      outline: none;
    }

    .btn {
      width: 100%;
      padding: 12px;
      background-color: #1e88e5;
      border: none;
      border-radius: 8px;
      color: white;
      font-size: 16px;
      cursor: pointer;
      transition: 0.3s;
      margin-bottom: 12px;
    }

    .btn:hover {
      background-color: #1565c0;
    }

    .btn-back {
      background-color: #78909c;
      text-decoration: none;
      display: inline-block;
      padding: 12px;
      width: 100%;
      border-radius: 8px;
      color: white;
      font-size: 16px;
      transition: 0.3s;
    }

    .btn-back:hover {
      background-color: #546e7a;
    }

    /* Responsive Improvement */
    @media (max-width: 480px) {
      .login-box {
        padding: 30px 20px;
      }
    }
  </style>
</head>
<body>

<div class="login-box">
  <h2>Login</h2>
  <form method="POST" action="proses_login.php">
    <div class="form-group">
      <label>Username</label>
      <input type="text" name="username" required>
    </div>

    <div class="form-group">
      <label>Password</label>
      <input type="password" name="password" required>
    </div>

    <button type="submit" class="btn">Login</button>
    <a href="../index.php" class="btn-back">Kembali</a>
  </form>
</div>

</body>
</html>
