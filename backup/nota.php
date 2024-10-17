<?php 
session_start();
include("function.php");
$db = new database;
if ($_SESSION["login"] != true){
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GEKKO COFFE EXPRESS</title>
</head>
<body>
    <h1>NOTA</h1>
    <table>
        <tr>
            <td><button onclick="document.location.href='logout.php'">LOGOUT</button></td>
            <td><button onclick="document.location.href='nota.php'">NOTA</button></td>
            <td><button onclick="document.location.href='home.php'">HOME</button></td>
        </tr>
    </table>
    <?php $transaksi = $db->showTransaksi("SELECT `tabel_transaksi`.`id`, `tabel_transaksi`.`id_operator`, `tabel_user`.`username`, `tabel_transaksi`.`diskon`, `tabel_transaksi`.`total`, `tabel_transaksi`.`bayar`, `tabel_transaksi`.`tanggal`, `tabel_transaksi`.`status`
        FROM `tabel_transaksi` 
        LEFT JOIN `tabel_user` ON `tabel_transaksi`.`id_user` = `tabel_user`.`id` WHERE tabel_user.username = '" . $_SESSION["user"]["username"] . "' AND tabel_transaksi.status = 'DONE' ");
        foreach ($transaksi as $row) { $id = $row["id"]?>
        <br><br>
        <table border="0">
            <tr>
                <td colspan="3"><a>===================================================</a></td>
            </tr>
            <tr>
                <td colspan="3">GEKKO</td>
            </tr>
            <tr>
                <td colspan="3"><a>===================================================</a></td>
            </tr>
            <tr>
                <td>NO</td>
                <td>:</td>
                <td><?= $row["id"] ?></td>
            </tr>
            <tr>
                <td>CASHIER</td>
                <td>:</td>
                <td><?= $row["id_operator"] ?></td>
            </tr>
            <tr>
                <td>DATE</td>
                <td>:</td>
                <td><?= $row["tanggal"] ?></td>
            </tr>
            <tr>
                <td>CUSTOMER</td>
                <td>:</td>
                <td><?= $_SESSION["user"]["username"] ?></td>
            </tr>
            <tr>
                <td colspan="3"><a>===================================================</a></td>
            </tr>
            <?php $produk = $db->showDetailTransaksi("SELECT `detail_transaksi`.`id`, `detail_transaksi`.`id_transaksi`, `tabel_produk`.`produk`, `detail_transaksi`.`harga`, `detail_transaksi`.`jumlah`, `detail_transaksi`.`subtotal`
FROM `detail_transaksi` 
	LEFT JOIN `tabel_produk` ON `detail_transaksi`.`id_produk` = `tabel_produk`.`id` WHERE detail_transaksi.id_transaksi = '$id'"); 
    foreach($produk as $data) { ?>
            <tr>
                <td><?= $data["jumlah"] ?></td>    
                <td><?= $data["produk"] ?></td>    
                <td><?= $data["harga"] ?></td>    
            </tr>
            <!-- <tr>
                <td colspan="3"><?= $data["produk"] ?></td>    
            </tr>
            <tr>
                <td colspan="3"><?= $data["harga"] ?></td>
            </tr> -->
            <?php } ?>
            <tr>
                <td colspan="3"><a>===================================================</a></td>
            </tr>
            <tr>
                <td>DISKON</td>
                <td>:</td>
                <td><?= $row["diskon"] ?></td>
            </tr>
            <tr>
                <td>SERVICE</td>
                <td>:</td>
                <td>Rp.5000</td>
            </tr>
            <tr>
                <td>TAX</td>
                <td>:</td>
                <td>10%</td>
            </tr>
            <tr>
                <td>TOTAL</td>
                <td>:</td>
                <td>Rp.<?= $row["total"] ?></td>
            </tr>
            <tr>
                <td>BAYAR</td>
                <td>:</td>
                <td>Rp.<?= $row["bayar"] ?></td>
            </tr>
            <tr>
                <td>KEMBALI</td>
                <td>:</td>
                <?php $kembali = $row["bayar"] - $row["total"] ?>
                <td>Rp.<?= $kembali ?></td>
            </tr>
            <tr>
                <td colspan="3"><a>===================================================</a></td>
            </tr>
        </table>
        <br><br>
    <?php } ?>
</body>
</html>