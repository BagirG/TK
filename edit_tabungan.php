<?php
include '../../config.php';

// Check if the form has been submitted
function updateUserInformationInDatabase($id_murid, $post_data)
{
    $conn = new mysqli("localhost", "root", "", "tkdata");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE tb_murid SET ";
    foreach ($post_data as $key => $value) {
        $sql .= "$key = '$value', ";
    }
    $sql = rtrim($sql, ', ') . " WHERE id_murid = '$id_murid'";
    $conn->query($sql);

    if (!$conn->query($sql)) {
        die("Update failed: " . $conn->error);
    }

    $conn->close();
}
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Saira:wght@500;600;700&display=swap" />

    <title>Daftar - Tabungan Siswa</title>
</head>

<body>

    <div class="box-input">
        <div class="card">
            <div class="card2">
                <form class="form">
                    <p id="heading">Edit Profile</p>
                    <input type="hidden" name="id_murid" value="<?php echo $id_murid; ?>">
                    <input type="hidden" name="id_murid" value="<?php echo $username; ?>">

                    <div class="field">
                        <input required type="number" class="input" name="id_tabungan" value="<?php echo $user_data['id_murid']; ?>" placeholder="id Tabungan" id="id_murid" autocomplete="off">
                    </div>
                    <div class="field">
                        <input required type="text" class="input" name="nama" value="<?php echo $user_data['nama']; ?>" placeholder="Nama Lengkap" id="nama" autocomplete="off">
                    </div>

                    <!-- ... -->

                    <div class="btn">
                        <button class="button1" type="submit" value="update">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Update&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>


</html>