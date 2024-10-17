<?php

include "connection.php";

$id = isset($_POST['id']) ? $_POST['id'] : '';
$diskon = isset($_POST['diskon']) ? $_POST['diskon'] : '';
$username = isset($_POST['username']) ? $_POST['username'] : '';
$total = isset($_POST['total']) ? $_POST['total'] : '';
$bayar = isset($_POST['bayar']) ? $_POST['bayar'] : '';
$tanggal = isset($_POST['tanggal']) ? $_POST['tanggal'] : '';
$status = isset($_POST['status']) ? $_POST['status'] : '';

if (empty($id)) {
	$data = mysqli_query($con, "SELECT * FROM tabel_user WHERE username = '$username'");
	$id_user = mysqli_fetch_assoc($data);
	$tanggal = date("Y-F-d");
	$subtotal = $_POST["subtotal"];
	$jumlah = $_POST["jumlah"];
	$total = $subtotal * $jumlah;
	$detailTotal = $total;
	$pajak = $total * 0.5;
	$totalPajak = $total - $pajak + 5000;

	$query = mysqli_query($con, "INSERT INTO tabel_transaksi VALUES(0,'" . $id_user["id"] . "', '4', '$diskon', '$total', '$bayar', '$tanggal', 'ORDER')");

	$id_transaksi = mysqli_insert_id($con);
	$produk = $_POST["produk"];
	$data = mysqli_query($con, "SELECT * FROM tabel_produk WHERE produk = '$produk'");
	$produk = mysqli_fetch_assoc($data);

	mysqli_query($con, "INSERT INTO detail_transaksi VALUES ('','$id_transaksi', '" . $produk["id"] . "', '" . $produk["harga"] . "', '" . $_POST["jumlah"] . "', '" . $detailTotal . "')");

	if ($query) {
		echo "Data berhasil di simpan";
	} else {
		echo "Error simpan Data";
	}
} else {
	$query = mysqli_query($con, "UPDATE tabel_transaksi set diskon = '" . $diskon . "', total = '" . $total . "', bayar = '" . $bayar . "',  tanggal = '" . $tanggal . "', status = '" . $status . "' WHERE id = '" . $id . "'");

	if ($query) {
		echo "Data berhasil di ubah";
	} else {
		echo "Error ubah Data";
	}
}
