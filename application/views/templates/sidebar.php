
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <img src="<?= base_url('assets/adminlte/dist/img/logo_rs.png');?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">SEMERUSMART</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url('assets/adminlte/dist/img/avatar.png');?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= $user['nama_user'];?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link  <?php if($title == 'Semerusmart - Indikator pelayanan RS'):?>active<?php endif;?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                SEMERUSMART
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('Dashboard');?>" class="nav-link <?php if($title == 'SemeruSmart - Dashboard Pendaftaran'):?>active<?php endif;?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard Pendaftaran</p>
                </a>
              </li>                          
            </ul>           
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('Dashboard/BankDarah');?>" class="nav-link <?php if($title == 'SemeruSmart - Dashboard Bank Darah'):?>active<?php endif;?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard Bank Darah</p>
                </a>
              </li>                          
            </ul>           
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('IndikatorPelayanan');?>" class="nav-link <?php if($title == 'Semerusmart - Indikator pelayanan RS'):?>active<?php endif;?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Indikator Pelayanan RS</p>
                </a>
              </li>                          
            </ul>           
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('Dashboard/BedMonitoring');?>" class="nav-link <?php if($title == 'SemeruSmart - Bed Monitoring'):?>active<?php endif;?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bed Monitoring</p>
                </a>
              </li>                          
            </ul>           
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('Dashboard/JadwalOperasi');?>" class="nav-link <?php if($title == 'SemeruSmart - Jadwal Operasi'):?>active<?php endif;?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Jadwal Operasi</p>
                </a>
              </li>                          
            </ul>           
          </li>
          <?php if($user['role_id'] == '3' && $user['kode_unit'] == '3001'):?>
          <li class="nav-item">
            <a href="<?= base_url('IndikatorPelayanan/setTempatTidur');?>" class="nav-link <?php if($title == 'SemerusmartReborn - Set Tempat Tidur'):?>active<?php endif;?>">
              <i class="nav-icon fas fa-plus"></i>
              <p>
                Set Tempat tidur
              </p>
            </a>
            <?php endif;?>
          <?php if($user['role_id'] == '3' && $user['kode_unit'] == '8004'):?>
          <li class="nav-item">
            <a href="<?= base_url('JasaMedis');?>" class="nav-link <?php if($title == 'SemeruSmart - Jasa Medis'):?>active<?php endif;?>">
              <i class="nav-icon fas fa-calculator "></i>
              <p>
                Jasa Medis Dokter
              </p>
            </a>
          </li>
          <?php endif;?>
          <?php if($user['role_id'] == '1'):?>        
          <li class="nav-item">
            <a href="<?= base_url('Billing');?>" class="nav-link <?php if($title == 'SemeruSmart - Billing'):?>active<?php endif;?>">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Billing system
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('Billing/dataBilling');?>" class="nav-link <?php if($title == 'SemerusmartReborn - Data billing system'):?>active<?php endif;?>">
              <i class="nav-icon fas fa-history"></i>
              <p>
                Data billing system
              </p>
            </a>
          </li>  
          <!-- <li class="nav-item">
            <a href="<?= base_url('rincianBiaya');?>" class="nav-link <?php if($title == 'SemerusmartReborn - Rincian biaya'):?>active<?php endif;?>">
              <i class="nav-icon fas fa-file-medical-alt"></i>
              <p>
                Rincian biaya
              </p>
            </a>
          </li>   -->
          <?php if($user['kode_unit'] == '3020'):?>      
          <li class="nav-item">
            <a href="<?= base_url('Billing/ExpertisiPA');?>" class="nav-link <?php if($title == 'SemeruSmart - Riwayat expertisi PA'):?>active<?php endif;?>">
              <i class="nav-icon fas fa-file-medical-alt"></i>
              <p>
                Riwayat expertisi PA
              </p>
            </a>
          </li>  
          <?php endif;?>
          <?php if($user['kode_unit'] == '3011'):?>
          <li class="nav-item">
            <a href="<?= base_url('Bankdarah');?>" class="nav-link <?php if($title == 'SemerusmartReborn - Bank darah ( stok darah )'):?>active<?php endif;?>">
              <i class="nav-icon fas fa-tint"></i>
              <p>
                Stok darah
              </p>
            </a>
          </li>  
          <?php endif;?>
          <?php endif;?>
          <?php if($user['role_id'] == '2' && $user['kode_unit'] == '3020'):?> 
          <li class="nav-item <?php if($title == 'SemeruSmart - Riwayat Expertisi PA' || $title == 'Semerusmart - Data pasien expertisi'):?>menu-open<?php endif;?>">
            <a href="#" class="nav-link  <?php if($title == 'Semerusmart - Expertisi' || $title == 'Semerusmart - Data pasien expertisi'):?>active<?php endif;?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Expertisi PA
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">              
              <li class="nav-item">
                <a href="<?= base_url('ExpertisiPA/index');?>" class="nav-link <?php if($title == 'SemeruSmart - Riwayat Expertisi PA'):?>active<?php endif;?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Riwayat expertisi PA</p>
                </a>
              </li>
            </ul>
          </li>  
          <?php endif;?>  
        </ul>
      </nav>


      <div class="user-panel mt-3 pb-3 mb-3 d-flex bg-danger">
        <div class="image">
          <!-- <img src="<?= base_url('assets/adminlte/dist/img/logout.jpg');?>" class="img-circle elevation-2" alt="User Image"> -->
          <i class="fas fa-sign-out-alt text-light"></i>
        </div>
        <div class="info">
          <a href="<?= base_url('Auth/logout');?>" class="d-block">Logout</a>
        </div>
      </div>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
