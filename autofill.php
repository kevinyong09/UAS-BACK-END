<?php 

// Get variable
$id= $_SESSION["id"]; 

$koneksi = mysqli_connect("localhost","root","","compro");

// Menampilkan Database 
$asd = mysqli_query($koneksi, "SELECT * FROM USER WHERE id = '$id'");
$user = mysqli_fetch_array($asd);
  
if ($user) {
    $data = array(
        'address' => $user['address'],
    );

    // Return the data as JSON
    echo json_encode($data);
} else {
    echo json_encode(array('address' => 'User not found'));
}
// // Generate Array dengan data username
// $data = array(
//     'address' => @$user['address'],
// ); 

// // Mengembalikan hasil sebagai array Json
//  echo json_encode($data); 
?>