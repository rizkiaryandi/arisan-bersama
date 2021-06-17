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
        <a class="navbar-brand brand-logo-mini" href="<?=base_url('/')?>"><img src="<?=base_url('assets/img/')?>icon.png" alt="logo"/></a>
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

          <?php if($this->apl->usr()['level'] == 'administrator' || $this->apl->usr()['level'] == 'operator'):?>
            <?php if($this->apl->usr()['level'] == 'administrator'):?>
              <li class="nav-item" id="tab-2">
                <a class="nav-link" href="<?=base_url('/operator')?>">
                  <i class="ti-user menu-icon"></i>
                  <!-- <span class="menu-title">Petugas</span> -->
                </a>
              </li>
            <?php endif?>
            
            <li class="nav-item" id="tab-3">
                <a class="nav-link" data-toggle="collapse" href="#students" aria-expanded="false" aria-controls="students">
                  <i class="icon-head menu-icon"></i>
                  <span class="menu-title">Peserta Didik</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="students">
                  <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="<?=base_url('students')?>">Siswa</a></li>
                    <li class="nav-item"> <a class="nav-link" href="<?=base_url('classroom')?>">Kelas</a></li>
                  </ul>
                </div>
              </li>
            <li class="nav-item" id="tab-4">
                <a class="nav-link" data-toggle="collapse" href="#spp" aria-expanded="false" aria-controls="spp">
                <i class="icon-grid-2 menu-icon"></i>
                <span class="menu-title">SPP</span>
                <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="spp">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="<?=base_url('transaction')?>">Transaksi SPP</a></li>
                    <li class="nav-item"> <a class="nav-link" href="<?=base_url('report')?>">Generate Laporan</a></li>
                </ul>
                </div>
            </li>
          <?php endif?>
          
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

