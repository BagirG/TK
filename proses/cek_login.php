<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Check if username and password are not empty
    if (empty($username) || empty($password)) {
        $error = 'Please enter both username and password';
    } else {
        // Query to check if the username and password are valid
        $sql = "SELECT * FROM admins WHERE username = ? AND password = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if the username and password are valid
        if ($result->num_rows > 0) {
            // Login successful, redirect to dashboard or other page
            header('Location: beranda.php');
            exit;
        } else {
            // Login failed, display error message
            $error = 'Invalid username or password';
        }
    }
}
?>