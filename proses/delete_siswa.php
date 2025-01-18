<?php
include '../config.php';

if (isset($_POST['ids'])) {
    $ids = explode(',', $_POST['ids']);
    $ids_array = array_map('intval', $ids); // Convert IDs to integers

    // SQL query to delete the records
    $stmt = $conn->prepare("DELETE FROM tb_murid WHERE id_murid IN (" . implode(',', array_fill(0, count($ids_array), '?')) . ")");
    $stmt->bind_param(str_repeat('i', count($ids_array)), ...$ids_array);

    // Execute the query
    if ($stmt->execute() === TRUE) {
        echo "Data Telah Dihapus Silahkan Tutup Tab ini";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Error: No IDs provided. Please provide the IDs to delete.";
}

// Close the connection
$conn->close();

exit;
