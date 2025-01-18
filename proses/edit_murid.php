<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style2.css">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Saira:wght@500;600;700&display=swap" />

    <title>Daftar - Tabungan Siswa</title>
</head>

<body>


    <div class="login-box">
        <p>Update Data Murid</p>
        <?php
        include "../config.php";

        $id_murid = $_GET['id_murid'] ?? null;
        $conn = new mysqli("localhost", "root", "", "tkdata");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM tb_murid WHERE id_murid=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_murid);
        $stmt->execute();
        $result = $stmt->get_result();

        $nomor = 1;
        while ($data = $result->fetch_assoc()) {
        ?>
            <form action="update_murid.php" method="post">

                <input required type="hidden" class="input" name="id_murid" value="<?php echo $data['id_murid']; ?>" placeholder="id Murid" id="id_murid" autocomplete="off">
                <div class="user-box">
                    <input type="text" class="input" name="nama" value="<?php echo $data['nama']; ?>" placeholder="Nama Lengkap" id="nama" autocomplete="off">
                    <label>Email</label>
                </div>
                <div class="user-box">
                    <input type="text" class="input" name="kelas" value="<?php echo $data['kelas']; ?>" placeholder="Kelas" id="kelas" autocomplete="off">
                    <label>Kelas</label>
                </div>
                <div class="user-box">
                    <input type="text" class="input" name="alamat" value="<?php echo $data['alamat']; ?>" placeholder="Alamat" id="alamat" autocomplete="off">
                    <label>Alamat</label>
                </div>
                <div class="user-box">
                    <input type="text" class="input" name="notlp" value="<?php echo $data['notlp']; ?>" placeholder="No. Telepon" id="notlp" autocomplete="off">
                    <label>No. Telepon</label>
                </div>
                <div class="user-box">
                    <label>Jenis Kelamin</label>
                    <br> <br>

                    <select name="jk" id="jk">
                        <option value="<?php echo $data['jk']; ?>"><?php echo $data['jk']; ?></option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                    <br>
                    <br>
                    <div style="display: flex; justify-content: center; align-items: center;">
                        <button class="btn-53" type="submit" value="update">
                            <div class="original">Update</div>
                            <div class="letters">

                                <span>U</span>
                                <span>P</span>
                                <span>D</span>
                                <span>A</span>
                                <span>T</span>
                                <span>E</span>
                            </div>
                        </button>
                    </div>
            </form>
        <?php
        }
        $conn->close();
        ?>
    </div>

</body>


</html>