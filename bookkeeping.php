<?php
include_once 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pastikan bahwa start_date dan end_date ada di dalam POST data
    if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
    } else {
        echo "Start date and end date are required.";
    }
}

$sql = "SELECT *, SUM(total) AS total_value FROM sales WHERE sales_created_at BETWEEN '$start_date' AND '$end_date'";

// Eksekusi query
$result = $koneksi->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <?php if ($result->num_rows > 0) {
                    echo "<table border='1'>
                <tr>
                    <th>ID Belanja</th>
                    <th>Nama User</th>
                    <th>Email</th>
                    <th>No Telp</th>
                    <th>Nama Barang</th>
                    <th>Alamat</th>
                    <th>Tanggal transaksi</th>
                </tr>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                <td>" . $row["id_belanja"] . "</td>
                <td>" . $row["nama_user"] . "</td>
                <td>" . $row["email"] . "</td>
                <td>" . $row["no_telp"] . "</td>
                <td>" . $row["nama_barang"] . "</td>
                <td>" . $row["alamat"] . "</td>
                <td>" . $row["sales_created_at"] . "</td>
            </tr>";
                    }

                    // Mendapatkan total_value
                    $query_total_value = "SELECT SUM(total) AS total_value FROM sales WHERE sales_created_at BETWEEN '$start_date' AND '$end_date'";
                    $result_total_value = $koneksi->query($query_total_value);
                    $total_value_row = $result_total_value->fetch_assoc();

                    // Menampilkan total_value
                    echo "<tr>
                    <td colspan='6'>Total Value</td>
                    <td>Rp " . number_format($total_value_row["total_value"], 2, ',', '.') . "</td>
                </tr>";

                    echo "</table>";
                } else {
                    echo "0 results";
                }
                ?>
            </div>

            <!-- Small boxes (Stat box) -->
            <!-- /.row -->
            <!-- Main row -->
            <!-- /.row (main row) -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</body>

<!-- print dialog every refresh -->
<script>
    // Event listener untuk memunculkan dialog print saat halaman selesai dimuat
    window.addEventListener('load', function() {
        window.print();
    });
</script>

</html>