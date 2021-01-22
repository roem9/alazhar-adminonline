    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center">
        <div class="sidebar-brand-icon">
          <!-- <i class="fas fa-user-shield"></i> -->
          <img src="<?= base_url()?>assets/img/logo.png" width="50" class="img-fluid img-shadow">
        </div>
        <div class="sidebar-brand-text mx-3">Admin Al-Azhar</div>
      </a>

      
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading text-light">
        Admin <br>Al-Azhar
      </div>
      
      <li class="nav-item" id="sidebarCivitas">
        <a class="nav-link" href="<?= base_url()?>civitas">
          <i class="fas fa-user-tie"></i>
          <span>Pengajar</span></a>
      </li>

      <li class="nav-item" id="sidebarPeserta">
        <a class="nav-link" href="<?= base_url()?>peserta">
          <i class="fas fa-users"></i>
          <span>Peserta</span></a>
      </li>
      
      <li class="nav-item" id="sidebarKonfirmPeserta">
        <a class="nav-link" href="<?= base_url()?>peserta/konfirm">
          <i class="fas fa-check-double"></i>
          <span>Konfirmasi Peserta</span></a>
      </li>
      

      <li class="nav-item" id="sidebarWlPeserta">
        <a class="nav-link" href="<?= base_url()?>peserta/wl">
          <i class="fas fa-clock"></i>
          <span>WL Peserta</span></a>
      </li>

      <li class="nav-item" id="sidebarClosing">
        <a class="nav-link" href="<?= base_url()?>closing">
          <i class="fas fa-funnel-dollar"></i>
          <span>Closing Peserta</span></a>
      </li>
      
      <li class="nav-item" id="sidebarKelas">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#droptwo" aria-expanded="true" aria-controls="droptwo">
          <i class="fas fa-book"></i>
          <span>Kelas</span>
        </a>
        <div id="droptwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-primary py-2 collapse-inner rounded">
            <h6 class="collapse-header text-light">Kelas</h6>
            <a class="collapse-item text-light" href="<?= base_url()?>kelas/aktif">Kelas Aktif</a>
            <a class="collapse-item text-light" href="<?= base_url()?>kelas/nonaktif">Kelas Nonaktif</a>
          </div>
        </div>
      </li>

      <!-- <li class="nav-item" id="sidebarKelas">
        <a class="nav-link" href="<?= base_url()?>kelas">
          <i class="fas fa-book"></i>
          <span>Kelas</span>
        </a>
      </li> -->
      
      <!-- <li class="nav-item" id="">
        <a class="nav-link" href="#laporan" class="collapse-item text-light bg-success" data-toggle="modal">
          <i class="fas fa-flag"></i>
          <span>Laporan</span>
        </a>
      </li> -->

      <li class="nav-item" id="">
        <a class="nav-link" href="<?= base_url()?>login/logout">
          <i class="fas fa-fw fa-sign-out-alt"></i>
          <span>Keluar</span></a>
      </li>
    </ul>
    <!-- End of Sidebar -->