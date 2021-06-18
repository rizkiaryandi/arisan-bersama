<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?=$title?></title>
  <link rel="stylesheet" href="<?=base_url('assets/temp/')?>vendors/feather/feather.css">
  <link rel="stylesheet" href="<?=base_url('assets/temp/')?>vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="<?=base_url('assets/temp/')?>vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="<?=base_url('assets/temp/')?>css/vertical-layout-light/style.css">
  <link rel="shortcut icon" href="<?=base_url('assets/')?>img/icon.png" />
</head>

<body>
  
    <?php $this->load->view($page, $data)?>

  <script src="<?=base_url('assets/temp/')?>vendors/js/vendor.bundle.base.js"></script>
  <script src="<?=base_url('assets/temp/')?>js/off-canvas.js"></script>
  <script src="<?=base_url('assets/temp/')?>js/hoverable-collapse.js"></script>
  <script src="<?=base_url('assets/temp/')?>js/template.js"></script>
  <script src="<?=base_url('assets/temp/')?>js/settings.js"></script>
  <script src="<?=base_url('assets/temp/')?>js/todolist.js"></script>
</body>

</html>
