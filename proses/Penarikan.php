<?php
// Connect to the database
include 'config.php';

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to retrieve all transactions
$sql = "SELECT * FROM tabungan";

$result = mysqli_query($conn, $sql);

// Initialize total expense
$total_expense = 0;

// Loop through each transaction
while ($row = mysqli_fetch_assoc($result)) {
    if ($row["ket"] == "Penarikan") {
        $total_expense += $row["nominal"]; // Add withdrawal amount
    }
}

// Format the total expense to Indonesian Rupiah
$expense_current = "Rp. " . number_format($total_expense, 0, ',', '.');

// Display the current expense
echo $expense_current;

// Close the database connection
mysqli_close($conn);
