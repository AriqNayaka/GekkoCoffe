<?php
include "connection.php";

$id = isset($_POST['id']) ? $_POST['id'] : '';
class emp
{
};

if (empty($id)) {
	echo "Error Mengambil Data id kosong";
} else {
	$query 	= mysqli_query($con, "SELECT `tabel_transaksi`.`id`, `tabel_user`.`username`, `tabel_transaksi`.`diskon`, `tabel_transaksi`.`total`, `tabel_transaksi`.`bayar`, `tabel_transaksi`.`tanggal`, `tabel_transaksi`.`status`
		FROM `tabel_transaksi` 
			LEFT JOIN `tabel_user` ON `tabel_transaksi`.`id_user` = `tabel_user`.`id` WHERE `tabel_transaksi`.`id`='" . $id . "'");
	$row 	= mysqli_fetch_array($query);

	if (!empty($row)) {
		$response = new emp();
		$response->id = $row["id"];
		$response->username = $row["username"];
		$response->diskon = $row["diskon"];
		$response->total = $row["total"];
		$response->bayar = $row["bayar"];
		$response->tanggal = $row["tanggal"];
		$response->status = $row["status"];


		echo (json_encode($response));
	} else {

		echo ("Error Mengambil Data");
	}
}
