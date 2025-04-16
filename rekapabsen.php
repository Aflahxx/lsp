<?php
include '../config/koneksi.php';

$data = mysqli_query($conn, "
    SELECT a.*, u.nama 
    FROM absensi a 
    JOIN users u ON a.user_id = u.id 
    ORDER BY tanggal DESC
");

while ($row = mysqli_fetch_assoc($data)) {
    echo $row['tanggal'] . " - " . $row['nama'] . " - " . $row['status'] . "<br>";
}
?>
