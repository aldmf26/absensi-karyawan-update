<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Rekap Absensi Karyawan</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    <?php
    date_default_timezone_set('Asia/Jakarta');
    ?>
</head>

<body>
    <div class="container">
        <center>
            <img src="http://localhost/absensi-karyawan/assets/gambar/logo2.png" alt="" class="img-responsive" width="50%" style="margin-bottom: 15px">
        </center>
        <h3>
            <center><b>REKAP ABSENSI KARYAWAN</b></center>
        </h3>

        <table>
            <tr>
                <td width="100px">Shift</td>
                <td width="10px">:</td>
                <td>
                    <?php
                    if ($idShift == 'Semua') {
                        echo 'Semua';
                    } else {
                        $this->db->where('id', $idShift);
                        foreach ($this->db->get('tb_shift')->result() as $sft) {
                            echo $sft->shift;
                        }
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>:</td>
                <td>
                    <?php
                    if ($tglAwal == $tglAkhir) {
                        echo date('d F Y', strtotime($tglAwal));
                    } else {
                        echo date('d F Y', strtotime($tglAwal)) . ' s/d ' . date('d F Y', strtotime($tglAkhir));
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td>Jumlah Absen</td>
                <td>:</td>
                <td><?= $absensi->num_rows() ?> Absensi</td>
            </tr>
        </table>

        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th width="10px">#</th>
                        <th>Shift</th>
                        <th>Nama Karyawan</th>
                        <th>Tanggal</th>
                        <th> <?= $jenis == 'masuk' ? 'Jam Masuk' : 'Jam Pulang' ?></th>
                        <th>Lama Kerja</th>
                        <th>Catatan</th>
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
                            <td>
                                <?php
                                $this->db->where('id', $row['idUser']);
                                foreach ($this->db->get('tb_user')->result() as $dUsr) {
                                    echo $dUsr->nama;
                                }
                                ?>
                            </td>
                            <td><?= date('d F Y', strtotime($row['tanggal'])) ?></td>
                            <?php if ($jenis == 'masuk') { ?>
                                <td><?= date('H:i:s', strtotime($row['jamMasuk'])) ?></td>
                            <?php } else { ?>
                                <td>
                                    <?php
                                    if ($row['jamPulang'] != '00:00:00') {
                                        echo date('H:i:s', strtotime($row['jamPulang']));
                                    } else {
                                        echo '<font color="red">Belum Absen</font>';
                                    }
                                    ?>
                                </td>
                            <?php } ?>

                            <td><?= date('H:i:s', strtotime($row['lama'])) ?></td>
                            <td><?= $row['catatan'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <font>
            <small><i><?= date('d F Y H:i:s') . ' - ' . $this->session->userdata('nama') ?></i></small>
        </font>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script>
        window.print();
    </script>
</body>

</html>