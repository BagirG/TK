<?php
include '../config.php';

// Initialize variables
$username = $_POST['username'];
$nama = $_POST['nama'];
$kelas = $_POST['kelas'];
$alamat = $_POST['alamat'];
$notlp = $_POST['notlp'];
$jk = $_POST['jk'];
$pw = $_POST['pw'];
$foto_profil = $_FILES['foto_profil'];
$id = $_POST['id']; // Assuming the ID is passed in the form

// Validate and sanitize input data
$username = filter_var($username, FILTER_SANITIZE_STRING);
$nama = filter_var($nama, FILTER_SANITIZE_STRING);
$kelas = filter_var($kelas, FILTER_SANITIZE_STRING);
$alamat = filter_var($alamat, FILTER_SANITIZE_STRING);
$notlp = filter_var($notlp, FILTER_SANITIZE_STRING);
$jk = filter_var($jk, FILTER_SANITIZE_STRING);
$pw = filter_var($pw, FILTER_SANITIZE_STRING);

// Handle file upload
$foto_profil_name = $foto_profil['name'];
$foto_profil_tmp_name = $foto_profil['tmp_name'];
$foto_profil_size = $foto_profil['size'];
$foto_profil_error = $foto_profil['error'];
$foto_profil_type = $foto_profil['type'];

// Check if file is uploaded
if ($foto_profil_error === 0) {
    // Check if file is an image
    if (preg_match("/(jpg|jpeg|png|gif)/", $foto_profil_name)) {
        // Upload file to server
        $foto_profil_destination = "../assets/images/profile/" . $foto_profil_name;
        if (move_uploaded_file($foto_profil_tmp_name, $foto_profil_destination)) {
            echo "File uploaded successfully.";
        } else {
            echo "Error uploading file.";
            die(); // Stop execution if file upload fails
        }
    } else {
        echo "File is not an image.";
        die(); // Stop execution if file is not an image
    }
} else {
    echo "Error uploading file.";
    die(); // Stop execution if file upload fails
}

// Connect to database
$conn = new mysqli("localhost", "root", "", "tkdata");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare SQL query
$sql = "UPDATE users SET username=?, nama=?, kelas=?, alamat=?, notlp=?, jk=?, foto_profil=?, pw=? WHERE id=?";
$stmt = $conn->prepare($sql);

// Check if prepare failed
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

// Bind parameters
$stmt->bind_param("ssssssssi", $username, $nama, $kelas, $alamat, $notlp, $jk, $foto_profil_destination, $pw, $id);

// Execute query
if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error);
} else {
    echo "Update successful!";
}

// Close statement and connection
$stmt->close();
$conn->close();

// Redirect to success page
echo '<script>window.location.href = "../beranda.php?notif=success";</script>';
