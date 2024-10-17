<?php require_once "template/headrer.php" ?>


<!-- ----------------------------------------------------------------------------------------- -->
<h1 style="width: 100%; text-align: center;"><span class="text-primary">GEKKO</span> <span style="color: sienna;">COFFE</span></h1>

<?php if ($_SESSION["user"]["role"] == "CUSTOMER") { ?>
    <br>

    <div>

    </div>
    <h2>Produk</h2>
    <div style="padding: 10px; background-color: #fff; width: 100%; height: max-content; display: flex; flex-wrap: wrap; flex-direction: column;" class="rounded">
        <div style="display: flex; flex-direction: row; justify-content: space-evenly; ">
            <?php $i = 1;
            $produk = $db->showProduk();
            foreach ($produk as $row) {
                $id = $row["id"] ?>
                <div style="width: max-content; height: max-content; display: flex; flex-direction: column; align-items: center;" class="mx-2" data-bs-toggle="modal" data-bs-target="#notaModal<?= $id ?>">
                    <img class="rounded" src="gambar/<?= $row["gambar"] ?>" style="width: 150px; height: 150px;" alt="" srcset="">
                    <a style="text-align: center; width: 100%; font-weight: bold;"><?= $row["produk"] ?></a>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="notaModal<?= $id ?>" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <form action="proses.php?action=aksiKeranjang&idProduk=<?= $row['id'] ?>" method="post">
                                        <div style="width: 100%; height: max-content; display: flex; justify-content: center; align-items: center; flex-direction: column;">
                                            <h3 style="text-align: center; font-weight: bold;"><?= $row["produk"] ?></h3>
                                            <img src="gambar/<?= $row["gambar"] ?>" style="width: 300px; height: 300px;" class="rounded mt-2" alt="" srcset="">
                                            <div style="width: 100%; height: max-content; background-color: lightgray; display: flex; flex-direction: row; justify-content: space-between; padding-right: 10px; padding-left: 10px;" class="mt-3 rounded">
                                                <a style="font-weight: bold;">Harga</a>
                                                <a style="font-weight: bold;">Rp.<?= $row["harga"] ?></a>
                                            </div>
                                            <div style="display: flex; flex-direction: row; width: 100%;">
                                                <div style="margin-right: 3px; width: 100%; height: max-content; background-color: lightgray; display: flex; flex-direction: row; justify-content: space-between; padding-right: 10px; padding-left: 10px;" class="mt-1 rounded">
                                                    <a style="font-weight: bold;">Jenis</a>
                                                    <a style="font-weight: bold;"><?= $row["jenis"] ?></a>
                                                </div>
                                                <div style="margin-left: 3px; width: 100%; height: max-content; background-color: lightgray; display: flex; flex-direction: row; justify-content: space-between; padding-right: 10px; padding-left: 10px;" class="mt-1 rounded">
                                                    <a style="font-weight: bold;">Jumlah</a>
                                                    <a style="font-weight: bold;"><input style="outline: none; border: none; width: 20px; height: 20px; text-align: center; font-weight: bold;" class="rounded" type="num" name="jumlah" value="1"></a>
                                                </div>
                                            </div>
                                            <div style="width: 100%; background-color: lightgray; display: flex; flex-direction: row; justify-content: space-between;" class="mt-1 rounded">
                                                <button class="btn btn-success" style="width: 100%;">Keranjang</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php $i++;
            } ?>
        </div>
    </div>

<?php } else if ($_SESSION["user"]["role"] == "OPERATOR") { ?>

    <div style="padding-bottom: 15px; width: 100%; height: max-content; background-color: #fff; display: flex; flex-direction: column; align-items: center;" class="rounded mx-2">
        <h3 class="text-primary mt-1">LIST TRANSAKSI</h1>


            <?php $transaksi = $db->showTransaksi("SELECT `tabel_transaksi`.`id`, `tabel_user`.`username`, `tabel_transaksi`.`diskon`, `tabel_transaksi`.`total`, `tabel_transaksi`.`bayar`, `tabel_transaksi`.`tanggal`, `tabel_transaksi`.`status`
            FROM `tabel_transaksi` 
                LEFT JOIN `tabel_user` ON `tabel_transaksi`.`id_user` = `tabel_user`.`id` WHERE tabel_transaksi.status = 'ORDER'");
            $i = 1;
            foreach ($transaksi as $row) {
                $id = $row["id"] ?>
                <div style="background-color: lightgray; width: 50%; height: max-content; display: flex; justify-content: space-between; align-items: center; padding-top: 10px; padding-bottom: 10px; padding: 10px;" class="mb-3 rounded">
                    <div style="display: flex; flex-direction: row;">
                        <div style="font-weight: bold;" class="mx-1"><?= $i ?></div>
                        <div style="font-weight: bold" class="mx-1"><?= $row["username"] ?></div>
                        <div style="font-weight: bold" class="mx-1">Total : Rp.<?= $row["total"] ?></div>
                        <div style="font-weight: bold" class="mx-1">Bayar : Rp.<?= $row["bayar"] ?></div>
                    </div>
                    <div style="font-weight: bold" class="mx-1"><a class="btn btn-success" onclick="document.location.href='proses.php?action=accTransaksi&id=<?= $id ?>'">BERI NOTA</a></div>
                </div>
            <?php $i++;
            } ?>
    </div>
    <br><br>
    <div style="padding-bottom: 15px; width: 100%; height: max-content; background-color: #fff; display: flex; flex-direction: column; align-items: center;" class="rounded mx-2">
        <h3 class="text-primary mt-1">TRANSAKSI SAYA</h1>
            <?php $transaksi = $db->showTransaksi("SELECT `tabel_transaksi`.`id`, `tabel_transaksi`.`id_operator`, `tabel_user`.`username`, `tabel_transaksi`.`diskon`, `tabel_transaksi`.`total`, `tabel_transaksi`.`bayar`, `tabel_transaksi`.`tanggal`, `tabel_transaksi`.`status`
FROM `tabel_transaksi` 
	LEFT JOIN `tabel_user` ON `tabel_transaksi`.`id_user` = `tabel_user`.`id` WHERE tabel_transaksi.id_operator = '" . $_SESSION["user"]["id"] . "' AND tabel_transaksi.status = 'DONE'");
            $i = 1;
            foreach ($transaksi as $row) {
                $id = $row["id"] ?>
                <div style="background-color: lightgray; width: 50%; height: max-content; display: flex; justify-content: center; align-items: center; padding-top: 10px; padding-bottom: 10px;" class="mb-3 rounded">
                    <div style="font-weight: bold;" class="mx-1"><?= $i ?></div>
                    <div style="font-weight: bold" class="mx-1"><?= $row["username"] ?></div>
                    <div style="font-weight: bold" class="mx-1"><?= $row["tanggal"] ?></div>
                    <div style="font-weight: bold" class="mx-1">Total : Rp.<?= $row["total"] ?></div>
                    <div style="font-weight: bold" class="mx-1">Bayar : Rp.<?= $row["bayar"] ?></div>
                </div>
            <?php $i++;
            } ?>
    </div>

<?php } else if ($_SESSION["user"]["role"] == "ADMIN") { ?>

    <h2>Produk</h2>
    <div style="padding: 10px; background-color: #fff; width: 100%; height: max-content; display: flex; flex-wrap: wrap; flex-direction: column;" class="rounded">
        <div style="display: flex; flex-direction: row; justify-content: space-evenly; ">
            <?php $i = 1;
            $produk = $db->showProduk();
            foreach ($produk as $row) {
                $id = $row["id"] ?>
                <div style="width: max-content; height: max-content; display: flex; flex-direction: column; align-items: center;" class="mx-2" data-bs-toggle="modal" data-bs-target="#notaModal<?= $id ?>">
                    <img class="rounded" src="gambar/<?= $row["gambar"] ?>" style="width: 150px; height: 150px;" alt="" srcset="">
                    <a style="text-align: center; width: 100%; font-weight: bold;"><?= $row["produk"] ?></a>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="notaModal<?= $id ?>" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <form action="proses.php?action=aksiKeranjang&idProduk=<?= $row['id'] ?>" method="post">
                                        <div style="width: 100%; height: max-content; display: flex; justify-content: center; align-items: center; flex-direction: column;">
                                            <h3 style="text-align: center; font-weight: bold;"><?= $row["produk"] ?></h3>
                                            <img src="gambar/<?= $row["gambar"] ?>" style="width: 300px; height: 300px;" class="rounded mt-2" alt="" srcset="">
                                            <div style="width: 100%; height: max-content; background-color: lightgray; display: flex; flex-direction: row; justify-content: space-between; padding-right: 10px; padding-left: 10px;" class="mt-3 rounded">
                                                <a style="font-weight: bold;">Harga</a>
                                                <a style="font-weight: bold;">Rp.<?= $row["harga"] ?></a>
                                            </div>
                                            <div style="display: flex; flex-direction: row; width: 100%;">
                                                <div style="margin-right: 3px; width: 100%; height: max-content; background-color: lightgray; display: flex; flex-direction: row; justify-content: space-between; padding-right: 10px; padding-left: 10px;" class="mt-1 rounded">
                                                    <a style="font-weight: bold;">Jenis</a>
                                                    <a style="font-weight: bold;"><?= $row["jenis"] ?></a>
                                                </div>
                                            </div>
                                            <div style="margin-left: 3px; width: 100%; height: max-content; background-color: lightgray; display: flex; flex-direction: row; justify-content: space-between; padding-right: 10px; padding-left: 10px;" class="mt-1 rounded">
                                                <a style="font-weight: bold;">Jumlah</a>
                                                <a style="font-weight: bold;"><input style="outline: none; border: none; width: 20px; height: 20px; text-align: center; font-weight: bold;" class="rounded" type="num" name="jumlah" value="1"></a>
                                            </div>
                                            <div style="width: 100%; background-color: lightgray; display: flex; flex-direction: row; justify-content: space-between;" class="mt-1 rounded">
                                                <button class="btn btn-success" style="width: 100%;">Keranjang</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php $i++;
            } ?>
        </div>
    </div>

    <div style="display: flex; flex-direction: row;" class="mt-3">
        <h2 class="mt-3">List Produk</h2>
        <button type="button" class="mx-2 btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#tambahProduk">Tambah</button>
    </div>

    <div class="modal fade" id="tambahProduk" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="proses.php?action=tambahProduk" method="post">
                            <div style="width: 100%; height: max-content; display: flex; justify-content: center; align-items: center; flex-direction: column;">
                                <h3 style="text-align: center; font-weight: bold;"><?= $row["produk"] ?></h3>
                                <div style="width: 100%; height: max-content; background-color: lightgray; display: flex; flex-direction: column; padding-right: 10px; padding-left: 10px; padding-bottom: 5px;" class="mt-3 rounded">
                                    <a style="font-weight: bold;">Gambar</a>
                                    <input style="outline: none; border: none; width: 100%;text-align: start; font-weight: bold;" class="rounded form-control" type="file" name="gambar">
                                </div>
                                <div style="width: 100%; height: max-content; background-color: lightgray; display: flex; flex-direction: row; justify-content: space-between; padding-right: 10px; padding-left: 10px;" class="mt-1 rounded">
                                    <a style="font-weight: bold;">Produk</a>
                                    <a style="font-weight: bold;"><input style="outline: none; border: none; width: 100%; height: 20px; text-align: start; font-weight: bold;" class="rounded" type="text" name="produk"></a>
                                </div>
                                <div style="margin-left: 3px; width: 100%; height: max-content; background-color: lightgray; display: flex; flex-direction: row; justify-content: space-between; padding-right: 10px; padding-left: 10px;" class="mt-1 rounded">
                                    <a style="font-weight: bold;">Harga</a>
                                    <a style="font-weight: bold;"><input style="outline: none; border: none; width: 100%; height: 20px; text-align: end; font-weight: bold;" class="rounded" type="num" name="harga"></a>
                                </div>
                                <div style="display: flex; flex-direction: row; width: 100%;">
                                    <div style="width: 100%; height: max-content; background-color: lightgray; display: flex; flex-direction: row; justify-content: space-between; padding-right: 10px; padding-left: 10px; padding-top: 5px; padding-bottom: 5px;" class="mt-1 rounded">
                                        <a style="font-weight: bold;">Jenis</a>
                                        <a style="font-weight: bold;">
                                            <select style="outline: none; border: none; width: 100%; text-align: start; font-weight: bold;" class="rounded" name="jenis" id="">
                                                <option selected> --pilih jenis</option>
                                                <option value="MAKANAN">MAKANAN</option>
                                                <option value="MINUMAN">MINUMAN</option>
                                            </select>
                                        </a>
                                    </div>
                                </div>
                                <div style="width: 100%; background-color: lightgray; display: flex; flex-direction: row; justify-content: space-between;" class="mt-1 rounded">
                                    <button class="btn btn-success" style="width: 100%;">TAMBAH</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="padding: 10px; background-color: #fff; width: 100%; height: max-content; display: flex; flex-wrap: wrap; flex-direction: column;" class=" mt-3 rounded">
        <div style="display: flex; flex-direction: row; justify-content: space-evenly; ">
            <?php $i = 1;
            $produk = $db->showProduk();
            foreach ($produk as $row) {
                $id = $row["id"] ?>
                <div style="width: max-content; height: max-content; display: flex; flex-direction: column; align-items: center;" class="mx-2" data-bs-toggle="modal" data-bs-target="#editProduk<?= $id ?>">
                    <img class="rounded" src="gambar/<?= $row["gambar"] ?>" style="width: 150px; height: 150px;" alt="" srcset="">
                    <a style="text-align: center; width: 100%; font-weight: bold;"><?= $row["produk"] ?></a>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="editProduk<?= $id ?>" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <form action="proses.php?action=editProduk" method="post">
                                        <div style="width: 100%; height: max-content; display: flex; justify-content: center; align-items: center; flex-direction: column;">
                                            <h3 style="text-align: center; font-weight: bold;"><?= $row["produk"] ?></h3>
                                            <img src="gambar/<?= $row["gambar"] ?>" style="width: 300px; height: 300px;" class="rounded mt-2" alt="" srcset="">
                                            <div style="width: 100%; height: max-content; background-color: lightgray; display: flex; flex-direction: column; padding-right: 10px; padding-left: 10px; padding-bottom: 5px;" class="mt-3 rounded">
                                                <a style="font-weight: bold;">Gambar</a>
                                                <input style="outline: none; border: none; width: 100%;text-align: start; font-weight: bold;" class="rounded form-control" type="file" name="gambar">
                                            </div>
                                            <div style="width: 100%; height: max-content; background-color: lightgray; display: flex; flex-direction: row; justify-content: space-between; padding-right: 10px; padding-left: 10px;" class="mt-1 rounded">
                                                <a style="font-weight: bold;">Produk</a>
                                                <a style="font-weight: bold;"><input style="outline: none; border: none; width: 100%; height: 20px; text-align: start; font-weight: bold;" class="rounded" type="text" name="produk" value="<?= $row['produk'] ?>"></a>
                                            </div>
                                            <div style="margin-left: 3px; width: 100%; height: max-content; background-color: lightgray; display: flex; flex-direction: row; justify-content: space-between; padding-right: 10px; padding-left: 10px;" class="mt-1 rounded">
                                                <a style="font-weight: bold;">Harga</a>
                                                <a style="font-weight: bold;"><input style="outline: none; border: none; width: 100%; height: 20px; text-align: end; font-weight: bold;" class="rounded" type="num" name="harga" value="<?= $row['harga'] ?>"></a>
                                            </div>
                                            <div style="display: flex; flex-direction: row; width: 100%;">
                                                <div style="width: 100%; height: max-content; background-color: lightgray; display: flex; flex-direction: row; justify-content: space-between; padding-right: 10px; padding-left: 10px; padding-top: 5px; padding-bottom: 5px;" class="mt-1 rounded">
                                                    <a style="font-weight: bold;">Jenis</a>
                                                    <a style="font-weight: bold;">
                                                        <select style="outline: none; border: none; width: 100%; text-align: start; font-weight: bold;" class="rounded" name="jenis" id="">
                                                            <option selected> --pilih jenis</option>
                                                            <option value="MAKANAN">MAKANAN</option>
                                                            <option value="MINUMAN">MINUMAN</option>
                                                        </select>
                                                        <input type="text" name="id" value="<?= $row['id'] ?>" hidden>
                                                        <input type="text" name="gambarBefore" value="<?= $row['gambar'] ?>" hidden>
                                                    </a>
                                                </div>
                                            </div>
                                            <div style="width: 100%; background-color: lightgray; display: flex; flex-direction: row; justify-content: space-between;" class="mt-1 rounded">
                                                <button class="btn btn-success" style="width: 100%;">EDIT</button>
                                            </div>
                                        </div>
                                    </form>
                                    <button class="btn btn-danger mt-1" style="width: 100%;" onclick="document.location.href='proses.php?action=hapusProduk&id=<?= $id ?>'">HAPUS</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php $i++;
            } ?>
        </div>
    </div>

    <div style="display: flex; flex-direction: row;" class="mt-3">
        <h2 class="mt-3">List Operator</h2>
        <button type="button" class="mx-2 btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#tambahOperator">Tambah</button>
    </div>

    <div class="modal fade" id="tambahOperator" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="proses.php?action=tambahOperator" method="post">
                            <div style="width: 100%; height: max-content; display: flex; justify-content: center; align-items: center; flex-direction: column;">
                                <div style="width: 100%; height: max-content; background-color: lightgray; display: flex; flex-direction: row; justify-content: space-between; padding-right: 10px; padding-left: 10px;" class="mt-1 rounded">
                                    <a style="font-weight: bold;">Username</a>
                                    <a style="font-weight: bold;"><input style="outline: none; border: none; width: 100%; height: 20px; text-align: start; font-weight: bold;" class="rounded" type="text" name="username"></a>
                                </div>
                                <div style="margin-left: 3px; width: 100%; height: max-content; background-color: lightgray; display: flex; flex-direction: row; justify-content: space-between; padding-right: 10px; padding-left: 10px;" class="mt-1 rounded">
                                    <a style="font-weight: bold;">Password</a>
                                    <a style="font-weight: bold;"><input style="outline: none; border: none; width: 100%; height: 20px; font-weight: bold;" class="rounded" type="text" name="password"></a>
                                </div>
                                <div style="width: 100%; background-color: lightgray; display: flex; flex-direction: row; justify-content: space-between;" class="mt-1 rounded">
                                    <button class="btn btn-success" style="width: 100%;">TAMBAH</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="padding: 10px; background-color: #fff; width: 100%; height: max-content; display: flex; flex-wrap: wrap; flex-direction: column;" class=" mt-3 rounded">
        <div style="display: flex; flex-direction: column; padding-right: 300px; padding-left: 300px;">
            <?php $i = 1;
            $produk = $db->showOperator();
            foreach ($produk as $row) {
                $id = $row["id"] ?>
                <div style="width: 100%; height: max-content; display: flex; flex-direction: row; align-items: center;" class="mx-2 mt-2 rounded bg-light">
                    <a style="padding: 10px; width: 100%; font-weight: bold;"><?= $row["username"] ?></a>
                    <div style="width: 100%; display: flex; flex-direction: row; justify-content: end;">
                        <button data-bs-toggle="modal" data-bs-target="#editOperator<?= $id ?>" class="btn btn-primary mx-2">EDIT</button>
                        <button class="btn btn-danger" onclick="document.location.href='proses.php?action=hapusOperator&id=<?= $id ?>'">DELETE</button>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="editOperator<?= $id ?>" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <form action="proses.php?action=editOperator" method="post">
                                        <div style="width: 100%; height: max-content; display: flex; justify-content: center; align-items: center; flex-direction: column;">
                                            <div style="width: 100%; height: max-content; background-color: lightgray; display: flex; flex-direction: row; justify-content: space-between; padding-right: 10px; padding-left: 10px;" class="mt-1 rounded">
                                                <a style="font-weight: bold;">Username</a>
                                                <a style="font-weight: bold;"><input style="outline: none; border: none; width: 100%; height: 20px; text-align: start; font-weight: bold;" class="rounded" type="text" name="username" value="<?= $row['username'] ?>"></a>
                                            </div>
                                            <div style="margin-left: 3px; width: 100%; height: max-content; background-color: lightgray; display: flex; flex-direction: row; justify-content: space-between; padding-right: 10px; padding-left: 10px;" class="mt-1 rounded">
                                                <a style="font-weight: bold;">Password</a>
                                                <a style="font-weight: bold;"><input style="outline: none; border: none; width: 100%; height: 20px; text-align: end; font-weight: bold;" class="rounded" type="num" name="password" value="<?= $row['password'] ?>"></a>
                                            </div>
                                            <div style="width: 100%; background-color: lightgray; display: flex; flex-direction: row; justify-content: space-between;" class="mt-1 rounded">
                                                <button class="btn btn-success" style="width: 100%;">EDIT</button>
                                                <input type="text" name="id" value="<?= $id ?>" hidden>

                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php $i++;
            } ?>
        </div>
    </div>


    <h2 class="mt-3">CATATAN TRANSAKSI</h2>
    <div style="padding: 10px; background-color: #fff; width: 100%; height: max-content; display: flex; flex-wrap: wrap; flex-direction: column; justify-content: center;" class="rounded">
        <table>
            <tr>
                <td style="display: flex; flex-direction: row;">
                    <form style="display: flex; flex-direction: row; " class=" mx-2" action="" method="post">
                        <input class="mx-2" type="number" name="tanggal" placeholder="tanggal" class="form-control">
                        <button class="btn btn-primary" name="cari">Cari</button>
                    </form>
                    <form style="display: flex; flex-direction: row; " action="" method="post">
                        <input class="mx-2" type="text" name="username" placeholder="operator" class="form-control">
                        <button class="btn btn-primary" name="operator" value="true">Cari</button>
                    </form>
                </td>
            </tr>
        </table>
        <table border="0">
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
            if (isset($_POST["cari"])) {
                $query = $db->searchLaporanTanggal($_POST["tanggal"]);
                $transaksi = $db->showTransaksi($query);
            } else if (isset($_POST["operator"])) {
                $query = $db->searchOperator($_POST["username"]);
                $transaksi = $db->showTransaksi($query);
            }
            $i = 1;
            foreach ($transaksi as $row) {
                $id = $row["id"]; ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?php $nama = $db->selectUserById($row["id_user"]);
                        echo $nama["username"] ?></td>
                    <td><?php $operator = $db->selectUserById($row["id_operator"]);
                        echo $operator["username"] ?></td>
                    <td>Rp.<?= $row["diskon"] ?></td>
                    <td>Rp.<?= $row["total"] ?></td>
                    <td>Rp.<?= $row["bayar"] ?></td>
                    <td><?= $row["tanggal"] ?></td>
                    <td><?= $row["status"] ?></td>
                    <td>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editTransaksi<?= $id ?>">EDIT</button>
                        <button class="btn btn-danger" onclick="document.location.href='proses.php?action=hapusTransaksi&id=<?= $id ?>'">HAPUS</button>
                    </td>
                </tr>


                <div class="modal fade" id="editTransaksi<?= $id ?>" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <form action="proses.php?action=editTransaksi" method="post">
                                        <div style="width: 100%; height: max-content; display: flex; justify-content: center; align-items: center; flex-direction: column;">
                                            <div style="width: 100%; height: max-content; background-color: lightgray; display: flex; flex-direction: row; justify-content: space-between; padding-right: 10px; padding-left: 10px;" class="mt-1 rounded">
                                                <a style="font-weight: bold;">Username</a>
                                                <a style="font-weight: bold;"><input style="outline: none; border: none; width: 100%; height: 20px; text-align: start; font-weight: bold;" class="rounded" type="text" name="username" value="<?= $nama['username'] ?>"></a>
                                            </div>
                                            <div style="margin-left: 3px; width: 100%; height: max-content; background-color: lightgray; display: flex; flex-direction: row; justify-content: space-between; padding-right: 10px; padding-left: 10px;" class="mt-1 rounded">
                                                <a style="font-weight: bold;">Diskon</a>
                                                <a style="font-weight: bold;"><input style="outline: none; border: none; width: 100%; height: 20px; text-align: end; font-weight: bold;" class="rounded" type="num" name="diskon" value="<?= $row['diskon'] ?>"></a>
                                            </div>
                                            <div style="margin-left: 3px; width: 100%; height: max-content; background-color: lightgray; display: flex; flex-direction: row; justify-content: space-between; padding-right: 10px; padding-left: 10px;" class="mt-1 rounded">
                                                <a style="font-weight: bold;">Bayar</a>
                                                <a style="font-weight: bold;"><input style="outline: none; border: none; width: 100%; height: 20px; text-align: end; font-weight: bold;" class="rounded" type="num" name="bayar" value="<?= $row['bayar'] ?>"></a>
                                            </div>
                                            <div style="margin-left: 3px; width: 100%; height: max-content; background-color: lightgray; display: flex; flex-direction: row; justify-content: space-between; padding-right: 10px; padding-left: 10px;" class="mt-1 rounded">
                                                <a style="font-weight: bold;">Tanggal</a>
                                                <a style="font-weight: bold;"><input style="outline: none; border: none; width: 100%; height: 20px; text-align: end; font-weight: bold;" class="rounded" type="text" name="tanggal" value="<?= $row['tanggal'] ?>"></a>
                                            </div>
                                            <div style="width: 100%; background-color: lightgray; display: flex; flex-direction: row; justify-content: space-between;" class="mt-1 rounded">
                                                <button class="btn btn-success" style="width: 100%;">EDIT</button>
                                                <input type="text" name="id" value="<?= $id ?>" hidden>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php $i++;
            } ?>
        </table>
    </div>
    <br><br><br>

    <div style="padding-bottom: 15px; width: 100%; height: max-content; background-color: #fff; display: flex; flex-direction: column; align-items: center;" class="rounded mx-2">
        <h3 class="text-primary mt-1">LIST TRANSAKSI</h1>


            <?php $transaksi = $db->showTransaksi("SELECT `tabel_transaksi`.`id`, `tabel_user`.`username`, `tabel_transaksi`.`diskon`, `tabel_transaksi`.`total`, `tabel_transaksi`.`bayar`, `tabel_transaksi`.`tanggal`, `tabel_transaksi`.`status`
            FROM `tabel_transaksi` 
                LEFT JOIN `tabel_user` ON `tabel_transaksi`.`id_user` = `tabel_user`.`id` WHERE tabel_transaksi.status = 'ORDER'");
            $i = 1;
            foreach ($transaksi as $row) {
                $id = $row["id"] ?>
                <div style="background-color: lightgray; width: 50%; height: max-content; display: flex; justify-content: space-between; align-items: center; padding-top: 10px; padding-bottom: 10px; padding: 10px;" class="mb-3 rounded">
                    <div style="display: flex; flex-direction: row;">
                        <div style="font-weight: bold;" class="mx-1"><?= $i ?></div>
                        <div style="font-weight: bold" class="mx-1"><?= $row["username"] ?></div>
                        <div style="font-weight: bold" class="mx-1">Total : Rp.<?= $row["total"] ?></div>
                        <div style="font-weight: bold" class="mx-1">Bayar : Rp.<?= $row["bayar"] ?></div>
                    </div>
                    <div style="font-weight: bold" class="mx-1"><a class="btn btn-success" onclick="document.location.href='proses.php?action=accTransaksi&id=<?= $id ?>'">BERI NOTA</a></div>
                </div>
            <?php $i++;
            } ?>
    </div>

    <div style="padding-bottom: 15px; width: 100%; height: max-content; background-color: #fff; display: flex; flex-direction: column; align-items: center;" class="rounded mt-3 mx-2">
        <h1 class="text-primary" style="width: 100%; text-align: center;">LAPORAN</h1>
        <table>
            <tr>
                <td>
                    <form action="" method="post">
                        <input type="number" name="tanggal" placeholder="tanggal">
                        <button class="btn btn-primary" name="cari">Cari</button>
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
                        <button class="btn btn-primary" name="cariBulan">Cari</button>
                    </form>
                </td>
            </tr>
            <tr>
                <th>Total</td>
                <th>Tanggal</td>
            </tr>
            <?php $total = 0;
            $transaksi = $db->showTransaksi("SELECT * FROM tabel_transaksi WHERE status = 'DONE'");
            if (isset($_POST["cari"])) {
                $query = $db->searchLaporanTanggal($_POST["tanggal"]);
                $transaksi = $db->showTransaksi($query);
            } else if (isset($_POST["cariBulan"])) {
                $query = $db->searchLaporanBulan($_POST["bulan"]);
                $transaksi = $db->showTransaksi($query);
            }
            foreach ($transaksi as $row) {
                $total = $total + $row["bayar"]; ?>
                <tr>
                    <td>Rp.<?= $row["bayar"] ?></td>
                    <td><?= $row["tanggal"] ?></td>
                </tr>
            <?php } ?>
            <tr>
                <td>Total : Rp.<?= $total ?></td>
            </tr>
        </table>
    </div>
<?php } ?>

<!-- ----------------------------------------------------------------------------------------- -->

<?php require_once "template/footer.php" ?>