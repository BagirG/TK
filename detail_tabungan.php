<html>

<head>
    <title>Detail Tabungan Siswa</title>
    <link rel="stylesheet" href="assets/css/table.css" />
</head>

<body>
    <h2>
        <img src="assets/images/logoTK.png" alt="Logo" style="height: 100px; vertical-align: middle;" />
        Detail Tabungan Siswa <img src="assets/images/logo-TK-Indonesia.png" alt="Logo" style="height: 100px; vertical-align: middle;" />
    </h2>
    <?php
    include "config.php";

    $conn = new mysqli("localhost", "root", "", "tkdata");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query untuk mengambil data tabungan
    $sql = "SELECT id_murid, tgl, nama, kelas, saldo
            FROM tabungan 
            GROUP BY id_murid, nama, kelas 
            ORDER BY tgl DESC";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $totalSaldo = 0; // Variabel untuk menyimpan total saldo
    ?>
        <div class="table-wrapper">
            <table class="fl-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Saldo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;

                    while ($row = $result->fetch_assoc()) {
                        $totalSaldo += $row['saldo']; // Menambahkan saldo ke totalSaldo
                    ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row['tgl']; ?></td>
                            <td><?php echo $row['nama']; ?></td>
                            <td><?php echo $row['kelas']; ?></td>
                            <td><?php echo number_format($row['saldo'], 0, ',', '.'); ?></td>
                        </tr>
                    <?php
                        $i++;
                    }
                    ?>
                    <!-- Baris untuk menampilkan total saldo -->
                    <tr>
                        <td colspan="4" style="text-align: right;"><strong>Total Saldo:</strong></td>
                        <td><strong><?php echo number_format($totalSaldo, 0, ',', '.'); ?></strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php
    } else {
        echo "No data found";
    }

    $conn->close();
    ?>
</body>

</html>