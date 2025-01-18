<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style2.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">


    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Saira:wght@500;600;700&display=swap" />

    <title>Daftar - Tabungan Siswa</title>
</head>

<body>

    <div class="mt-4 flex flex-col bg-gray-100 rounded-lg p-4 shadow-sm">
        <h2 class="text-black font-bold text-lg">Edit Tabungan</h2>
        <?php
        include "../config.php";

        $id_murid = $_GET['id_murid'];
        $tgl = $_GET['tgl'];

        $conn = new mysqli("localhost", "root", "", "tkdata");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM tabungan WHERE id_murid = ? AND tgl = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $id_murid, $tgl);
        $stmt->execute();
        $result = $stmt->get_result();
        $nomor = 1;

        $data = $result->fetch_assoc(); // fetch only one row

        if ($data) { // check if data is not empty
        ?>
            <form action="update_tabungan.php" method="post">
                <input type="hidden" name="id_murid" value="<?php echo $data['id_murid']; ?>">
                <input type="hidden" name="username" value="<?php echo $data['username']; ?>">

                <div class="mt-4">
                    <label class="text-black" for="nama">Nama</label>
                    <input placeholder="" class="w-full bg-white rounded-md border-gray-300 text-black px-2 py-1" type="text" id="nama" name="nama" value="<?php echo $data['nama']; ?>">
                </div>

                <div class="mt-4">
                    <label class="text-black" for="kelas">Kelas</label>
                    <input placeholder="" class="w-full bg-white rounded-md border-gray-300 text-black px-2 py-1" id="kelas" name="kelas" value="<?php echo $data['kelas']; ?>">
                </div>

                <div class="mt-4 flex flex-row space-x-2">
                    <div class="flex-1">
                        <label class="text-black" for="ket">Keterangan</label>
                        <select class="w-full bg-white rounded-md border-gray-300 text-black px-2 py-1" id="ket" name="ket">
                            <option value="0">Pilih Keterangan</option>
                            <option value="Setoran" <?php echo ($data['ket'] == 'Setoran') ? 'selected' : ''; ?>>Setoran</option>
                            <option value="Penarikan" <?php echo ($data['ket'] == 'Penarikan') ? 'selected' : ''; ?>>Penarikan</option>
                        </select>
                    </div>
                </div>

                <div class="flex-1">
                    <label class="text-black" for="tgl">Tanggal</label>
                    <input placeholder="" class="w-full bg-white rounded-md border-gray-300 text-black px-2 py-1" id="tgl" type="datetime-local" name="tgl" value="<?php echo $data['tgl']; ?>">
                </div>

                <div class="mt-4 flex flex-row space-x-2">
                    <div class="flex-1">
                        <label class="text-black" for="nominal">Nominal</label>
                        <input placeholder="" class="w-full bg-white rounded-md border-gray-300 text-black px-2 py-1" id="nominal" type="text" name="nominal" value="<?php echo $data['nominal']; ?>">
                    </div>

                    <div class="mt-4 flex justify-end">
                        <button class="bg-blue-500 text-white rounded-md px-4 py-1 hover:bg-blue-700 hover:text-white" type="submit">Submit</button>
                    </div>
            </form>
        <?php
        }
        $conn->close();
        ?>
    </div>


</body>


</html>