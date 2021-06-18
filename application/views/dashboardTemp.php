<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?=$title?></title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?=base_url('assets/temp/')?>vendors/feather/feather.css">
  <link rel="stylesheet" href="<?=base_url('assets/temp/')?>vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="<?=base_url('assets/temp/')?>vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="<?=base_url('assets/temp/')?>vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="<?=base_url('assets/temp/')?>vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" type="text/css" href="<?=base_url('assets/temp/')?>js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?=base_url('assets/temp/')?>css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?=base_url('assets/')?>img/icon.png" />

  
  <!-- plugins:js -->
  <script src="<?=base_url('assets/temp/')?>vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="<?=base_url('assets/temp/')?>vendors/chart.js/Chart.min.js"></script>
  <script src="<?=base_url('assets/temp/')?>vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="<?=base_url('assets/temp/')?>vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <script src="<?=base_url('assets/temp/')?>js/dataTables.select.min.js"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="<?=base_url('assets/temp/')?>js/off-canvas.js"></script>
  <script src="<?=base_url('assets/temp/')?>js/hoverable-collapse.js"></script>
  <script src="<?=base_url('assets/temp/')?>js/template.js"></script>
  <script src="<?=base_url('assets/temp/')?>js/settings.js"></script>
  <script src="<?=base_url('assets/temp/')?>js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="<?=base_url('assets/temp/')?>js/dashboard.js"></script>
  <script src="<?=base_url('assets/temp/')?>js/Chart.roundedBarCharts.js"></script>
  <!-- End custom js for this page-->
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo ml-2" href="<?=base_url('/')?>"><img src="<?=base_url('assets/img/')?>logo.png" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="<?=base_url('/')?>"><img src="<?=base_url('assets/img/')?>mini-logo.png" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="<?=base_url('assets/temp/')?>images/faces/def_profile.png" alt="profile"/>
              <?=$this->apl->usr()['name']?>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="<?=base_url('personal')?>">
                <i class="ti-user text-primary"></i>
                Akun
              </a>
              <a class="dropdown-item" href="<?=base_url('logout')?>">
                <i class="ti-power-off text-primary"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item" id="tab-1">
            <a class="nav-link" href="<?=base_url('dashboard')?>">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item" id="tab-2">
            <a class="nav-link" href="<?=base_url('arisan-list')?>">
              <i class="ti-briefcase menu-icon"></i>
              <span class="menu-title">List Arisan</span>
            </a>
          </li>
          <li class="nav-item" id="tab-3">
            <a class="nav-link" href="<?=base_url('transaction-list')?>">
              <i class="ti-archive menu-icon"></i>
              <span class="menu-title">List Transaksi</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
                <?php if($this->session->flashdata('res')): ?>
                    <div class="alert alert-<?php echo $this->session->flashdata('res')['met'] ?>" role="alert">
                        <?php echo $this->session->flashdata('res')['mess'] ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
          <?php $data['usr'] = $this->apl->usr(); $this->load->view($page, $data);?>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021 All rights reserved.</span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

</body>

</html>

