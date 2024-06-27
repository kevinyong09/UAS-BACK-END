<?php
session_start();
require 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $qtys = $_POST["qty"];
    $id_user = $_POST["id_user"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $total = $_POST["total"];

    if ($koneksi->connect_error) {
        die("Koneksi gagal: " . $koneksi->connect_error);
    }

    // inisialisasi variabel untuk menyimpan semua nama barang
    $nama_barang_concat = "";

    foreach ($qtys as $id_barang => $qty) {
        // Perbarui stok barang
        $sql = "UPDATE barang SET stok = stok - ? WHERE id = ?";
        $stmt = $koneksi->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("ii", $qty, $id_barang);
            $stmt->execute();

            // Dapatkan data pengguna
            $user_get_query = "SELECT * FROM `user` WHERE id = '$id_user'";
            $user_get_result = mysqli_query($koneksi, $user_get_query);

            if (mysqli_num_rows($user_get_result) > 0) {
                $user_data = mysqli_fetch_assoc($user_get_result);
                $name = $user_data['name'];
                $email = $user_data['email'];
            }

            // Dapatkan data barang
            $barang_get_query = "SELECT * FROM `barang` WHERE id = '$id_barang'";
            $barang_get_result = mysqli_query($koneksi, $barang_get_query);

            if (mysqli_num_rows($barang_get_result) > 0) {
                $barang_data = mysqli_fetch_assoc($barang_get_result);
                $nama_barang = $barang_data['nama_barang'];

                // Gabungkan nama barang dengan qty nya
                $nama_barang_concat .= "$nama_barang - $qty, ";
            }

            $stmt->close();
        } else {
            echo "Gagal mempersiapkan statement untuk barang dengan ID $id_barang.<br>";
        }
    }

    // Hapus koma ekstra di akhir string
    $nama_barang_concat = rtrim($nama_barang_concat, ", ");

    // upload bukti transfer
    if (isset($_FILES['bukti_transfer']) && $_FILES['bukti_transfer']['error'] === UPLOAD_ERR_OK) {
        // Tentukan direktori tujuan
        $targetDir = 'bukti_transfer/';

        // Dapatkan informasi file
        $fileTmpPath = $_FILES['bukti_transfer']['tmp_name'];
        $fileName = $_FILES['bukti_transfer']['name'];
        $fileSize = $_FILES['bukti_transfer']['size'];
        $fileType = $_FILES['bukti_transfer']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $newFileName = date("Ymd_His") . '.' . $fileExtension;

        $destPath = $targetDir . $newFileName;

        if (move_uploaded_file($fileTmpPath, $destPath)) {
            // echo "File is successfully uploaded.";
        }
    }

    // Insert sales
    $query_sales = "INSERT INTO `sales` (id_user, nama_user, email, no_telp, nama_barang, alamat, total, bukti_transfer, sales_created_at)
                VALUES ('$id_user', '$name', '$email', '$phone', '$nama_barang_concat', '$address', '$total', '$newFileName', NOW())";
    $result_sales = mysqli_query($koneksi, $query_sales);

    if ($result_sales) {
        // Hapus cart setelah penjualan berhasil disimpan
        $query_cart = "DELETE FROM `cart` WHERE id_user = '$id_user'";
        $result_cart = mysqli_query($koneksi, $query_cart);

        if ($result_cart) {
            echo "<script>alert('Selesai!');
              document.location.href = 'cart.php'</script>";
        } else {
            echo "Gagal menghapus cart.";
        }
    } else {
        echo "Gagal menyimpan penjualan.";
    }
}
