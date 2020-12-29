<?php
$uri1 = getSegment(1);
$uri2 = getSegment(2);
$uri3 = getSegment(3);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title><?php echo $title; ?></title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->

  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/modules/jqvmap/dist/jqvmap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/modules/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css">

  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/datatables/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/modules/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/modules/ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/modules/izitoast/css/iziToast.min.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/style.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/components.css">
  <script src="https://www.gstatic.com/charts/loader.js"></script>

</head>

<body <?php if (isset($load)) {
        echo $load;
      } ?>>
  <?php
  if ($uri1 == 'dashboard' || $uri1 == 'admin') {
    echo  $this->include('template/navbar');
    if (session()->role == 'admin') {

      echo $this->include('template/sidebar');
    } else {
      echo $this->include('template/sidebar');
    }
  }
  ?>


  <?= $this->renderSection('content') ?>

  </div>
  </div>


  <!-- General JS Scripts -->
  <script src="<?php echo base_url(); ?>/assets/modules/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>/assets/modules/popper.js"></script>
  <script src="<?php echo base_url(); ?>/assets/modules/tooltip.js"></script>
  <script src="<?php echo base_url(); ?>/assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>/assets/autoNumeric.js"></script>
  <script src="<?php echo base_url(); ?>/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="<?php echo base_url(); ?>/assets/modules/moment.min.js"></script>
  <script src="<?php echo base_url(); ?>/assets/js/stisla.js"></script>

  <!-- JS Libraies -->
  <?php if ($uri2 != 'add') { ?>
    <script src="<?php echo base_url(); ?>/assets/bootbox.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/modules/jquery.sparkline.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/modules/chart.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/modules/owlcarousel2/dist/owl.carousel.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/modules/summernote/summernote-bs4.js"></script>
    <script src="<?php echo base_url(); ?>/assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>/assets/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/modules/datatables/datatables.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>/assets/datatables/buttons.bootstrap4.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>/assets/datatables/jszip.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>/assets/datatables/pdfmake.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>/assets/datatables/vfs_fonts.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>/assets/datatables/buttons.html5.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>/assets/datatables/buttons.print.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>/assets/datatables/buttons.colVis.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/modules/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/modules/select2/dist/js/select2.full.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/modules/izitoast/js/iziToast.min.js"></script>

  <?php } ?>

  <!-- Template JS File -->
  <script src="<?php echo base_url(); ?>/assets/js/scripts.js"></script>
  <script src="<?php echo base_url(); ?>/assets/js/custom.js"></script>
</body>

</html>