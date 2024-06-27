<?php
session_start();
require 'functions.php';

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
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->

  <!-- icon -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

  <!-- Option 2: Separate Popper and Bootstrap JS -->

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
    crossorigin="anonymous"></script>



  <title>Home</title>
</head>

<body class="p-0">
  <div class="container-fluid">
    <nav class="navbar navbar-light bg-light">

      <img src="images/logo.jpg" alt="" width="150" height="40">
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
    <div class="row justify-content-center mb-5">
      <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active" style="height:900px;object-fit:fill;">
            <img src="images/penten-01.jpg" class="d-block w-10" width="100%" alt="...">
          </div>
          <div class="carousel-item" style="height:900px;object-fit:fill;">
            <img src="images/penten-02.jpg" class="d-block w-10" width="100%" alt="...">
          </div>
          <div class="carousel-item" style="height:900px;object-fit:fill;">
            <img src="images/penten-03.jpg" class="d-block w-10" width="100%" alt="...">
          </div>
          <div class="carousel-item" style="height:900px;object-fit:fill;">
            <img src="images/penten-04.jpg" class="d-block w-10" width="100%" alt="...">
          </div>
          <div class="carousel-item" style="height:900px;object-fit:fill;">
            <img src="images/penten-05.jpg" class="d-block w-10" width="100%" alt="...">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
          data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
          data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>

    <div class="d-flex justify-content-center  gap-5 mb-5">
      <div class="card" style="width: 30rem;border: 2px solid green;">
        <div class="card-body">
          <div class="d-flex justify-content-center">
            <h5 class="card-title mt-5">Go Green</h5>
          </div>
          <p class="card-text">
            DJI International (Grup), diririkan pada tahun 1989, adalah salah satu produsen terkemuka dan
            mendistribusikan spesialis bahan bangunan untuk semua industri yang meliputi raised floor</p>
        </div>
      </div>
      <div class="card" style="width: 30rem;border: 2px solid green;">
        <div class="card-body">
          <div class="d-flex justify-content-center">
            <h5 class="card-title mt-5">Misi Kami</h5>
          </div>
          <ul>
            <li> Ramah lingkungan</li>
            <li> Bersih, Estetika, Fleksibel</li>
            <li> Kualitas nyaman dan tahan lama</li>
            <li> Anti bocor dan waterproofing terbaik</li>
          </ul>
          </p>
        </div>
      </div>
      <div class="card" style="width: 30rem;border: 2px solid green;">
        <div class="card-body">
          <div class="d-flex justify-content-center font-bold">
            <h5 class="card-title mt-5">Mengapa memilih Pentens</h5>
          </div>
          <ul>
            <li>VOC rendah</li>
            <li>Garansi jangka panjang</li>
            <li>Lebih dari 20 tahun spesialis terkait dalam pengalaman waterproofing dan flooring</li>
            <li>Fasilitas manufaktur regional</li>
            <li>Kualitas unggul, pelayanan terbaik, dan harga kompetitif</li>
          </ul>
        </div>
      </div>
    </div>


    <!-- <div class="row row-cols-1 row-cols-md-3 g-4">
          <div class="col">
            <div class="card">
              <img src="..." class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <img src="..." class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <img src="..." class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <img src="..." class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              </div>
            </div>
          </div>
        </div> -->
  </div>

</body>

</html>