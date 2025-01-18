<?php
include '../../config.php';
session_start();
$foto_profil = $foto_profil ?? "default.jpg"; // Nilai default jika $foto_profil tidak terdefinisi

// Call session profile
$_SESSION['foto_profil'] = $foto_profil;

$foto_profil_name = '';
$query = "SELECT foto_profil FROM guru WHERE username = '" . $_SESSION['username'] . "'";
$result = mysqli_query($conn, $query);
if ($result) {
  $row = mysqli_fetch_assoc($result);
  $foto_profil_name = $row['foto_profil'] ?? 'default.jpg';
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $nama = $_POST["nama"];
  $kelas = $_POST["kelas"];
  $alamat = $_POST["alamat"];
  $notlp = $_POST["notlp"];
  $jk = $_POST["jk"];
  $pw = $_POST["pw"];

  // Prepare and execute the insert into tb_murid
  $sql = "INSERT INTO tb_murid (username, nama, kelas, alamat, notlp, jk, pw) VALUES (?, ?, ?, ?, ?, ?, ?)";
  $stmt2 = $conn->prepare($sql);
  $stmt2->bind_param("sssssss", $username, $nama, $kelas, $alamat, $notlp, $jk, $pw);

  if ($stmt2->execute()) {
    $id_murid = $conn->insert_id; // Get the last inserted id
    echo "New murid ID: " . $id_murid; // Debugging output
    echo "<script>alert('Pendaftaran Berhasil, Klik Untuk Kembali'); window.location.href = 'form.php';</script>";
  } else {
    echo "Error inserting into tb_murid: " . $stmt2->error; // Debugging output
  }

  $stmt2->close();
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Corona Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css" />
  <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css" />
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="../../assets/vendors/select2/select2.min.css" />
  <link rel="stylesheet" href="../../assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css" />
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="../../assets/css/style.css" />
  <!-- End layout styles -->
  <link rel="shortcut icon" href="../../assets/images/favicon.png" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.10/dist/sweetalert2.all.min.js"></script>
</head>

<body>
  <<div class="container-scroller">
    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <a class="sidebar-brand brand-logo" href="beranda.php"><img src="../../assets/images/logo2.svg" alt="logo" /></a>
        <a class="sidebar-brand brand-logo" href="beranda.php"><img src="../../assets/images/logoTK.png" style="height: 50px; width: 50px;" alt="logo" /></a>
        <a class="sidebar-brand brand-logo-mini" href="beranda.php"><img src="../../assets/images/logoTK.png" style="height: 50px; width: 50px;" alt="logo" /></a>
      </div>
      <ul class="nav">
        <li class="nav-item profile">
          <div class="profile-desc">
            <div class="profile-pic">
              <div class="count-indicator">
                <img class="img-xs rounded-circle" src="../../profile/<?php echo $foto_profil_name; ?>" alt="" />
                <span class=" count bg-success"></span>
              </div>
              <div class="profile-name">
                <h5 class="mb-0 font-weight-normal"><?= $_SESSION['username'] ?></h5>
              </div>
            </div>
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
          <a class="nav-link" href="../../beranda.php">
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
        <li class="nav-item menu-items">
          <a class="nav-link" href="form.php">
            <span class="menu-icon">
              <i class="mdi mdi-playlist-play"></i>
            </span>
            <span class="menu-title">Register</span>
          </a>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link " data-toggle="collapse" href="#auth">
            <span class="menu-icon">
              <i class="mdi mdi-table-large"></i>
            </span>
            <span class="menu-title">Tables</span>
          </a>
        </li>

        <div class="collapse" id="auth">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item">
              <a class="nav-link" href="../tables/tables_murid.php">
                Table Murid
              </a>
            </li>
            <li class=" nav-item">
              <a class="nav-link" href="../tables/tables_tabungan.php">
                Table Tabungan
              </a>
            </li>
          </ul>
        </div>
        </li>

        <li class="nav-item menu-items">
          <!-- <a class="nav-link" href="pages/forms/inserttabungan.php">
            <span class="menu-icon">
              <i class="mdi mdi-file-document-box"></i>
            </span>
            <span class="menu-title">Tambahkan</span>
          </a>-->
        </li>
      </ul>

    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar p-0 fixed-top d-flex flex-row">
        <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
          <a class="navbar-brand brand-logo-mini" href="index.html"><img src="assets/images/logo-mini.svg" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <!---<ul class="navbar-nav w-100">
              <li class="nav-item w-100">
                <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search">
                  <input
                    type="text"
                    class="form-control"
                    placeholder="Search products" />
                </form>
              </li>
            </ul>-->
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item dropdown d-none d-lg-block">

            <li class="nav-item dropdown">
              <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
                <div class="navbar-profile">
                  <img class="img-xs rounded-circle" src="../../profile/<?php echo $foto_profil_name; ?>" alt="" />
                  <p class="mb-0 d-none d-sm-block navbar-profile-name">
                    <?= $_SESSION['username'] ?>
                  </p>
                  </p>
                  <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
                <h6 class="p-3 mb-0">Profile</h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item" href="../../setting.php">
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
          <div class="page-header">
            <h3 class="page-title">Form Rigister</h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Forms</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                  Form Rigister
                </li>
              </ol>
            </nav>
          </div>
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Form murid</h4>
                  <p class="card-description">Daftarkan murid</p>
                  <form action="form.php" method="post">

                    <div class="form-group">
                      <label for="username">Username</label>
                      <input type="text" class="form-control" id="username" name="username" placeholder="Username" />
                    </div>
                    <div class="form-group">
                      <label for="nama">Nama</label>
                      <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" />
                    </div>
                    <div class="form-group">
                      <label for="kelas">Kelas</label>
                      <input type="text" class="form-control" id="kelas" name="kelas" placeholder="Kelas" />
                    </div>
                    <div class="form-group">
                      <label for="alamat">Alamat</label>
                      <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" />
                    </div>

                    <div class="form-group">
                      <label for="notlp">No. Telepon</label>
                      <input type="tel" class="form-control" id="notlp" name="notlp" placeholder="No. Telepon" />
                    </div>
                    <div class="form-group">
                      <label for="jk">Jenis Kelamin</label>
                      <select class="form-control" id="jk" name="jk">
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                      </select>
                    </div>
                    <div class="form-group row">
                      <label for="pw" class="col-sm-3 col-form-label" id="pw">Password</label>
                      <div class="col-sm-9">
                        <input type="password" class="form-control" id="pw" name="pw" placeholder="Password" />
                      </div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary mr-2">
                      Submit
                    </button>
                    <button class="btn btn-dark">Cancel</button>

                  </form>
                </div>
              </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Form Admin/Guru</h4>
                  <p class="card-description">Daftarkan Admin/Guru</p>
                  <form class="forms-sample" action="../../proses/input_guru.php" method="post">


                    <input type="hidden" name="roles" value="guru" />
                    <div class="form-group row">
                      <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" />
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="username" class="col-sm-3 col-form-label">Username</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" />
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" />
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="jk" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                      <div class="col-sm-9">
                        <select class="form-control" id="jk" name="jk">
                          <option value="">-- Pilih Jenis Kelamin --</option>
                          <option value="Laki-laki">Laki-laki</option>
                          <option value="Perempuan">Perempuan</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="pw" class="col-sm-3 col-form-label" id="pw">Password</label>
                      <div class="col-sm-9">
                        <input type="password" class="form-control" id="pw" name="pw" placeholder="Password" />
                      </div>
                    </div>

                    <button type="submit" class="btn btn-primary mr-2">
                      Submit
                    </button>
                    <button class="btn btn-dark">Cancel</button>
                  </form>
                </div>
              </div>
            </div>

          </div>
          <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
      </div>
      <!-- container-scroller -->
      <!-- plugins:js -->
      <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
      <!-- endinject -->
      <!-- Plugin js for this page -->
      <script src="../../assets/vendors/select2/select2.min.js"></script>
      <script src="../../assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>
      <!-- End plugin js for this page -->
      <!-- inject:js -->
      <script src="../../assets/js/off-canvas.js"></script>
      <script src="../../assets/js/hoverable-collapse.js"></script>
      <script src="../../assets/js/misc.js"></script>
      <script src="../../assets/js/settings.js"></script>
      <script src="../../assets/js/todolist.js"></script>
      <!-- endinject -->
      <!-- Custom js for this page -->
      <script src="../../assets/js/file-upload.js"></script>
      <script src="../../assets/js/typeahead.js"></script>
      <script src="../../assets/js/select2.js"></script>
      <!-- End custom js for this page -->
</body>

<script>
  //Logout Script
  function confirmLogout() {
    var confirmMessage = "Are you sure you want to log out?";
    if (confirm(confirmMessage)) {
      var timeout = 3; // seconds
      var countdown = setTimeout(function() {
        window.location.href = '../../proses/logout.php';
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