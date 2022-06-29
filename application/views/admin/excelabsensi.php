<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Export Data Absensi Karyawan.xls");
?>
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

<table>
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