<?php
    include_once 'conn.php';
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec("set names utf8");
    try {
        $stmt = $conn->prepare("SELECT * FROM items");
         
        $stmt->execute();
        $result = $stmt->fetchAll();     
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
?>
<!DOCTYPE html>
<html>
<head>
<table>
    
</table>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>Bstudio</title>


	<link rel="shortcut icon" type="image/png" href="/favicon.png"/>

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <link rel="stylesheet" href="rs-plugin/css/settings.css">

    <link rel="stylesheet" href="css/bootstrap-theme.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">

    <link rel="stylesheet" type="text/css" href="css/story-box-zen.css">

    <link rel="stylesheet" type='text/css' href="css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="css/slick.css">
    <link rel="stylesheet" type="text/css" href="css/slick-theme.css">

    <link rel="stylesheet/less" type='text/css' href="css/style.less">


</head>

<body>
<?php include_once 'navbar.php'; ?>
    <section>
        <div class='container'>
            <div class='row' style='margin-top:10%;'>
                <div class='col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12'>
                    <form method="post" action='create_order.php'>
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label for="name">Имя(*)</label>
                            <input type="text" name='name' class="form-control" id="name" placeholder="Имя" required="">
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label for="sname">Фамилия(*)</label>
                            <input type="text" name='sname' class="form-control" id="sname" placeholder="Фамилия" required="">
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label for="email">Адрес электронной почты(*)</label>
                            <input type="email" name='email' class="form-control" id="email" placeholder="Email" required="">
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label for="phone">Номер вашего мобильного телефона(*)</label>
                            <input type="text" name='phone' class="form-control" id="phone" placeholder="Номер телефона" required="">
                        </div>
                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                            <label for="address">Адрес(*)</label>
                            <textarea name='address' id='address' class="form-control" rows="3" required=""></textarea>
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label>Выберите область(*)</label>
                            <select name='region' class="form-control" required="">
                                <option value=''>Область*</option>
                                <option value='almaty'>Алматы</option>
                                <option value='kostanay'>Костанай</option>
                                <option value='uko'>ЮКО</option>
                                <option value='vko'>ВКО</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label>Выберите регион\город(*)</label>
                            <select name='city' class="form-control" required="">
                                <option value=''>Регион*</option>
                                <option value='almaty'>Алматы</option>
                                <option value='kostanay'>Костанай</option>
                                <option value='astana'>Астана</option>
                                <option value='aktobe'>Актобе</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label for="postCode">Почтовый индекс(*)</label>
                            <input type="text" name='postCode' class="form-control" id="postCode" placeholder="Почтовый индекс" required="">
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label>Способ доставки(*)</label>
                            <select name='shipping' class="form-control" required="">
                                <option value=''>Выберите*</option>
                                <option value='0'>1-2 месяц - Бесплатная доставка</option>
                                <option value='3000'>1-2 неделя - 2000 тг.</option>
                                <option value='5000'>3-5 день - 5000 тг.</option>
                            </select>
                        </div>
                        <a href='catalog.php' class="bttn-catalog" style='margin-right:2%;'>Каталог</a>
                        <a href='cart.php' class="bttn-cart" style='margin-right:2%;'>Корзина</a>
                        <button type="submit" name='checkout' class="bttn-submit" style='margin-right:2%;'>Оформить</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

<?php include_once 'footer.php'; ?>
	<script type="text/javascript" src="js/less.min.js"></script>
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src='js/story-box.min.js'></script>
    <script src='js/story-box-uncompressed.js'></script>

	<script src='js/scripts.js'></script>
    <script src='js/placeholdem.min.js'></script>
    <script src="rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
    <script src="rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
    <script src='js/waypoints.min.js'></script>
</body>
</html>