<?php session_start();
    require '../../connection.php';
    $sql = "Select * from product;";
    $product=$db->query($sql)->fetch_all();
    if(isset($_POST['edit'])){
      $_SESSION['id-edit']=$_POST['edit'];
      header("Location: editForm.php");
    }
    if(isset($_POST['delete'])){
      $id=$_POST['delete'];
      $sql = "DELETE FROM product WHERE id=".$id.";";
      $db->query($sql);
      header("Location: adminForm.php");
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <link rel="stylesheet" href="../../Assets/CSS/admin.css">
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
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Services</a>
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
    <center><h1 class="font-weight-light">Ukulele Shop Management</h1></center>
  </did>
  <nav class="navbar navbar-light ">
    <a href="addForm.php">
  <button class="navbar-brand btn btn-outline-warning">Add</button></a>
  <form class="form-inline">
    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
  </form>
</nav>
  <table class="table">
  <caption>List of products</caption>
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Image</th>
      <th scope="col">Name</th>
      <th scope="col">Price</th>
      <th scope="col">Old Price</th>
      <th scope="col">Quantity</th>
      <th scope="col">Type</th>
      <th scope="col">Description</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
      <?php for($i=0;$i<count($product);$i++){  ?>
    <tr>
      <th scope="row"><?php echo $product[$i][0]; ?></th>
      <td><img src="<?php echo "../../".$product[$i][7]; ?>" alt="" style="width:100px"></td>
      <td><?php echo $product[$i][1]; ?></td>
      <td><?php echo $product[$i][2]; ?></td>
      <td><?php echo $product[$i][3]; ?></td>
      <td><?php echo $product[$i][4]; ?></td>
      <td><?php echo $product[$i][5]; ?></td>
      <td><?php echo $product[$i][6]; ?></td>
      <td><form action="" method="POST"><button class="btn btn-primary" name="edit" value="<?php echo $product[$i][0]; ?>">Edit</button></form></td>
      <td><form action="" method="POST"><button class="btn btn-danger" name="delete" value="<?php echo $product[$i][0]; ?>">Delete</button></form></td>
    </tr>
      <?php } ?>
  </tbody>
</table>
</section>
<div class="container">
<center><img src="../../Assets/Image/logo3.jpg" alt="logo" style="margin: 30px;"></center>
</div>
</body>
</html>