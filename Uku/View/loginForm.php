<?php session_start();
    require '../connection.php';
    $sql = "Select * from account;";
    $accounts=$db->query($sql)->fetch_all(); 
    if(isset($_POST["login"])){
      $username = $_POST["user-name"];
      $password = $_POST["password"];
      // echo $username." " .$password;
      $sql = "select * from account where username = '".$username."' and password ='".$password."';";
      $result = $db->query($sql)->fetch_all();
      if(count($result)>0){
        if($result[0][4]==true){
          header('Location: Admin/adminForm.php');
        }else{
          $_SESSION['check-login']=true;
          header('Location: ../index.php');
        }
      }else {

      }
      }
?> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="../Assets/CSS/login.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="container">
  <div class="row no-gutter">
    <!-- <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div> -->
    <div class="col-md-8 col-lg-6">
      <div class="login d-flex align-items-center py-5">
        <div class="container">
          <div class="row">
            <div class="col-md-9 col-lg-8 mx-auto">
              <h3 class="login-heading mb-4">Welcome to our shop!</h3>
              <form method="POST">
                <div class="form-label-group">
                  <input type="user-name" id="inputEmail" class="form-control" name="user-name"placeholder="Email address" required autofocus>
                  <label for="inputEmail">User-name</label>
                </div>

                <div class="form-label-group">
                  <input type="password" id="inputPassword" class="form-control" name="password"placeholder="Password" required>
                  <label for="inputPassword">Password</label>
                </div>

                <div class="custom-control custom-checkbox mb-3">
                  <input type="checkbox" class="custom-control-input" id="customCheck1">
                  <label class="custom-control-label" for="customCheck1">Remember password</label>
                </div>
                <button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit" name ="login">Sign in</button>
                <div class="text-center">
                  <a class="small" href="#">Forgot password?</a>
                </div>
                <div class="text-center">
                  <a class="medium" href="Cus/registerForm.php">You haven't had any account!</a>
                </div>
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