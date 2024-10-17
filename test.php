<?php
echo date("Y-F-d");
if (isset($_POST["r"])) {
    $phi = 3.14;
    $r = $_POST["r"];
    $luas = $phi * $r * $r;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jitung luas lingkaran</title>
</head>

<body>
    <h1>LUAS LINGKARAN BY PHI 3.14</h1>
    <form action="" method="post">
        <table>
            <tr>
                <td>INPUT R</td>
                <td>:</td>
                <td><input type="number" name="r"></td>
            </tr>
            <tr>
                <td><button>Submit</button></td>
            </tr>
        </table>
    </form>
    <br><br>
    <?php if (isset($_POST["r"])) { ?>
        <h4>Jawab</h4>
        <br>
        <p>Luas = 3.14 * <?= $r ?> * <?= $r ?></p>
        <p>Jawaban = <?= $luas ?></p>
    <?php } ?>
</body>

</html>