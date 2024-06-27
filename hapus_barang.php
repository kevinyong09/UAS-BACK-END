<?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "compro");

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_barang = $_POST['id_barang'];

    // Query untuk menghapus barang berdasarkan id_barang
    $query = "DELETE FROM barang WHERE id = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "i", $id_barang);

    if (mysqli_stmt_execute($stmt)) {
        echo "Barang berhasil dihapus.";
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($koneksi);

    // Redirect kembali ke halaman lihat_data_barang.php
    header("Location: lihat_data_barang.php");
    exit();
} else {
    // Jika halaman ini diakses langsung, redirect ke halaman data barang
    header("Location: lihat_data_barang.php");
    exit();
}
?>
