<?php
include 'config.php';
$sql = "SELECT COUNT(*) as total_murid FROM tb_murid";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$total_murid = $row["total_murid"];
?>

<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
    <circle cx="12" cy="7" r="4"></circle>
</svg> <?php echo $total_murid; ?>