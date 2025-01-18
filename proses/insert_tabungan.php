<?php
include "../config.php";

$conn = new mysqli("localhost", "root", "", "tkdata");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$nama = $_POST['nama'];
$kelas = $_POST['kelas'];
$ket = $_POST['ket'];
$tgl = $_POST['tgl'];
$nominal = $_POST['nominal'];
$saldo = $_POST['saldo'];

$sql = "INSERT INTO tabungan (username, nama, kelas, ket, tgl, nominal, saldo) VALUES (?,?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssdd", $username, $nama, $kelas, $ket, $tgl, $nominal, $saldo);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo '<script>window.location.href = "../pages/tables/tables_tabungan.php?notif=success";</script>';
} else {
    echo "Error inserting data: " . $stmt->error;
}
$stmt->close();
$conn->close();
