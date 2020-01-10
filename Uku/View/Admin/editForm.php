<?php session_start();
    require '../../connection.php';
    $id=0;
    if(isset($_SESSION['id-edit'])){
      $id=$_SESSION['id-edit'];
    }
    
    $sql = "Select * from product where id =".$id.";";
    $product=$db->query($sql)->fetch_all();
    $_SESSION['old-price']= $product[0][3];
    if(isset($_POST['edit'])){
     $name=$_POST['name'];
     $quantity=$_POST['quantity'];
     $type=$_POST['type'];
     $price=$_POST['price'];
     $oldPrice= $_SESSION['old-price'];
     $description=$_POST['description'];
     $image=$_POST['image'];
     $sql="update product set name='".$name."',price=".$price.",quantity=".$quantity.
     ",type='".$type."',description='".$description."',image='Assets/Image/".$image.
     "',oldPrice=".$oldPrice." where id=".$id.";";
     $db->query($sql);
     echo "<script>alert('Successful...');</script>";
     header("Location: adminForm.php");
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit</title>
    <link rel="stylesheet" href="../../Assets/CSS/editForm.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="container-fluid">
  <div class="row no-gutter">
    <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image " style="background-image: url('<?php echo "../../".$product[0][7]; ?>');"></div>
    <!-- bg -->
    <div class="col-md-8 col-lg-6">
      <div class="login d-flex align-items-center py-5">
        <div class="container">
          <div class="row">
            <div class="col-md-9 col-lg-8 mx-auto">
              <h3 class="login-heading mb-4">Edit Product ID:  <?php echo $product[0][0]; ?> </h3>
              <form method="POST">
                <div class="form-label-group">
                  <input type="text" id="inputEmail" value="<?php echo $product[0][1]; ?>" class="form-control"name="name" placeholder="Email address" required autofocus>
                  <label for="inputEmail">Name</label>
                </div>
                <div class="form-label-group">
                  <input type="text" id="inpute" value="<?php echo $product[0][2]; ?>"class="form-control"name="price" placeholder="Email address"  required>
                  <label for="inpute">Price</label>
                </div>
                <div class="form-label-group">
                  <input type="text" id="inputPassword" value="<?php echo $product[0][4]; ?>"class="form-control"name="quantity" placeholder="Password" required>
                  <label for="inputPassword">Quantity</label>
                </div>
                <div class="form-label-group">
                  <input type="text" id="inputail" value="<?php echo $product[0][5]; ?>"class="form-control"name="type" placeholder="Email address" required autofocus>
                  <label for="inputail">Type</label>
                </div>
                <div class="form-label-group">
                  <input type="text" id="inputeb" value="<?php echo $product[0][6]; ?>" class="form-control"name="description" placeholder="Email address"  required>
                  <label for="inputeb">Description</label>
                </div>
                <div class="form-label-group">
                  <input type="file" id="inputea" class="form-control" placeholder="Email address"name="image"  required>
                  <label for="inputea">Image</label>
                </div>
                <button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit" name="edit">Edit</button>
                <div class="text-center">
                  <a class="small" href="adminForm.php">Back to Page?</a></div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>