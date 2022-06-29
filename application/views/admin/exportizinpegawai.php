<?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Data Izin Pegawai.xls");
?>

<table>
    <tr>
        <th width="10px">#</th>
        <th>Shift</th>
        <th>Jenis</th>
        <th>Nama Karyawan</th>
        <th>Tanggal</th>
        <th>Jam Masuk</th>
        <th>URL Masuk</th>
        <th>Catatan</th>
    </tr>
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
            <td><?= $row['urlMasuk'] ?> </td>
            <td><?= $row['catatan'] ?></td>
        </tr>
    <?php } ?>
</table>