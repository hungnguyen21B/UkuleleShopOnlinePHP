<?php
session_start();
require 'connection.php';
require 'Model/product.php';
require 'Model/ukulele.php';
require 'Model/accessory.php';
require 'Model/productDatabase.php';
//With Customer
$canNotAddCart = "block";
$canAddCart = "none";
if (!isset($_SESSION['check-login'])) {
  $_SESSION['check-login'] = false;
}
if (($_SESSION['check-login']) == true) {
  $canNotAddCart = "none";
  $canAddCart = "block";
}
if (isset($_POST['log-out'])) {
  $_SESSION['check-login'] = false;
  header("Location: View/loginForm.php");
}
if (isset($_POST['detail'])) {
  $_SESSION['id-detail'] = $_POST['detail'];
  header("Location: View/Cus/detailForm.php");
}
if (isset($_POST['addCart'])) {
  $idProduct = $_POST['addCart'];
  $idAccount = 0;
  if (isset($_SESSION['id-account-login'])) {
    $idAccount = $_SESSION['id-account-login'];
  }
  checkQuantity($idProduct);
  actionWhenAddToCArt($idProduct,$idAccount);
}
$products = getAllProduct();
//with Admin