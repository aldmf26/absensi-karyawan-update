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
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="dataTable">
                        <thead>
                            <tr>
                                <th width="10px">#</th>
                                <th width="10px">Foto</th>
                                <th>Nama Lengkap</th>
                                <th>Level</th>
                                <th>Gaji Pokok</th>
                                <th>Potongan (<?= date('F Y') ?>)</th>
                                <th>Sisa Gaji (<?= date('F Y') ?>)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                foreach ($user->result_array() as $row) {
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><img src="<?= base_url('assets/profil/').$row['foto'] ?>" class="img-responsive" width="100%"></td>
                                    <td><?= $row['nama'] ?></td>
                                    <td><?= $row['level'] ?></td>
                                    <td>Rp. 3.500.000</td>
                                    <td>
                                        <?php
                                            $this->db->where('idUser', $row['id']);
                                            $this->db->where('jenis', 'Izin');
                                            $this->db->where('MONTH(tanggal)', date('m'));
                                            $this->db->where('YEAR(tanggal)', date('Y'));
                                            $jumlahIjin = $this->db->get('tb_absensi')->num_rows();
                                            $potongan   = $jumlahIjin * 50000;
                                            echo 'Rp. ' . number_format($potongan,0,',','.');
                                        ?>
                                    </td>
                                    <td><?= 'Rp. ' . number_format(3500000 - $potongan,0,',','.'); ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>