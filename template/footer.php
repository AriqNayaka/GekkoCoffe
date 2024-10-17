</div>


<div class=" modal fade" id="keranjang" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container-fluid">
                    <h2 style="text-align: center;">KERANJANG ANDA</h2>
                    <?php if (!empty($_SESSION["cart"])) { ?>
                        <?php $total = 0;
                        $i = 1;
                        foreach ($_SESSION["cart"] as $row) {
                            $id = $row["id"];
                            $total = $total + $row["subtotal"] ?>
                            <div style="width: 100%; height: max-content; display: flex; flex-direction: row;">
                                <img src="gambar/<?= $row["gambar"] ?>" style="width: 100px; height: 100px;" class="rounded mt-2" alt="" srcset="">
                                <div style="width: 100%; margin-top: 10px; height: max-content; display: flex; flex-direction: column;" class="mx-2">
                                    <a style="font-weight: bold; font-size: small;"><?= $row["produk"] ?></a>
                                    <a style="font-size: small;">Jenis : <?= $row["jenis"] ?></a>
                                    <a style="font-size: small;">Harga : Rp.<?= $row["harga"] ?></a>
                                    <a style="font-size: small;">Jumlah : <?= $row["jumlah"] ?></a>
                                    <a style="font-size: small;">Subtotal : Rp.<?= $row["subtotal"] ?></a>
                                </div>
                                <div style="margin-right: 20px; width: 20%; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                                    <button class="btn btn-danger" onclick="document.location.href='proses.php?action=hapusKeranjang&idKeranjang=<?= $id ?>'">Hapus</button>
                                </div>
                            </div>
                        <?php } ?>
                        <?php
                        $diskon = 0;
                        if ($total > 50000) {
                            $diskon = 5000;
                        }
                        ?>

                        <?php
                        $pajak = $total * 0.05;
                        $total = $total + $pajak;
                        $total = $total + 5000; ?>

                        <br>
                        <form action="proses.php?action=tambahTransaksi" method="post">

                            <div style="width: 100%; height: max-content; display: flex; justify-content: center; align-items: center; flex-direction: column;">
                                <div style="width: 100%; height: max-content; background-color: lightgray; display: flex; flex-direction: row; justify-content: space-between; padding-right: 10px; padding-left: 10px;" class="mt-3 rounded">
                                    <a style="font-weight: bold;">Diskon</a>
                                    <a style="font-weight: bold;">Rp.<?= $diskon ?></a>
                                </div>
                                <div style="width: 100%; height: max-content; background-color: lightgray; display: flex; flex-direction: row; justify-content: space-between; padding-right: 10px; padding-left: 10px;" class="mt-1 rounded">
                                    <a style="font-weight: bold;">Pajak</a>
                                    <a style="font-weight: bold;">Rp.<?= $pajak ?></a>
                                </div>
                                <div style="width: 100%; height: max-content; background-color: lightgray; display: flex; flex-direction: row; justify-content: space-between; padding-right: 10px; padding-left: 10px;" class="mt-1 rounded">
                                    <a style="font-weight: bold;">Service</a>
                                    <a style="font-weight: bold;">Rp.5000</a>
                                </div>
                                <div style="width: 100%; height: max-content; background-color: lightgray; display: flex; flex-direction: row; justify-content: space-between; padding-right: 10px; padding-left: 10px;" class="mt-1 rounded">
                                    <a style="font-weight: bold;">Total</a>
                                    <a style="font-weight: bold;">Rp.<?= $total ?></a>
                                </div>
                                <div style="width: 100%; height: max-content; background-color: lightgray; display: flex; flex-direction: row; justify-content: space-between; padding-right: 10px; padding-left: 10px;" class="mt-1 rounded">
                                    <a style="font-weight: bold;">Bayar</a>
                                    <a style="font-weight: bold;"><input style="outline: none; border: none; width: 100%; height: 20px; text-align: end; font-weight: bold;" class="rounded" type="num" name="bayar"></a>
                                </div>
                                <input type="num" name="total" value="<?= $total ?>" hidden>
                                <input type="num" name="diskon" value="<?= $diskon ?>" hidden>
                                <div style="width: 100%; background-color: lightgray; display: flex; flex-direction: row; justify-content: space-between;" class="mt-1 rounded">
                                    <button class="btn btn-success" style="width: 100%;">BAYAR</a>
                                </div>
                            </div>

                        </form>
                    <?php } else { ?>
                        <h4 style="text-align: center;">Belum ada keranjang</h4>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="nota" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container-fluid">
                    <h2 style="text-align: center;">History</h2>
                    <?php $transaksi = $db->showTransaksi("SELECT `tabel_transaksi`.`id`, `tabel_transaksi`.`id_operator`, `tabel_user`.`username`, `tabel_transaksi`.`diskon`, `tabel_transaksi`.`total`, `tabel_transaksi`.`bayar`, `tabel_transaksi`.`tanggal`, `tabel_transaksi`.`status`
        FROM `tabel_transaksi` 
        LEFT JOIN `tabel_user` ON `tabel_transaksi`.`id_user` = `tabel_user`.`id` WHERE tabel_user.username = '" . $_SESSION["user"]["username"] . "' AND tabel_transaksi.status = 'DONE' ");
                    foreach ($transaksi as $row) {
                        $id = $row["id"] ?>

                        <div style="outline: 2px solid lightgray; background-color: lightcyan; padding: 10px; width: 100%; height: max-content; display: flex; flex-direction: column;" class="rounded mb-4">
                            <div style="width: 100%; height: max-content; display: flex; flex-direction: column;" class="">
                                <div style="width: 100%; height: max-content; display: flex; flex-direction: row; justify-content: space-between; padding-right: 10px; padding-left: 10px;" class="mt-2 rounded bg-white">
                                    <a style="font-weight: bold;">No transaksi</a>
                                    <a style="font-weight: bold;"><?= $row["id"] ?></a>
                                </div>
                                <div style="width: 100%; height: max-content; display: flex; flex-direction: row; justify-content: space-between; padding-right: 10px; padding-left: 10px;" class="mt-2 rounded bg-white">
                                    <a style="font-weight: bold;">Cashier</a>
                                    <a style="font-weight: bold;"><?= $row["id_operator"] ?></a>
                                </div>
                                <div style="width: 100%; height: max-content; display: flex; flex-direction: row; justify-content: space-between; padding-right: 10px; padding-left: 10px;" class="mt-2 rounded bg-white">
                                    <a style="font-weight: bold;">Date</a>
                                    <a style="font-weight: bold;"><?= $row["tanggal"] ?></a>
                                </div>
                                <div style="width: 100%; height: max-content; display: flex; flex-direction: row; justify-content: space-between; padding-right: 10px; padding-left: 10px;" class="mt-2 rounded bg-white">
                                    <a style="font-weight: bold;">Diskon</a>
                                    <a style="font-weight: bold;"><?= $row["diskon"] ?></a>
                                </div>
                                <div style="width: 100%; height: max-content; display: flex; flex-direction: row; justify-content: space-between; padding-right: 10px; padding-left: 10px;" class="mt-2 rounded bg-white">
                                    <a style="font-weight: bold;">Service</a>
                                    <a style="font-weight: bold;">Rp.5000</a>
                                </div>
                                <div style="width: 100%; height: max-content; display: flex; flex-direction: row; justify-content: space-between; padding-right: 10px; padding-left: 10px;" class="mt-2 rounded bg-white">
                                    <a style="font-weight: bold;">Pajak</a>
                                    <a style="font-weight: bold;">10%</a>
                                </div>
                                <div style="width: 100%; height: max-content; display: flex; flex-direction: row; justify-content: space-between; padding-right: 10px; padding-left: 10px;" class="mt-2 rounded bg-white">
                                    <a style="font-weight: bold;">Total</a>
                                    <a style="font-weight: bold;">Rp.<?= $row["total"] ?></a>
                                </div>
                                <div style="width: 100%; height: max-content; display: flex; flex-direction: row; justify-content: space-between; padding-right: 10px; padding-left: 10px;" class="mt-2 rounded bg-white">
                                    <a style="font-weight: bold;">Bayar</a>
                                    <a style="font-weight: bold;">Rp.<?= $row["bayar"] ?></a>
                                </div>
                                <div style="width: 100%; height: max-content; display: flex; flex-direction: row; justify-content: space-between; padding-right: 10px; padding-left: 10px;" class="mt-2 rounded bg-white">
                                    <a style="font-weight: bold;">Kembali</a>
                                    <a style="font-weight: bold;">Rp.<?= $kembali = $row["bayar"] - $row["total"] ?></a>
                                </div>
                                <button style="width: 100%;" class="mt-2 btn btn-primary" data-bs-toggle="modal" data-bs-target="#detail<?= $row['id'] ?>">Detail</button>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $transaksi = $db->showTransaksi("SELECT `tabel_transaksi`.`id`, `tabel_transaksi`.`id_operator`, `tabel_user`.`username`, `tabel_transaksi`.`diskon`, `tabel_transaksi`.`total`, `tabel_transaksi`.`bayar`, `tabel_transaksi`.`tanggal`, `tabel_transaksi`.`status`
        FROM `tabel_transaksi` 
        LEFT JOIN `tabel_user` ON `tabel_transaksi`.`id_user` = `tabel_user`.`id` WHERE tabel_user.username = '" . $_SESSION["user"]["username"] . "' AND tabel_transaksi.status = 'DONE' ");
foreach ($transaksi as $row) {
    $id = $row["id"] ?>
    <div class="modal fade" id="detail<?= $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h2 style="text-align: center;">Detail</h2>
                    <?php $produk = $db->showDetailTransaksi("SELECT `detail_transaksi`.`id`, `detail_transaksi`.`id_transaksi`, `tabel_produk`.`produk`, `detail_transaksi`.`harga`, `detail_transaksi`.`jumlah`, `detail_transaksi`.`subtotal`, `tabel_produk`.`gambar`
FROM `detail_transaksi` 
	LEFT JOIN `tabel_produk` ON `detail_transaksi`.`id_produk` = `tabel_produk`.`id` WHERE detail_transaksi.id_transaksi = '$id'");
                    foreach ($produk as $data) { ?>

                        <div style="width: 100%; height: max-content; display: flex; flex-direction: row;">
                            <img src="gambar/<?= $data["gambar"] ?>" style="width: 100px; height: 100px;" class="rounded mt-2" alt="" srcset="">
                            <div style="width: 100%; margin-top: 10px; height: max-content; display: flex; flex-direction: column;" class="mx-2">
                                <a style="font-weight: bold; font-size: small;"><?= $data["produk"] ?></a>
                                <a style="font-size: small;">Jumlah : <?= $data["jumlah"] ?></a>
                                <a style="font-size: small;">Harga : Rp.<?= $data["harga"] ?></a>
                            </div>
                        </div>
                    <?php } ?>
                    <div style="width: 100%; display: flex; flex-direction: row;">
                        <a onclick="window.print();" style="width: 100%; margin-right: 3px;" class="mt-2 btn btn-primary">Print</a>
                        <a data-bs-toggle="modal" data-bs-target="#nota" style="width: 100%; margin-left: 3px;" class="mt-2 btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<div class="modal fade" id="ubahnama" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form action="proses.php?action=ubahNama" method="post">
                    <div style="display: flex; flex-direction: column;" class="container-fluid">
                        <h2 style="width: 100%; text-align: center;">UBAH NAMA</h2>
                        <input class="form-control" type="text" name="username" value="<?= $_SESSION['user']['username'] ?>">
                        <button class="btn btn-success mt-2">UBAH</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="keranjangAdmin" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container-fluid">
                    <h2 style="text-align: center;">KERANJANG ANDA</h2>
                    <?php if (!empty($_SESSION["cart"])) { ?>
                        <?php $total = 0;
                        $i = 1;
                        foreach ($_SESSION["cart"] as $row) {
                            $id = $row["id"];
                            $total = $total + $row["subtotal"] ?>
                            <div style="width: 100%; height: max-content; display: flex; flex-direction: row;">
                                <img src="gambar/<?= $row["gambar"] ?>" style="width: 100px; height: 100px;" class="rounded mt-2" alt="" srcset="">
                                <div style="width: 100%; margin-top: 10px; height: max-content; display: flex; flex-direction: column;" class="mx-2">
                                    <a style="font-weight: bold; font-size: small;"><?= $row["produk"] ?></a>
                                    <a style="font-size: small;">Jenis : <?= $row["jenis"] ?></a>
                                    <a style="font-size: small;">Harga : Rp.<?= $row["harga"] ?></a>
                                    <a style="font-size: small;">Jumlah : <?= $row["jumlah"] ?></a>
                                    <a style="font-size: small;">Subtotal : Rp.<?= $row["subtotal"] ?></a>
                                </div>
                                <div style="margin-right: 20px; width: 20%; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                                    <button class="btn btn-danger" onclick="document.location.href='proses.php?action=hapusKeranjang&idKeranjang=<?= $id ?>'">Hapus</button>
                                </div>
                            </div>
                        <?php } ?>
                        <?php
                        $diskon = 0;
                        if ($total > 50000) {
                            $diskon = 5000;
                        }
                        ?>

                        <?php
                        $pajak = $total * 0.05;
                        $total = $total + $pajak;
                        $total = $total + 5000; ?>

                        <br>
                        <form action="proses.php?action=tambahTransaksi" method="post">

                            <div style="width: 100%; height: max-content; display: flex; justify-content: center; align-items: center; flex-direction: column;">
                                <div style="width: 100%; height: max-content; background-color: lightgray; display: flex; flex-direction: row; justify-content: space-between; padding-right: 10px; padding-left: 10px;" class="mt-3 rounded">
                                    <a style="font-weight: bold;">Diskon</a>
                                    <a style="font-weight: bold;">Rp.<?= $diskon ?></a>
                                </div>
                                <div style="width: 100%; height: max-content; background-color: lightgray; display: flex; flex-direction: row; justify-content: space-between; padding-right: 10px; padding-left: 10px;" class="mt-1 rounded">
                                    <a style="font-weight: bold;">Pajak</a>
                                    <a style="font-weight: bold;">Rp.<?= $pajak ?></a>
                                </div>
                                <div style="width: 100%; height: max-content; background-color: lightgray; display: flex; flex-direction: row; justify-content: space-between; padding-right: 10px; padding-left: 10px;" class="mt-1 rounded">
                                    <a style="font-weight: bold;">Service</a>
                                    <a style="font-weight: bold;">Rp.5000</a>
                                </div>

                                <div style="width: 100%; height: max-content; background-color: lightgray; display: flex; flex-direction: row; justify-content: space-between; padding-right: 10px; padding-left: 10px;" class="mt-1 rounded">
                                    <a style="font-weight: bold;">Total</a>
                                    <a style="font-weight: bold;">Rp.<?= $total ?></a>
                                </div>
                                <div style="width: 100%; height: max-content; background-color: lightgray; display: flex; flex-direction: row; justify-content: space-between; padding-right: 10px; padding-left: 10px;" class="mt-1 rounded">
                                    <a style="font-weight: bold;">Bayar</a>
                                    <a style="font-weight: bold;"><input style="outline: none; border: none; width: 100%; height: 20px; text-align: end; font-weight: bold;" class="rounded" type="num" name="bayar"></a>
                                </div>
                                <div style="width: 100%; height: max-content; background-color: lightgray; display: flex; flex-direction: row; justify-content: space-between; padding-right: 10px; padding-left: 10px;" class="mt-1 rounded">
                                    <a style="font-weight: bold;">Username</a>
                                    <a style="font-weight: bold;"><input style="outline: none; border: none; width: 100%; height: 20px; text-align: start; font-weight: bold;" class="rounded" type="text" name="username"></a>
                                </div>
                                <input type="num" name="total" value="<?= $total ?>" hidden>
                                <input type="num" name="diskon" value="<?= $diskon ?>" hidden>
                                <div style="width: 100%; background-color: lightgray; display: flex; flex-direction: row; justify-content: space-between;" class="mt-1 rounded">
                                    <button name="admin" class="btn btn-success" style="width: 100%;">BAYAR</a>
                                </div>
                            </div>

                        </form>
                    <?php } else { ?>
                        <h4 style="text-align: center;">Belum ada keranjang</h4>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="riwayat" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container-fluid">
                    <div style="padding: 10px; background-color: #fff; width: 100%; height: max-content; display: flex; flex-wrap: wrap; flex-direction: column; justify-content: center;" class="rounded">
                        <h2>RIWAYAT</h2>
                        <table border="1">
                            <tr>
                                <th>NO. </th>
                                <th>TANGGAL</th>
                                <th>NAMA OPERATOR</th>
                                <th>AKTIVITAS</th>
                            </tr>
                            <?php
                            $log = $db->showLog();
                            $i = 1;
                            foreach ($log as $row) {
                                $id = $row["id"]; ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $row["tanggal"] ?></td>
                                    <td><?= $row["username"] ?></td>
                                    <td><?= $row["aktivitas"] ?></td>
                                </tr>
                            <?php $i++;
                            } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="laporan" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <div class="container-fluid">

                </div>
            </div>

        </div>
    </div>
</div>



<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#modalId">
    Launch
</button> -->

<!-- Modal -->
<div class="modal fade" id="modalId" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>


<footer style="width: 100%; height: 50px; display: flex; justify-content: center; align-items: center;" class="bg-white">
    <h5 class="text-dark">Created with <span style="color: red;">Love</span> By Ariq Nayaka</h5>
</footer>

<script src="bootstrap/bootstrap-5.3.2-dist/js/bootstrap.min.js" crossorigin="anonymous">
</script>

</body>

</html>