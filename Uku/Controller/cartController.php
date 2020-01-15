<?php 
session_start();
require 'connection.php';
require '../../Model/cart.php';
require '../../Model/bill.php';
require '../../Model/cartDatabase.php';
$idAccount = 0;
$total = 0;
if (isset($_SESSION['id-account-login'])) {
  $idAccount = $_SESSION['id-account-login'];
}
$products=getCart($idAccount);
if (isset($_POST['edit'])) {
  if (isset($_POST['quantity'])) {
    $idproduct = $_POST['edit'];
    $quantityChanged = $_POST['quantity'];
    editQuantity($idAccount,$idproduct,$quantityChanged);
  }
}
if (isset($_POST['delete'])) {
  $idproduct = $_POST['delete'];
  deleteInCart($idAccount,$idproduct);
}
// Order
if (isset($_POST['order'])) {
  $payment = $_POST['payment'];
  $name = $_POST['name'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
  $comment = $_POST['comment'];
  $listSp = null;
  for ($i = 0; $i < count($products); $i++) {
    if ($listSp == null) {
      $listSp = $products[$i]->id;
    } else {
      $listSp = $listSp . ", " . $products[$i]->id;
    }
  }
  order($name,$payment,$phone,$address,$comment,$listSp,$idAccount);
}

?>
