<?php
include '../config.php';

$id_murid = $_POST['id_murid'];
$username = $_POST['username'];
$nama = trim($_POST['nama']);
$kelas = trim($_POST['kelas']);
$ket = trim($_POST['ket']);
$tgl = trim($_POST['tgl']);
$nominal = trim($_POST['nominal']);

// Validate and sanitize input data
$nama = filter_var($nama, FILTER_SANITIZE_STRING);
$username = filter_var($username, FILTER_SANITIZE_STRING);
$kelas = filter_var($kelas, FILTER_SANITIZE_STRING);
$ket = filter_var($ket, FILTER_SANITIZE_STRING);
$tgl = filter_var($tgl, FILTER_SANITIZE_STRING);
$nominal = filter_var($nominal, FILTER_VALIDATE_FLOAT);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE tabungan SET username=?, nama=?, kelas=?, ket=?, tgl=?, nominal=? 
        WHERE id_murid=? AND tgl=?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

// Binding parameters (ensure correct types)
$stmt->bind_param("sssssdis", $username, $nama, $kelas, $ket, $tgl, $nominal, $id_murid, $tgl);

if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error);
}

if ($stmt->affected_rows > 0) {
    echo '<script>alert("Update successful!"); window.close();</script>';
} else {
    echo '<script>alert("No records were updated."); window.close();</script>';
}

$conn->close();
