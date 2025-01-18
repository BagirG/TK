<?php
include '../config.php';
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"];
    $username = $_POST["username"];
    $alamat = $_POST["alamat"];
    $jk = $_POST["jk"];
    $pw = $_POST["pw"];

    $sql = "INSERT INTO guru (username, nama, alamat, jk, pw) VALUES ('$username', '$nama', '$alamat','$jk', '$pw')";

    if ($conn->query($sql) === TRUE) {
?>
        <script>
            alert("Pendaftaran Berhasil, Klik Untuk Kembali");
            window.location.href = "../pages/forms/form.php"; // Redirect to login page
        </script>
<?php
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
