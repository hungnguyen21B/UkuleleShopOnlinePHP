<?php
session_start();
require '../../Controller/connection.php';
require '../../Model/product.php';
require '../../Model/productAdmin.php';
require '../../Model/productDatabaseAdmin.php';
$products = getAllProductAdmin();
if (isset($_POST['id-edit'])) {
    $_SESSION['id-edit'] = $_POST['id-edit'];
    header("Location: editForm.php");
}
if (isset($_POST['delete'])) {
    echo "<script>alert('Successful...');</script>";
    $iddelete = $_POST['delete'];
    deleteProductById($iddelete);
}
?>
