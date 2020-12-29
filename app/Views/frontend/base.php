<?php
$uri1 = getSegment(1);
$uri2 = getSegment(2);
$uri3 = getSegment(3);
$seg1 = ($uri1) ? $uri1 : '';
$seg2 = ($uri2) ? $uri2 : '';
$seg3 = ($uri3) ? $uri3 : '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= $title ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>/asset/css/animate.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/asset/js/dropzone.min.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>/asset/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/asset/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/asset/css/magnific-popup.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>/asset/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/asset/css/jquery.timepicker.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>/asset/css/flaticon.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/asset/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <script src="<?php echo base_url(); ?>/asset/js/dropzone.min.js"></script>
    <script src="<?php echo base_url(); ?>/asset/js/jquery.min.js"></script>
</head>

<body <?php if (isset($load)) {
            echo $load;
        } ?>>

    <?php if ($uri1 != 'dash' && $uri1 != 'alumni') {
        echo $this->include('frontend/navs');
        $wid = app('tb_widget');
    ?>
        <div class="hero-wrap js-fullheight" style="background-image: url('<?= base_url($wid[0]->widget_cover) ?>');">
            <div class="overlay"></div>
            <div class="container">
                <div class="row no-gutters slider-text js-fullheight align-items-center" data-scrollax-parent="true">
                    <div class="col-md-7 ftco-animate">
                        <h1 class="mb-4"><?= $wid[0]->widget_name ?></h1>
                        <p class="mb-0"><a href="#about" class="btn btn-primary">Our About</a></p>
                    </div>
                </div>
            </div>
        </div>
    <?php } else {
        echo $this->include('frontend/nav');
    } ?>

    <?= $this->renderSection('content') ?>

    <footer class="ftco-footer ftco-no-pt" id="about">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md pt-5">
                    <div class="ftco-footer-widget pt-md-5 mb-4">
                        <?php $da = app('tb_app'); ?>
                        <h2 class="ftco-heading-2"><?= $da[0]->app_name ?></h2>
                        <p><?= $da[0]->app_des ?></p>
                        <ul class="ftco-footer-social list-unstyled float-md-left float-lft">
                            <li class="ftco-animate"><a href="#"><span class="fa fa-twitter"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="fa fa-facebook"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="fa fa-instagram"></span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md pt-5">
                    <div class="ftco-footer-widget pt-md-5 mb-4 ml-md-5">
                        <h2 class="ftco-heading-2">Quick Link</h2>
                        <ul class="list-unstyled">
                            <li><a href="<?= base_url('loker') ?>" class="py-2 d-block">Lowongan Pekerjaan</a></li>
                            <li><a href="<?= base_url('alumni') ?>" class="py-2 d-block">Alumni</a></li>
                            <li><a href="<?= base_url('info') ?>" class="py-2 d-block">Info</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md pt-5">
                    <div class="ftco-footer-widget pt-md-5 mb-4">
                        <h2 class="ftco-heading-2">Contat US</h2>
                        <div class="block-23 mb-3">
                            <ul>
                                <li><span class="icon fa fa-map-marker"></span><span class="text"><?= $da[0]->app_addr ?></span></li>
                                <li><a href="#"><span class="icon fa fa-phone"></span><span class="text"><?= $da[0]->app_hp ?></span></a></li>
                                <li><a href="#"><span class="icon fa fa-paper-plane"></span><span class="text">info@<?= getSegment(1) ?>.com</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <p>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;<?= date('Y') ?> All rights reserved
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                </div>
            </div>
        </div>
    </footer>



    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" /></svg></div>


    <script src="<?php echo base_url(); ?>/asset/js/jquery-migrate-3.0.1.min.js"></script>
    <script src="<?php echo base_url(); ?>/asset/js/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>/asset/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>/asset/js/jquery.easing.1.3.js"></script>
    <script src="<?php echo base_url(); ?>/asset/js/jquery.waypoints.min.js"></script>
    <script src="<?php echo base_url(); ?>/asset/js/jquery.stellar.min.js"></script>
    <script src="<?php echo base_url(); ?>/asset/js/owl.carousel.min.js"></script>
    <script src="<?php echo base_url(); ?>/asset/js/jquery.magnific-popup.min.js"></script>
    <script src="<?php echo base_url(); ?>/asset/js/jquery.animateNumber.min.js"></script>
    <script src="<?php echo base_url(); ?>/asset/js/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url(); ?>/asset/js/scrollax.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/autoNumeric.js"></script>
    <script src="<?php echo base_url(); ?>/assets/bootbox.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="<?php echo base_url(); ?>/asset/js/main.js"></script>

</body>

</html>