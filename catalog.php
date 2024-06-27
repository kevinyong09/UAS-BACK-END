<?php
session_start();
require 'functions.php';

if (!isset($_SESSION["logged_in"]) || $_SESSION["role"] !== "user") {
  header("Location: login.php");
  exit;
}

$barang = query("SELECT * from barang order by id asc");

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

  <!-- icon -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->


  <title>Catalog!</title>
  <style>
    .card {
      width: 100%;
    }

    .card-img-top {
      height: 400px;
      /* atur tinggi gambar */
      object-fit: cover;
      /* agar gambar tetap proporsional */
    }
  </style>
</head>

<body>
  <div class="container-fluid">
    <nav class="navbar navbar-light bg-light">

      <img src="images/logo.jpg" alt="" width="100" height="24">
      <form class="container justify-content-end">
        <a class="btn btn-outline-success me-2" href="cart.php"><i class="bi bi-cart3"></i></a>
        <a class="btn btn-outline-success me-2" href="home.php">About</a>
        <a class="btn btn-outline-success me-2" href="catalog.php">Catalog</a>
        <a class="btn btn-outline-success me-2" href="contact.php">Contact</a>
        <?php if ($_SESSION): ?>
          <a class="btn btn-outline-success me-2" href="logout.php">
            Logout
          </a>
        <?php else: ?>
          <a class="btn btn-outline-success me-2" href="login.php">
            Login
          </a>
        <?php endif; ?>
      </form>
    </nav>
    <div class="row row-cols-1 row-cols-md-3 g-4">
      <?php foreach ($barang as $row): ?>
        <div class="col">
          <div class="card">
            <img src="<?= $row['gambar']; ?>" class="card-img-top" alt="..." style="width: 100%;">
            <div class="card-body">
              <h5 class="card-title text-center"><?= $row['nama_barang']; ?></h5>
            </div>
            <div class="card-footer text-end bg-white d-flex align-items-center justify-content-between">
              <p class="text-start fw-bold">Stock : <?= $row['stok']; ?> </p>
              <form action="addcart.php" method="post">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                  data-bs-target="#exampleModal<?= htmlspecialchars($row['id']); ?>"><i class="bi bi-eye"></i></button>
                <button type="submit" class="btn btn-primary"><i class="bi bi-cart3"></i></button>
              </form>
            </div>
          </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal<?= $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-4">
                    <img src="<?= $row['gambar']; ?>" class="" alt="..." width="100%">
                  </div>
                  <div class="col text-start">
                    <h3><?= $row['nama_barang']; ?></h3>
                    <p><?= $row['keterangan']; ?></p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    Advantage Of Product:
                    <ul>
                      <?= $row['keuntungan']; ?>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <form action="addcart.php" method="post">
                  <input type="hidden" name="id" value="<?= $row['id']; ?>">
                  <button type="submit" class="btn btn-primary"><i class="bi bi-cart3"></i></button>
                </form>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

</body>

</html>