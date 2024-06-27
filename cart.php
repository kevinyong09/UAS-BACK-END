<?php
session_start();
$id = $_SESSION["id"];
require 'functions.php';
// require 'autofill.php';

if (!isset($_SESSION["logged_in"])) {
  header("Location: login.php");
  exit;
}

$get_address = "SELECT address FROM `user` WHERE id = '$id';";
$result_address = mysqli_query($koneksi, $get_address);
if ($result_address !== null && $result_address->num_rows > 0) {
  $row = $result_address->fetch_assoc();
  $address = $row['address'];
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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


  <!-- icon -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->

  <style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    /* Firefox */
    input[type=number] {
      -moz-appearance: textfield;
    }
  </style>
  <title>Cart!</title>
</head>

<body>
  <div class="container-fluid">
    <nav class="navbar navbar-light bg-light">

      <img src="images/logo.jpg" alt="" width="100" height="24">
      <div class="container justify-content-end">
        <a class="btn btn-outline-success me-2" href="cart.php"><i class="bi bi-cart3"></i></a>
        <a class="btn btn-outline-success me-2" href="home.php">About</a>
        <a class="btn btn-outline-success me-2" href="catalog.php">Catalog</a>
        <a class="btn btn-outline-success me-2" href="contact.php">Contact</a>
        <?php if ($_SESSION) : ?>
          <a class="btn btn-outline-success me-2" href="logout.php">
            Logout
          </a>
        <?php else : ?>
          <a class="btn btn-outline-success me-2" href="login.php">
            Login
          </a>
        <?php endif; ?>
      </div>
    </nav>
    <div class="container-fluid mt-3">
      <a href="catalog.php" class="">
        <h6>
          < Back To Product</h6>
      </a>
      <h1 class="text-center">Shopping Cart</h1>
    </div>
    <form action="finishcart.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="id_user" value=" <?php echo $id ?>">
      <div class="card mx-5 mb-5">
        <table class="table table-striped" id="" cellpadding="10">
          <thead class="">
            <tr>
              <th class="text-center">Product</th>
              <th class="text-center">Price</th>
              <th class="text-center">Qty</th>
              <th class="text-center">Total</th>
            </tr>
          </thead>
          <?php
          $sql = "SELECT cart.id,id_barang, nama_barang, gambar, harga,stok from cart
          inner join barang on cart.id_barang = barang.id 
          where id_user = '$id'
          and status = 0
          order by barang.id asc";

          $result = $koneksi->query($sql);

          if ($result->num_rows > 0) { ?>
            <?php while ($row = $result->fetch_assoc()) {
            ?>
              <tr>
                <td>
                  <div class="row">
                    <div class="col-8 text-center">
                      <img src="<?= $row['gambar']; ?>" alt="" width="30%">
                    </div>
                    <div class="col-3">
                      <div class="row">
                        <?= $row['nama_barang']; ?>
                      </div>
                      <div class="row">
                        <!-- Hapus form deletecart di sini -->
                        <button type="button" class="btn-sm text-danger border-0 remove-item" data-id="<?php echo $row['id']; ?>">Remove</button>
                      </div>
                    </div>
                  </div>
                </td>
                <td>
                  Rp. <h6 id=""><?= number_format($row['harga'], 0, ',', '.'); ?></h6>

                  <input class="form-control form-inline" type="hidden" id="harga[]" value="<?= $row['harga']; ?>" style="display: inline;">
                </td>
                <td width="15%">
                  <div class="input-group mb-3">
                    <span onclick="decrease(this)" class="input-group-text" id="basic-addon1"><i class="d-inline bi bi-dash-circle"></i></span>

                    <input class="form-control form-inline qty-input" type="number" name="qty[<?= $row['id_barang']; ?>]" id="modal_qty_<?= $row['id_barang']; ?>" data-id="<?= $row['id']; ?>" min="1" style="display: inline;" value="1">

                    <span onclick="increment(this)" class="input-group-text" id="basic-addon1"><i class="d-inline bi bi-plus-circle"></i></span>
                  </div>
                </td>
                <td width="20%">
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Rp.</span>
                    <input class="form-control form-inline" type="number" id="total[]" name="total" value="" style="display: inline;" readonly>
                  </div>
                </td>
              </tr>
            <?php } ?>
          <?php } ?>
          <tr>
            <td colspan="3" class="text-end">
              <h3>Total</h3>
            </td>
            <td>
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Rp.</span>
                <input class="form-control form-inline" type="number" id="totalharga" value="" style="display: inline;" readonly required>
              </div>
            </td>
          </tr>
        </table>
      </div>
      <div class="text-end fixed-bottom p-5">
        <button class="btn btn-outline-success me-2" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Proceed to Pay</button>
      </div>
      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header text-center">
              <h1 class="modal-title text-center" id="exampleModalLabel"></h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Shipping</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Payment</button>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                <div class="modal-body">
                  <div class="row">
                    <h1 class="text-center mb-5">Shipping</h1>
                  </div>
                  <div class="row">
                    <div class="offset-1 col-3">
                      The product will be delivered by the company <br> <br>
                      Estimate Time 3 - 7 Days <br> <br>
                      <p class="text-danger">The product will be sent one day after the payment process</p>
                    </div>
                    <div class="offset-1 col-6">
                      <div class="row">
                        <label for="">
                          <h3 class="text-secondary">Input Your Address</h3>
                        </label>

                        <!-- alamat -->
                        <textarea class="form-control" name="address" id="address" cols="30" rows="3" required></textarea>
                        <div class="text-end p-0">
                          <button id="addressButton" class="btn btn-primary my-2">Set Address</button>
                        </div>

                        <script>
                          document.getElementById('addressButton').addEventListener('click', function() {
                            var alamat = "<?php echo $address; ?>";
                            document.getElementById('address').value = alamat;
                          });
                        </script>
                        <!-- alamat -->

                      </div>
                      <div class="row mb-3">
                        <label for="">Input Your Phone Number</label>
                        <div class="input-group mb-3">
                          <span class="input-group-text" id="basic-addon1">+62</span>
                          <input name="phone" class="form-control form-inline" type="number" value="" style="display: inline;" required>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                <div class="modal-body">
                  <div class="row">
                    <h1 class="text-center mb-5">Payment</h1>
                  </div>
                  <div class="row mb-3">
                    <div class="col-4 border border-1 rounded-pill pt-2">
                      <h5 class="text-center">Choose Your Payment Method</h5>
                    </div>
                    <div class="offset-1 col-7 border border-1 rounded-pill">
                      <div class="row">
                        <div class="col-6 text-start pt-2">
                          <h5 class="">Total</h5>
                        </div>
                        <div class="col-6">
                          <input class="form-control form-inline" name="total" type="number" id="totalharga2" value="" style="display: inline;" readonly required>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-4 mt-5">
                      <div class="row px-5">
                        <div class="col-3 border border-1 border-dark">
                          <img src="images/bca.png" alt="" width="100%">
                        </div>
                      </div>
                    </div>
                    <div class="offset-1 col-7">
                      <div class="row">
                        <div class="col-12">
                          <p class="fs-5 text-danger text-end">Waiting For Payment</p>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-12">
                          <h5 class="text-secondary">Bank</h5>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-12">
                          <h5>Bank Central Asia</h5>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-12">
                          <h5 class="text-secondary">Transfer</h5>
                        </div>
                      </div>
                      <div class="border border-1 rounded-pill">
                        <div class="row">
                          <div class="col-5 text-start pt-3 px-4">
                            <p class="fs-5">1247 2098 1298 12</p>
                          </div>
                          <div class="col-7 pt-3 px-4">
                            <p class="fs-5">Rekening Atas Nama <strong>Edward Nari</strong></p>
                          </div>
                        </div>
                      </div>
                      <div class="my-2 p-0">
                        <label for="">Bukti Transfer</label>
                        <input type="file" name="bukti_transfer" class="form-control">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
              <button type="submit" class="btn btn-primary">Finish</button>
            </div>
          </div>
        </div>
    </form>
  </div>

</body>
<script>
  function decrease(element) {
    var inputElement = element.nextElementSibling;
    var row = element.closest('tr');

    var currentValue = parseInt(inputElement.value, 10);
    currentValue--;

    if (currentValue < 1) {
      currentValue = 1;
    }

    inputElement.value = currentValue;
    calculateTotal(row);
  }

  function increment(element) {
    var inputElement = element.previousElementSibling;
    var row = element.closest('tr');

    var currentValue = parseInt(inputElement.value, 10);
    currentValue++;

    inputElement.value = currentValue;
    calculateTotal(row);
  }

  function calculateTotal(row) {
    var price = parseFloat(row.querySelector('h6').textContent.replace(/[^0-9-]+/g, ''));
    var quantity = parseInt(row.querySelector('input[type="number"]').value, 10);
    var total = price * quantity;
    row.querySelector('input[type="number"][id="total[]"]').value = total.toFixed(0);

    updateTotalHarga();
  }

  function updateTotalHarga() {
    var totalElements = document.querySelectorAll('input[type="number"][id="total[]"]');
    var totalHargaElement = document.querySelector('input[type="number"][id="totalharga"]');
    var totalHarga = 0;
    var totalharga2 = document.querySelector('input[type="number"][id="totalharga2"]');

    totalElements.forEach(function(element) {
      totalHarga += parseFloat(element.value);
    });

    totalHargaElement.value = totalHarga.toFixed(0);
    totalharga2.value = totalHarga.toFixed(0);
  }
</script>


<script>
  // Fungsi untuk menyisipkan nilai qty ke dalam form di modal
  function updateModalQty() {
    const qtyInputs = document.querySelectorAll('.qty-input');
    qtyInputs.forEach(input => {
      const id = input.dataset.id;
      console.log(id);
      const modalInput = document.getElementById('modal_qty_' + id);
      if (modalInput) {
        modalInput.value = input.value;
      }
    });
  }

  document.addEventListener('DOMContentLoaded', function() {
    // Panggil updateModalQty setelah semua nilai dimuat
    updateModalQty();
  });
</script>

<!-- delete cart -->
<script>
  document.addEventListener("DOMContentLoaded", function() {
    const removeButtons = document.querySelectorAll('.remove-item');

    removeButtons.forEach(button => {
      button.addEventListener('click', function() {
        const id = this.getAttribute('data-id');
        removeItem(id);
      });
    });

    function removeItem(id) {
      fetch('deletecart.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
          },
          body: 'id=' + encodeURIComponent(id)
        })
        .then(response => response.text())
        .then(data => {
          if (data === 'success') {
            alert('Item removed failed!');
            location.reload();
          } else {
            alert('Item removed successfully!');
            location.reload();
          }
        })
        .catch(error => {
          console.error('Error:', error);
        });
    }
  });
</script>

<!-- <script>

        function decrease(element) {
            var inputElement = element.nextElementSibling;

            var currentValue = parseInt(inputElement.value, 10);

            currentValue--;

            if (currentValue < 1) {
              currentValue = 1;
            }

            inputElement.value = currentValue;
          }

          function increment(element) {
            var inputElement = element.previousElementSibling;

            var currentValue = parseInt(inputElement.value, 10);

            currentValue++;

            inputElement.value = currentValue;
          }
          
    </script> -->

</html>