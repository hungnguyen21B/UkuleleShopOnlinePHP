<?php 
session_start();
require 'connection.php';
require '../Model/account.php';
require '../Model/accountDatabase.php';
if (isset($_POST["login"])) {
  $username = $_POST["user-name"];
  $password = $_POST["password"];
  checkLogin($username,$password);
}
if(isset($_POST['register'])){
  $username= $_POST['username'];
  $phonenumber= $_POST['phone-number'];
  $password1= $_POST['password1'];
  $password2= $_POST['password2'];
  checkRegister($username,$password1,$password2,$phonenumber);
}
?>
