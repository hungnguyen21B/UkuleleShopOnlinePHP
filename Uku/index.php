<?php session_start();
    require 'connection.php';
    if(!isset($_SESSION['check-login'])){
      $_SESSION['check-login']=false;
    }
    $canNotAddCart="block";
    $canAddCart="none";
    if(($_SESSION['check-login'])==true){
      $canNotAddCart="none";
      $canAddCart="block";
    }
    if(isset($_POST['log-out'])){
      $_SESSION['check-login']=false;
      header("Location: View/loginForm.php");
    }
    if(isset($_POST['detail'])){
      $_SESSION['id-detail']=$_POST['detail'];
      header("Location: View/Cus/detailForm.php");
    }
    if(isset($_POST['addCart'])){
      $idProduct=$_POST['addCart'];
      $idAccount=0;
        if(isset($_SESSION['id-account-login'])){
          $idAccount=$_SESSION['id-account-login'];
        }
        $sql ="select quantity from product where id = ".$idProduct.";";
        $checkQuantityPro=$db->query($sql)->fetch_all();
          if(count($checkQuantityPro)>0)
          {
          
            if ($checkQuantityPro[0][0]<1){
              // echo "<script>alert('Not enough.');</script>";
              // $sql ="delete from product where id = ".$idProduct." ;";
              echo "<script>confirm('Not enough.');</script>";
              header("Location: index.php");
              exit;
              // $db->query($sql);
            }
          }
      $sql ="select id_product from cart where id_product = ".$idProduct.";";
      $checkEmptyInCart=$db->query($sql)->fetch_all();     
        if(count($checkEmptyInCart)<1){
          $sql = "insert into cart(id_product,id_account,quantitty) values (".$idProduct.",".$idAccount.",1);";
          // echo "<script>alert('".$sql."');</script>";
          $db->query($sql);
        }else {
          $sql= "update cart set quantitty=quantitty+1 where id_product = ".$idProduct." and id_account = ".$idAccount." ;";
          // echo "<script>alert('".$sql."');</script>";
          $db->query($sql);
        }
      $sql=" update product set quantity=quantity-1 where id = ".$idProduct.";";
      $db->query($sql);
    }
    $sql = "Select * from product where quantity>=1;";
    $product=$db->query($sql)->fetch_all();
    // var_dump($product);
 ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Main Page</title>
    <link rel="stylesheet" href='index.css'>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
<span class="top-contact">NEED ASSISTANCE? 80324609687</span>
  <div class="container">
    <a class="navbar-brand" href="#"><img src="Assets/Image/logo2.jpg" alt="" style="margin: 20px 0px;"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home
                <span class="sr-only">(current)</span>
              </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="View/Cus/cartForm.php"><i class="fas fa-cart-arrow-down"></i></a>
        </li>
        <li class="nav-item">
          <!-- <form action="View/loginForm.php" method="POST"> -->
          <?php if(($_SESSION['check-login'])){ 
          ?>
          <form action="" method="POST">
          <button class="nav-link btn-logout" style=" background-color: Transparent;
                                                      background-repeat:no-repeat;
                                                      border: none;
                                                      cursor:pointer;
                                                      overflow: hidden;
                                                      outline:none;" 
          name ="log-out">Log out</button></form>
         <?php }else{ ?>
          <a class="nav-link" href="View/loginForm.php">Log in</a>
          <?php }?>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- <img src="slide2.jpg" alt=""> -->
<header>
<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
    <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="Assets/Image/slide2.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <!-- <h5>First slide label</h5>
        <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p> -->
      </div>
    </div>
    <div class="carousel-item">
      <img src="Assets/Image/slide1.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <!-- <h5>Second slide label</h5>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> -->
      </div>
    </div>
    <div class="carousel-item">
      <img src="Assets/Image/slide3.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <!-- <h5>Third slide label</h5>
        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p> -->
      </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</header>

<!-- Page Content -->
<section class="py-5">
  <div class="container">
    <nav class="navbar navbar-light ">
    <h1 class="font-weight-light">Check out the product</h1>
  <form class="form-inline">
    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
  </form>
</nav>
    
  <div class="row row-cols-4">
  <?php for($i=0;$i<count($product);$i++){?>
    <div class="col img-thumbnail" style="margin:10px">
      <div class="img-thumbnail" style="height:350px" ><img src="<?php echo $product[$i][7]; ?>" alt="" style="width:200px" ></div>
      <div><?php echo $product[$i][1]; ?></div>
      <div class="d-flex">
        <div style="margin-right:40%"><?php echo $product[$i][2]."VND"; ?></div>
        <div style="text-decoration: line-through"><?php echo $product[$i][3]."VND"; ?></div>
      </div>
      <div class="d-flex" style="display:  <?php echo $canNotAddCart;?>">
      <div><button class="btn btn-primary"style="display:  <?php echo $canNotAddCart;?>" onclick="addCartFailed()">Add to Cart</button></div>
      <button class="btn btn-warning"style="display:  <?php echo $canNotAddCart;?>" onclick="addCartFailed()">View detail</button>
      </div>
      <div  class="d-flex" style="display:  <?php echo $canAddCart;?>">
      <form action="" method="POST"  >
        <button class="btn btn-primary" style="display:  <?php echo $canAddCart;?>" id="canAddCart"name="addCart" value="<?php echo $product[$i][0]; ?>">Add to Cart</button>
      </form>
      <div>
      <form action="" method="POST"  >
        <button class="btn btn-warning" style="display:  <?php echo $canAddCart;?>" id="canAddCart"name="detail" value="<?php echo $product[$i][0]; ?>">View detail</button>
      </form>
      </div>
    </div>
    </div>
    <br>
    <?php
  }
    ?>
  </div>
  </div>
</section>
<div id="footer">
        <div class="footer-top">
            <div class="footer-top-item">
                <span>Shop Products</span> <br> Models Hawaiian Made <br> Custom Build <br> Accessories <br> Advanced Search
            </div>
            <div class="footer-top-item">
                <span>Helpful Links</span> <br>Support Center <br>Shipping & Turnaround <br>Customer Service <br>Return Policy <br>Our Setup Process <br> Ukulele Care
            </div>
            <div class="footer-top-item" id="footer-top-easy">
                <span>Easy Shopping</span> <br> We accept all major credit cards, PayPal, and now you can apply for PayPal credit and get 6 months with no interest! <br>
                <img src="Image/sponsor.png" alt="" style="margin: 30px auto;">
            </div>
            <div class="footer-top-item" id="footer-top-contact">
                <p><span>NEED ASSISTANCE?</span></p>
                <p>808.622.8000</p>
                <p>66-560 #4 Kamehameha Hwy.</p>
                <p>Haleiwa HI, 96712</p>
                Email:&nbsp;<a href="#">hung.nguyen@gmail.com</a>
            </div>
        </div>
        <center><img src="Assets/Image/logo3.jpg" alt="logo" style="margin: 30px;"></center>
    </div>
    <script src="Assets/JS/index.js"></script>
</body>
</html>