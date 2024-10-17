<?php 
session_start();
include("function.php");
$db = new database;
if($_SESSION["user"]["role"] == "OPERATOR"){
    $db->log($_SESSION["user"]["id"], $_SESSION["user"]["role"] . " " . $_SESSION["user"]["username"] . " telah logout");
}
session_destroy();
header("Location: login.php");
exit;

?>