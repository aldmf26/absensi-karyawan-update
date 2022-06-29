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

        <div class="row">
            <div class="col-lg-6 col-xs-12">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>
                            Absen Masuk
                        </h3>

                        <p>

                        </p>
                    </div>
                    <div class="icon">
                        <div class="fa fa-sign-in"></div>
                    </div>

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