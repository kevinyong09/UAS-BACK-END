<?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "compro");

// Pastikan koneksi berhasil
if (mysqli_connect_errno()) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Pastikan file ini hanya dapat diakses melalui proses pengiriman form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai yang dikirim dari form
    $nama_barang = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $keterangan = $_POST['keterangan'];
    $keuntungan = $_POST['keuntungan'];
    $stok = $_POST['stok'];

    // Proses penyimpanan gambar
    $target_dir = "images/"; // Direktori tempat menyimpan gambar
    $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["gambar"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File bukan gambar.";
        $uploadOk = 0;
    }

    // Check if file already exist

    // Check file size
    if ($_FILES["gambar"]["size"] > 500000) {
        echo "Maaf, ukuran file gambar terlalu besar.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Maaf, hanya file JPG, JPEG, PNG & GIF yang diperbolehkan.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Maaf, file gambar tidak terunggah.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
            echo "File " . htmlspecialchars(basename($_FILES["gambar"]["name"])) . " berhasil terunggah.";
            // Simpan data barang ke database
            $gambar = $target_file;
            $query = "INSERT INTO barang (nama_barang, harga, stok, keterangan, keuntungan, gambar) VALUES ('$nama_barang', '$harga', '$stok','$keterangan', '$keuntungan', '$gambar')";
            if (mysqli_query($koneksi, $query)) {
                header("Location: lihat_data_barang.php");
                exit();
            } else {
                echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
            }
        } else {
            echo "Maaf, terjadi kesalahan saat mengunggah file gambar.";
        }
    }

    // Tutup koneksi database
    mysqli_close($koneksi);
} else {
    // Jika halaman ini diakses langsung, redirect pengguna ke halaman form
    header("Location: form_tambah_barang.php");
    exit();
}
?>