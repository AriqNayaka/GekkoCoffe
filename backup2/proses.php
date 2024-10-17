<?php
session_start();
include("function.php");
$db = new database;
$action = $_GET["action"];

if ($action == "login") {
    $row = $db->selectUser($_POST["username"]);
    $checkpass = $row["password"];
    if ($checkpass == $_POST["password"]) {
        $_SESSION["login"] = true;
        $_SESSION["user"] = [
            "id" => $row["id"],
            "username" => $row["username"],
            "password" => $row["password"],
            "role" => $row["role"]
        ];
        if ($row["role"] == "OPERATOR") {
            $db->log($row["id"], $row["role"] . " " . $row["username"] . " telah login");
        }
        header("Location: home.php");
    } else {
        header("Location: login.php");
    }
} else if ($action == "aksiKeranjang") {
    $id = $_GET["idProduk"];
    $row = $db->selectProduk($id);
    $subtotal = $row["harga"] * $_POST["jumlah"];
    $_SESSION["cart"][$id] = [
        "id" => $row["id"],
        "produk" => $row["produk"],
        "jenis" => $row["jenis"],
        "gambar" => $row["gambar"],
        "harga" => $row["harga"],
        "jumlah" => $_POST["jumlah"],
        "subtotal" => $subtotal
    ];
    header("Location: home.php");
} else if ($action == "hapusKeranjang") {
    $id = $_GET["idKeranjang"];
    unset($_SESSION["cart"][$id]);
    header("Location: home.php");
} else if ($action == "tambahTransaksi") {
    if (isset($_POST["admin"])) {
        $db->tambahTransaksiAdmin($_POST);
    } else {
        $db->tambahTransaksi($_POST);
    }
    header("Location: home.php");
} else if ($action == "accTransaksi") {
    $db->accTransaksi($_GET["id"]);
    if ($_SESSION["user"]["role"] == "OPERATOR") {
        $db->log($_SESSION["user"]["id"], $_SESSION["user"]["role"] . " " . $_SESSION["user"]["username"] . " telah Mengacc transaksi : " . $_GET['id']);
    }
    header("Location: home.php");
} else if ($action == "editProduk") {
    $db->editProduk($_POST);
    header("Location: home.php");
} else if ($action == "tambahProduk") {
    $db->tambahProduk($_POST);
    header("Location: home.php");
} else if ($action == "hapusProduk") {
    $db->hapusProduk($_GET["id"]);
    header("Location: home.php");
} else if ($action == "editOperator") {
    $db->editOperator($_POST);
    header("Location: home.php");
} else if ($action == "tambahOperator") {
    $db->tambahOperator($_POST);
    header("Location: home.php");
} else if ($action == "hapusOperator") {
    $db->hapusOperator($_GET["id"]);
    header("Location: home.php");
} else if ($action == "hapusTransaksi") {
    $db->hapusTransaksi($_GET["id"]);
    header("Location: home.php");
} else if ($action == "editTransaksi") {
    $db->editTransaksi($_POST);
    header("Location: home.php");
} else if ($action == "ubahNama") {
    $db->ubahNama($_POST);
    header("Location: home.php");
}
