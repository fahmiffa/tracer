 <!-- <nav class="navbar navbar-expand-lg navbar-dark shadow-sm" id="ftco-navbar"> -->
 <nav class="navbar navbar-expand-lg navbar-dark bg-white shadow-sm ftco_navbar ftco-navbar-light" id="ftco-navbar">
   <div class="container">
     <a class="navbar-brand" href="<?= base_url() ?>"><span>BKK</span></a>
     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
       <span class="oi oi-menu"></span> <i class="fa fa-bars"></i>
     </button>

     <div class="collapse navbar-collapse" id="ftco-nav">
       <ul class="navbar-nav ml-auto">
         <li class="nav-item <?= ($act == 1) ? 'active' : '' ?>"><a href="<?= base_url() ?>" class="nav-link text-dark">Home</a></li>
         <li class="nav-item"><a href="#about" class="nav-link text-dark">About</a></li>
         <li class="nav-item <?= ($act == 2) ? 'active' : '' ?>"><a href="<?= base_url('info') ?>" class="nav-link text-dark">Info</a></li>
         <li class="nav-item <?= ($act == 3) ? 'active' : '' ?>"><a href="<?= base_url('loker') ?>" class="nav-link text-dark">Lowongan Pekerjaan</a></li>
         <li class="nav-item <?= ($act == 4) ? 'active' : '' ?>"><a href="<?= base_url('alumni') ?>" class="nav-link <?= ($act == 4) ? '' : 'text-dark' ?>">Alumnni</a></li>
         <?php if (!empty(session()->role) && session()->role != 'admin') { ?>
           <li class="nav-item <?= ($act == 5) ? 'active' : '' ?>"><a href="<?= base_url('dash') ?>" class="nav-link <?= ($act == 5) ? '' : 'text-dark' ?>">Dashboard</a></li>
           <li class="nav-item"><a href="<?php echo base_url('logout'); ?>" class="nav-link text-dark">keluar</a></li>
         <?php } ?>
       </ul>
     </div>
   </div>
 </nav>