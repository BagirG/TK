<?php
include '../config.php';

// Get the ID and TGL from the URL
$id_murid = $_GET['id'];
$tgl = $_GET['tgl'];

// SQL query to delete the record
$stmt = $conn->prepare("DELETE FROM tabungan WHERE id_murid = ? AND tgl = ?");
$stmt->bind_param("is", $id_murid, $tgl);

// Execute the query
if ($stmt->execute() === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
exit;
