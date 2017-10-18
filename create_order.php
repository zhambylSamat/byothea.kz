<?php
include_once 'conn.php';
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn->exec("set names utf8");
//Create
if (isset($_POST['checkout'])) {
    $order_num = substr(uniqid('O', true), 0, 10);
  try {
    $stmt = $conn->prepare("INSERT INTO client_order (order_num, name, surname, email, phone, address, region, city, post_code, shipping, status) VALUES(:order_num, :name, :surname, :email, :phone, :address, :region, :city, :post_code, :shipping, :status)");
   
    $stmt->bindParam(':order_num', $order_num, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':surname', $surname, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
    $stmt->bindParam(':address', $address, PDO::PARAM_STR);
    $stmt->bindParam(':region', $region, PDO::PARAM_STR);
    $stmt->bindParam(':city', $city, PDO::PARAM_STR);
    $stmt->bindParam(':post_code', $post_code, PDO::PARAM_STR);
    $stmt->bindParam(':shipping', $shipping, PDO::PARAM_STR);
    $stmt->bindParam(':status', $status, PDO::PARAM_INT);

    
    $name = $_POST['name'];
    $surname = $_POST['sname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $region = $_POST['region'];
    $city = $_POST['city'];
    $post_code = $_POST['postCode'];
    $shipping = $_POST['shipping'];
    $status = 0;

    $stmt->execute();
    $item_name = '';
    $count = 1;
    foreach ($_SESSION['cart'] as $key => $value) {
        try {
            $result = explode('!', $value);
            $stmt = $conn->prepare("SELECT * FROM items WHERE item_num = :item_num");
            $stmt->bindParam(':item_num', $item_num, PDO::PARAM_INT);
            $item_num = $result[6];
            $stmt->execute();
            $result_query = $stmt->fetchAll();
            if($result_query[0]['quantity']>=1){
                $stmt2 = $conn->prepare("INSERT INTO item_id (order_num, item_num, quantity) VALUES(:order_num, :item_num, :quantity)");
                $stmt3 = $conn->prepare("UPDATE items SET quantity = :res_quantity WHERE item_num = :item_num");

                $stmt2->bindParam(':order_num', $order_num, PDO::PARAM_STR);
                $stmt2->bindParam(':item_num', $item_num, PDO::PARAM_INT);
                $stmt2->bindParam(':quantity', $quantity, PDO::PARAM_INT);
               
                $stmt3->bindParam(':item_num', $item_num, PDO::PARAM_STR);
                $stmt3->bindParam(':res_quantity', $res_quantity, PDO::PARAM_INT);

                $quantity_tmp = (int)$result[4];
                // $res_quantity_tmp = (int)$result[5]-(int)$result[4];
                if($quantity_tmp>=$result_query[0]['quantity']){
                    $res_quantity = 0;
                    $quantity = $result_query[0]['quantity'];
                }
                else{
                    $res_quantity = (int)$result[5]-(int)$result[4];
                    $quantity = (int)$result[4];
                }
                
                $stmt2->execute();   
                $stmt3->execute();
            }
            else{
                $item_name .= "".$count++.". ".$result[0]['name']."<br>";
            }

        } catch (Exception $e2) {
            echo "Error: " . $e2->getMessage();
        }
    }
    
    unset($_SESSION['cart']);
    if($item_name!=''){
        header('location:index.php?checkout=ok&fail='.$item_name);
    }
    else{
        header('location:index.php?checkout=ok');   
    }
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

$conn = null;
?>