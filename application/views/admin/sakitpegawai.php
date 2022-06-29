<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <?= $title ?>
            <small> <?= $subtitle ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('index.php/admin/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><?= $title ?></li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped" id="dataTable">
                        <thead>
                            <tr>
                                <th width="10px">#</th>
                                <th>Shift</th>
                                <th>Jenis</th>
                                <th>Nama Karyawan</th>
                                <th>Tanggal</th>
                                <th>Jam Masuk</th>
                                <th>Jam Pulang</th>
                                <th>Lama Kerja</th>
                                <th>Location</th>
                                <th>Catatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                foreach ($absensi->result_array() as $row) {
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td>
                                        <?php
                                            $this->db->where('id', $row['idShift']);
                                            foreach ($this->db->get('tb_shift')->result() as $vSft) {
                                                echo $vSft->shift;
                                            }
                                        ?>
                                    </td>
                                    <td><?= $row['jenis'] ?></td>
                                    <td>
                                        <?php
                                            $this->db->where('id', $row['idUser']);
                                            foreach ($this->db->get('tb_user')->result() as $dUsr) {
                                                echo $dUsr->nama;
                                            }
                                        ?>
                                    </td>
                                    <td><?= date('d F Y', strtotime($row['tanggal'])) ?></td>
                                    <td><?= date('H:i:s', strtotime($row['jamMasuk'])) ?></td>
                                    <td>
                                        <?php
                                            if($row['jamPulang'] != '00:00:00') {
                                                echo date('H:i:s', strtotime($row['jamPulang']));
                                            } else {
                                                echo '<div class="label label-danger">Belum Absen</div>';
                                            }
                                        ?>
                                    </td>
                                    <td><?= date('H:i:s', strtotime($row['lama'])) ?></td>
                                    <td>
                                        <a href="<?= $row['urlMasuk'] ?>" class="btn btn-primary btn-xs" target="blank">
                                            <div class="fa fa-map-marker"></div> Lokasi Masuk
                                        </a>
                                        <?php if($row['jamPulang'] != '00:00:00') { ?>
                                            <a href="<?= $row['urlPulang'] ?>" class="btn btn-warning btn-xs" target="blank">
                                                <div class="fa fa-map-marker"></div> Lokasi Pulang
                                            </a>
                                        <?php } ?>
                                    </td>
                                    <td><?= $row['catatan'] ?></td>
                                    <td>
                                        <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#detail<?= $row['id'] ?>">
                                            <div class="fa fa-eye"></div> Detail
                                        </button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>