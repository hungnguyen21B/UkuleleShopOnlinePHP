<?php
function getAllProductAdmin()
{
    $sql = "Select * from product;";
    $products = $GLOBALS['db']->query($sql)->fetch_all();
    for ($i = 0; $i < count($products); $i++) {
        $products[$i] = new ProductAdmin($products[$i][0], $products[$i][1], $products[$i][2], $products[$i][3], $products[$i][4], $products[$i][6], $products[$i][7], $products[$i][5]);
    }
    return $products;
}
function deleteProductById($iddelete)
{
    global $db;
    $sql = "DELETE FROM product WHERE id=" . $iddelete . ";";
    $db->query($sql);
    header("Location: adminForm.php");
}
function selectOneProduct($idEdit)
{
    $sql = "Select * from product where id =" . $idEdit . ";";
    $product = $GLOBALS['db']->query($sql)->fetch_all();
    $product = new ProductAdmin($product[0][0], $product[0][1], $product[0][2], $product[0][3], $product[0][4], $product[0][6], $product[0][7], $product[0][5]);
    return $product;
}
function selectListProductDetail($name)
{
    $sql = "Select * from product where name like '%" .$name. "%'  limit 4;";
    $products = $GLOBALS['db']->query($sql)->fetch_all();
    for ($i = 0; $i < count($products); $i++) {
        $products[$i] = new ProductAdmin($products[$i][0], $products[$i][1], $products[$i][2], $products[$i][3], $products[$i][4], $products[$i][6], $products[$i][7], $products[$i][5]);
    }
    // var_dump($products);
    return $products;
}

function updateProduct($idEdit, $name, $price, $oldPrice, $quantity, $description, $image, $type)
{
    $sql = "update product set name='" . $name . "',price=" . $price . ",quantity=" . $quantity .
        ",type='" . $type . "',description='" . $description . "',image='Assets/Image/" . $image .
        "',oldPrice=" . $oldPrice . " where id=" . $idEdit . ";";
    $GLOBALS['db']->query($sql);
    echo "<script>alert('Successful...');</script>";
    header("Location: adminForm.php");
}

?>