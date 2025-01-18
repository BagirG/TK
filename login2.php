<?php
require_once 'config.php';


// Register user
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = $_POST["id"];
  $nama = $_POST["nama"];
  $username = $_POST["username"];
  $roles = "murid"; // Set the value of $roles to "Murid"
  $pw = $_POST["password"]; // Note: You had a typo here, it should be "password" instead of "pw"

  // Hash passwor
  // Insert user into database
  $sql = "INSERT INTO users ( nama, username, roles, pw) VALUES ( '$nama', '$username', '$roles', '$pw')";
  if ($conn->query($sql) === TRUE) {
?>
    <script>
      alert("Pendaftaran Berhasil, Anda akan diarahkan Ke Login !");
      window.location.href = "login.php"; // Redirect to login page
    </script>
<?php
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

?>


<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/style.css">

  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Saira:wght@500;600;700&display=swap" />

  <title>Daftar - Tabungan Siswa</title>
</head>

<body>

  <div class="bg-dark box-input">
    <div class="bg-animation">
      <div id="stars"></div>
      <div id="stars2"></div>
      <div id="stars3"></div>
      <div id="stars4"></div>
    </div>
    <div class="card">
      <div class="card2">
        <form class=" form" action="login2.php" method="post">
          <p id="heading">Daftar</p>


          <div class="field">
            <input required type="text" class="input" name="nama" placeholder="Nama Lengkap" id="nama" autocomplete="off">
          </div>

          <div class="field">
            <input required type="text" class="input" name="username" placeholder="username" id="username" autocomplete="off">
          </div>


          <div class="field">
            <input required type="password" class="input" name="password" id="password" placeholder="Password">
          </div>

          <div class="btn">
            <button class="button1" type="submit" value="register">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Daftar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
          </div>
          <div>
            <?php if (isset($error)) {
              echo $error;
            } ?>

            <p style="text-align:center">Sudah Memilik akun? <a href="Login.php">Login</a></p>

          </div>
        </form>
      </div>
    </div>
  </div>
</body>
<script>
  // Make an AJAX request to the server to retrieve the user count
  fetch('/get-user-count.php') // Replace with your server-side script URL
    .then(response => response.json())
    .then(data => {
      const userCount = data.userCount;
      document.getElementById("id").value = userCount;
    })
    .catch(error => console.error('Error:', error));
</script>

</html>