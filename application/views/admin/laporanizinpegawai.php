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
            <form class="form-horizontal" action="<?= base_url('index.php/admin/izinpegawai/exportexcel') ?>" method="POST">
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Dari Tanggal</label>

                        <div class="col-sm-10">
                            <input type="date" name="dariTanggal" class="form-control" placeholder="Dari Tanggal" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Sampai Tanggal</label>

                        <div class="col-sm-10">
                            <input type="date" name="sampaiTanggal" class="form-control" placeholder="Sampai Tanggal" required>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="pull-right">
                        <button type="reset" class="btn btn-danger">
                            <div class="fa fa-trash"></div> Reset
                        </button>
                        <button type="submit" class="btn btn-success">
                            <div class="fa fa-file-excel-o"></div> Export Excel
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>