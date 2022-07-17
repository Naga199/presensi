<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo base_url(); ?>assets/img/<?php echo $userdata->foto; ?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $userdata->nama; ?></p>
        <!-- Status -->
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
      <li class="header">MAIN MENU</li>
      <!-- Optionally, you can add icons to the links -->

      <li <?php if ($page == 'home') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('Home'); ?>">
          <i class="fa fa-home"></i>
          <span>Home</span>
        </a>
      </li>
      <?php if($this->userdata->type == 'admin') { ?>
		  <li <?php if ($page == 'user') {echo 'class="active"';} ?>>
			<a href="<?php echo base_url('user'); ?>">
			  <i class="fa fa-user"></i>
			  <span>Data Admin</span>
			</a>
		  </li>

		  <li <?php if ($page == 'posisi') {echo 'class="active"';} ?>>
			<a href="<?php echo base_url('Posisi'); ?>">
			  <i class="fa fa-briefcase"></i>
			  <span>Data Matpel</span>
			</a>
		  </li>
		  
		  <!-- <li <?php if ($page == 'kota') {echo 'class="active"';} ?>>
			<a href="<?php echo base_url('Kota'); ?>">
			  <i class="fa fa-location-arrow"></i>
			  <span>Data Kota</span>
			</a>
		  </li> -->
	  <?php } ?>
      <li <?php if ($page == 'guru') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('guru'); ?>">
          <i class="fa fa-users"></i>
          <span>Data Guru</span>
        </a>
      </li>
      
      <li <?php if ($page == 'izin') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('izin'); ?>">
          <i class="fa fa-envelope"></i>
          <span>Data Izin</span>
        </a>
      </li>
	  
	  
      <?php if($this->userdata->type == 'guru') { ?>
		  <li <?php if ($page == 'kehadiran') {echo 'class="active"';} ?>>
			<a href="<?php echo base_url('kehadiran'); ?>">
			  <i class="fa fa-clock-o"></i>
			  <span>Kehadiran</span>
			</a>
		  </li>
      <?php } ?>

      <li <?php if ($page == 'laporan') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('laporan'); ?>">
          <i class="fa fa-book"></i>
          <span>Laporan Kehadiran</span>
        </a>
      </li>
    </ul>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>
