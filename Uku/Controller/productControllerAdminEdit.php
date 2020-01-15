<?php
session_start();
require '../../Controller/connection.php';
require '../../Model/product.php';
require '../../Model/productAdmin.php';
require '../../Model/productDatabaseAdmin.php';
if (isset($_SESSION['id-edit'])) {
    $product = selectOneProduct($_SESSION['id-edit']);
}
if (isset($_POST['edit'])) {
    $_SESSION['old-price'] = $product->price;
    $idEdit = $_SESSION['id-edit'];
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $type = $_POST['type'];
    $price = $_POST['price'];
    $oldPrice = $_SESSION['old-price'];
    $description = $_POST['description'];
    $image = $_POST['image'];
    updateProduct($idEdit, $name, $price, $oldPrice, $quantity, $description, $image, $type);
}
?>