<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <?= $title ?>
            <small><?= $subtitle ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('index.php/admin/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><?= $title ?></li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
                <button class="btn btn-primary" data-toggle="modal" data-target="#tambahData">
                    <div class="fa fa-plus"></div> Tambah Data
                </button>
                <a href="<?= base_url('index.php/admin/barang/exportexcel') ?>" class="btn btn-success">
                    <div class="fa fa-file-excel-o"></div> Export Excel
                </a>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="dataTable">
                        <thead>
                            <tr>
                                <th width="10px">#</th>
                                <th>Nama Barang</th>
                                <th>Stok</th>
                                <th>Satuan</th>
                                <th>Harga Satuan</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                foreach ($barang->result_array() as $row) {
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row['nama'] ?></td>
                                    <td><?= $row['stok'] ?></td>
                                    <td><?= $row['satuan'] ?></td>
                                    <td>Rp <?= number_format($row['harga'],0,',','.') ?></td>
                                    <td><?= $row['keterangan'] ?></td>
                                    <td>
                                        <button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#editData<?= $row['id'] ?>">
                                            <div class="fa fa-edit"></div> Edit
                                        </button>
                                        <a href="<?= base_url('index.php/admin/barang/delete/').$row['id'] ?>" class="btn btn-danger btn-xs tombol-yakin" data-isidata="Ingin menghapus data barang ini?">
                                            <div class="fa fa-trash"></div> Delete
                                        </a>
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

<!-- Modal Tambah Data -->
<div class="modal fade" id="tambahData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah Barang</h4>
            </div>
            <form action="<?= base_url('index.php/admin/barang/insert') ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" name="nama" class="form-control" placeholder="Nama Barang" required>
                    </div>
                    <div class="form-group">
                        <label>Stok</label>
                        <input type="number" name="stok" class="form-control" placeholder="Stok" required>
                    </div>
                    <div class="form-group">
                        <label>Satuan</label>
                        <input type="text" name="satuan" class="form-control" placeholder="Satuan" required>
                    </div>
                    <div class="form-group">
                        <label>Harga Satuan</label>
                        <input type="number" name="harga" class="form-control" placeholder="Harga Satuan" required>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <input type="text" name="keterangan" class="form-control" placeholder="Keterangan">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-danger"><div class="fa fa-trash"></div> Reset</button>
                    <button type="submit" class="btn btn-primary"><div class="fa fa-save"></div> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Data -->
<?php foreach ($barang->result() as $eBrg) { ?>
    <div class="modal fade" id="editData<?= $eBrg->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit Barang</h4>
                </div>
                <form action="<?= base_url('index.php/admin/barang/update/').$eBrg->id ?>" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Barang</label>
                            <input type="text" name="nama" class="form-control" value="<?= $eBrg->nama; ?>" placeholder="Nama Barang" required>
                        </div>
                        <div class="form-group">
                            <label>Stok</label>
                            <input type="number" name="stok" class="form-control" value="<?= $eBrg->stok; ?>" placeholder="Stok" required>
                        </div>
                        <div class="form-group">
                            <label>Satuan</label>
                            <input type="text" name="satuan" class="form-control" value="<?= $eBrg->satuan; ?>" placeholder="Satuan" required>
                        </div>
                        <div class="form-group">
                            <label>Harga Satuan</label>
                            <input type="number" name="harga" class="form-control" value="<?= $eBrg->harga; ?>" placeholder="Harga Satuan" required>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" name="keterangan" class="form-control" value="<?= $eBrg->keterangan; ?>" placeholder="Keterangan">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-danger"><div class="fa fa-trash"></div> Reset</button>
                        <button type="submit" class="btn btn-primary"><div class="fa fa-save"></div> Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>