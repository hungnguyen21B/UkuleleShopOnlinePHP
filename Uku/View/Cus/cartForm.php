<?php require '../../Controller/cartController.php';
?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Cart</title>
  <link rel="stylesheet" href="../../Assets/CSS/cartForm.css">
  <style>


  </style>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="#"><img src="../../Assets/Image/logo2.jpg" alt="" style="margin: 20px 0px;"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="../../index.php">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <!-- <form action="View/loginForm.php" method="POST"> -->
            <a class="nav-link" href="cartForm.php"><i class="fas fa-cart-arrow-down"></i></a>
            <!-- </form> -->
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <section class="py-5">

    <did class="container">
      <center>
        <h1 class="font-weight-light">Ukulele Shopping Cart</h1>
      </center>
    </did>
    <div class="container">
      <table class="table">
        <caption>
          <div class="container" style="display:flex;  flex-direction: row;   justify-content: space-between;">List of products &nbsp&nbsp&nbsp&nbsp
            <div><button class="btn btn-info" id="btn-order" onclick="displayOrderForm()">Order</button></div>
          </div>
        </caption>
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Image</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Quantity</th>
            <th scope="col">Total</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
          </tr>
        </thead>
        <tbody>
          <?php for ($i = 0; $i< count($products); $i++) {
            $total += $products[$i]->getTotalOnePro(); ?>
            <tr>
              <th scope="row"><?php echo $i + 1; ?></th>
              <td><img src="<?php echo $products[$i]->getImage(); ?>" alt="" style="width:100px"></td>
              <td><?php echo $products[$i]->name; ?></td>
              <td><?php echo $products[$i]->price; ?></td>
              <td>
                <form action="" method="POST"><input type="text" value="<?php echo $products[$i]->quantity; ?>" style="width:40px" name="quantity">
              </td>
              <td><?php echo $products[$i]->getTotalOnePro(); ?></td>
              <td><button class="btn btn-primary" name="edit" value="<?php echo $products[$i]->id; ?>">Edit</button></form>
              </td>
              <td>
                <form action="" method="POST"><button class="btn btn-danger" name="delete" value="<?php echo $products[$i]->id; ?>">Delete</button></form>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </section>
  <div class="container">
    <form method="POST" class="credit-card-div" id="orderForm" style="display:none">
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="row ">
            <div class="col-md-12">
              <h2>Order</h2>
            </div>

            <div class="col-md-12">
              <input type="text" class="form-control" name="name" placeholder="Enter Full Name" />
            </div>
          </div>
          <div class="row ">
            <div class="col-md-12 pad-adjust">
              <input type="phone-number" class="form-control" name="phone" placeholder="Enter Phone Number" />
            </div>
          </div>
          <div class="row ">
            <div class="col-md-3 col-sm-3 col-xs-3">
              <span class="help-block text-muted small-font">Form of delivery</span>
              <div class="form-control"><input type="checkbox" id="myCheck" onclick="delivery()">
                <div class="help-block text-muted small-font" id="delivery">Normal (5-7 days)</div>
              </div>

            </div>
            <div class="col-md-3 col-sm-3 col-xs-3">
              <span class="help-block text-muted small-font">Total</span>
              <div class="form-control"><?php echo $total; ?></div>
            </div>

            <div class="col-md-3 col-sm-3 col-xs-3">
              <span class="help-block text-muted small-font">Ship</span>
              <div class="form-control" id="ship">35000</div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-3">
              <span class="help-block text-muted small-font">Payment amount</span>
              <div class="form-control" id="payment"></div>
              <input type="hidden" name="payment" id="input-payment">
            </div>
          </div>
          <div class="row ">
            <div class="col-md-12 pad-adjust">
              <input type="text" class="form-control" name="address" placeholder="Enter shipping address" />
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 pad-adjust">
              <input type="text" class="form-control" placeholder="Comment" name="comment" style="height:100px; text-align: left;text-align: start;" />
            </div>
          </div>
          <div class="row ">
            <div class="col-md-6 col-sm-6 col-xs-6 pad-adjust">
              <div class="btn btn-danger" onclick="hideOrderForm()">Cancel</div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6 pad-adjust">
              <button class="btn btn-warning btn-block" onclick="hideOrderForm()" name="order">PAY NOW</button>
            </div>
          </div>

        </div>
      </div>
    </form>
  </div>
  <div class="container">
    <center><img src="../../Assets/Image/logo3.jpg" alt="logo" style="margin: 30px;"></center>
  </div>
  <script src="../../Assets/JS/index.js"></script>
  <script>
    document.getElementById("payment").innerText = 35000 + <?php echo $total; ?>;
    document.getElementById("input-payment").value = Number(document.getElementById("payment").textContent);

    function delivery() {
      var checkBox = document.getElementById("myCheck");
      if (checkBox.checked == true) {
        document.getElementById("delivery").innerText = "Fast (3-5 days)";
        document.getElementById("ship").innerText = 45000;
        document.getElementById("payment").innerText = 45000 + <?php echo $total; ?>;
      } else {
        document.getElementById("delivery").innerText = "Normal (5-7 days)";
        document.getElementById("ship").innerText = 35000;
        document.getElementById("payment").innerText = 35000 + <?php echo $total; ?>;
      }
      document.getElementById("input-payment").value = Number(document.getElementById("payment").textContent);
    }
  </script>

</body>

</html>