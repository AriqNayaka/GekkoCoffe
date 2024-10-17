<?php 
class database{
    var $host = "localhost", $uname = "root", $pass = "", $dbname = "ariqahmadnayaka_reservasirestoran", $koneksi = "";
    
    public function __construct()
    {
        $this->koneksi = mysqli_connect($this->host, $this->uname, $this->pass, $this->dbname);
    }

    public function selectUser($username){
        $result = mysqli_query($this->koneksi, "SELECT * FROM tabel_user WHERE username = '$username'");
        return mysqli_fetch_assoc($result);
    }

    public function selectUserById($id){
        $result = mysqli_query($this->koneksi, "SELECT * FROM tabel_user WHERE id = '$id'");
        return mysqli_fetch_assoc($result);
    }

    public function showProduk(){
        $result = mysqli_query($this->koneksi,"SELECT * FROM tabel_produk WHERE status = 'ENABLE'");
        while ($row = mysqli_fetch_assoc($result)){
            $hasil[] = $row;
        }
        return $hasil;
    }

    public function selectProduk($id){
        $result = mysqli_query($this->koneksi,"SELECT * FROM tabel_produk WHERE id = '$id'");
        return mysqli_fetch_assoc($result);
    }

    public function tambahTransaksi($data){
        $date = date("Y-F-d");
        $kembali = $data["bayar"] - $data["total"];

        mysqli_query($this->koneksi, "INSERT INTO tabel_transaksi VALUES ('', '" . $_SESSION["user"]["id"] . "', '4', '" . $data["diskon"] ."', '" . $data["total"] . "', '" . $data["bayar"] . "', '$date', 'ORDER')");
        $id = mysqli_insert_id($this->koneksi);

        foreach($_SESSION["cart"] as $row){
            mysqli_query($this->koneksi, "INSERT INTO detail_transaksi VALUES ('','$id', '" . $row["id"] . "', '" . $row["harga"] . "', '" . $row["jumlah"] . "', '" . $row["subtotal"] . "')");
        }

        unset($_SESSION["cart"]);

    }

    public function tambahTransaksiAdmin($data){
        $date = date("Y-F-d");
        $kembali = $data["bayar"] - $data["total"];

        $row = $this->selectUser($data["username"]);

        mysqli_query($this->koneksi, "INSERT INTO tabel_transaksi VALUES ('', '" . $row["id"] . "', '4', '" . $data["diskon"] ."', '" . $data["total"] . "', '" . $data["bayar"] . "', '$date', 'ORDER')");
        $id = mysqli_insert_id($this->koneksi);

        foreach($_SESSION["cart"] as $row){
            mysqli_query($this->koneksi, "INSERT INTO detail_transaksi VALUES ('','$id', '" . $row["id"] . "', '" . $row["harga"] . "', '" . $row["jumlah"] . "', '" . $row["subtotal"] . "')");
        }

        unset($_SESSION["cart"]);

    }

    public function showTransaksi($query){
        $result = mysqli_query($this->koneksi, $query);
        while ($row = mysqli_fetch_assoc($result)){
            $hasil[] = $row;
        }
        return $hasil;
    }

    public function accTransaksi($id){
        mysqli_query($this->koneksi, "UPDATE tabel_transaksi SET id_operator = '" . $_SESSION["user"]["id"] . "', status = 'DONE' WHERE id = '$id'");
    }

    public function showDetailTransaksi($query){
        $result = mysqli_query($this->koneksi, $query);
        while ($row = mysqli_fetch_assoc($result)){
            $hasil[] = $row;
        }
        return $hasil;
    }

    public function showDetailTransaksi2($id){
        $result = mysqli_query($this->koneksi, "SELECT `detail_transaksi`.`id`, `detail_transaksi`.`id_transaksi`, `tabel_produk`.`produk`, `detail_transaksi`.`harga`, `detail_transaksi`.`jumlah`, `detail_transaksi`.`subtotal`
        FROM `detail_transaksi` 
            LEFT JOIN `tabel_produk` ON `detail_transaksi`.`id_produk` = `tabel_produk`.`id` WHERE detail_transaksi.id_transaksi = '$id'");
        while ($row = mysqli_fetch_assoc($result)){
            $hasil[] = $row;
        }
        return $hasil;
    }
    
    public function editProduk($data){
        mysqli_query($this->koneksi, "UPDATE tabel_produk SET produk = '" . $data["produk"] . "', jenis = '" . $data["jenis"] . "', harga = '" . $data["harga"] . "' WHERE id = '" . $data["id"] . "' ");
    }

    public function tambahProduk($data){
        mysqli_query($this->koneksi, "INSERT INTO tabel_produk VALUES ('', '" . $data["produk"] . "', '" . $data["jenis"] . "', '" . $data["harga"] . "', 'ENABLE')");
    }

    public function hapusProduk($id){
        mysqli_query($this->koneksi, "UPDATE tabel_produk SET status = 'DISABLE' WHERE id = '$id'");
    }

    public function showOperator(){
        $result = mysqli_query($this->koneksi,"SELECT * FROM tabel_user WHERE role = 'OPERATOR' AND status = 'ACTIVE'");
        while ($row = mysqli_fetch_assoc($result)){
            $hasil[] = $row;
        }
        return $hasil;
    }

    public function editOperator($data){
        mysqli_query($this->koneksi, "UPDATE tabel_user SET username = '" . $data["username"] . "', password = '" . $data["password"] . "' WHERE id = '" . $data["id"] . "' ");
    }

    public function tambahOperator($data){
        mysqli_query($this->koneksi, "INSERT INTO tabel_user VALUES ('', '" . $data["username"] . "', '" . $data["password"] . "', 'OPERATOR', 'ACTIVE')");
    }

    public function hapusOperator($id){
        mysqli_query($this->koneksi, "UPDATE tabel_user SET status = 'DISACTIVE' WHERE id = '$id'");
    }

    public function selectTransaksi($id){
        $result = mysqli_query($this->koneksi, "SELECT `tabel_transaksi`.`id`, `tabel_user`.`username`, `tabel_transaksi`.`diskon`, `tabel_transaksi`.`bayar`, `tabel_transaksi`.`tanggal`
        FROM `tabel_transaksi` 
            LEFT JOIN `tabel_user` ON `tabel_transaksi`.`id_user` = `tabel_user`.`id` WHERE tabel_transaksi.id = '$id'");
        return mysqli_fetch_assoc($result);
    }

    public function hapusTransaksi($id){
        mysqli_query($this->koneksi, "UPDATE tabel_transaksi SET status = 'DELETE' WHERE id = '$id'");
    }

    public function editTransaksi($data){
        $row = $this->selectUser($data["username"]);

        mysqli_query($this->koneksi, "UPDATE tabel_transaksi SET id_user = '" . $row["id"] . "', diskon = '" . $data["diskon"] . "',  bayar = '" . $data["bayar"] . "',  tanggal = '" . $data["tanggal"] . "' WHERE id = '" . $data["id"] . "' ");
    }

    public function showLaporan(){
        $result = mysqli_query($this->koneksi, "SELECT * FROM tabel_transaksi");
        while ($row = mysqli_fetch_assoc($result)){
            $hasil[] = $row;
        }
        return $hasil;
    }

    public function searchLaporanTanggal($search){
        $query = "
        SELECT * FROM tabel_transaksi WHERE
        tanggal LIKE '%$search' AND status = 'DONE'
        ";

        return $query;
    }

    public function searchLaporanBulan($search){
        $query = "
        SELECT * FROM tabel_transaksi WHERE
        tanggal LIKE '%$search%' AND status = 'DONE'
        ";

        return $query;
    }

    public function searchTransaksiTanggal($search){
        $query = "
        SELECT `tabel_transaksi`.`id`, `tabel_transaksi`.`id_user`, `tabel_user`.`username`, `tabel_transaksi`.`diskon`, `tabel_transaksi`.`total`, `tabel_transaksi`.`bayar`, `tabel_transaksi`.`tanggal`, `tabel_transaksi`.`status`
FROM `tabel_transaksi` 
	LEFT JOIN `tabel_user` ON `tabel_transaksi`.`id_operator` = `tabel_user`.`id` WHERE tabel_transaksi.tanggal LIKE '%$search' tabel_transaksi.status = 'DONE'
        ";

        return $query;
    }

    public function searchOperator($username){
        $row = $this->selectUser($username);
        $id = $row["id"];
        $query = "
        SELECT `tabel_transaksi`.`id`, `tabel_transaksi`.`id_user`, `tabel_transaksi`.`id_operator`, `tabel_transaksi`.`diskon`, `tabel_transaksi`.`total`, `tabel_transaksi`.`bayar`, `tabel_transaksi`.`tanggal`, `tabel_transaksi`.`status`
FROM `tabel_transaksi` WHERE tabel_transaksi.id_operator LIKE '$id%' AND tabel_transaksi.status = 'DONE'
        ";

        return $query;
    }

    public function log($id, $text){
        $date = date("Y-m-d H:m:s");
        mysqli_query($this->koneksi, "INSERT INTO log VALUES ('', '$date', '$id', '$text')");
    }

    public function showLog(){
        $result = mysqli_query($this->koneksi, "SELECT `log`.`id`, `log`.`tanggal`, `tabel_user`.`username`, `log`.`aktivitas`
        FROM `log` 
            LEFT JOIN `tabel_user` ON `log`.`id_operator` = `tabel_user`.`id`");
        while($row = mysqli_fetch_assoc($result)){
            $hasil[] = $row;
        }
        return $hasil;
    }

    public function ubahNama($data){
        mysqli_query($this->koneksi, "UPDATE tabel_user SET username = '" . $data["username"] . "' WHERE id = '" . $_SESSION["user"]["id"] . "'");
        $_SESSION["user"]["username"] = $data["username"];
    }
}
?>