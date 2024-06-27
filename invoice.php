<?php
include_once 'functions.php';

if (isset($_GET['id_belanja']) && !empty($_GET['id_belanja'])) {
    $id_belanja = $_GET['id_belanja'];

    // check verified status
    $status_query = "SELECT * FROM `sales` WHERE id_belanja = '$id_belanja';";
    $result_status = mysqli_query($koneksi, $status_query);

    if ($result_status !== null && $result_status->num_rows > 0) {
        $row = $result_status->fetch_assoc();
        $nama_user = $row['nama_user'];
        $email = $row['email'];
        $no_telp = $row['no_telp'];
        $nama_barang = $row['nama_barang'];
        $alamat = $row['alamat'];
        $total = $row['total'];
        $sales_created_at = $row['sales_created_at'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
    <style>
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>

    <a href="javascript:void(0);" class="btn btn-primary no-print my-4 ms-4" onclick="closePage()">Close</a>
    <div class="col-12 mx-auto text-center border border-2 p-5">
        <div class="row">
            <div class="col-12 mb-4">
                <img src="images/logo.jpg" alt="" width="300">
            </div>
            <div class="col-4">
                Nama Pelanggan : <?php echo $nama_user ?>
            </div>
            <div class="col-4">
                No Telp : <?php echo $no_telp ?>
            </div>
            <div class="col-4">
                Email : <?php echo $email ?>
            </div>
            <hr class="my-3">
            <div class="col-12 text-end">
                Alamat : <br>
                <?php echo $alamat ?>
            </div>
            <div class="col-12 border rounded mt-3 p-3 text-start">
                <div class="col-12">
                    <?php echo str_replace(',', '<br><hr>', $nama_barang) ?>
                </div>
            </div>
            <div class="col-12 mt-3 text-end fs-3 fw-bold">
                Total : <?php echo 'Rp ' . number_format($total, 2, ',', '.'); ?>
            </div>
        </div>
    </div>
    <button class="btn btn-primary no-print mt-4 ms-4" onclick="printPage()">Print</button>

    <script>
        // Fungsi untuk memunculkan dialog print
        function printPage() {
            window.print();
        }

        // Fungsi untuk menutup halaman
        function closePage() {
            window.close();
        }
    </script>
</body>

</html>