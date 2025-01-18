<?php
include '../config.php';

require  '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Connect to database
$conn = new mysqli('localhost', 'root', '', 'tkdata');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to retrieve data
$sql = "SELECT * FROM tb_murid";
$result = $conn->query($sql);

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set header row
$headers = array('No', 'ID', 'Nama', 'Kelas', 'Alamat', 'No. TLP', 'Jenis Kelamin');
$sheet->fromArray($headers, null, 'A1');

// Set data rows
$rowCount = 2;
while ($row = $result->fetch_assoc()) {
    $dataRow = array(
        $rowCount,
        $row["id_murid"],
        $row["nama"],
        $row["kelas"],
        $row["alamat"],
        $row["notlp"],
        $row["jk"]
    );
    $sheet->fromArray($dataRow, null, 'A' . $rowCount);
    $rowCount++;
}

// Set styles
$styleArray = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
    ],
];
$sheet->getStyle('A1:I' . $rowCount)->applyFromArray($styleArray);
$sheet->getColumnDimension('B')->setWidth(100);
$sheet->getStyle("A1:I1")->getFont()->setBold(true);

// Output to Excel file
$writer = new Xlsx($spreadsheet);
$filename = 'Murid Data';
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="' . $filename . '.xls"');
header('Cache-Control: max-age=0');
$writer->save('php://output');

// Close database connection
$conn->close();
