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


    <title>Home</title>
  </head>
  <body>
      <div class="container-fluid">
        <nav class="navbar navbar-light bg-light">
            
            <img src="images/logo.jpg" alt="" width="100" height="24">
            <form class="container justify-content-end">
            <a class="btn btn-outline-success me-2" href="cart.php" ><i class="bi bi-cart3"></i></a>
              <a class="btn btn-outline-success me-2" href="home.php" >About</a>
              <a class="btn btn-outline-success me-2" href="catalog.php" >Catalog</a>
              <a class="btn btn-outline-success me-2" href="contact.php" >Contact</a>
              <a class="btn btn-outline-success me-2" href="login.php" >Login</a> 
             </form>
        </nav>
        <div class="container-fluid" >
          <a href="catalog.php" class=""> < Back To Product</a>
          <h1 class="text-center">Shipping</h1>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-md-4">
              <h5>The product will be delivered by the company</h5>
              <h5>Estimate Time 3-7 Days</h5>
              <h5 class="text-danger">The product will be sent one day after the payment process</h5>
            </div>
          <div class="col-md-8">
            <form class="row g-3">
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Input Your Address</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
              </div>
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Input Your Phone Number</label>
              <input type="phone" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
            </div>
          </form>
          </div>
          </div>
        </div>
      </div>
        <div class="text-end"> 
          <button class="btn btn-outline-success me-2" type="button">Proceed to Pay</button>
        </div>
      </div>

  </body>
</html>