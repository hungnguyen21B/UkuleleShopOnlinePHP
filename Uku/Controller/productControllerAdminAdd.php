<?php
session_start();
require '../../Controller/connection.php';
require '../../Model/product.php';
require '../../Model/productAdmin.php';
require '../../Model/productDatabaseAdmin.php';
$products = getAllProductAdmin();
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $type = $_POST['type'];
    $price = $_POST['price'];
    $oldPrice = $_SESSION['old-price'];
    $description = $_POST['description'];
    $image = $_POST['image'];
    $sql = "insert into product(name,price,quantity,type,description,image)values('" . $name . "'," . $price . "," . $quantity .
        ",'" . $type . "','" . $description . "','Assets/Image/" . $image . "');";
    $db->query($sql);
    echo "<script>alert('Successful...');</script>";
    header("Location: adminForm.php");
}
?>