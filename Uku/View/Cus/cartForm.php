<?php session_start();
    require '../../connection.php';
    $idAccount=0;
    $total=0;
    if(isset($_SESSION['id-account-login'])){
        $idAccount=$_SESSION['id-account-login'];
    }
    $sql = "Select p.id,p.name,p.price,c.quantitty,p.image,p.price* c.quantitty from product as p, cart as
    c where c.id_account=".$idAccount." and c.id_product=p.id ;";
    $product=$db->query($sql)->fetch_all();
    if(isset($_POST['edit'])){
        if(isset($_POST['quantity'])){
            $idproduct=$_POST['edit'];
            $quantityChanged=$_POST['quantity'];
            $sql = "select quantitty from cart WHERE id_product =".$idproduct." and id_account=".$idAccount." ;";
            $oldQuantity=$db->query($sql)->fetch_all();
            $sql = "select quantity from product WHERE id=".$idproduct.";";
            $quantityProInProduct=$db->query($sql)->fetch_all();
            var_dump($oldQuantity[0][0]);
            // echo "<script>alert('".$quantityProInProduct[0][0]."');</script>";
            if(($quantityChanged>0 )&& (($quantityProInProduct[0][0]+$oldQuantity[0][0])>=$quantityChanged)){
                $sql = "update cart set quantitty=".$quantityChanged." WHERE id_product=".$idproduct." and id_account=".$idAccount.";";
                // echo "<script>alert('".$sql."');</script>";
                $db->query($sql);
                $sql="update product set quantity = quantity+".$oldQuantity[0][0]."-".$quantityChanged." where id=".$idproduct." ;";
                // echo "<script>alert('".$sql."');</script>";
                $db->query($sql);
                header("Location: cartForm.php");
            }else {
                echo "<script>alert('Please, fill in the right information');</script>";
            } 
        }
    }
    if(isset($_POST['delete'])){
      $idproduct=$_POST['delete'];
      $sql = "DELETE FROM cart WHERE id_product=".$idproduct." and id_account=".$idAccount.";";
      $db->query($sql);
    }
    // if(isset($_SESSION['payment']))
    //   {
    //     $payment=$_SESSION['payment'];
    //   }  else {
    //     $payment=0;
    //   } 
    if(isset($_POST['order'])){
      $payment=$_POST['payment'];
      $name=$_POST['name'];
      $phone=$_POST['phone'];
      $address=$_POST['address'];
      $comment=$_POST['comment'];
      $listSp=null;
      for($i=0;$i<count($product);$i++){
        if($listSp==null){
          $listSp=$product[$i][0];
        }else{
          $listSp=$listSp.", ". $product[$i][0];
        }  
      }
      $sql="insert into customer(name, phone, address, payment,comment, listSp, id_account)
      values ('".$name."','".$phone."','".$address."',".$payment.",'".$comment."','".$listSp."',".$idAccount.")
      ; DELETE FROM cart WHERE id_account=".$idAccount.";";
      $db->query($sql);

    } 
   
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
          <a class="nav-link" href="#">Home
                <span class="sr-only">(current)</span>
              </a>
        </li>
        <li class="nav-item">
          <!-- <form action="View/loginForm.php" method="POST"> -->
          <a class="nav-link" href="View/loginForm.php">Log out</a>
          <!-- </form> -->
        </li>
      </ul>
    </div>
  </div>
</nav>
<section class="py-5">
  
  <did class="container">
    <center><h1 class="font-weight-light">Ukulele Shopping Cart</h1></center>
  </did>
  <div class="container">
  <table class="table">
  <caption><div class="container" style="display:flex;  flex-direction: row;   justify-content: space-between;">List of products &nbsp&nbsp&nbsp&nbsp
  <div><button class="btn btn-info" id="btn-order" onclick="displayOrderForm()">Order</button></div></div></caption>
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
      <?php for($i=0;$i<count($product);$i++){  $total+=$product[$i][5];?>
    <tr>
      <th scope="row"><?php echo $i+1; ?></th>
      <td><img src="<?php echo "../../".$product[$i][4]; ?>" alt="" style="width:100px"></td>
      <td><?php echo $product[$i][1]; ?></td>
      <td><?php echo $product[$i][2]; ?></td>
      <td><form action="" method="POST"><input type="text" value="<?php echo $product[$i][3]; ?>"style="width:40px" name="quantity"></td>
      <td><?php echo $product[$i][5]; ?></td>
      <td><button class="btn btn-primary" name="edit" value="<?php echo $product[$i][0]; ?>">Edit</button></form></td>
      <td><form action="" method="POST"><button class="btn btn-danger" name="delete" value="<?php echo $product[$i][0]; ?>">Delete</button></form></td>
    </tr>
      <?php } ?>
  </tbody>
</table>
  </div>
</section>
<div class="container">
<form method="POST" class="credit-card-div" id="orderForm" style="display:none">
<div class="panel panel-default" >
 <div class="panel-heading">
 <div class="row "><div class="col-md-12"><h2>Order</h2>
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
                  <span class="help-block text-muted small-font" >Form of delivery</span>
                  <div class="form-control"><input type="checkbox" id="myCheck"  onclick="delivery()">
                  <div class="help-block text-muted small-font" id="delivery">Normal (5-7 days)</div></div>
                 
              </div>
              <div class="col-md-3 col-sm-3 col-xs-3">
                  <span class="help-block text-muted small-font" >Total</span>
                  <div class="form-control"><?php echo $total; ?></div>
              </div>
        
         <div class="col-md-3 col-sm-3 col-xs-3">
                  <span class="help-block text-muted small-font" >Ship</span>
                  <div class="form-control" id="ship">35000</div>
              </div>
         <div class="col-md-3 col-sm-3 col-xs-3">
                <span class="help-block text-muted small-font" >Payment amount</span>
                <div class="form-control" id="payment"></div>
                <input type="hidden" name="payment" id="input-payment">
         </div>
          </div>
     <div class="row ">
              <div class="col-md-12 pad-adjust">
                  <input type="text" class="form-control"name="address" placeholder="Enter shipping address" />
              </div>
          </div>
     <div class="row">
<div class="col-md-12 pad-adjust">
      <input type="text" class="form-control" placeholder="Comment" name="comment"style="height:100px; text-align: left;text-align: start;" />
</div>
     </div>
       <div class="row ">
            <div class="col-md-6 col-sm-6 col-xs-6 pad-adjust">
                <div class="btn btn-danger" onclick="hideOrderForm()">Cancel</div> 
              </div>
              <div class="col-md-6 col-sm-6 col-xs-6 pad-adjust">
              <button class="btn btn-warning btn-block"onclick="hideOrderForm()" name="order">PAY NOW</button>
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
document.getElementById("payment").innerText = 35000+<?php echo $total; ?>;
document.getElementById("input-payment").value=Number(document.getElementById("payment").textContent);
function delivery() {
    var checkBox = document.getElementById("myCheck");
    if (checkBox.checked == true) {
        document.getElementById("delivery").innerText = "Fast (3-5 days)";
        document.getElementById("ship").innerText = 45000;
        document.getElementById("payment").innerText = 45000+<?php echo $total; ?>;
    } else {
        document.getElementById("delivery").innerText = "Normal (5-7 days)";
        document.getElementById("ship").innerText = 35000;
        document.getElementById("payment").innerText = 35000+<?php echo $total; ?>;
    }
    document.getElementById("input-payment").value=Number(document.getElementById("payment").textContent);
}
function displayOrderForm(){
  document.getElementById("orderForm").style.display = 'grid';
  document.getElementById("btn-order").style.display = 'none';
}
function hideOrderForm(){
  document.getElementById("orderForm").style.display = 'none';
  document.getElementById("btn-order").style.display = 'flex';
}
</script>

</body>
</html>