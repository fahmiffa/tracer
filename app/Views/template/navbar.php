<div id="app">
  <div class="main-wrapper main-wrapper-1">
    <div class="navbar-bg"></div>
    <nav class="navbar navbar-expand-lg main-navbar">
      <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
          <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
        </ul>
        <div class="search-element">
          <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250">
          <button class="btn" type="submit"><i class="fas fa-search"></i></button>
          <div class="search-backdrop"></div>
          <div class="search-result">
            <div class="search-header">
              Histories
            </div>
            <div class="search-item">
              <?php
              $client = session()->role == 'admin' ? '/data/client' : '/user/client';
              $reg = session()->role == 'admin' ? '/data/paket' : '/layanan/registrasi';
              $paket = session()->role == 'admin' ? '/data/paket' : '/layanan/paket';
              ?>
              <a href="<?= base_url(getSegment(1) . $client) ?>">client</a>
              <a href="#" class="search-close"><i class="fas fa-times"></i></a>
            </div>
            <div class="search-item">
              <a href="<?= base_url(getSegment(1) . $reg) ?>"><?= session()->role == 'admin' ? 'Sales' : 'Registrasi' ?></a>
              <a href="#" class="search-close"><i class="fas fa-times"></i></a>
            </div>
            <div class="search-item">
              <a href="<?= base_url(getSegment(1) . $paket) ?>">Paket</a>
              <a href="#" class="search-close"><i class="fas fa-times"></i></a>
            </div>
          </div>
        </div>
      </form>
      <ul class="navbar-nav navbar-right">
        <a target="_blank" href="<?= base_url() ?>" class="text-white"><i class="far fa-paper-plane"></i></a>
        <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
          <div class="dropdown-menu dropdown-list dropdown-menu-right">
            <div class="dropdown-header">Notifications
              <div class="float-right">
                <a href="#">Aktifitas</a>
              </div>
            </div>
            <div class="dropdown-list-content dropdown-list-icons">
              <?php $n = count($notif) > 5 ? 5 : count($notif);
              for ($i = 0; $i < $n; $i++) { ?>
                <a href="#" class="dropdown-item dropdown-item-unread">
                  <div class="dropdown-item-icon bg-primary text-white">
                    <i class="fas fa-file-alt"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    <?= $notif[$i]['notif']; ?>
                    <div class="time text-primary"><?= trans_date($notif[$i]['notif_time']) ?></div>
                  </div>
                </a>
              <?php  } ?>
            </div>
            <div class="dropdown-footer text-center">
              <a href="<?= base_url(getSegment(1) . '/log') ?>">View All <i class="fas fa-chevron-right"></i></a>
            </div>
          </div>
        </li>
        <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="<?php echo base_url(); ?>/assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block"><?php echo session()->nama; ?></div>
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-title">
              <?php
              $log = session()->waktu;
              $date = new DateTime($log);
              $now = new DateTime();
              echo 'LOGGED IN ' . $date->diff($now)->format("%I Min") . ' AGO';
              ?>
            </div>
            <a href="<?php echo base_url(getSegment(1)); ?>/setting/app" class="dropdown-item has-icon">
              <i class="fas fa-ellipsis-h"></i> Aplikasi
            </a>
            <div class="dropdown-divider"></div>
            <a href="<?php echo base_url('logout'); ?>" class="dropdown-item has-icon text-danger">
              <i class="fas fa-sign-out-alt"></i> Logout
            </a>
          </div>
        </li>
      </ul>
    </nav>