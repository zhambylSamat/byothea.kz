<?php
session_start();

$id = $_GET['id'];
$name = $_GET['name'];
$price = $_GET['price'];
$image = $_GET['image'];
$maxQuantity = $_GET['maxQuantity'];
$item_num = $_GET['item_num'];
$defaultQ = 1;
 
if(!array_key_exists($id, $_SESSION['cart'])){
    $_SESSION['cart'][$id]=$id.'!'.$name.'!'.$image.'!'.$price.'!'.$defaultQ.'!'.$maxQuantity.'!'.$item_num;
}
?>
