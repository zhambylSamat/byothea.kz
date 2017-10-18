<?php
session_start();
 
// get the product id
$id = $_GET['id'];
$name = $_GET['name'];
$price = $_GET['price'];
$image = $_GET['image'];
$quantity = $_POST['quantity'];
$maxQuantity = $_GET['maxQuantity'];
$item_num = $_GET['item_num'];
 
// remove the item from the array
$_SESSION['cart'][$id]=$id.'!'.$name.'!'.$image.'!'.$price.'!'.$quantity.'!'.$maxQuantity.'!'.$item_num;
 
// redirect to product list and tell the user it was added to cart
header('Location: cart.php?action=updated&name='. $name);
?>