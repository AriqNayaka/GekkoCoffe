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
    <link rel="stylesheet" href="bootstrap/bootstrap-5.3.2-dist/css/bootstrap.min.css">
</head>
<body>
    <h1>GEKKO COFFE</h1>

    <?php if($_SESSION["user"]["role"] == "CUSTOMER") {?>
    <table>
        <tr>
            <td><button onclick="document.location.href='logout.php'">LOGOUT</button></td>
            <td><button onclick="document.location.href='nota.php'">NOTA</button></td>
            <td><button onclick="document.location.href='home.php'">HOME</button></td>
        </tr>
    </table>
    <br>
    <h2>Produk</h2>
    <table border="1">
        <tr>
            <th>NO. </th>
            <th>PRODUK</th>
            <th>JENIS</th>
            <th>HARGA</th>
            <th>AKSI</th>
        </tr>
        <?php $i = 1; $produk = $db->showProduk();
        foreach($produk as $row){ ?>
        <tr>
            <td><?= $i ?></td>
            <td><?= $row["produk"] ?></td>
            <td><?= $row["jenis"] ?></td>
            <td><?= $row["harga"] ?></td>
            <td>
                <form action="proses.php?action=aksiKeranjang&idProduk=<?= $row['id'] ?>" method="post">
                    <table>
                        <tr>
                            <td>
                                <input type="num" name="jumlah" value="1">
                                <button>KERANJANG</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </td>
            <?php $i++;} ?>
        </tr>
    </table>
    <br>
    <?php if (isset($_SESSION["cart"])){ ?>
    <table>
         <tr>
            <th>NO. </th>
            <th>PRODUK</th>
            <th>JENIS</th>
            <th>HARGA</th>
            <th>JUMLAH</th>
            <th>SUBTOTAL</th>
            <th>AKSI</th>
        </tr>
        <?php $total = 0; $i = 1; foreach ($_SESSION["cart"] as $row) { $id = $row["id"]; $total = $total + $row["subtotal"] ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $row["produk"] ?></td>
                <td><?= $row["jenis"] ?></td>
                <td><?= $row["harga"] ?></td>
                <td><?= $row["jumlah"] ?></td>
                <td><?= $row["subtotal"] ?></td>
                <td><button onclick="document.location.href='proses.php?action=hapusKeranjang&idKeranjang=<?= $id ?>'">Hapus</button></td>
            </tr>
            <?php } ?>
            
    </table>
    <?php 
    $diskon = 0;
    if ($total > 50000){
        $diskon = 5000;
    }
    $total = $total + 5000;
    ?>
    <br>
    <form action="proses.php?action=tambahTransaksi" method="post">
        <table>
            <tr>
                <td>Diskon</td>
                <td> : </td>
                <td>Rp.<?= $diskon ?></td>
            </tr>
            <tr>
                <td>Jasa Service</td>
                <td>:</td>
                <td>Rp.5000</td>
            </tr>
            <tr>
                <td>Pajak</td>
                <td>:</td>
                <td>10%</td>
                <?php $total = $total * 1.10; ?>
            </tr>
            <tr>
                <td>Total</td>
                <td> : </td>
                <td>Rp.<?= $total ?></td>
            </tr>
            <tr>
                <td>Bayar</td>
                <td>:</td>
                <td><input type="num" name="bayar"></td>
            </tr>
            <input type="num" name="total" value="<?= $total ?>" hidden>
            <input type="num" name="diskon" value="<?= $diskon ?>" hidden>
            <tr>
                <td><button>BAYAR</button></td>
            </tr>
        </table>
    </form>
        <?php } ?>
    <?php } else if($_SESSION["user"]["role"] == "OPERATOR") { ?>
        <table>
            <tr>
                <td><button onclick="document.location.href='logout.php'">LOGOUT</button></td>
                <td><button onclick="document.location.href='home.php'">HOME</button></td>
            </tr>
        </table>
        <h3>GANTI NAMA</h3>
        <table>
            <tr>
                <td>
                    <form action="proses.php?action=ubahNama" method="post">
                        <input type="text" name="username" value="<?= $_SESSION['user']['username'] ?>">
                        <button>UBAH</button>
                    </form>
                </td>
            </tr>
        </table>

        <br><br><br>
        <table>
         <tr>
            <th>NO. </th>
            <th>USERNAME</th>
            <th>DISKON</th>
            <th>TOTAL</th>
            <th>BAYAR</th>
            <th>TANGGAL</th>
            <th>STATUS</th>
            <th>AKSI</th>
        </tr>
        <?php $transaksi = $db->showTransaksi("SELECT `tabel_transaksi`.`id`, `tabel_user`.`username`, `tabel_transaksi`.`diskon`, `tabel_transaksi`.`total`, `tabel_transaksi`.`bayar`, `tabel_transaksi`.`tanggal`, `tabel_transaksi`.`status`
FROM `tabel_transaksi` 
	LEFT JOIN `tabel_user` ON `tabel_transaksi`.`id_user` = `tabel_user`.`id` WHERE tabel_transaksi.status = 'ORDER'"); 
        $i = 1; foreach ($transaksi as $row) { $id = $row["id"] ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $row["username"] ?></td>
                <td><?= $row["diskon"] ?></td>
                <td><?= $row["total"] ?></td>
                <td><?= $row["bayar"] ?></td>
                <td><?= $row["tanggal"] ?></td>
                <td><?= $row["status"] ?></td>
                <td><button onclick="document.location.href='proses.php?action=accTransaksi&id=<?= $id ?>'">BERI NOTA</button></td>
            </tr>
            <?php $i++; } ?>

    </table>
    <br><br>

    <h3>CATATAN</h3>
    <table>
         <tr>
            <th>NO. </th>
            <th>USERNAME</th>
            <th>DISKON</th>
            <th>TOTAL</th>
            <th>BAYAR</th>
            <th>TANGGAL</th>
            <th>STATUS</th>
        </tr>
        <?php $transaksi = $db->showTransaksi("SELECT `tabel_transaksi`.`id`, `tabel_transaksi`.`id_operator`, `tabel_user`.`username`, `tabel_transaksi`.`diskon`, `tabel_transaksi`.`total`, `tabel_transaksi`.`bayar`, `tabel_transaksi`.`tanggal`, `tabel_transaksi`.`status`
FROM `tabel_transaksi` 
	LEFT JOIN `tabel_user` ON `tabel_transaksi`.`id_user` = `tabel_user`.`id` WHERE tabel_transaksi.id_operator = '" . $_SESSION["user"]["id"] . "' AND tabel_transaksi.status = 'DONE'"); 
        $i = 1; foreach ($transaksi as $row) { $id = $row["id"] ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $row["username"] ?></td>
                <td><?= $row["diskon"] ?></td>
                <td><?= $row["total"] ?></td>
                <td><?= $row["bayar"] ?></td>
                <td><?= $row["tanggal"] ?></td>
                <td><?= $row["status"] ?></td>
            </tr>
            <?php $i++; } ?>

    </table>

    <?php } else if($_SESSION["user"]["role"] == "ADMIN") { ?>
        <table>
            <tr>
                <td><button onclick="document.location.href='logout.php'">LOGOUT</button></td>
                <td><button onclick="document.location.href='nota.php'">NOTA</button></td>
                <td><button onclick="document.location.href='laporan.php'">LAPORAN</button></td>
                <td><button onclick="document.location.href='home.php'">HOME</button></td>
            </tr>
        </table>
    <br>
    <h2>Produk</h2>
    <table border="1">
        <tr>
            <th>NO. </th>
            <th>PRODUK</th>
            <th>JENIS</th>
            <th>HARGA</th>
            <th>AKSI</th>
        </tr>
        <?php $i = 1; $produk = $db->showProduk();
        foreach($produk as $row){ ?>
        <tr>
            <td><?= $i ?></td>
            <td><?= $row["produk"] ?></td>
            <td><?= $row["jenis"] ?></td>
            <td><?= $row["harga"] ?></td>
            <td>
                <form action="proses.php?action=aksiKeranjang&idProduk=<?= $row['id'] ?>" method="post">
                    <table>
                        <tr>
                            <td>
                                <input type="num" name="jumlah" value="1">
                                <button>KERANJANG</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </td>
            <?php $i++;} ?>
        </tr>
    </table>
    <br>
    <?php if (isset($_SESSION["cart"])){ ?>
    <table>
         <tr>
            <th>NO. </th>
            <th>PRODUK</th>
            <th>JENIS</th>
            <th>HARGA</th>
            <th>JUMLAH</th>
            <th>SUBTOTAL</th>
            <th>AKSI</th>
        </tr>
        <?php $total = 0; $i = 1; foreach ($_SESSION["cart"] as $row) { $id = $row["id"]; $total = $total + $row["subtotal"] ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $row["produk"] ?></td>
                <td><?= $row["jenis"] ?></td>
                <td><?= $row["harga"] ?></td>
                <td><?= $row["jumlah"] ?></td>
                <td><?= $row["subtotal"] ?></td>
                <td><button onclick="document.location.href='proses.php?action=hapusKeranjang&idKeranjang=<?= $id ?>'">Hapus</button></td>
            </tr>
            <?php } ?>
            
    </table>
    <?php 
    $diskon = 0;
    if ($total > 50000){
        $diskon = 5000;
    }
    $total = $total + 5000;
    ?>
    <br>
    <form action="proses.php?action=tambahTransaksi" method="post">
        <table>
            <tr>
                <td>Diskon</td>
                <td> : </td>
                <td>Rp.<?= $diskon ?></td>
            </tr>
            <tr>
                <td>Jasa Service</td>
                <td>:</td>
                <td>Rp.5000</td>
            </tr>
            <tr>
                <td>Pajak</td>
                <td>:</td>
                <td>10%</td>
                <?php $total = $total * 1.10; ?>
            </tr>
            <tr>
                <td>Total</td>
                <td> : </td>
                <td>Rp.<?= $total ?></td>
            </tr>
            <tr>
                <td>Bayar</td>
                <td>:</td>
                <td><input type="num" name="bayar"></td>
            </tr>
            <tr>
                <td>Username</td>
                <td>:</td>
                <td><input type="num" name="username"></td>
            </tr>
            <input type="num" name="total" value="<?= $total ?>" hidden>
            <input type="num" name="diskon" value="<?= $diskon ?>" hidden>
            <tr>
                <td><button name="admin">BAYAR</button></td>
            </tr>
        </table>
    </form>
        <?php } ?>
        <br><br>
        <br><br><br>
        
    <h2>LIST PRODUK</h2>
    <button onclick="document.location.href='form.php?action=tambahProduk'">TAMBAH</button>
    <br>
    <table border="1">
        <tr>
            <th>NO. </th>
            <th>PRODUK</th>
            <th>JENIS</th>
            <th>HARGA</th>
            <th>AKSI</th>
        </tr>
        <?php $i = 1; $produk = $db->showProduk();
        foreach($produk as $row){ $id = $row["id"]?>
        <tr>
            <td><?= $i ?></td>
            <td><?= $row["produk"] ?></td>
            <td><?= $row["jenis"] ?></td>
            <td><?= $row["harga"] ?></td>
            <td>
                <table>
                    <tr>
                        <td>
                            <button onclick="document.location.href='form.php?action=editProduk&id=<?= $id ?>'">EDIT</button>
                            <button onclick="document.location.href='proses.php?action=hapusProduk&id=<?= $id ?>'">HAPUS</button>
                        </td>
                    </tr>
                </table>
            </td>
            <?php $i++;} ?>
        </tr>
    </table>
    <br><br><br>
    <h2>LIST OPERATOR</h2>
    <button onclick="document.location.href='form.php?action=tambahOperator'">TAMBAH</button>
    <br>
    <table border="1">
        <tr>
            <th>NO. </th>
            <th>PRODUK</th>
            <th>AKSI</th>
        </tr>
        <?php $i = 1; $Operator = $db->showOperator();
        foreach($Operator as $row){ $id = $row["id"]?>
        <tr>
            <td><?= $i ?></td>
            <td><?= $row["username"] ?></td>
            <td>
                <table>
                    <tr>
                        <td>
                            <button onclick="document.location.href='form.php?action=editOperator&id=<?= $id ?>'">EDIT</button>
                            <button onclick="document.location.href='proses.php?action=hapusOperator&id=<?= $id ?>'">HAPUS</button>
                        </td>
                    </tr>
                </table>
            </td>
            <?php $i++;} ?>
        </tr>
    </table>
    <br><br><br>
    <h2>CATATAN TRANSAKSI</h2>
        <table>
            <tr>
                <td>
                    <form action="" method="post">
                        <input type="number" name="tanggal" placeholder="tanggal">
                        <button name="cari">Cari</button>
                    </form>
                </td>
            </tr>
            <tr>
                <td>
                    <form action="" method="post">
                        <input type="text" name="username" placeholder="operator">
                        <button name="operator">Cari</button>
                    </form>
                </td>
            </tr>
        </table>
        <table border="1">
         <tr>
            <th>NO. </th>
            <th>USERNAME</th>
            <th>CASHIER</th>
            <th>DISKON</th>
            <th>TOTAL</th>
            <th>BAYAR</th>
            <th>TANGGAL</th>
            <th>STATUS</th>
            <th>AKSI</th>
        </tr>
        <?php
        $transaksi = $db->showTransaksi("SELECT `tabel_transaksi`.`id`, `tabel_transaksi`.`id_user`, `tabel_transaksi`.`id_operator`, `tabel_transaksi`.`diskon`, `tabel_transaksi`.`total`, `tabel_transaksi`.`bayar`, `tabel_transaksi`.`tanggal`, `tabel_transaksi`.`status`
FROM `tabel_transaksi` 
	LEFT JOIN `tabel_user` ON `tabel_transaksi`.`id_operator` = `tabel_user`.`id` WHERE tabel_transaksi.status = 'DONE'"); 
    if (isset($_POST["cari"])){
        $query = $db->searchLaporanTanggal($_POST["tanggal"]);
        $transaksi = $db->showTransaksi($query);
    } else if (isset($_POST["operator"])){
        $query = $db->searchOperator($_POST["username"]);
        $transaksi = $db->showTransaksi($query);
    }
        $i = 1; foreach ($transaksi as $row) { $id = $row["id"];?>
            <tr>
                <td><?= $i ?></td>
                <td><?php $nama = $db->selectUserById($row["id_user"]); echo $nama["username"] ?></td>
                <td><?php $operator = $db->selectUserById($row["id_operator"]); echo $operator["username"] ?></td>
                <td><?= $row["diskon"] ?></td>
                <td><?= $row["total"] ?></td>
                <td><?= $row["bayar"] ?></td>
                <td><?= $row["tanggal"] ?></td>
                <td><?= $row["status"] ?></td>
                <td>
                    <button onclick="document.location.href='form.php?action=editTransaksi&id=<?= $id ?>'">EDIT</button>
                    <button onclick="document.location.href='proses.php?action=hapusTransaksi&id=<?= $id ?>'">HAPUS</button>
                </td>
            </tr>
            <?php $i++; } ?>
    </table>
    <br><br><br>
    <h2>CATATAN TRANSAKSI</h2>
        <table>
            <tr>
                <td>
                    <form action="" method="post">
                        <input type="number" name="tanggal" placeholder="tanggal">
                        <button name="cari">Cari</button>
                    </form>
                </td>
            </tr>
            <tr>
                <td>
                    <form action="" method="post">
                        <input type="text" name="username" placeholder="operator">
                        <button name="operator">Cari</button>
                    </form>
                </td>
            </tr>
        </table>
        <table border="1">
         <tr>
            <th>NO. </th>
            <th>TANGGAL</th>
            <th>NAMA OPERATOR</th>
            <th>AKTIVITAS</th>
        </tr>
        <?php
        $log = $db->showLog(); 
        $i = 1; foreach ($log as $row) { $id = $row["id"];?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $row["tanggal"] ?></td>
                <td><?= $row["username"] ?></td>
                <td><?= $row["aktivitas"] ?></td>
            </tr>
            <?php $i++; } ?>
    </table>
    <br><br><br>
    <?php } ?>

        
    </body>
    <script src="bootstrap/bootstrap-5.3.2-dist/js/bootstrap.min.js"></script>
    </html>