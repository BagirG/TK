<?php
// Start the session
session_start();

include '../../config.php';


// Include config file


// Check if the username is set in the session
if (isset($_SESSION['username'])) {
  $user_sql = "SELECT * FROM guru WHERE username = ?";
  $stmt = $conn->prepare($user_sql);
  $stmt->bind_param("s", $_SESSION['username']);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $profile_text = $user['username']; // Get the username from the $user array
    echo 'Welcome, ' . $profile_text; // Output the username
  } else {
    echo 'Error: Unable to retrieve user data.';
  }
} else {
  echo 'Error: Username not set in session.';
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">

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
        <a class="sidebar-brand brand-logo" href="../../beranda.php"><img src="../../assets/images/logo2.png" alt="logo" /></a>
        <a class="sidebar-brand brand-logo-mini" href="../../beranda.php"><img src="../../assets/images/logo-mini.svg" alt="logo" /></a>
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
                <div class="dropdown-divider"></div>
                <p class="p-3 mb-0 text-center">Advanced settings</p>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-format-line-spacing"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div id="notification"></div>
        <div class="content-wrapper">
          <div class="mt-4 flex flex-col bg-gray-100 rounded-lg p-4 shadow-sm">
            <h2 class="text-black font-bold text-lg">Input Tabungan</h2>
            <form action="../../proses/insert_tabungan.php" method="post">
              <div class="mt-4">
                <label class="text-black" for="username">username</label>
                <input placeholder="" class="w-full bg-white rounded-md border-gray-300 text-black px-2 py-1" type="text" id="username" name="username">
              </div>

              <div class="mt-4">
                <label class="text-black" for="nama">Nama</label>
                <input placeholder="" class="w-full bg-white rounded-md border-gray-300 text-black px-2 py-1" type="text" id="nama" name="nama">
              </div>

              <div class="mt-4">
                <label class="text-black" for="kelas">Kelas</label>
                <input placeholder="" class="w-full bg-white rounded-md border-gray-300 text-black px-2 py-1" id="kelas" name="kelas">
              </div>

              <div class="mt-4 flex flex-row space-x-2">
                <div class="flex-1">
                  <label class="text-black" for="ket">Keterangan</label>
                  <select class="w-full bg-white rounded-md border-gray-300 text-black px-2 py-1" id="ket" name="ket">
                    <option value="">Pilih Keterangan</option>
                    <option value="Setoran">Setoran</option>
                    <option value="Penarikan">Penarikan</option>
                  </select>
                </div>

                <div class="flex-1">
                  <label class="text-black" for="tgl">Tanggal</label>
                  <input placeholder="" class="w-full bg-white rounded-md border-gray-300 text-black px-2 py-1" id="tgl" type="datetime-local" name="tgl" value="">
                </div>
              </div>


              <div class="mt-4 flex flex-row space-x-2">
                <div class="flex-1">
                  <label class="text-black" for="nominal">nominal</label>
                  <input placeholder="" class="w-full bg-white rounded-md border-gray-300 text-black px-2 py-1" id="nominal" type="text" name="nominal">
                </div>
              </div>

              <div class="mt-4 flex flex-row space-x-2">
                <div class="flex-1">
                  <label class="text-black" for="saldo">Saldo</label>
                  <input placeholder="" class="w-full bg-white rounded-md border-gray-300 text-black px-2 py-1" id="saldo" type="text" name="saldo">
                </div>
              </div>

              <div class="mt-4 flex justify-end">
                <button class=" btn btn-primary mr-2" type="submit">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

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
  var notif = getParameterByName('notif');

  // Display the notification if the query parameter is set
  if (notif == 'success') {
    var notification = document.getElementById('notification');
    notification.innerHTML = '<div class="alert alert-success">Data inserted successfully</div>';
    setTimeout(function() {
      notification.innerHTML = '';
    }, 3000);
  }

  // Function to get query parameter by name
  function getParameterByName(name) {
    var url = window.location.href;
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
      results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
  }
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
  function confirmDelete2(id) {
    var confirmMessage = "Are you sure you want to delete?";
    if (confirm(confirmMessage)) {
      var popupWidth = 400;
      var popupHeight = 200;
      var screenWidth = screen.width;
      var screenHeight = screen.height;
      var left = (screenWidth - popupWidth) / 2;
      var top = (screenHeight - popupHeight) / 2;
      var popup = window.open('../../proses/delete_tabungan.php?id=' + id, 'Delete Confirmation', 'width=' + popupWidth + ',height=' + popupHeight + ',left=' + left + ',top=' + top);
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

  function openEditForm(id_tabungan) {
    var url = '../../proses/edit_tabungan.php?id_tabungan=' + id_tabungan;
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
</script>

</html>