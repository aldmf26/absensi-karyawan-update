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
            <?php if($this->session->userdata('level') == 'Karyawan') { ?>
                <div class="box-header">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#tambahData">
                        <div class="fa fa-plus"></div> Tambah Data
                    </button>
                </div>
            <?php } ?>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped" id="dataTable">
                        <thead>
                            <tr>
                                <th width="10px">#</th>
                                <th>Karyawan</th>
                                <th>Waktu</th>
                                <th>Kegiatan</th>
                                <th>Masalah</th>
                                <th>Location</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                foreach ($kegiatan->result_array() as $row) {
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td>
                                        <?php
                                            $this->db->where('id', $row['idUser']);
                                            foreach ($this->db->get('tb_user')->result() as $dUsr) {
                                                echo $dUsr->nama;
                                            }
                                        ?>
                                    </td>
                                    <td><?= date('d F Y H:i:s', strtotime($row['terdaftar'])) ?></td>
                                    <td><?= $row['kegiatan'] ?></td>
                                    <td><?= $row['masalah'] ?></td>
                                    <td>
                                        <a href="<?= $row['lokasi'] ?>" class="btn btn-primary btn-xs" target="blank">
                                            <div class="fa fa-map-marker"></div> Lokasi
                                        </a>
                                    </td>
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

<!-- Modal Tambah Data -->
<div class="modal fade" id="tambahData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah <?= $title ?></h4>
            </div>
            <form action="<?= base_url('index.php/admin/kegiatan/insert') ?>" method="POST" enctype="multipart/form-data">
                <?php date_default_timezone_set('Asia/Jakarta') ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Foto</label>
                        <input type="file" name="foto" class="form-control-file" required>
                    </div>
                    <div class="form-group">
                        <label>Waktu</label>
                        <input type="datetime-local" name="waktu" class="form-control" value="<?= date('Y-m-d H:i:s') ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Kegiatan</label>
                        <input type="text" name="kegiatan" class="form-control" placeholder="Kegiatan" required>
                    </div>
                    <div class="form-group">
                        <label>Masalah</label>
                        <input type="text" name="masalah" class="form-control" placeholder="Masalah" required>
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
                    <button type="reset" class="btn btn-danger"><div class="fa fa-undo"></div> Reset</button>
                    <button type="submit" class="btn btn-primary"><div class="fa fa-save"></div> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Detail Data -->
<?php foreach ($kegiatan->result() as $dtlAbs) { ?>
    <div class="modal fade" id="detail<?= $dtlAbs->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Foto</h4>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="50%"><center>Foto Kegiatan</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><img src="<?= base_url('assets/gambar/').$dtlAbs->foto ?>" alt="" width="100%" class="img-responsive"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>