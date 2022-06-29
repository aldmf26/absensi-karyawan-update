<?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Data Pegawai.xls");
?>

<table>
    <tr>
        <th width="10px">#</th>
        <th>Nama Lengkap</th>
        <th>Telp</th>
        <th>Email</th>
        <th>Sebagai</th>
        <th>Terdaftar</th>
    </tr>
    <?php
        $no = 1;
        foreach ($user->result_array() as $row) {
    ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['telp'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['level'] ?></td>
            <td><?= date('d F Y H:i', strtotime($row['terdaftar'])) ?></td>
        </tr>
    <?php } ?>
</table>