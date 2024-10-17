<?php
	
	include "connection.php";
	
	$obat = isset($_POST['obat']) ? $_POST['obat'] : '';
	$username = isset($_POST['id_user']) ? $_POST['id_user'] : '';
	$metode_bayar = isset($_POST['metode_bayar']) ? $_POST['metode_bayar'] : '';
	$totalBayar = isset($_POST['totalBayar']) ? $_POST['totalBayar'] : '';
	$totalHarga = isset($_POST['totalHarga']) ? $_POST['totalHarga'] : '';
    
	$id_kasir = 1;
	$status = "ORDER";
	//$totalBayar = 5000;
	$tanggal = date('Y-F-d');

	$response = array();

	$data = mysqli_query($con,"SELECT * FROM tabel_user WHERE username = '$username'");
	$row = mysqli_fetch_assoc($data);
	$id_user = $row["id"];

	if ( empty($obat)) { 
		echo "Kolom isian tidak boleh kosong";  
		
	} else if($obat) {
		$query = mysqli_query($con,"INSERT INTO tabel_transaksi VALUES ('','".$id_user."','".$id_kasir."','".$obat."','".$metode_bayar."','".$totalBayar."','".$totalHarga."','".$tanggal."','".$status."')");
		
		if ($query) {
			array_push($response, array('status' => 'OK'));
			
		} else{ 
			echo "Error simpan Data";
			
		}
	} else {
		echo "gagal";
	}
	echo json_encode(array("server_response" => $response));
	mysqli_close($con);
?>