<?php
session_start();
$id = $_SESSION["id"];
require 'functions.php';
// require 'autofill.php';

if (!isset($_SESSION["logged_in"])) {
  header("Location: login.php");
  exit;
}

$cart = query("SELECT cart.id, nama_barang, gambar, harga from cart
               inner join barang on cart.id_barang = barang.id 
               where id_user = '$id'
               and status = 0
               order by barang.id asc");

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<!-- icon -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->


    <title>Cart!</title>
  </head>
  <body>
      <div class="container-fluid">
        <nav class="navbar navbar-light bg-light">
            
            <img src="images/logo.jpg" alt="" width="100" height="24">
            <div class="container justify-content-end">
            <a class="btn btn-outline-success me-2" href="cart.php" ><i class="bi bi-cart3"></i></a>
              <a class="btn btn-outline-success me-2" href="home.php" >About</a>
              <a class="btn btn-outline-success me-2" href="catalog.php" >Catalog</a>
              <a class="btn btn-outline-success me-2" href="contact.php" >Contact</a>
              <?php if($_SESSION):?>
                <a class="btn btn-outline-success me-2" href="logout.php" >
                  Logout
                </a>
                <?php else:?>
                  <a class="btn btn-outline-success me-2" href="login.php" >
                  Login
                  </a>
                <?php endif;?>
            </div>
        </nav>
        <div class="container-fluid mt-3">
          <!-- <a href="catalog.php" class=""><h6> < Back To Product</h6></a> -->
          <!-- <h1 class="text-center">Contact</h1> -->
        </div>
        <div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
    <div class="modal-body">
      <div class="row">
      <h1 class="text-center mb-2" >Contact</h1>
      <hr>
      </div>
      <div class="row">
         <div class="col-2">
           
          </div>
          <div class="offset-1 col-6">
            <div class="row">
              <br>
              <br>
              <label for=""><h3 class="text-secondary">Company Address</h3></label>
              <br>
              <br>
              <label for="">Jl. Komp. Multi Guna No.2, Pakualam, Serpong Utara, South Tangerang City, Banten</label>
              <br>
              <br>
              <br>
              <br>
              <br>
            </div>
            <div class="row mb-3">
                <label for=""><h3 class="text-secondary">Company Contact</h3></label>
                <br>
                <br>
            <label for="">No telp kantor : (021) 22219615</label>
            <label for="">Whatsapp : +62 822-1455-5509 </label>
            </div>
          </div>
        </div>
    </div>
  </div>
        <!-- <div class="card mx-5 mb-5">
          <table class="table table-striped" id="" cellpadding="10">
                  <thead class="">
                      <tr>
                          <th class="text-center">Product</th>
                          <th class="text-center">Price</th>
                          <th class="text-center">Qty</th>
                          <th class="text-center">Total</th>
                      </tr>
                  </thead>
                  <?php foreach($cart as $row):?>
                    <tr>
                      <td>
                        <div class="row">
                          <div class="col-8 text-center">
                          <img src="images/<?= $row['gambar'] ;?>" alt="" width="30%">
                          </div>
                          <div class="col-3">
                            <div class="row">
                              <?=$row['nama_barang'];?>
                            </div>
                            <div class="row">
                              <form action="deletecart.php" method="post">
                                <input type="hidden" name="id" value="<?=$row['id'];?>">
                                <button type="submit" class="btn-sm text-danger border-0" >Remove </button>
                              </form>
                            </div>
                          </div>
                          </div>
                      </td>
                      <td>
                        Rp. <h6 id=""><?= number_format($row['harga'], 0, ',', '.');?></h6>
                        <input class="form-control form-inline" type="hidden" id="harga[]" value="<?= $row['harga'] ;?>" style="display: inline;">
                      </td>
                      <td width="15%">
                        <div class="input-group mb-3">
                        <span onclick="decrease(this)" class="input-group-text" id="basic-addon1"><i class="d-inline bi bi-dash-circle"></i></span>
                          <input class="form-control form-inline" type="number" id="qty[]" value="0" style="display: inline;">
                          <span onclick="increment(this)" class="input-group-text" id="basic-addon1"><i class="d-inline bi bi-plus-circle"></i></span>
                        </div>
                      </td>
                      <td width="20%">
                        <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Rp.</span>
                          <input class="form-control form-inline" type="number" id="total[]" value="" style="display: inline;" readonly>
                        </div>
                      </td>
                    </tr>
                  <?php endforeach;?>
                  <tr>
                    <td colspan="3" class="text-end"><h3>Total</h3></td>
                    <td>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Rp.</span>
                          <input class="form-control form-inline" type="number" id="totalharga" value="" style="display: inline;" readonly required>
                        </div>
                    </td>
                  </tr>
          </table>
        </div> -->
</html>