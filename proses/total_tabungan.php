<?php
include 'config.php';

// Query to retrieve all transactions
$sql = "SELECT * FROM tabungan";

$result = mysqli_query($conn, $sql);

// Initialize total tabungan dan total penarikan
$total_tabungan = 0;
$total_penarikan = 0;

// Buat array untuk menyimpan id_murid yang telah dihitung
$id_murids = array();

// Loop through each transaction
while ($row = mysqli_fetch_assoc($result)) {
    if (!in_array($row["id_murid"], $id_murids)) {
        $id_murids[] = $row["id_murid"];
        if ($row["ket"] == "Setoran") {
            $total_tabungan += $row["saldo"]; // Add deposit amount
        } elseif ($row["ket"] == "Penarikan") {
            $total_penarikan += $row["saldo"]; // Add withdrawal amount
        }
    }
}

// Calculate the total tabungan minus the total penarikan
$total_saldo = $total_tabungan - $total_penarikan;

// Format the total saldo to Indonesian Rupiah
$total_saldo_current = "Rp. " . number_format($total_saldo, 0, ',', '.');

// Display the total saldo
echo $total_saldo_current;

// Close the database connection
mysqli_close($conn);
