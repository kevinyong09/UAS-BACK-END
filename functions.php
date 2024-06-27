<?php 
// koneksi db

use Dompdf\Dompdf;
use Dompdf\Options;

// $koneksi = mysqli_connect("localhost","root","","compro");
$koneksi = mysqli_connect("personaku.com","personak","Newman2602!","personak_compro");

// set tanggal timezone default
date_default_timezone_set("Asia/Jakarta");

// query
function query($query){
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function registrasi($data){
    global $koneksi;

    $name = htmlspecialchars($data["name"]);
    $email = strtolower(stripslashes(htmlspecialchars($data["email"])));
    $password = mysqli_real_escape_string($koneksi, $data["password"]);
    $address = htmlspecialchars($data["Address"]);

    $result= mysqli_query($koneksi, "SELECT email from user where email = '$email'");
    if(mysqli_fetch_assoc($result)){
        echo "<script>
                alert(' Email Sudah Terdaftar ');
              </script>";
        return false;
    }
    $query = "INSERT into user values ('','$name', '$email','user','$password', '$address')";
    mysqli_query($koneksi,$query);
    return mysqli_affected_rows($koneksi);
}

?>