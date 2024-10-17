<?php
include 'connection.php';
$query = mysqli_query($con, "SELECT `tabel_transaksi`.`id`, `tabel_user`.`username`, `tabel_transaksi`.`diskon`, `tabel_transaksi`.`total`, `tabel_transaksi`.`bayar`, `tabel_transaksi`.`tanggal`, `tabel_transaksi`.`status`
    FROM `tabel_transaksi` 
        LEFT JOIN `tabel_user` ON `tabel_transaksi`.`id_user` = `tabel_user`.`id` WHERE tabel_transaksi.status != 'DELETE'");
$json = array();

while ($row = mysqli_fetch_assoc($query)) {
    $json[] = $row;
}
echo json_encode($json);
mysqli_close($con);
