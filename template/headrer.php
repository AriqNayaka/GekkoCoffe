<?php
error_reporting(0);
session_start();
include("function.php");
$db = new database;
if ($_SESSION["login"] != true) {
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GEKKO COFFE EXPRESS</title>
    <link href="bootstrap/bootstrap-5.3.2-dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

</head>

<body class="bg-light">
    <nav style="background-color: #fff;" class="navbar navbar-expand-sm navbar-light py-4">
        <div class="container">
            <a class="navbar-brand text-primary" href="home.php">GEKKO</a>
            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                    <?php if ($_SESSION["user"]["role"] == "ADMIN") { ?>
                        <li class="nav-item mx-1">
                            <a class="btn btn-primary" href="home.php" aria-current="page">HOME<span class="visually-hidden">(current)</span></a>
                        </li>
                        <li class="nav-item mx-1">
                            <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#keranjangAdmin" aria-current="page">KERANJANG<span class="visually-hidden">(current)</span></a>
                        </li>

                        <li class="nav-item mx-1">
                            <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#riwayat" aria-current="page">RIWAYAT<span class="visually-hidden">(current)</span></a>
                        </li>
                    <?php } else if ($_SESSION["user"]["role"] == "OPERATOR") { ?>
                        <li class="nav-item mx-1">
                            <a class="btn btn-primary" href="home.php" aria-current="page">HOME<span class="visually-hidden">(current)</span></a>
                        </li>
                        <li class="nav-item mx-1">
                            <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ubahnama" aria-current="page">UBAH NAMA<span class="visually-hidden">(current)</span></a>
                        </li>
                    <?php } else if ($_SESSION["user"]["role"] == "CUSTOMER") { ?>
                        <li class="nav-item mx-1">
                            <a class="btn btn-primary" href="home.php" aria-current="page">HOME<span class="visually-hidden">(current)</span></a>
                        </li>
                        <li class="nav-item mx-1">
                            <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nota" aria-current="page">NOTA<span class="visually-hidden">(current)</span></a>
                        </li>
                        <li class="nav-item mx-1">
                            <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#keranjang" aria-current="page">KERANJANG<span class="visually-hidden">(current)</span></a>
                        </li>
                    <?php } ?>
                </ul>
                <ul class="d-flex my-2 my-lg-0">
                    <a href="logout.php" class="btn btn-danger my-2 my-sm-0">LOGOUT</a>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container pt-3 mb-5">