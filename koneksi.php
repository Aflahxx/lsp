<?php
$conn = mysqli_connect("localhost", "root", "", "daftar_hadir");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
session_start(); // penting untuk login
?>