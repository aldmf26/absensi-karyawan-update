  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?= base_url('assets') ?>/profil/<?= $this->session->userdata('foto') ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?= $this->session->userdata('nama') ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="<?= base_url('index.php/admin/dashboard') ?>">
            <i class="fa fa-tachometer"></i> <span>Dashboard</span>
          </a>
        </li>
        <?php if ($this->session->userdata('level') == 'Administrator') { ?>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-cogs"></i> <span>Master Data</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?= base_url('index.php/admin/user') ?>"><i class="fa fa-circle-o"></i> Data Pegawai</a></li>
              <li><a href="<?= base_url('index.php/admin/aplikasi') ?>"><i class="fa fa-circle-o"></i> Tentang Aplikasi</a></li>

            </ul>
          </li>
        <?php } ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Data Absensi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if ($this->session->userdata('level') == 'Administrator') { ?>
              <li><a href="<?= base_url('index.php/admin/shift') ?>"><i class="fa fa-circle-o"></i>Data Shift</a></li>
            <?php } ?>
            <li><a href="<?= base_url('index.php/admin/absensi') ?>"><i class="fa fa-circle-o"></i>Data Absensi</a></li>
          </ul>
        </li>
        <?php if ($this->session->userdata('level') == 'Administrator') { ?>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-money"></i> <span>Data Gaji</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?= base_url('index.php/admin/gajipokok') ?>"><i class="fa fa-circle-o"></i> Data Gaji Pokok</a></li>
              <li><a href="<?= base_url('index.php/admin/gajipegawai') ?>"><i class="fa fa-circle-o"></i> Data Gaji Pegawai</a></li>
              <li><a href="<?= base_url('index.php/admin/aplikasi') ?>"><i class="fa fa-circle-o"></i> Data Pemotongan Gaji</a></li>

            </ul>
          </li>
        <?php } ?>
        <li>
          <a href="<?= base_url('index.php/admin/kegiatan') ?>">
            <i class="fa fa-calendar"></i> <span>Data Kegiatan</span>
          </a>
        </li>
        <li>
          <a href="<?= base_url('index.php/admin/absensi') ?>">
            <i class="fa fa-close"></i> <span>Data Pemberhentian Pegawai</span>
          </a>
        </li>
        <li>
          <a href="<?= base_url('index.php/admin/izinpegawai') ?>">
            <i class="fa fa-edit"></i> <span>Data Izin Pegawai</span>
          </a>
        </li>
        <li>
          <a href="<?= base_url('index.php/admin/sakitpegawai') ?>">
            <i class="fa fa-edit"></i> <span>Data Sakit Pegawai</span>
          </a>
        </li>
        <?php if ($this->session->userdata('level') == 'Administrator') { ?>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-print"></i> <span>Laporan</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?= base_url('index.php/admin/user/exportexcel') ?>"><i class="fa fa-circle-o"></i>Data Pegawai</a></li>
              <li><a href="<?= base_url('index.php/admin/lapAbsen') ?>?jenis=masuk"><i class="fa fa-circle-o"></i>Data Absen Masuk</a></li>
              <li><a href="<?= base_url('index.php/admin/lapAbsen') ?>?jenis=pulang"><i class="fa fa-circle-o"></i>Data Absen Pulang</a></li>
              <li><a href="<?= base_url('index.php/admin/user') ?>"><i class="fa fa-circle-o"></i>Data Kegiatan Pegawai</a></li>
              <li><a href="<?= base_url('index.php/admin/user') ?>"><i class="fa fa-circle-o"></i>Data Gaji Pegawai</a></li>
              <li><a href="<?= base_url('index.php/admin/aplikasi') ?>"><i class="fa fa-circle-o"></i>Data Pemotongan Gaji</a></li>
              <li><a href="<?= base_url('index.php/admin/user') ?>"><i class="fa fa-circle-o"></i>Data Pemberhentian Pegawai</a></li>
              <li><a href="<?= base_url('index.php/admin/izinpegawai/laporan') ?>"><i class="fa fa-circle-o"></i>Data Izin Pegawai</a></li>
          </li>
      </ul>
      </li>
    <?php } ?>
    <li>
      <a href="<?= base_url('index.php/home/logout') ?>" class="tombol-yakin" data-isidata="Ingin keluar dari sistem ini?">
        <i class="fa fa-sign-out"></i> <span>Sign Out</span>
      </a>
    </li>
    </li>
    </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->