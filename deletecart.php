<?php
session_start();
$id = $_POST["id"];
require 'functions.php';

$query = "DELETE cart where id = '$id'";
mysqli_query($koneksi, "DELETE from cart where id = '$id'");

echo "<script> alert('Data Berhasil Dihapus!');
          document.location.href = 'cart.php' </script>";
// return mysqli_affected_rows($koneksi);
exit;
