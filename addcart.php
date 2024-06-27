<?php
session_start();
// echo '<pre>';
// echo 'SESSION: ';

// echo 'POST: ';
// print_r($_POST);
// echo '</pre>';
// exit;
// Pastikan 'id' ada di session dan 'id_barang' ada di data POST
$id = $_SESSION["id"];
$id_barang = $_POST["id"];
require 'functions.php';

$query = "SELECT * from cart where id_user = $id and id_barang = $id_barang and status = 0";
$koenksi = mysqli_query($koneksi, $query);
if (mysqli_affected_rows($koneksi) > 0) {
    header("Location: cart.php");
    exit;
}
// die;
$query = "INSERT into cart values ('','$id', '$id_barang','0')";
mysqli_query($koneksi, $query);
// return mysqli_affected_rows($koneksi);
header("Location: cart.php");
exit;
?>