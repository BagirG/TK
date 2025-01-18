<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // redirect to login page if not logged in
    exit;
}
?>
Welcome, <?php echo $_SESSION['username']; ?>!


<html>


<head>
</head>

<body>
    <a href="logout.php">Logout</a>

</body>

</html>