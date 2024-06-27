<?php
session_Start();
require 'functions.php';
if(isset($_POST["register"])){
  if (registrasi($_POST) > 0) {
      echo " <script>
               alert(' User Baru Berhasil Ditambahkan ');

               window.location.href = 'login.php';
             </script> ";
  } else{
      mysqli_error($koneksi);
  }
}

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

<!-- icon -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->


    <title>Register!</title>
  </head>
  <body>
      <div class="container-fluid">
        <nav class="navbar navbar-light bg-light">
            
          <img src="images/logo.jpg" alt="" width="100" height="24">
          <div class="container justify-content-end">
              <a class="btn btn-outline-success me-2" href="home.php" >About</a>
              <a class="btn btn-outline-success me-2" href="catalog.php" >Catalog</a>
              <a class="btn btn-outline-success me-2" href="cart.php" >Contact</a>
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

    <div class="row justify-content-center">
      <div class="col-10">
        <div class="card m-5">
            <div class="pt-4 text-center bg-white mb-3">
                <h2>Sign Up</h2>
            </div>
            <div class="card-body">
              <form action="" method="POST">
                <div class="row mb-3">
                  <div class="offset-2 col-2">
                    <label for="name">Name</label>
                  </div>
                  <div class="col-6 p-0">
                    <input type="text" name="name" class="form-control border-bottom" id="name" placeholder="ahmad rizqi" style="border: none;">
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="offset-2 col-2">
                    <label for="Email">Email</label>
                  </div>
                  <div class="col-6 p-0">
                    <input type="email" name="email" class="form-control border-bottom" id="Email" placeholder="Email@example.com" style="border: none;">
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="offset-2 col-2">
                    <label for="Password">Password</label>
                  </div>
                  <div class="col-6 p-0">
                    <input type="password" name="password" class="form-control border-bottom" id="Password" style="border: none;">
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="offset-2 col-2">
                    <label for="Address">Address</label>
                  </div>
                  <div class="col-6 p-0">
                    <input type="text" name="Address" class="form-control border-bottom" id="Address" placeholder="St. Road Number 12" style="border: none;">
                  </div>
                </div>
                <div class="row mb-1">
                  <div class="offset-9 col-2">
                      <button type="submit" name="register" class="btn btn-outline-primary">Sign Up</button>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="text-center col-12">
                    <a href="#" class="text-decoration-none text-dark">Already have an account?</a> 
                    <a href="login.php" class="">Login</a>              
                </div> 
                </div>
              </form>
            </div>
        </div>
      </div>
    </div>

</div>

  </body>
</html>