<?php
    include_once '../conn.php';
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec("set names utf8");
    try {
        $stmt1 = $conn->prepare("SELECT * FROM client_order WHERE status = :status1");
        $stmt1->bindParam(':status1',$status1,PDO::PARAM_INT);
        $status1 = 0;
        $stmt1->execute();

        $stmt2 = $conn->prepare("SELECT * FROM client_order WHERE status = :status2");
        $stmt2->bindParam(':status2',$status2,PDO::PARAM_INT);
        $status2 = 1;
        $stmt2->execute();

        $stmt3 = $conn->prepare("SELECT * FROM client_order WHERE status = :status3");
        $stmt3->bindParam(':status3',$status3,PDO::PARAM_INT);
        $status3 = 2;
        $stmt3->execute();

        $result1 = $stmt1->fetchAll();
        $result2 = $stmt2->fetchAll();    
        $result3 = $stmt3->fetchAll();    

        $count1 = 0;
        $count2 = 0;
        $count3 = 0;

        $count1 += $stmt1->rowCount(); 
        $count2 += $stmt2->rowCount(); 
        $count3 += $stmt3->rowCount();

        $c1 = 0;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
    if(!isset($_SESSION['user_id'])){
        header("location:index.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
<table>
    
</table>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Byothea – итальянская профессиональная косметическая линия</title>


    <link rel="shortcut icon" type="image/png" href="/favicon.png"/>

    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <link rel="stylesheet" href="../css/bootstrap-theme.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap-theme.min.css">

    <link rel="stylesheet/less" type='text/css' href="css/style.less">


</head>

<body>
    <section>
        <div class='container'>
            <div class='row'>
                <div class='col-md-12 col-sm-12 col-xs-12'>
                    <a href="products.php" class='pull-left btn btn-primary btn-sm'>Назад</a>
                    <a href="logout.php" class='pull-right btn btn-danger btn-sm'>Выйти</a>
                    <center><h1>Все заказы (<?php echo $count1 + $count2 + $count3?>)</h1></center>
                    <hr style='border:1px solid black;'>
                </div>
                <div class='col-md-12 col-sm-12 col-xs-12'>
                    <?php if(isset($_GET['order']) && $_GET['order']==md5('deleted')){?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <center><strong>Заказ удален.</strong></center>
                    </div>
                    <?php }?>
                </div>
                <div class='col-md-12 col-sx-12 col-xs-12'>
                    <center>
                        <h1>Необработанные (<?php echo $count1;?>)</h1>
                        <table class='table table-hover'>
                            <tr class='active'>
                                <th>Номер заказа</th>
                                <th>Имя\Фамилия получателя</th>
                                <th>Email</th>
                                <th>Номер телефона</th>
                                <th>Адрес</th>
                                <th>Область</th>
                                <th>Регион\Город</th>
                                <th>Почтовый индекс</th>
                                <th>Доставка</th>
                            </tr>
                            <?php foreach ($result1 as $readrow) { ?>
                            <tr id='not<?php echo ++$c1?>' onclick='showHide(<?php echo $c1;?>)' style='cursor:pointer;'>
                                <td><?php echo $readrow['order_num'];?></td>
                                <td><?php echo $readrow['name'].' '.$readrow['surname'];?></td>
                                <td><?php echo $readrow['email'];?></td>
                                <td><?php echo $readrow['phone'];?></td>
                                <td><?php echo $readrow['address'];?></td>
                                <td><?php echo $readrow['region'];?></td>
                                <td><?php echo $readrow['city'];?></td>
                                <td><?php echo $readrow['post_code'];?></td>
                                <td>₸ <?php echo $readrow['shipping'];?></td>
                            </tr>
                            <tr>
                                <td colspan = '9' style='display:none;' id='not_inside<?php echo $c1?>'>
                                    <table class="table table-striped">
                                        <tr  class="info">
                                            <th>Номер товара</th>
                                            <th>Наименование товара</th>
                                            <th>Цена за 1 товар</th>
                                            <th>Количество</th>
                                            <th>Итог</th>
                                        </tr>
                                    <?php
                                        $items = $conn->prepare("SELECT ii.quantity quantity, i.name name, i.price price, i.item_num item_num, i.id item_id FROM item_id ii, items i, client_order co WHERE co.order_num = '$readrow[order_num]' AND co.order_num = ii.order_num AND ii.item_num = i.item_num");
                                        $items->execute();
                                        $res = $items->fetchAll();
                                        $totalPrice = 0.0;
                                        foreach ($res as $read) {
                                        $totalPrice += $read['quantity'] * $read['price'];
                                    ?>
                                        <tr class="danger">
                                            <td><?php echo $read['item_num'];?></td>
                                            <td><?php echo $read['name'];?></td>
                                            <td>₸ <?php echo $read['price'];?></td>
                                            <td><?php echo $read['quantity'];?></td>
                                            <td>₸ <?php echo $read['quantity'] * $read['price'];?></td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td colspan = '5' class='pull-right'>
                                            Итог ₸ <?php echo $totalPrice?> + ₸ <?php echo $readrow['shipping'];?> = ₸ <?php echo $totalPrice + $readrow['shipping'];?>
                                        </td>
                                    </tr>
                                    </table>
                                    <form action='admin_crud.php' method='get' onsubmit="return confirm();">
                                        <input type="hidden" name="order_access" value='<?php echo $readrow['order_num']?>'>
                                        <input type="hidden" name="client_email" value='<?php echo $readrow['email'];?>'>
                                        <input type="submit" class="btn btn-warning pull-right" value='Подтвердить доставку'>
                                    </form>
                                    <form action='admin_crud.php' method='post' onsubmit="return confirm();">
                                        <input type="hidden" name="order_delete" value='<?php echo $readrow['order_num']?>'>
                                        <input type="submit" name="cancel_order" class='btn btn-danger pull-right'  value='Удалить заказ!'>
                                    </form>
                                    <!-- <a href='admin_crud.php?order_access=<?php //echo $readrow['order_num']?>' class='btn btn-warning pull-right'>Подтвердить доставку</a> -->
                                </td>
                            </tr>
                            <?php } ?>
                        </table>
                    </center>
                </div>
                <div class='col-md-12 col-sx-12 col-xs-12'>
                    <center>
                        <h1>Обработанные (<?php echo $count2;?>)</h1>
                        <table class='table table-hover'>
                            <tr class='active'>
                                <th>Номер заказа</th>
                                <th>Имя\Фамилия получателя</th>
                                <th>Email</th>
                                <th>Номер телефона</th>
                                <th>Адрес</th>
                                <th>Область</th>
                                <th>Регион\Город</th>
                                <th>Почтовый индекс</th>
                                <th>Доставка</th>
                            </tr>
                            <?php foreach ($result2 as $readrow) { ?>
                            <tr id='not<?php echo ++$c1?>' onclick='showHide(<?php echo $c1;?>)' style='cursor:pointer;'>
                                <td><?php echo $readrow['order_num'];?></td>
                                <td><?php echo $readrow['name'].' '.$readrow['surname'];?></td>
                                <td><?php echo $readrow['email'];?></td>
                                <td><?php echo $readrow['phone'];?></td>
                                <td><?php echo $readrow['address'];?></td>
                                <td><?php echo $readrow['region'];?></td>
                                <td><?php echo $readrow['city'];?></td>
                                <td><?php echo $readrow['post_code'];?></td>
                                <td>₸ <?php echo $readrow['shipping'];?></td>
                            </tr>
                            <tr>
                                <td colspan = '9' style='display:none;' id='not_inside<?php echo $c1?>'>
                                    <table class="table table-striped">
                                        <tr  class="info">
                                            <th>Номер товара</th>
                                            <th>Наименование товара</th>
                                            <th>Цена за 1 товар</th>
                                            <th>Количество</th>
                                            <th>Итог</th>
                                        </tr>
                                    <?php
                                        $items = $conn->prepare("SELECT ii.quantity quantity, i.name name, i.price price, i.item_num item_num, i.id item_id FROM item_id ii, items i, client_order co WHERE co.order_num = '$readrow[order_num]' AND co.order_num = ii.order_num AND ii.item_num = i.item_num");
                                        $items->execute();
                                        $res = $items->fetchAll();
                                        $totalPrice = 0.0;
                                        foreach ($res as $read) {  
                                            $totalPrice += $read['quantity'] * $read['price'];
                                    ?>
                                        <tr class="warning">
                                            <td><?php echo $read['item_num'];?></td>
                                            <td><?php echo $read['name'];?></td>
                                            <td>₸ <?php echo $read['price'];?></td>
                                            <td><?php echo $read['quantity'];?></td>
                                            <td>₸ <?php echo $read['quantity'] * $read['price'];?></td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td colspan = '5' class='pull-right'>
                                            Итог ₸ <?php echo $totalPrice?> + ₸ <?php echo $readrow['shipping'];?> = ₸ <?php echo $totalPrice + $readrow['shipping'];?>
                                        </td>
                                    </tr>
                                    </table>
                                    <form onsubmit="return confirm();" style='padding:0 30px;' method='post' action='admin_crud.php'>
                                        <input type="hidden" name="order_num" value='<?php echo $readrow['order_num']?>'>
                                        <center><input type='submit' name='order_cancel' class='btn btn-danger pull-right' value='Отменить заказ'></center>
                                    </form>
                                    <form method='post' style='border-right: 3px solid black; padding:0 30px;' class='pull-right' action='admin_crud.php'>
                                        <label for='date-id'>
                                            Укажите дату, когда было доставлено.
                                        </label><br>
                                        <center><input type="date" id='date-id' placeholder='YYYY-DD-YY ' name="order_date" required><br></center>
                                        <input type="hidden" name="order_done" value='<?php echo $readrow['order_num']?>'>
                                        <center><input type='submit' name='order_success' class='btn btn-success' value='Доставлено'></center>
                                    </form>
                                </td>
                            </tr>
                            <?php } ?>
                        </table>
                    </center>
                </div>
                <div class='col-md-12 col-sx-12 col-xs-12'>
                    <center>
                        <h1>Принятые заказы (<?php echo $count3;?>)</h1>
                        <table class='table table-hover'>
                            <tr class='active'>
                                <th>Номер заказа</th>
                                <th>Имя\Фамилия получателя</th>
                                <th>Email</th>
                                <th>Номер телефона</th>
                                <th>Адрес</th>
                                <th>Область</th>
                                <th>Регион\Город</th>
                                <th>Почтовый индекс</th>
                                <th>Дата доставки</th>
                            </tr>
                            <?php foreach ($result3 as $readrow) { ?>
                            <tr id='not<?php echo ++$c1?>' onclick='showHide(<?php echo $c1;?>)' style='cursor:pointer;'>
                                <td><?php echo $readrow['order_num'];?></td>
                                <td><?php echo $readrow['name'].' '.$readrow['surname'];?></td>
                                <td><?php echo $readrow['email'];?></td>
                                <td><?php echo $readrow['phone'];?></td>
                                <td><?php echo $readrow['address'];?></td>
                                <td><?php echo $readrow['region'];?></td>
                                <td><?php echo $readrow['city'];?></td>
                                <td><?php echo $readrow['post_code'];?></td>
                                <td><?php echo $readrow['complete_date'];?></td>
                            </tr>
                            <tr>
                                <td colspan = '9' style='display:none;' id='not_inside<?php echo $c1?>'>
                                    <table class="table table-striped">
                                        <tr  class="info">
                                            <th>Номер товара</th>
                                            <th>Наименование товара</th>
                                            <th>Цена за 1 товар</th>
                                            <th>Количество</th>
                                            <th>Итог</th>
                                        </tr>
                                    <?php
                                        $items = $conn->prepare("SELECT ii.quantity quantity, i.name name, i.price price, i.item_num item_num, i.id item_id FROM item_id ii, items i, client_order co WHERE co.order_num = '$readrow[order_num]' AND co.order_num = ii.order_num AND ii.item_num = i.item_num");
                                        $items->execute();
                                        $res = $items->fetchAll();
                                        $totalPrice = 0.0;
                                        foreach ($res as $read) {  
                                        $totalPrice += $read['quantity']*$read['price'];
                                    ?>
                                        <tr class="success">
                                            <td><?php echo $read['item_num'];?></td>
                                            <td><?php echo $read['name'];?></td>
                                            <td>₸ <?php echo $read['price'];?></td>
                                            <td><?php echo $read['quantity'];?></td>
                                            <td>₸ <?php echo $read['quantity'] * $read['price'];?></td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td colspan = '5' class='pull-right'>
                                            Итог ₸ <?php echo $totalPrice?> + ₸ <?php echo $readrow['shipping'];?> = ₸ <?php echo $totalPrice + $readrow['shipping'];?>
                                        </td>
                                    </tr>
                                    </table>
                                </td>
                            </tr>
                            <?php } ?>
                        </table>
                    </center>
                </div>
            </div>
        </div>
    </section>

	<script type="text/javascript" src="../js/less.min.js"></script>
    <script src="../js/jquery-1.11.1.min.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/bootstrap.min.js"></script>

    <script type="text/javascript">
        function showHide(id){
            $(function(){
                if($("#not_inside"+id).css('display')=='none'){
                    $("#not_inside"+id).css({'display':'table-cell'});
                }
                else{
                    $("#not_inside"+id).css({'display':'none'});   
                }
            });
        }

        function confirmd(){
            var r = confirm("Вы уверены, что хотите выполнить этот запрос?");
            return r;
        }
    </script>

</body>
</html>