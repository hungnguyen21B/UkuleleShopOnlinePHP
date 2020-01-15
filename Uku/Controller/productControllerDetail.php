<?php 
session_start();
require '../../Controller/connection.php';
require '../../Model/product.php';
require '../../Model/productAdmin.php';
require '../../Model/productDatabaseAdmin.php';
require '../../Model/productDatabase.php';
$id = 0;
if (isset($_SESSION['id-detail'])) {
  $id = $_SESSION['id-detail'];
}
$product = selectOneProduct($id);
$img = selectListProductDetail($product->name);
if (isset($_POST['add-cart-detail'])) {
    $idAccount=$_SESSION['id-account-login'];
    actionWhenAddToCArt($id,$idAccount);
    header("Location: detailForm.php");
  }
?>