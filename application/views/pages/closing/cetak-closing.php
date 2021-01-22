<?php
    function rupiah($angka){           
        $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
        return $hasil_rupiah;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Closing</title>
</head>
<body>
    <table border=1>
        <thead>
            <tr>
                <th><center>No</center></th>
                <th><center>Tgl</center></th>
                <th><center>Nama</center></th>
                <th><center>TTL</center></th>
                <th><center>Alamat</center></th>
                <th><center>Program</center></th>
                <th><center>No. Wa</center></th>
                <th><center>Biaya</center></th>
                <th><center>Sumber Closing</center></th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $i = 1;
                foreach ($closing as $data) :?>
                <tr>
                    <td><center><?= $i?></center></td>
                    <td><?= $data['tgl_closing']?></td>
                    <td><?= $data['nama']?></td>
                    <td><?= $data['t4_lahir'].", ".date("d-m-Y", strtotime($data['tgl_lahir']))?></td>
                    <td><?= $data['alamat']?></td>
                    <td><?= $data['program']?></td>
                    <td>'<?= $data['no_wa']?></td>
                    <td><?= rupiah($data['biaya'])?></td>
                    <td><?= $data['sumber']?></td>
                </tr>
            <?php 
                $i++;
                endforeach;?>
        </tbody>
    </table>
</body>
</html>