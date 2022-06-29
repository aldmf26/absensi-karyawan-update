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
        <?php if ($this->session->userdata('level') == 'Karyawan') { ?>
            <?php
            date_default_timezone_set('Asia/Jakarta');
            $hariIni = $this->db->query('SELECT * FROM tb_absensi WHERE idUser="' . $this->session->userdata('id') . '" AND tanggal="' . date('Y-m-d') . '"');
            foreach ($hariIni->result() as $dAbs) {
            }
            ?>
            <div class="row">
                <div class="col-lg-6 col-xs-12">
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>
                                Absen Masuk
                            </h3>

                            <p>
                                <?php if (empty($hariIni->num_rows())) { ?>
                                    Belum Absen
                                <?php } else { ?>
                                    <?= date('d M Y H:i:s', strtotime($dAbs->tanggal . $dAbs->jamMasuk)) . ' - ' . $dAbs->jenis ?>
                                <?php } ?>
                            </p>
                        </div>
                        <div class="icon">
                            <div class="fa fa-sign-in"></div>
                        </div>
                        <?php if (!empty($hariIni->num_rows())) { ?>
                            <a href="<?= base_url('index.php/admin/absensi/cekmasuk') ?>" class="small-box-footer">
                                Absen Sekarang <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        <?php } else { ?>
                            <a href="#" class="small-box-footer" data-toggle="modal" data-target="#masuk">
                                Absen Sekarang <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        <?php } ?>
                    </div>
                </div>
                <?php if (!empty($hariIni->num_rows())) { ?>
                    <?php if ($dAbs->jenis == 'Hadir') { ?>
                        <div class="col-lg-6 col-xs-12">
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>
                                        Absen Pulang
                                    </h3>

                                    <p>
                                        <?php if (empty($hariIni->num_rows())) { ?>
                                            Belum Absen
                                        <?php } else { ?>
                                            <?php
                                            if ($dAbs->jamPulang == '00:00:00') {
                                                echo 'Belum Absen';
                                            } else {
                                                echo date('d M Y H:i:s', strtotime($dAbs->tanggal . $dAbs->jamPulang));
                                            }
                                            ?>
                                        <?php } ?>
                                    </p>
                                </div>
                                <div class="icon">
                                    <div class="fa fa-sign-out"></div>
                                </div>
                                <?php if (empty($hariIni->num_rows())) { ?>
                                    <a href="<?= base_url('index.php/admin/absensi/cekpulang') ?>" class="small-box-footer">
                                        Absen Sekarang <i class="fa fa-arrow-circle-right"></i>
                                    </a>
                                <?php } else { ?>
                                    <?php if ($dAbs->jamPulang == '00:00:00') { ?>
                                        <a href="#" class="small-box-footer" data-toggle="modal" data-target="#pulang">
                                            Absen Sekarang <i class="fa fa-arrow-circle-right"></i>
                                        </a>
                                    <?php } else { ?>
                                        <a href="<?= base_url('index.php/admin/absensi/selesai') ?>" class="small-box-footer">
                                            Absen Sekarang <i class="fa fa-arrow-circle-right"></i>
                                        </a>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        <?php } ?>
        <div class="box">
            <?php if ($this->session->userdata('level') == 'Administrator') { ?>
                <div class="box-header">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#filterData">
                        <div class="fa fa-calendar"></div> Filter Data
                    </button>
                    <button class="btn btn-success" data-toggle="modal" data-target="#rekapData">
                        <div class="fa fa-print"></div> Rekap Data
                    </button>
                </div>
            <?php } ?>
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
                                        if ($row['jamPulang'] != '00:00:00') {
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
                                        <?php if ($row['jamPulang'] != '00:00:00') { ?>
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

<script type="text/javascript">
    function getLocationConstant() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(onGeoSuccess, onGeoError);
        } else {
            alert("Your browser or device doesn't support Geolocation");
        }
    }

    // If we have a successful location update
    function onGeoSuccess(event) {
        document.getElementById("LatitudeMasuk").value = event.coords.latitude;
        document.getElementById("LongitudeMasuk").value = event.coords.longitude;
        document.getElementById("LatitudePulang").value = event.coords.latitude;
        document.getElementById("LongitudePulang").value = event.coords.longitude;
        document.getElementById("Position1").value = event.coords.latitude + ", " + event.coords.longitude;
    }


    // If something has gone wrong with the geolocation request
    function onGeoError(event) {
        alert("Error code " + event.code + ". " + event.message);
    }
</script>

<!-- Modal Absen Masuk -->
<div class="modal fade" id="masuk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Absen Masuk</h4>
            </div>
            <form action="<?= base_url('index.php/admin/absensi/masuk') ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Shift</label>
                        <select name="idShift" class="form-control" required>
                            <option value="" disabled selected> -- Pilih Shift -- </option>
                            <?php foreach ($shift->result() as $dMsft) { ?>
                                <option value="<?= $dMsft->id ?>"><?= $dMsft->shift ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Foto</label>
                        <input type="file" name="foto" class="form-control-file" accept="image/*" capture="camera" required>
                    </div>
                    <div class="form-group">
                        <label>Jenis</label>
                        <select name="jenis" class="form-control" required>
                            <option value="" disabled selected> -- Pilih Jenis -- </option>
                            <option value="Hadir">Hadir</option>
                            <option value="Izin">Izin</option>
                            <option value="Sakit">Sakit</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Catatan</label>
                        <input type="text" name="catatan" class="form-control" placeholder="Catatan" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Latitude</label>
                                <input type="text" name="latitude" class="form-control" id="LatitudeMasuk" required readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Longitude</label>
                                <input type="text" name="longitude" class="form-control" id="LongitudeMasuk" required readonly>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-warning btn-xs" onclick="getLocationConstant()">
                        <div class="fa fa-map-marker"></div> Get Location
                    </button>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-danger">
                        <div class="fa fa-undo"></div> Reset
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <div class="fa fa-save"></div> Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Pulang -->
<div class="modal fade" id="pulang" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Absen Pulang</h4>
            </div>
            <form action="<?= base_url('index.php/admin/absensi/pulang/') . $dAbs->id ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Foto</label>
                        <input type="file" name="foto" class="form-control-file" accept="image/*" capture="camera" required>
                        <input type="hidden" name="jamMasuk" class="form-control" value="<?= $dAbs->jamMasuk ?>">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Latitude</label>
                                <input type="text" name="latitude" class="form-control" id="LatitudePulang" required readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Longitude</label>
                                <input type="text" name="longitude" class="form-control" id="LongitudePulang" required readonly>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-warning btn-xs" onclick="getLocationConstant()">
                        <div class="fa fa-map-marker"></div> Get Location
                    </button>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-danger">
                        <div class="fa fa-undo"></div> Reset
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <div class="fa fa-save"></div> Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Detail Data -->
<?php foreach ($absensi->result() as $dtlAbs) { ?>
    <div class="modal fade" id="detail<?= $dtlAbs->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Detail Absensi</h4>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="50%">
                                        <center>Foto Masuk</center>
                                    </th>
                                    <th width="50%">
                                        <center>Foto Pulang</center>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><img src="<?= base_url('assets/gambar/') . $dtlAbs->fotoMasuk ?>" alt="" width="100%" class="img-responsive"></td>
                                    <td><img src="<?= base_url('assets/gambar/') . $dtlAbs->fotoPulang ?>" alt="" width="100%" class="img-responsive"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- Modal Filter Data -->
<div class="modal fade" id="filterData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Filter Absensi Karyawan</h4>
            </div>
            <form action="<?= base_url('index.php/admin/absensi/filter') ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Karyawan</label>
                        <select name="idUser" class="select2" style="width: 100%" required>
                            <option value="" selected disabled> -- Pilih Nama Karyawan -- </option>\
                            <?php foreach ($karyawan->result() as $dKrywn) { ?>
                                <option value="<?= $dKrywn->id ?>"><?= $dKrywn->username . ' - ' . $dKrywn->nama ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-danger">
                        <div class="fa fa-undo"></div> Reset
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <div class="fa fa-save"></div> Filter
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Filter Data -->
<div class="modal fade" id="rekapData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Rekap Absensi Karyawan</h4>
            </div>
            <form action="<?= base_url('index.php/admin/absensi/rekap') ?>" method="POST">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Shift</label>
                                <select name="idShift" class="form-control" style="width: 100%" required>
                                    <option value="" selected disabled> -- Pilih Nama Shift -- </option>
                                    <option value="Semua">Semua</option>
                                    <?php foreach ($shift->result() as $dvSft) { ?>
                                        <option value="<?= $dvSft->id ?>"><?= $dvSft->shift ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label for="">Jenis</label>
                            <select name="jenis" class="form-control" id="">
                                <option value=""> -- Pilih Jenis -- </option>
                                <option value="masuk">Masuk</option>
                                <option value="pulang">Pulang</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Dari Tanggal</label>
                                <input type="date" name="dariTanggal" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Sampai Tanggal</label>
                                <input type="date" name="sampaiTanggal" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-danger">
                        <div class="fa fa-undo"></div> Reset
                    </button>
                    <button type="submit" name="btnExcel" class="btn btn-success">
                        <div class="fa fa-file-excel-o"></div> Excel
                    </button>
                    <button type="submit" name="btnPrint" class="btn btn-primary">
                        <div class="fa fa-print"></div> Print
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>