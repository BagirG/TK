<?php
// Create connection
$conn = new mysqli("localhost", "root", "", "tkdata");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from tb_tabungan table
$sql = "SELECT * FROM tb_tabungan";
$result = $conn->query($sql);

// Check if data is retrieved successfully
if (!$result) {
    die("Query failed: " . $conn->error);
}
