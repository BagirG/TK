<?php
include 'config.php';
// Get the ID from the URL
$id_murid = $_GET['id'];

// SQL query to delete the record
$stmt = $conn->prepare("DELETE FROM tb_murid WHERE id_murid = ?");
$stmt->bind_param("i", $id_murid);

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
