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
    <h1>LAPORAN</h1>
    <table>
            <tr>
                <td><button onclick="document.location.href='logout.php'">LOGOUT</button></td>
                <td><button onclick="document.location.href='nota.php'">NOTA</button></td>
                <td><button onclick="document.location.href='laporan.php'">LAPORAN</button></td>
                <td><button onclick="document.location.href='home.php'">HOME</button></td>
            </tr>
        </table>
    <table>
        <tr>
            <td>
                <form action="" method="post">
                    <input type="number" name="tanggal" placeholder="tanggal">
                    <button name="cari">Cari</button>
                </form>
            </td>
            <td>
                <form action="" method="post">
                    <select name="bulan" id="">
                        <option selected> --Pilih Bulan</option>
                        <option value="January">January</option>
                        <option value="February">February</option>
                        <option value="March">March</option>
                        <option value="April">April</option>
                        <option value="May">May</option>
                        <option value="June">June</option>
                        <option value="July">July</option>
                        <option value="August">August</option>
                        <option value="September">September</option>
                        <option value="Oktober">Oktober</option>
                        <option value="November">November</option>
                        <option value="December">December</option>
                    </select>
                    <button name="cariBulan">Cari</button>
                </form>
            </td>
        </tr>
        <tr>
            <th>Total</td>
            <th>Tanggal</td>
        </tr>
        <?php $total = 0; 
        $transaksi = $db->showTransaksi("SELECT * FROM tabel_transaksi WHERE status = 'DONE'");
        if (isset($_POST["cari"])){
            $query = $db->searchLaporanTanggal($_POST["tanggal"]);
            $transaksi = $db->showTransaksi($query);
        } else if (isset($_POST["cariBulan"])){
            $query = $db->searchLaporanBulan($_POST["bulan"]);
            $transaksi = $db->showTransaksi($query);
        }
        foreach($transaksi as $row ){ $total = $total + $row["bayar"]; ?>
            <tr>
                <td><?= $row["bayar"] ?></td>
                <td><?= $row["tanggal"] ?></td>
            </tr>
        <?php } ?>
        <tr>
            <td>Total : <?= $total ?></td>
        </tr>
    </table>
</body>
</html>