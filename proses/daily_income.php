<?php
include 'config.php';

// Get the current month and year
$month = date("m");
$year = date("Y");

// Query to get the total nominal for the current month
$sql = "SELECT id_murid, nominal, ket FROM tabungan WHERE MONTH(tgl) = '$month' AND YEAR(tgl) = '$year' AND ket = 'Setoran'";
$result_setoran = mysqli_query($conn, $sql);

// Inisialisasi variabel
$total_tabungan = 0;

// Loop through each transaction
while ($row = mysqli_fetch_assoc($result_setoran)) {
    $total_tabungan += $row["nominal"]; // Add deposit amount
}

// Query to get the total penarikan for the current month
$sql = "SELECT id_murid, nominal, ket FROM tabungan WHERE MONTH(tgl) = '$month' AND YEAR(tgl) = '$year' AND ket = 'Penarikan'";
$result_penarikan = mysqli_query($conn, $sql);

// Inisialisasi variabel
$total_penarikan = 0;

// Loop through each transaction
while ($row = mysqli_fetch_assoc($result_penarikan)) {
    $total_penarikan += $row["nominal"]; // Add withdrawal amount
}

// Calculate the total tabungan minus the total penarikan
$total_nominal = $total_tabungan - $total_penarikan;

// Format the total nominal to Indonesian Rupiah
$total_nominal_current = "Rp. " . number_format($total_nominal, 0, ',', '.');

// Display the total nominal for the current month
echo "" . $total_nominal_current;
