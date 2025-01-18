<html>

<head>
    <title>Detail Tabungan Siswa</title>
    <link rel="stylesheet" href="assets/css/table.css" />
</head>

<body>
    <h2>Detail Tabungan Siswa</h2>
    <?php
    include "config.php";

    $conn = new mysqli("localhost", "root", "", "tkdata");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $id_murid = $_GET['id_murid'];

    // Retrieve the Nama and Username from the database
    $sql_nama = "SELECT nama, username FROM tabungan WHERE id_murid = '$id_murid' LIMIT 1";
    $result_nama = $conn->query($sql_nama);
    $row_nama = $result_nama->fetch_assoc();
    $nama = $row_nama['nama'];
    $username = $row_nama['username'];

    // Modified query to group identical records and count them
    $sql = "SELECT tgl, kelas, ket, nominal, COUNT(*) as count 
            FROM tabungan 
            WHERE id_murid = '$id_murid' 
            GROUP BY tgl, kelas, ket, nominal 
            ORDER BY tgl ASC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    ?>
        <p>ID: <?php echo $id_murid; ?></p>
        <p>Nama: <?php echo $nama; ?></p>
        <p>Username: <?php echo $username; ?></p>
        <div class="table-wrapper">
            <table class="fl-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Kelas</th>
                        <th>Keterangan</th>
                        <th>Nominal</th>
                        <th>Total Nominal</th>
                        <th>Saldo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $balance = 0;

                    while ($row = $result->fetch_assoc()) {
                        $total_nominal = $row['nominal'] * $row['count'];

                        if ($row["ket"] == "Setoran") {
                            $balance += $total_nominal;
                        } elseif ($row["ket"] == "Penarikan") {
                            $balance -= $total_nominal;
                        }
                    ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row['tgl']; ?></td>
                            <td><?php echo $row['kelas']; ?></td>
                            <td><?php echo $row['ket']; ?></td>
                            <td><?php echo number_format($row['nominal'], 0, ',', '.'); ?></td>
                            <td><?php echo number_format($total_nominal, 0, ',', '.'); ?></td>
                            <td><?php echo number_format($balance, 0, ',', '.'); ?></td>
                        </tr>
                    <?php
                        $i++;
                    }
                    ?>
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