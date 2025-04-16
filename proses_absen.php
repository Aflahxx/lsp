<?php
include '../config/koneksi.php';

$user_id = $_SESSION['user_id'];
$tanggal = $_POST['tanggal'];
$status = $_POST['status'];

mysqli_query($conn, "INSERT INTO absensi (user_id, tanggal, status) VALUES ('$user_id', '$tanggal', '$status')");
header("Location: dashboard.php");
?>
