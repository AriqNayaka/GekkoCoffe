<?php 
session_start();
include("function.php");
$db = new database;
if ($_SESSION["login"] != true){
    header("Location: login.php");
}

$action = $_GET["action"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GEKKO COFFE EXPRESS</title>
</head>
<body>
    <table>
        <tr>
            <td><button onclick="document.location.href='logout.php'">LOGOUT</button></td>
            <td><button onclick="document.location.href='nota.php'">NOTA</button></td>
            <td><button onclick="document.location.href='home.php'">HOME</button></td>
        </tr>
    </table>
    <?php if($action == "editProduk") {?>
        <?php $row = $db->selectProduk($_GET["id"]); ?>
        <h1>EDIT PRODUK</h1>
        <form action="proses.php?action=editProduk" method="post">
            <table>
                <tr>
                    <td>PRODUK</td>
                    <td>:</td>
                    <td><input type="text" name="produk" value="<?= $row['produk'] ?>"></td>
                </tr>
                <tr>
                    <td>JENIS</td>
                    <td>:</td>
                    <td>
                        <select name="jenis" id="">
                            <option selected> --pilih jenis</option>
                            <option value="MAKANAN">MAKANAN</option>
                            <option value="MINUMAN">MINUMAN</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>HARGA</td>
                    <td>:</td>
                    <td><input type="num" name="harga" value="<?= $row['harga'] ?>"></td>
                </tr>
                <input type="text" name="id" value="<?= $_GET['id'] ?>" hidden>
                <tr>
                    <td colspan="3"><button>EDIT</button></td>
                </tr>
            </table>
        </form>
    <?php }if($action == "tambahProduk") { ?>
        <h1>TAMBAH PRODUK</h1>
        <form action="proses.php?action=tambahProduk" method="post">
            <table>
                <tr>
                    <td>PRODUK</td>
                    <td>:</td>
                    <td><input type="text" name="produk"></td>
                </tr>
                <tr>
                    <td>JENIS</td>
                    <td>:</td>
                    <td>
                        <select name="jenis" id="">
                            <option selected> --pilih jenis</option>
                            <option value="MAKANAN">MAKANAN</option>
                            <option value="MINUMAN">MINUMAN</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>HARGA</td>
                    <td>:</td>
                    <td><input type="num" name="harga"></td>
                </tr>
                <tr>
                    <td colspan="3"><button>TAMBAH</button></td>
                </tr>
            </table>
        </form>
    <?php } else if($action == "editOperator") { ?>
        <?php $row = $db->selectUserById($_GET["id"]); ?>
        <h1>EDIT OPERATOR</h1>
        <form action="proses.php?action=editOperator" method="post">
            <table>
                <tr>
                    <td>USERNAME</td>
                    <td>:</td>
                    <td><input type="text" name="username" value="<?= $row['username'] ?>"></td>
                </tr>
                <tr>
                    <td>PASSWORD</td>
                    <td>:</td>
                    <td><input type="text" name="password" value="<?= $row['password'] ?>"></td>
                </tr>
                <input type="text" name="id" value="<?= $_GET['id'] ?>" hidden>
                <tr>
                    <td colspan="3"><button>EDIT</button></td>
                </tr>
            </table>
        </form>

    <?php } else if($action == "editTransaksi") { ?>
        <?php $row = $db->selectTransaksi($_GET["id"]); ?>
        <h1>EDIT TRANSAKSI</h1>
        <form action="proses.php?action=editTransaksi" method="post">
            <table>
                <tr>
                    <td>USERNAME</td>
                    <td>:</td>
                    <td><input type="text" name="username" value="<?= $row['username'] ?>"></td>
                </tr>
                <tr>
                    <td>DISKON</td>
                    <td>:</td>
                    <td><input type="text" name="diskon" value="<?= $row['diskon'] ?>"></td>
                </tr>
                <tr>
                    <td>BAYAR</td>
                    <td>:</td>
                    <td><input type="text" name="bayar" value="<?= $row['bayar'] ?>"></td>
                </tr>
                <tr>
                    <td>TANGGAL</td>
                    <td>:</td>
                    <td><input type="text" name="tanggal" value="<?= $row['tanggal'] ?>"></td>
                </tr>
                <input type="text" name="id" value="<?= $_GET['id'] ?>" hidden>
                <tr>
                    <td colspan="3"><button>EDIT</button></td>
                </tr>
            </table>
        </form>
    <?php } else if($action == "tambahOperator") { ?>
        <h1>TAMBAH OPERATOR</h1>
        <form action="proses.php?action=tambahOperator" method="post">
            <table>
                <tr>
                    <td>USERNAME</td>
                    <td>:</td>
                    <td><input type="text" name="username"></td>
                </tr>
                <tr>
                    <td>PASSWORD</td>
                    <td>:</td>
                    <td><input type="text" name="password"></td>
                </tr>
                <tr>
                    <td colspan="3"><button>TAMBAH</button></td>
                </tr>
            </table>
        </form>
    <?php } ?>
</body>
</html>