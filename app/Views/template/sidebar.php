  <div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="<?php echo base_url(); ?>/<?= getSegment(1) ?>">Bursa Khusus Kerja</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="<?php echo base_url(); ?>/<?= getSegment(1) ?>">BKK</a>
      </div>
      <ul class="sidebar-menu">
        <li class="menu-header">Dashboard Data</li>
        <li class="dropdown <?php echo $act == 1 ? 'active' : '' ?>">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-file-alt"></i> <span>Master Data</span></a>
          <ul class="dropdown-menu">
            <li class="<?php echo getSegment(3) == 'alumni' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>/<?= getSegment(1) ?>/data/alumni">Alumni</a></li>
            <li class="<?php echo getSegment(3) == 'account' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>/<?= getSegment(1) ?>/data/account">Account</a></li>
            <li class="<?php echo getSegment(3) == 'question' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>/<?= getSegment(1) ?>/data/question">Question</a></li>
            <li class="<?php echo getSegment(3) == 'answer' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>/<?= getSegment(1) ?>/data/answer">Q & A</a></li>
            <li class="<?php echo getSegment(3) == 'loker' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>/<?= getSegment(1) ?>/data/loker">Loker</a></li>
          </ul>
        </li>

        <li class="dropdown <?php echo  $act == 2 ? 'active' : '' ?>">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-tachometer-alt"></i> <span>Widget</span></a>
          <ul class="dropdown-menu">
            <li class="<?php echo getSegment(3) == 'cover' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>/<?= getSegment(1) ?>/widget/cover">Cover</a></li>
            <li class="<?php echo getSegment(3) == 'pos' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>/<?= getSegment(1) ?>/widget/pos">Pos</a></li>
          </ul>
        </li>
        <!-- <li class="dropdown <?php echo  $act == 3 ? 'active' : '' ?>">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="far fa-file-alt"></i> <span>Laporan</span></a>
          <ul class="dropdown-menu">
            <li class="<?php echo getSegment(3) == 'bill' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>/<?= getSegment(1) ?>/laporan/bill">Bill Client</a></li>
            <li class="<?php echo getSegment(3) == 'income' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>/<?= getSegment(1) ?>/laporan/income">Revenue</a></li>
            <li class="<?php echo getSegment(3) == 'other' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>/<?= getSegment(1) ?>/laporan/other">Biaya lain-lain</a></li>
          </ul>
        </li> -->

        <!-- <li class="dropdown <?php echo  $act == 4 ? 'active' : '' ?>">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="far fa-file-alt"></i> <span>Biaya Operasional</span></a>
          <ul class="dropdown-menu">
            <li class="<?php echo getSegment(3) == 'kategori' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>/<?= getSegment(1) ?>/biaya/kategori">Kategori Biaya</a></li>
            <li class="<?php echo getSegment(3) == 'anggaran' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>/<?= getSegment(1) ?>/biaya/anggaran">Anggaran Biaya</a></li>
          </ul>
        </li> -->
        <li class="menu-header">Dashboard Setting</li>
        <li class="dropdown <?php echo  $act == 5 ? 'active' : '' ?>">
          <a href="#" class="nav-link has-dropdown"><i class="fas fa-cog"></i> <span>Setting</span></a>
          <ul class="dropdown-menu">
            <li class="<?php echo getSegment(3) == 'app' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>/<?= getSegment(1) ?>/setting/app">Aplikasi</a></li>
          </ul>
        </li>
      </ul>
    </aside>
  </div>