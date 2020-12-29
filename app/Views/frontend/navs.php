 <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar ftco-navbar-light" id="ftco-navbar">
     <div class="container">
         <a class="navbar-brand" href="<?= base_url() ?>"><span>BKK</span></a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
             <span class="oi oi-menu"></span> <i class="fa fa-bars"></i>
         </button>

         <div class="collapse navbar-collapse" id="ftco-nav">
             <ul class="navbar-nav ml-auto">
                 <li class="nav-item <?= ($act == 1) ? 'active' : '' ?>"><a href="<?= base_url() ?>" class="nav-link">Home</a></li>
                 <li class="nav-item"><a href="#about" class="nav-link">About</a></li>
                 <li class="nav-item <?= ($act == 2) ? 'active' : '' ?>"><a href="<?= base_url('info') ?>" class="nav-link">Info</a></li>
                 <li class="nav-item <?= ($act == 3) ? 'active' : '' ?>"><a href="<?= base_url('loker') ?>" class="nav-link">Lowongan Pekerjaan</a></li>
                 <li class="nav-item <?= ($act == 4) ? 'active' : '' ?>"><a href="<?= base_url('alumni') ?>" class="nav-link">Alumnni</a></li>
                 <?php if (!empty(session()->role) && session()->role != 'admin') { ?>
                     <li class="nav-item <?= ($act == 5) ? 'active' : '' ?>"><a href="<?= base_url('dash') ?>" class="nav-link">Dashboard</a></li>
                     <li class="nav-item"><a href="<?php echo base_url('logout'); ?>" class="nav-link">keluar</a></li>
                 <?php } ?>
             </ul>
         </div>
     </div>
 </nav>