<?php
include '../config.php';

$id_murid = $_POST['id_murid'];
$nama = $_POST['nama'];
$kelas = $_POST['kelas'];
$alamat = $_POST['alamat'];
$notlp = $_POST['notlp'];
$jk = $_POST['jk'];

// Validate and sanitize input data
$nama = filter_var($nama, FILTER_SANITIZE_STRING);
$kelas = filter_var($kelas, FILTER_SANITIZE_STRING);
$alamat = filter_var($alamat, FILTER_SANITIZE_STRING);
$notlp = filter_var($notlp, FILTER_SANITIZE_STRING);
$jk = filter_var($jk, FILTER_SANITIZE_STRING);

$conn = new mysqli("localhost", "root", "", "tkdata");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE tb_murid SET nama=?, kelas=?, alamat=?, notlp=?, jk=? WHERE id_murid=?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("sssssi", $nama, $kelas, $alamat, $notlp, $jk, $id_murid);
if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error);
}

echo '<script>alert("Update successful!"); window.close();</script>';
$conn->close();
