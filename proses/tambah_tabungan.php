<?php
include '../config.php';

$id_murid = $_POST['id_murid'];
$username = $_POST['username'];
$nama = $_POST['nama'];
$kelas = $_POST['kelas'];
$ket = $_POST['ket'];
$tgl = $_POST['tgl'];
$nominal = $_POST['nominal'];

// Validate and sanitize input data
$username = filter_var($username, FILTER_SANITIZE_STRING);
$nama = filter_var($nama, FILTER_SANITIZE_STRING);
$kelas = filter_var($kelas, FILTER_SANITIZE_STRING);
$ket = filter_var($ket, FILTER_SANITIZE_STRING);
$tgl = filter_var($tgl, FILTER_SANITIZE_STRING);
$nominal = filter_var($nominal, FILTER_SANITIZE_NUMBER_INT);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get current balance
$sql_balance = "SELECT SUM(nominal) AS saldo FROM tabungan WHERE id_murid = ?";
$stmt_balance = $conn->prepare($sql_balance);
$stmt_balance->bind_param("i", $id_murid);
$stmt_balance->execute();
$result_balance = $stmt_balance->get_result();
$row_balance = $result_balance->fetch_assoc();
$saldo = $row_balance['saldo'];

// Check if balance is sufficient
if ($saldo < $nominal) {
    echo '<script>alert("Saldo tidak mencukupi!"); window.close();</script>';
    exit();
}

// Insert new transaction
$sql = "INSERT INTO tabungan (id_murid, username, nama, kelas, ket, tgl, nominal) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("isssssi", $id_murid, $username, $nama, $kelas, $ket, $tgl, $nominal);
if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error);
}
echo '<script>alert("Insert successful!"); window.close();</script>';
$conn->close();
