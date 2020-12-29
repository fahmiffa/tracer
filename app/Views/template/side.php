  
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="<?php echo base_url(); ?>/<?=getSegment(1)?>">Aplikasi</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?php echo base_url(); ?>/<?=getSegment(1)?>">App</a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Dashboard Data</li>            
            <li class="dropdown <?php echo $act == 1 ? 'active' : '' ?>">
              <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-file"></i> <span>Data</span></a>
              <ul class="dropdown-menu">                
                <li class="<?php echo getSegment(3) == 'sales' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>/<?=getSegment(1)?>/data/sales">Sales</a></li>     
                <li class="<?php echo getSegment(3) == 'paket' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>/<?=getSegment(1)?>/data/paket">Profil Sales</a></li>    
                <li class="<?php echo getSegment(3) == 'client' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>/<?=getSegment(1)?>/data/client">Client</a></li>  
                <li class="<?php echo getSegment(3) == 'mirotik' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>/<?=getSegment(1)?>/data/mikrotik">Mikrotik</a></li>                
              </ul>
            </li>
            <li class="dropdown <?php echo  $act == 3 ? 'active' : '' ?>">
              <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="far fa-file-alt"></i> <span>Laporan</span></a>
              <ul class="dropdown-menu">                
                <li class="<?php echo getSegment(3) == 'income' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>/<?=getSegment(1)?>/laporan/income">Income</a></li>                
              </ul>
            </li>         
            <li class="menu-header">Dashboard Setting</li>
            <li class="dropdown <?php echo  $act == 4 ? 'active' : '' ?>">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-cog"></i> <span>Setting</span></a>
              <ul class="dropdown-menu">
              <li class="<?php echo getSegment(3) == 'aplikasi' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>/<?=getSegment(1)?>/setting/aplikasi">Aplikasi</a></li>
              <li class="<?php echo getSegment(3) == 'notif' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>/<?=getSegment(1)?>/setting/notif">Notif</a></li>
              <li class="<?php echo getSegment(3) == 'mikrotik' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>/<?=getSegment(1)?>/setting/mikrotik">Mikrotik</a></li>                
              <li class="<?php echo getSegment(3) == 'bank' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>/<?=getSegment(1)?>/setting/bank">Bank</a></li>       
              <li class="<?php echo getSegment(3) == 'api' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>/<?=getSegment(1)?>/setting/api">API TOKEN</a></li>                
              </ul>
            </li>  
          </ul>
        </aside>
      </div>
