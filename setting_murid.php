<?php
// Start the session
session_start();
$foto_profil = $foto_profil ?? "default.jpg"; // Nilai default jika $foto_profil tidak terdefinisi

// Include config file
include 'config.php';


/// Check if the username is set in the session
if (isset($_SESSION['username'])) {

  $user_sql = "SELECT * FROM tb_murid WHERE username = ?";
  $stmt = $conn->prepare($user_sql);
  $stmt->bind_param("s", $_SESSION['username']);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $profile_text = $user['username']; // Get the username from the $user array
  }
}
// Check if the username is set in the role



// call season profil
$_SESSION['foto_profil'] = $foto_profil;

$foto_profil_name = '';
$query = "SELECT foto_profil FROM tb_murid WHERE username = '" . $_SESSION['username'] . "'";
$result = mysqli_query($conn, $query);
if ($result) {
  $row = mysqli_fetch_assoc($result);
  $foto_profil_name = $row['foto_profil'] ?? 'default.jpg';
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>TK Azhar Azka</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css" />
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css" />
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css" />
  <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css" />
  <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.carousel.min.css" />
  <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.theme.default.min.css" />
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="assets/css/style.css" />
  <!-- End layout styles -->
  <link rel="shortcut icon" href="assets/images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <a class="sidebar-brand brand-logo" href="beranda_murid.php"><img src="assets/images/logo2.svg" alt="logo" /></a>
        <a class="sidebar-brand brand-logo" href="beranda_murid.php"><img src="assets/images/logoTK.png" style="height: 50px; width: 50px;" alt="logo" /></a>
        <a class="sidebar-brand brand-logo-mini" href="beranda_murid.php"><img src="assets/images/logoTK.png" style="height: 50px; width: 50px;" alt="logo" /></a>
      </div>
      <ul class="nav">
        <li class="nav-item profile">
          <div class="profile-desc">
            <div class="profile-pic">
              <div class="count-indicator">
                <img class="img-xs rounded-circle" src="profile/<?php echo $foto_profil_name; ?>" alt="" />
                <span class="count bg-success"></span>
              </div>
              <div class="profile-name">
                <h5 class="mb-0 font-weight-normal"><?= $_SESSION['username'] ?></h5>
              </div>
            </div>
            <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
            <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
              <a href="#" class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-dark rounded-circle">
                    <i class="mdi mdi-settings text-primary"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <p class="preview-subject ellipsis mb-1 text-small">
                    Account settings
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-dark rounded-circle">
                    <i class="mdi mdi-onepassword text-info"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <p class="preview-subject ellipsis mb-1 text-small">
                    Change Password
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-dark rounded-circle">
                    <i class="mdi mdi-calendar-today text-success"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <p class="preview-subject ellipsis mb-1 text-small">
                    To-do list
                  </p>
                </div>
              </a>
            </div>
          </div>
        </li>
        <li class="nav-item nav-category">
          <span class="nav-link">Navigation</span>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" href="beranda_murid.php">
            <span class="menu-icon">
              <i class="mdi mdi-speedometer"></i>
            </span>
            <span class="menu-title">Dashboard</span>
          </a>
        </li>
        <!--<li class="nav-item menu-items">
            <a
              class="nav-link"
              data-toggle="collapse"
              href="#ui-basic"
              aria-expanded="false"
              aria-controls="ui-basic">
              <span class="menu-icon">
                <i class="mdi mdi-laptop"></i>
              </span>
              <span class="menu-title">Basic UI Elements</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="pages/ui-features/buttons.html"
                    >Buttons</a
                  >
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="pages/ui-features/dropdowns.html"
                    >Dropdowns</a
                  >
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="pages/ui-features/typography.html"
                    >Typography</a
                  >
                </li>
              </ul>
            </div>
          </li>-->

    </nav>

    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar p-0 fixed-top d-flex flex-row">
        <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
          <a class="navbar-brand brand-logo-mini" href="../../beranda.php"><img src="../assets/images/logo-mini.svg" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item dropdown d-none d-lg-block">
            <li class="nav-item dropdown">
              <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
                <div class="navbar-profile">
                  <img class="img-xs rounded-circle" src="profile/<?php echo $foto_profil_name; ?>" alt="" />
                  <p class="mb-0 d-none d-sm-block navbar-profile-name">
                    <?= $_SESSION['username'] ?>
                  </p>
                  <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
                <h6 class="p-3 mb-0">Profile</h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item" href="setting_murid.php">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-settings text-success"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject mb-1">Settings</p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item" href="logout.php" onclick="return confirmLogout()">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-logout text-danger"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject mb-1">Log out</p>
                  </div>
                </a>

            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-format-line-spacing"></span>
          </button>
        </div>
      </nav>

      <!-- partial -->

      <div class="main-panel">
        <div class="content-wrapper">
          <div class='card'>
            <div class='card-body'>
              <h4 class='card-title'>Edit</h4>
              <h2 class="text-2xl font-bold text-gray-200 mb-4">Data</h2>
              <?php
              include "config.php";

              $query = "SELECT * FROM tb_murid WHERE username = '" . $_SESSION['username'] . "'";
              $result = mysqli_query($conn, $query);
              if ($result) {
                $row = mysqli_fetch_assoc($result);
                if ($row !== null) {
                  $id_murid = $row['id_murid'];
                  $username = $row['username'];
                  $nama = $row['nama'];
                  $kelas = $row['kelas'];
                  $alamat = $row['alamat'];
                  $notlp = $row['notlp'];
                  $jk = $row['jk'];
                  $foto_profile = $row['foto_profil'];
                  $pw = $row['pw']; // assuming the password is stored in the database
                }
              }
              ?>
              <form class="flex flex-col" enctype="multipart/form-data" action="proses/update_profile2.php" method="post">

                <div>
                  <input type="hidden" name="id" value="<?php echo $row['id_murid']; ?>">
                </div>


                <div>
                  <label class="text-sm mb-2 text-gray-200 cursor-pointer" for="Username">
                    Username
                  </label><br>
                  <input placeholder="Username" class="bg-gray-700 text-gray-200 border-0 rounded-md p-2 mb-4 focus:bg-gray-600 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150" type="text" name="username" value="<?php echo $username; ?>" />
                </div>

                <div>
                  <label class="text-sm mb-2 text-gray-200 cursor-pointer" for="nama">
                    Nama
                  </label><br>
                  <input placeholder="Nama" class="bg-gray-700 text-gray-200 border-0 rounded-md p-2 mb-4 focus:bg-gray-600 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150" type="text" name="nama" value="<?php echo $nama; ?>" />
                </div>

                <div>
                  <label class="text-sm mb-2 text-gray-200 cursor-pointer" for="kelas">
                    Kelas
                  </label><br>
                  <input placeholder="Kelas" class="bg-gray-700 text-gray-200 border-0 rounded-md p-2 mb-4 focus:bg-gray-600 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150" type="text" name="kelas" value="<?php echo $kelas; ?>" />
                </div>

                <div>
                  <label class="text-sm mb-2 text-gray-200 cursor-pointer" for="alamat">
                    Alamat
                  </label><br>
                  <textarea placeholder="Alamat" class="bg-gray-700 text-gray-200 border-0 rounded-md p-2 mb-4 focus:bg-gray-600 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150" name="alamat"><?php echo $alamat; ?></textarea>
                </div>

                <div>
                  <label class="text-sm mb-2 text-gray-200 cursor-pointer" for="notlp">
                    No Telpon / No WA
                  </label><br>
                  <input placeholder="No. TLP" class="bg-gray-700 text-gray-200 border-0 rounded-md p-2 mb-4 focus:bg-gray-600 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150" type="tel" name="notlp" value="<?php echo $notlp; ?>" />
                </div>

                <label class="text-sm mb-2 text-gray-200 cursor-pointer" for="gender">
                  Jenis Kelamin
                </label>
                <br>
                <select class="bg-gray-700 text-gray-200 border-0 rounded-md p-2 mb-4 focus:bg-gray-600 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150" id="Jenis Kelamin" name="jk">
                  <option value="<?php echo $jk; ?>"><?php echo $jk; ?></option>
                  <option value="Laki-Laki">Laki-Laki</option>
                  <option value="Perempuan">Perempuan</option>
                </select>
                <br>


                <label class="text-sm mb-2 text-gray-200 cursor-pointer" for="photo"><br>
                  Foto Profil
                </label><br>
                <input class="bg-gray-700 text-gray-200 border-0 rounded-md p-2" id="photo" type="file" name="foto_profil" value="<?php echo $foto_profile; ?>" />
                <br>
                <br>
                <div>
                  <label class="text-sm mb-2 text-gray-200 cursor-pointer" for="pw">
                    Password
                  </label><br>
                  <input placeholder="Alamat" class="bg-gray-700 text-gray-200 border-0 rounded-md p-2 mb-4 focus:bg-gray-600 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150" name="pw" value="<?php echo $pw; ?>" />
                </div>

                <button class="bg-gradient-to-r from-indigo-500 to-blue-500 text-black font-bold py-2 px-4 rounded-md mt-4 hover:bg-indigo-600 hover:to-blue-600 transition ease-in-out duration-150" type="submit">
                  Simpan
                </button>
              </form>
              <?php

              $conn->close();
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>

  <!-- plugins:js -->
  <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="../../assets/js/off-canvas.js"></script>
  <script src="../../assets/js/hoverable-collapse.js"></script>
  <script src="../../assets/js/misc.js"></script>
  <script src="../../assets/js/settings.js"></script>
  <script src="../../assets/js/todolist.js"></script>
</body>
<script>
  //Logout Script
  function confirmLogout() {
    var confirmMessage = "Are you sure you want to log out?";
    if (confirm(confirmMessage)) {
      var timeout = 3; // seconds
      var countdown = setTimeout(function() {
        window.location.href = '../../logout.php';
      }, timeout * 1000);

      var popup = document.createElement('div');
      popup.innerHTML = 'Anda Akan Logout dalam <span id="countdown">3</span>s';
      popup.style.position = 'fixed';
      popup.style.top = '50%';
      popup.style.left = '50%';
      popup.style.transform = 'translate(-50%, -50%)';
      popup.style.background = 'black';
      popup.style.padding = '20px';
      popup.style.border = '1px solid black';
      popup.style.borderRadius = '10px';
      popup.style.boxShadow = '0 0 10px rgba(0, 0, 0, 0.5)';
      document.body.appendChild(popup);

      var count = timeout;
      var interval = setInterval(function() {
        count--;
        document.getElementById('countdown').innerHTML = count;
        if (count === 0) {
          clearInterval(interval);
        }
      }, 1000);

      setTimeout(function() {
        document.body.removeChild(popup);
      }, timeout * 1000);
    }
    return false;
  }
</script>

</html>