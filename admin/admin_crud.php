    <?php
include_once '../conn.php';
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn->exec("set names utf8");
//Create
$allow = true;
if (isset($_POST['registr'])) {
    $allow=false;
  try {
    $stmt = $conn->prepare("INSERT INTO admin (aid, name, surname, email, phone, password, access, manipulation, head) VALUES(:aid, :name, :surname, :email, :phone, :password, :access, :manipulation, :head)");
   
    $stmt->bindParam(':aid', $aid, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':surname', $surname, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
    $stmt->bindParam(':access', $access, PDO::PARAM_INT);
    $stmt->bindParam(':head', $head, PDO::PARAM_INT);
    $stmt->bindParam(':manipulation', $manipulation, PDO::PARAM_INT);

    $aid = substr(uniqid('A', true), 0, 10);
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = md5($_POST['password']);
    $access = 0;
    $head = 0;
    $manipulation = 0;
       
    $stmt->execute();
    header('location:index.php?request=ok');
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

else if(isset($_POST['login'])){
    echo "string";
    $allow=false;
  try {
    $stmt = $conn->prepare("SELECT * FROM admin WHERE email = :email AND password = :password AND access = 1");
     
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
       
    $email =  $_POST['email'];
    $password = md5($_POST['password']);
     
    $stmt->execute();
 
    $editrow = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();
    if($count==1){
      header('location:products.php');
      $_SESSION['user_id']=$editrow['aid'];
      $_SESSION['user_name']=$editrow['name'];
      $_SESSION['user_surname']=$editrow['surname'];
      $_SESSION['manipulation']=$editrow['manipulation'];
    }
    else{
      header('location:index.php?login=fail');
    }
  } 
  catch (Exception $e) {
    echo "Error: " . $e->getMessage();
  }
}

else if (isset($_POST['allow'])) {
    $allow=false;
  try {
    $stmt = $conn->prepare("UPDATE  admin SET access = :access WHERE aid = :aid");
   
    $stmt->bindParam(':aid', $aid, PDO::PARAM_STR);
    $stmt->bindParam(':access', $access, PDO::PARAM_INT);

    $aid = $_POST['hid'];
    $access = 1;
       
    $stmt->execute();
    header('location:products.php');
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
else if (isset($_POST['allPermission'])) {
    $allow=false;
  try {
    $stmt = $conn->prepare("UPDATE  admin SET manipulation = :manipulation WHERE aid = :aid");
   
    $stmt->bindParam(':aid', $aid, PDO::PARAM_STR);
    $stmt->bindParam(':manipulation', $manipulation, PDO::PARAM_INT);

    $aid = $_POST['hid'];
    $manipulation = 1;
       
    $stmt->execute();
    header('location:products.php');
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
else if (isset($_POST['onePermission'])) {
    $allow=false;
  try {
    $stmt = $conn->prepare("UPDATE  admin SET manipulation = :manipulation WHERE aid = :aid AND head != 1");
   
    $stmt->bindParam(':aid', $aid, PDO::PARAM_STR);
    $stmt->bindParam(':manipulation', $manipulation, PDO::PARAM_INT);

    $aid = $_POST['hid'];
    $manipulation = 0;
       
    $stmt->execute();
    header('location:products.php');
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

else if (isset($_POST['deny'])) {
    $allow=false;
  try {
    $stmt = $conn->prepare("UPDATE  admin SET access = :access, manipulation = :manipulation WHERE aid = :aid AND head = 0");
   
    $stmt->bindParam(':aid', $aid, PDO::PARAM_STR);
    $stmt->bindParam(':access', $access, PDO::PARAM_INT);
    $stmt->bindParam(':manipulation', $manipulation, PDO::PARAM_INT);

    $aid = $_POST['hid'];
    $manipulation = 0;
    $access = 0;
       
    $stmt->execute();
    header('location:products.php');
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

if (isset($_POST['addProduct'])) {
    $allow=false;
  try {
    $stmt = $conn->prepare("INSERT INTO items (item_num, img, name, description, price, quantity, author) VALUES(:item_num, :img, :name, :description, :price, :quantity, :author)");
   
    $stmt->bindParam(':item_num', $item_num, PDO::PARAM_STR);
    $stmt->bindParam(':img', $img, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':description', $description, PDO::PARAM_STR);
    $stmt->bindParam(':price', $price, PDO::PARAM_INT);
    $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
    $stmt->bindParam(':author', $author, PDO::PARAM_STR);

    $photo_path = '../products/';
    $photo_path = $photo_path . basename($_FILES['img']['name']);
    $img_corr = 'false';
    $imageFileType = pathinfo($photo_path,PATHINFO_EXTENSION);

    if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif"){
        if(!file_exists($photo_path)) {
            if(move_uploaded_file($_FILES['img']['tmp_name'], $photo_path)){
                $img_corr = 'true';
                $img = $_FILES['img']['name'];
            }
            else{
                $img_corr = 'false';
                $img = '';
            }
        }
        else{
            $img_corr='exist';
            $img='';
        }
    }
    else{
        $img_corr='wrong_format';
        $img='';
    }

    $item_num = substr(uniqid('I', true), 0, 10);
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $author = $_SESSION['user_id'];
    
    $stmt->execute();
    header('location:products.php?send=success&img='.md5($img_corr));
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

else if (isset($_POST['editProduct'])) {
    $allow=false;
  try {
    $stmt = $conn->prepare("UPDATE items SET img = :img, name = :name, description = :description, price = :price, quantity = :quantity, author = :author WHERE id = :id");
   
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':img', $img, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':description', $description, PDO::PARAM_STR);
    $stmt->bindParam(':author', $author, PDO::PARAM_STR);
    $stmt->bindParam(':price', $price, PDO::PARAM_INT);
    $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);

    if(!isset($_POST['edit_img'])){
        $photo_path = '../products/';
        $photo_path = $photo_path . basename($_FILES['img']['name']);
        $img_corr = 'false';
        $imageFileType = pathinfo($photo_path,PATHINFO_EXTENSION);

        if($imageFileType == 'jpg' || $imageFileType == 'png' || $imageFileType == 'jpeg' || $imageFileType == 'gif'){
            if(!file_exists($photo_path)) {
                if(move_uploaded_file($_FILES['img']['tmp_name'], $photo_path)){
                    $img_corr = 'true';
                    $img = $_FILES['img']['name'];
                }
                else{
                    $img_corr = 'false';
                    $img = '';
                }
            }
            else{
                $img_corr='exist';
                $img='';
            }
        }
        else{
            $img_corr='wrong_format';
            $img='';
        }
    }
    else{
        $img = $_POST['edit_img'];
    }

    $id = $_POST['editHid'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $author = $_SESSION['user_id'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $stmt->execute();
    $e = md5("edited");
    // echo $id;
    header('location:products.php?'.$e.'=y&img='.md5($img_corr));
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
    
else if(isset($_POST['delete'])){
    $allow=false;
    try {
        $stmt = $conn->prepare("DELETE FROM items WHERE id = :id");
        $stmt->bindParam(':id',$id,PDO::PARAM_INT);
        $id = $_POST['deleteProduct'];
        $stmt->execute();
        $d=md5('rowdeleted');
        header('location:products.php?'.$d.'=y');
    } catch (Exception $e) {
        echo "Error: ".$e->getMessage();
    }
}

else if(isset($_GET['order_access'])){
    $allow=false;
    try {
        $stmt = $conn->prepare("UPDATE client_order SET status = :status WHERE order_num = :order_num");
        $stmt->bindParam(':order_num',$order_num,PDO::PARAM_STR);
        $stmt->bindParam(':status',$status,PDO::PARAM_INT);
        $order_num = $_GET['order_access'];
        $status = 1;
        $stmt->execute();
        
        // $stmt_email = $conn->prepare("SELECT it.name, ii.quantity,ii.price FROM items it, item_id ii WHERE ii.item_num = it.item_num AND ii.order_num = :order_num");
        // $stmt_email->bindParam(':order_num',$order_num,PDO::PARAM_STR);
        // $stmt_email->execute();
        // $result_email=$stmt_email->fetchAll();
        // $to = $_GET['client_email'];
        // $subject = "Request from byothea.kz";
        // $nn = 1;
        // $total_pr = 0.0;
        // $message = "
        // <html>
        // <head>
        // <title>Request</title>
        // </head>
        // <body>
        // <h4>Автомотическое письмо!!</h4>
        // <table>
        // <tr>
        // <th>#</th>
        // <th>Наименование товара</th>
        // <th>Количество</th>
        // <th>Цена за 1 товар</th>
        // <th>Цена</th>
        // </tr>";
        // foreach ($result_email as $row) {
        //     $total_pr = (float)$row['quantity']*(float)$row['price'];
        //     $message.="<tr>
        //                 <td>".$nn++."</td>
        //                 <td>".$row['name']."</td>
        //                 <td>".$row['quantity']."</td>
        //                 <td>".$row['price']."</td>
        //                 <td>".$total_pr."</td>
        //                 </tr>";
        // }
        // $message.="<tr><th>Итог : </th><td>".$total_pr."</td></tr>"
        // $message .="</table>
        // </body>
        // </html>
        // ";
        // $headers = "MIME-Version: 1.0" . "\n";
        // $headers .= "Content-type:text/html;charset=UTF-8" . "\n";

        // More headers
        // $headers .= 'From: <byothea.kz>' . "\n";
        // $headers .= 'Cc: info@byothea.kz' . "\n";

        // mail($to,$subject,$message,$headers);

        header('location:order.php');
    } catch (Exception $e) {
        echo "Error: ".$e->getMessage();
    }
}
else if(isset($_POST['cancel_order'])){
    $allow=false;
    // echo "string";
    try {
        $stmt = $conn->prepare("SELECT * FROM item_id WHERE order_num = :order_num");
        $stmt_delete = $conn->prepare("DELETE FROM client_order WHERE order_num = :order_num");
        $stmt->bindParam(':order_num',$order_num,PDO::PARAM_STR);
        $stmt_delete->bindParam(':order_num',$order_num,PDO::PARAM_STR);
        $order_num = $_POST['order_delete'];
        $stmt->execute();
        $stmt_delete->execute();
        $result = $stmt->fetchAll();

        foreach ($result as $readrow) {
            $stmt = $conn->prepare("UPDATE items SET quantity = quantity + :quantity_t WHERE item_num = :i_num");
            $stmt_delete = $conn->prepare("DELETE FROM item_id WHERE order_num = :order_num AND item_num = :i_num");
            $stmt->bindParam(':quantity_t',$quantity_t,PDO::PARAM_INT);
            $stmt->bindParam(':i_num',$i_num,PDO::PARAM_STR);

            $stmt_delete->bindParam(':i_num',$i_num,PDO::PARAM_STR);
            $stmt_delete->bindParam(':order_num',$order_num,PDO::PARAM_STR);

            $quantity_t = $readrow['quantity'];
            $i_num = $readrow['item_num'];

            $stmt->execute();
            $stmt_delete->execute();
            // echo $quantity_t.'<br>';
        }
        header('location:order.php?order='.md5('deleted').'');
    } catch (Exception $e) {
        echo "Error: ".$e->getMessage();
    }
}
// else if(isset($_GET['order_done'])){
//     $allow=false;
//     try {
//         $stmt = $conn->prepare("UPDATE client_order SET status = :status WHERE order_num = :order_num");
//         $stmt->bindParam(':order_num',$order_num,PDO::PARAM_STR);
//         $stmt->bindParam(':status',$status,PDO::PARAM_INT);
//         $order_num = $_GET['order_done'];
//         $status = 2;
//         $stmt->execute();
//         header('location:order.php');
//     } catch (Exception $e) {
//         echo "Error: ".$e->getMessage();
//     }
// }

else if(isset($_POST['order_success'])){
    $allow=false;
    try {
        $stmt = $conn->prepare("UPDATE client_order SET status = :status, complete_date = :order_date WHERE order_num = :order_num");
        $stmt->bindParam(':order_num',$order_num,PDO::PARAM_STR);
        $stmt->bindParam(':order_date',$order_date,PDO::PARAM_STR);
        $stmt->bindParam(':status',$status,PDO::PARAM_INT);
        $order_num = $_POST['order_done'];
        $order_date = $_POST['order_date'];
        $status = 2;
        $stmt->execute();
        header('location:order.php');
    } catch (Exception $e) {
        echo "Error: ".$e->getMessage();
    }
}
else if(isset($_POST['order_cancel'])){
    $allow=false;
    try {
        $stmt = $conn->prepare("UPDATE client_order SET status = :status WHERE order_num = :order_num");
        $stmt->bindParam(':order_num',$order_num,PDO::PARAM_STR);
        $stmt->bindParam(':status',$status,PDO::PARAM_INT);
        $order_num = $_POST['order_num'];
        $status = 0;
        $stmt->execute();
        header('location:order.php');
    } catch (Exception $e) {
        echo "Error: ".$e->getMessage();
    }
}
else if(isset($_POST['delete_from_admin'])){
    $allow=false;
    try {
        $stmt = $conn->prepare("DELETE FROM admin WHERE aid = :aid");
        $stmt->bindParam(':aid',$aid,PDO::PARAM_STR);
        $aid = $_POST['delete_from_admin_hid'];
        $stmt->execute();
        $d=md5('rowdeleted');
        // echo $aid;
        header('location:products.php?'.$d.'=a');
    } catch (Exception $e) {
        echo "Error: ".$e->getMessage();
    }
}
if(!isset($_SESSION['user_id']) && $allow){
    header('location:../index.php');
}
$conn = null;
?>