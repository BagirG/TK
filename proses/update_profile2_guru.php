<?php
// config.php is assumed to have the database connection settings
include "../config.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the posted values
    $username = $_POST["username"];
    $nama = $_POST["nama"];
    $tgl_lahir = $_POST["tgl_lahir"];
    $alamat = $_POST["alamat"];
    $notlp = $_POST["notlp"];
    $jk = $_POST["jk"];
    $foto_profil = $_FILES['foto_profil'];
    $pw = $_POST["pw"];


    // Ambil id_guru dan foto_profil yang sudah ada dari database
    $query = "SELECT id_guru, foto_profil FROM guru WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $id = $row['id_guru'];
    $existing_foto_profil = $row['foto_profil']; // Foto profil yang sudah ada

    // Proses upload file jika ada file baru yang diunggah
    if ($_FILES['foto_profil']['error'] === 0) {
        $foto_profil_tmp = $_FILES["foto_profil"]["tmp_name"];
        $foto_profil_name = $_FILES["foto_profil"]["name"];
        $foto_profil_size = $_FILES["foto_profil"]["size"];
        $foto_profil_type = $_FILES["foto_profil"]["type"];
        $foto_profil_error = $_FILES["foto_profil"]["error"];

        // Cek apakah file adalah gambar
        if (preg_match("/(jpg|jpeg|png|gif)/", $foto_profil_name)) {
            $foto_profil_destination = "../assets/images/profile/guru/" . $foto_profil_name;
            if (move_uploaded_file($foto_profil_tmp, $foto_profil_destination)) {
                $foto_profil_path = "../assets/images/profile/guru/" . $foto_profil_name;
                echo "File uploaded successfully.";
            } else {
                echo "Error uploading file.";
                die();
            }
        } else {
            echo "File is not an image.";
            die();
        }
    } else {
        // Jika tidak ada file yang diunggah, gunakan foto profil yang sudah ada
        $foto_profil_path = $existing_foto_profil;
    }
    // Get the id value from the database
    // Get the id value from the database
    $query = "SELECT id_guru FROM guru WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $id = $row['id_guru']; // Corrected from 'id' to 'id_guru'

    // Update the user data
    echo "Updating user data: \n";
    echo "Username: $username\n";
    echo "Nama: $nama\n";
    echo "Tgl_lahir: $tgl_lahir\n";
    echo "Alamat: $alamat\n";
    echo "Notlp: $notlp\n";
    echo "Jk: $jk\n";
    echo "Foto_profil: $foto_profil_path\n";
    echo "Pw: $pw\n";
    echo "Id: $id\n"; // Now this will show the correct ID

    // Update the user data
    $query = "UPDATE guru SET username = ?, nama = ?, tgl_lahir = ?, alamat = ?, notlp = ?, jk = ?, foto_profil = ?, pw = ? WHERE id_guru = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssssssi", $username, $nama, $tgl_lahir, $alamat, $notlp, $jk, $foto_profil_path, $pw, $id);
    if (!$stmt->execute()) {
        echo "Error executing query: " . $stmt->error;
        die();
    } else {
        echo "Query executed successfully!\n";
        echo "Affected rows: " . $stmt->affected_rows . "\n";
    }

    if ($stmt->affected_rows > 0) {
        echo "<script>alert('Update Profile Berhasil!');</script>";
        echo "<script>window.location.href='../beranda.php';</script>";
    } else {
        echo "<script>alert('Update Profile Gagal!');</script>";
        echo "<script>window.location.href='../setting.php';</script>";
    }
    // Check if the values have changed
    $query = "SELECT * FROM guru WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        echo "Existing data:\n";
        print_r($row);
        echo "New data:\n";
        echo "Nama: $nama\n";
        echo "Tgl_lahir: $tgl_lahir\n";
        echo "Alamat: $alamat\n";
        echo "Notlp: $notlp\n";
        echo "Jk: $jk\n";
        echo "Foto_profil: $foto_profil_path\n";
        echo "Pw: $pw\n";

        if ($row["nama"] == $nama && $row["tgl_lahir"] == $tgl_lahir && $row["alamat"] == $alamat && $row["notlp"] == $notlp && $row["jk"] == $jk && $row["foto_profil"] == $foto_profil_path && $row["pw"] == $pw) {
            echo "No changes detected.";
        } else {
            echo "Changes detected, but not updated.";
        }
    } else {
        echo "User not found.";
    }
}

echo '<script>window.location.href = "../beranda.php?notif=success";</script>';
