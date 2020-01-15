<?php

function getCart($idAccount)
{
    $sql = "Select p.id,p.name,p.price,c.quantitty,p.image from product as p, cart as
    c where c.id_account=" . $idAccount . " and c.id_product=p.id ;";
    $products = $GLOBALS['db']->query($sql)->fetch_all();
    for ($i = 0; $i < count($products); $i++) {
        $products[$i] = new Cart($products[$i][0], $products[$i][1], $products[$i][2], $products[$i][3], $products[$i][4]);
    }
    return $products;
}
function deleteInCart($idAccount, $idproduct)
{
    $sql = "DELETE FROM cart WHERE id_product=" . $idproduct . " and id_account=" . $idAccount . ";";
    $GLOBALS['db']->query($sql);
    header("Location: cartForm.php");
}
function  editQuantity($idAccount, $idproduct, $quantityChanged)
{
    $sql = "select quantitty from cart WHERE id_product =" . $idproduct . " and id_account=" . $idAccount . " ;";
    $oldQuantity = $GLOBALS['db']->query($sql)->fetch_all();
    $sql = "select quantity from product WHERE id=" . $idproduct . ";";
    $quantityProInProduct = $GLOBALS['db']->query($sql)->fetch_all();
    var_dump($oldQuantity[0][0]);
    // echo "<script>alert('".$quantityProInProduct[0][0]."');</script>";
    if (($quantityChanged > 0) && (($quantityProInProduct[0][0] + $oldQuantity[0][0]) >= $quantityChanged)) {
        setQuantityInCart($idAccount, $idproduct, $quantityChanged);
        setQuantityInPro($oldQuantity, $idproduct, $quantityChanged);
        header("Location: cartForm.php");
    } else {
        echo "<script>alert('Please, fill in the right information');</script>";
    }
}
function setQuantityInCart($idAccount, $idproduct, $quantityChanged)
{
    $sql = "update cart set quantitty=" . $quantityChanged . " WHERE id_product=" . $idproduct . " and id_account=" . $idAccount . ";";
    // echo "<script>alert('".$sql."');</script>";
    $GLOBALS['db']->query($sql);
}
function setQuantityInPro($oldQuantity, $idproduct, $quantityChanged)
{
    $sql = "update product set quantity = quantity+" . $oldQuantity[0][0] . "-" . $quantityChanged . " where id=" . $idproduct . " ;";
    // echo "<script>alert('".$sql."');</script>";
    $GLOBALS['db']->query($sql);
}
function order($name,$payment,$phone,$address,$comment,$listSp,$idAccount){
     $order= new Bill();
     $order->setPhone($phone);
     $order->setAddress($address);
     if($order->phone==null || $order->address==null){
        echo "<script>alert('Fill true information.');</script>";
     }else if($order->listSp==null){
        echo "<script>var check=confirm('Dont have product to order.');
        </script>";
     }
     else{
        $sql = "insert into customer(name, phone, address, payment,comment, listSp, id_account)
        values ('" . $name . "','" . $phone . "','" . $address . "'," . $payment . ",'" . $comment . "','" . $listSp . "'," . $idAccount . "); ";
      $GLOBALS['db']->query($sql);
      deleteAllOfCart($idAccount);
     }
    
}
function deleteAllOfCart($idAccount){
    $sql= "DELETE FROM cart WHERE id_account=" . $idAccount . ";";
    $GLOBALS['db']->query($sql);
}
