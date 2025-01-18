<?php
// Start the session
session_start();
$foto_profil = $foto_profil ?? "default.jpg"; // Nilai default jika $foto_profil tidak terdefinisi

// Include config file
include '../../config.php';


/// Check if the username is set in the session
if (isset($_SESSION['username'])) {

  $user_sql = "SELECT * FROM guru WHERE username = ?";
  $stmt = $conn->prepare($user_sql);
  $stmt->bind_param("s", $_SESSION['username']);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $profile_text = $user['username']; // Get the username from the $user array
  }
}

// call season profil
$_SESSION['foto_profil'] = $foto_profil;

$foto_profil_name = '';
$query = "SELECT foto_profil FROM guru WHERE username = '" . $_SESSION['username'] . "'";
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
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Corona Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="../../assets/css/style.css">

  <!-- End layout styles -->
  <link rel="shortcut icon" href="../../assets/images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
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
                <span class="count bg-success"></span>
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
          <a class="nav-link" href="../forms/form.php">
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
              <a class="nav-link" href="tables_murid.php">
                Table Murid
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="tables_tabungan.php">
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
        <!--<li class="nav-item menu-items">
          <a class="nav-link" href="../charts/chartjs.php">
            <span class="menu-icon">
              <i class="mdi mdi-chart-bar"></i>
            </span>
            <span class="menu-title">Charts</span>
          </a>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
            <span class="menu-icon">
              <i class="mdi mdi-security"></i>
            </span>
            <span class="menu-title">User Pages</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="auth">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item">
                <a class="nav-link" href="pages/samples/blank-page.html">
                  Blank Page
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="pages/samples/error-404.html">
                  404
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="pages/samples/error-500.html">
                  500
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="pages/samples/login.html">
                  Login
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="pages/samples/register.html">
                  Register
                </a>
              </li>
            </ul>
          </div>
        </li>-->
        <!--<li class="nav-item menu-items">
            <a
              class="nav-link"
              href="http://www.bootstrapdash.com/demo/corona-free/jquery/documentation/documentation.html">
              <span class="menu-icon">
                <i class="mdi mdi-file-document-box"></i>
              </span>
              <span class="menu-title">Documentation</span>
            </a>
          </li>-->
      </ul>
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
              <!---<div
                  class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                  aria-labelledby="createbuttonDropdown">
                  <h6 class="p-3 mb-0">Projects</h6>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-file-outline text-primary"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1">
                        Software Development
                      </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-web text-info"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1">
                        UI Development
                      </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-layers text-danger"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1">
                        Software Testing
                      </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <p class="p-3 mb-0 text-center">See all projects</p>
                </div>
              </li>
              <li class="nav-item nav-settings d-none d-lg-block">
                <a class="nav-link" href="#">
                  <i class="mdi mdi-view-grid"></i>
                </a>
              </li>
              <li class="nav-item dropdown border-left">
                <a
                  class="nav-link count-indicator dropdown-toggle"
                  id="messageDropdown"
                  href="#"
                  data-toggle="dropdown"
                  aria-expanded="false">
                  <i class="mdi mdi-email"></i>
                  <span class="count bg-success"></span>
                </a>
                <div
                  class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                  aria-labelledby="messageDropdown">
                  <h6 class="p-3 mb-0">Messages</h6>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <img
                        src="assets/images/faces/face4.jpg"
                        alt="image"
                        class="rounded-circle profile-pic" />
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1">
                        Mark send you a message
                      </p>
                      <p class="text-muted mb-0">1 Minutes ago</p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <img
                        src="assets/images/faces/face2.jpg"
                        alt="image"
                        class="rounded-circle profile-pic" />
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1">
                        Cregh send you a message
                      </p>
                      <p class="text-muted mb-0">15 Minutes ago</p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <img
                        src="assets/images/faces/face3.jpg"
                        alt="image"
                        class="rounded-circle profile-pic" />
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1">
                        Profile picture updated
                      </p>
                      <p class="text-muted mb-0">18 Minutes ago</p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <p class="p-3 mb-0 text-center">4 new messages</p>
                </div>
              </li>
              <li class="nav-item dropdown border-left">
                <a
                  class="nav-link count-indicator dropdown-toggle"
                  id="notificationDropdown"
                  href="#"
                  data-toggle="dropdown">
                  <i class="mdi mdi-bell"></i>
                  <span class="count bg-danger"></span>
                </a>
                <div
                  class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                  aria-labelledby="notificationDropdown">
                  <h6 class="p-3 mb-0">Notifications</h6>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-calendar text-success"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Event today</p>
                      <p class="text-muted ellipsis mb-0">
                        Just a reminder that you have an event today
                      </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-settings text-danger"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Settings</p>
                      <p class="text-muted ellipsis mb-0">Update dashboard</p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-link-variant text-warning"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Launch Admin</p>
                      <p class="text-muted ellipsis mb-0">New admin wow!</p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <p class="p-3 mb-0 text-center">See all notifications</p>
                </div>
              </li>-->
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




          <?php
          // Create connection
          $conn = new mysqli("localhost", "root", "", "tkdata");

          // Check connection
          if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }

          // Retrieve data from tb_tabungan table
          $sql = "SELECT * FROM tabungan";

          // Add month filter
          $month = isset($_GET['month']) ? $_GET['month'] : '';
          if ($month != '' && $month != '0') { // added a check for '0' to cancel filter
            $sql .= " WHERE MONTH(tgl) = '$month'";
          }

          // Add sorting by tanggal_setoran in descending order (newest first)
          $sql .= " ORDER BY tgl DESC";

          $result = $conn->query($sql);

          // Check if data is retrieved successfully
          if (!$result) {
            die("Query failed: " . $conn->error);
          }

          // Create HTML table
          echo "
<div class='row'>
<div class='col-12 grid-margin'>
<div class='card'>
<div class='card-body'>
<h4 class='card-title'>Data Tabungan</h4>
<div class='table-responsive'>
<div>
<div class='col-md-1' style='float: right;'>
<select id='rows-per-page' class='form-control'>
<option value='10'>10</option>
<option value='25'>25</option>
<option value='50'>50</option>
<option value='100'>100</option>
</select>
</div>
<div class='col-md-2' style='float: right;'>
<select id='month-filter' class='form-control'>
<option value='0'>All</option>
<option value='1'>January</option>
<option value='2'>February</option>
<option value='3'>March</option>
<option value='4'>April</option>
<option value='5'>May</option>
<option value='6'>June</option>
<option value='7'>July</option>
<option value='8'>August</option>
<option value='9'>September</option>
<option value='10'>October</option>
<option value='11'>November</option>
<option value='12'>December</option>
</select>
</div>
</div>
<input type='text' id='search-input' placeholder='Search...'>
<table class='table'>
<thead>
<tr>
<th>
<div class='form-check form-check-muted m-0'>
<label class='form-check-label'>
<input type='checkbox' class='form-check-input' />
</label>
</div>
</th>
<th>No</th>
<th>Tanggal</th>
<th>Nama</th>
<th>Kelas</th>
<th>Keterangan</th>
<th>Nominal</th>
<th>Saldo</th>
<th>Delete</th>
<th>Edit</th>
<th>Tambah</th>
<th>Detail</th>
</tr>
</thead>
<tbody id='tabungan-table-body'>";
          $no = 1;
          $balances = array();
          while ($row = $result->fetch_assoc()) {
            $id_murid = $row["id_murid"];
            if (!isset($balances[$id_murid])) {
              $balances[$id_murid] = 0;
            }

            if ($row["ket"] == "Setoran") {
              $balances[$id_murid] += $row["nominal"]; // Use nominal instead of saldo
            } elseif ($row["ket"] == "Penarikan") {
              $balances[$id_murid] -= $row["nominal"]; // Use nominal instead of saldo
            }

            // Update the Saldo column with the calculated balance
            $update_sql = "UPDATE tabungan SET saldo = '$balances[$id_murid]' WHERE id_murid = '$id_murid'";
            $conn->query($update_sql);


            echo "<tr>";
            echo "<td>";
            echo "<div class='form-check form-check-muted m-0'>";
            echo "<label class='form-check-label'>";
            echo "<input type='checkbox' class='form-check-input' />";
            echo "</label>";
            echo "</div>";
            echo "</td>";
            echo "<td>" . $no . "</td>"; // Display auto-number
            echo "<td>" . $row["tgl"] . "</td>";
            echo "<td>" . $row["nama"] . "</td>";
            echo "<td>" . $row["kelas"] . "</td>";
            echo "<td>" . $row["ket"] . "</td>";
            echo "<td>" . $row["nominal"] . "</td>";
            echo "<td>" . $balances[$id_murid] . "</td>";
            echo "<td><a href='#' onclick='return confirmDelete2(" . $row["id_murid"] . ", \"" . $row["tgl"] . "\");' class='btn btn-danger'> Delete</a></td>";
            echo "<td><a href='#' onclick='openEditForm(" . $row["id_murid"] . ", \"" . $row["tgl"] . "\");' class='btn btn-primary'>Edit</a></td>";
            echo "<td><a href='#' onclick='openEditForm3(" . $row["id_murid"] . ");' class='btn btn-info'>Tambah</a></td>";
            echo "<td><a href='#' onclick='openEditForm4(" . $row["id_murid"] . ")' class='btn btn-warning'>Detail</a></td>";
            echo "</tr>";
            $no++;
          }
          echo "</tbody>
            </table>
          </div>
          <br>
                                        <div style='float: right;'>
                                        <button class='btn btn-outline-success' onclick='exportToExcel()'>Export to Excel</button>
                                        <button class='btn btn-outline-success' onclick='exportToDetail()'>Detail Seluruh Tabungan</button>

                                      </div>
        </div>
      </div>
    </div>
  </div>
  </div>";

          // Close connection
          $conn->close();
          ?>
        </div>

      </div>
      <!-- partial -->
    </div>
    <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->

  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../../assets/js/off-canvas.js"></script>
  <script src="../../assets/js/hoverable-collapse.js"></script>
  <script src="../../assets/js/misc.js"></script>
  <script src="../../assets/js/settings.js"></script>
  <script src="../../assets/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page -->
  <!-- End custom js for this page -->
</body>
<script>
  //Seacrh
  const searchInput = document.getElementById('search-input');
  const tableBody = document.getElementById('tabungan-table-body');

  searchInput.addEventListener('input', (e) => {
    const searchTerm = e.target.value.toLowerCase();
    const rows = tableBody.rows;

    for (let i = 0; i < rows.length; i++) {
      const row = rows[i];
      const cells = row.cells;

      let match = false;
      for (let j = 0; j < cells.length; j++) {
        const cell = cells[j];
        if (cell.textContent.toLowerCase().includes(searchTerm)) {
          match = true;
          break;
        }
      }

      if (match) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    }
  });

  // Load table data from PHP script
  const loadData = async () => {
    const response = await fetch('your-php-script.php');
    const data = await response.json();

    // Loop through the data and create table rows
    tableBody.innerHTML = '';

    data.forEach((item) => {
      const row = document.createElement('tr');
      // Create table cells and add them to the row
      // ...
      tableBody.appendChild(row);
    });
  };

  loadData();

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


  //Delete warning
  function confirmDelete(id) {
    var confirmMessage = "Are you sure you want to delete?";
    if (confirm(confirmMessage)) {
      var popupWidth = 400;
      var popupHeight = 200;
      var screenWidth = screen.width;
      var screenHeight = screen.height;
      var left = (screenWidth - popupWidth) / 2;
      var top = (screenHeight - popupHeight) / 2;
      var popup = window.open('../../delete.php?id=' + id, 'Delete Confirmation', 'width=' + popupWidth + ',height=' + popupHeight + ',left=' + left + ',top=' + top);
      popup.focus();
    }
    return false;
  }

  //Delete warning
  function confirmDelete2(id, tgl) {
    var confirmMessage = "Are you sure you want to delete?";
    if (confirm(confirmMessage)) {
      var popupWidth = 400;
      var popupHeight = 200;
      var screenWidth = screen.width;
      var screenHeight = screen.height;
      var left = (screenWidth - popupWidth) / 2;
      var top = (screenHeight - popupHeight) / 2;
      var popup = window.open('../../proses/delete_tabungan.php?id=' + id + '&tgl=' + tgl, 'Delete Confirmation', 'width=' + popupWidth + ',height=' + popupHeight + ',left=' + left + ',top=' + top);
      popup.focus();
    }
    return false;
  }


  //display data
  $(document).ready(function() {
    var rowsPerPage = 10;
    var currentPage = 1;
    var totalRowsMurid = $('#murid-table-body tr').length;
    var totalPagesMurid = Math.ceil(totalRowsMurid / rowsPerPage);
    var totalRowsTabungan = $('#tabungan-table-body tr').length;
    var totalPagesTabungan = Math.ceil(totalRowsTabungan / rowsPerPage);

    $('#rows-per-page').on('change', function() {
      rowsPerPage = $(this).val();
      currentPage = 1;
      totalPagesMurid = Math.ceil(totalRowsMurid / rowsPerPage);
      totalPagesTabungan = Math.ceil(totalRowsTabungan / rowsPerPage);
      showRowsMurid();
      showRowsTabungan();
    });

    function showRowsMurid() {
      var startRow = (currentPage - 1) * rowsPerPage;
      var endRow = startRow + rowsPerPage;
      $('#murid-table-body tr').hide();
      $('#murid-table-body tr').slice(startRow, endRow).show();
    }

    function showRowsTabungan() {
      var startRow = (currentPage - 1) * rowsPerPage;
      var endRow = startRow + rowsPerPage;
      $('#tabungan-table-body tr').hide();
      $('#tabungan-table-body tr').slice(startRow, endRow).show();
    }

    showRowsMurid();
    showRowsTabungan();
  });

  function deleteSelected() {
    var ids = [];
    $('input[type="checkbox"]:checked').each(function() {
      ids.push($(this).val());
    });
    if (ids.length > 0) {
      // Show a confirmation dialog box
      if (confirm("Anda Benar Ingin Menghapus Data ini?")) {
        // Send the request to delete the records using AJAX
        $.ajax({
          type: "POST",
          url: "../../proses/delete_siswa.php",
          data: {
            ids: ids.join(',')
          },
          success: function() {
            alert("Data Telah Dihapus! Silahkan Refresh");
            // You can also refresh the table or update the UI here
          }
        });
      }
    } else {
      alert('No records selected for deletion.');
    }
  }

  function openEditForm2(id_murid) {
    var url = '../../proses/edit_murid.php?id_murid=' + id_murid;
    var popup = window.open(url, '_blank', 'width=800, height=600');
    popup.focus();

  }

  function openEditForm(id_murid, tgl) {
    var url = '../../proses/edit_tabungan.php?id_murid=' + id_murid + '&tgl=' + tgl;
    var popup = window.open(url, '_blank', 'width=800, height=600');
    popup.focus();
  }

  function openEditForm3(id_murid) {
    var url = '../../tambah_tabungan.php?id_murid=' + id_murid;
    var popup = window.open(url, '_blank', 'width=800, height=600');
    popup.focus();
  }

  function openEditForm4(id_murid) {
    var url = '../../detailtabungan.php?id_murid=' + id_murid;
    var popup = window.open(url, '_blank', 'width=800, height=600');
    popup.focus();
  }


  document.getElementById('month-filter').addEventListener('change', function() {
    var month = this.value;
    if (month == '0') { // cancel filter
      window.location.href = ''; // remove the ?month= parameter
    } else {
      window.location.href = '?month=' + month;
    }
  });

  function exportToExcel() {
    window.location.href = '../../proses/export_to_excel_tabungan.php';
  }

  function exportToDetail() {
    var url = '../../detail_tabungan.php';
    var popup = window.open(url, '_blank', 'width=800, height=600');
    popup.focus();
  }
</script>

</html>