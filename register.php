<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Registrasi Akun</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background-color: #f4f6f8;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .login-box {
      background: #ffffff;
      padding: 40px;
      border-radius: 20px;
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 420px;
      transition: 0.3s ease;
    }

    .login-box:hover {
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #333;
      font-weight: 600;
      letter-spacing: 0.5px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-bottom: 8px;
      color: #555;
      font-weight: 500;
    }

    input[type="text"],
    input[type="password"],
    select {
      width: 100%;
      padding: 12px 15px;
      border: 1.5px solid #ddd;
      border-radius: 10px;
      background-color: #fafafa;
      font-size: 15px;
      transition: border-color 0.3s, background-color 0.3s;
    }

    input:focus,
    select:focus {
      border-color: #4a90e2;
      background-color: #fff;
      outline: none;
    }

    .btn {
      width: 100%;
      padding: 13px;
      background-color: #4a90e2;
      border: none;
      border-radius: 10px;
      color: white;
      font-size: 16px;
      font-weight: 500;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .btn:hover {
      background-color: #3a78c2;
    }

    /* Responsive */
    @media (max-width: 480px) {
      .login-box {
        padding: 30px 20px;
      }

      h2 {
        font-size: 22px;
      }
    }
  </style>
</head>
<body>

<div class="login-box">
  <h2>Registrasi Akun</h2>
  <form method="POST" action="proses_register.php">
    <div class="form-group">
      <label>Nama Lengkap</label>
      <input type="text" name="nama" required />
    </div>
    <div class="form-group">
      <label>Username</label>
      <input type="text" name="username" required />
    </div>
    <div class="form-group">
      <label>Password</label>
      <input type="password" name="password" required />
    </div>
    <div class="form-group">
      <label>Daftar sebagai</label>
      <select name="role" required>
        <option value="">-- Pilih Role --</option>
        <option value="siswa">Siswa</option>
        <option value="guru">Guru</option>
      </select>
    </div>
    <button type="submit" class="btn">Daftar</button>
  </form>
</div>

</body>
</html>
