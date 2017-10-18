<?php
    // if (isset($_POST['submit'])){
    //     $to = "zhambyl.9670@gmail.com, info@gmail.com";//, aiym.usserbayeva@gmail.com
    //     $subject = "Request from byothea.kz";
    //     $message = "
    //     <html>
    //     <head>
    //     <title>Request</title>
    //     </head>
    //     <body>
    //     <table>
    //     <tr>
    //     <th>Phone number</th>
    //     </tr>
    //     <tr>
    //     <td>".$_POST['phone']."</td>
    //     </tr>
    //     </table>
    //     </body>
    //     </html>";
    //     $headers = "MIME-Version: 1.0" . "\n";
    //     $headers .= "Content-type:text/html;charset=UTF-8" . "\n";

    //     // More headers
    //     $headers .= 'From: <byothea.kz>' . "\n";
    //     $headers .= 'Cc: from byothea.kz' . "\n";

    //     mail($to,$subject,$message,$headers);
    // }
    // header("Location:index.php");
?>
<?php
    include_once 'conn.php';
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec("set names utf8");
    try {
        // $stmt = $conn->prepare("SELECT * FROM items WHERE img != ''");
         
        // $stmt->execute();
        // $result = $stmt->fetchAll();     
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
	<title>Онлайн магазин</title>


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

    <style type="text/css">
        .btn-cart{
            margin-top:10px;
            padding:5px 10px;
            width: 100%; 
            background-color: #F2D70A;
            color: white; 
            font-size: 16px; 
            border-radius: 5px; 
            vertical-align: middle;
            border:none;
            transition: 0.3s !important;
        }
        .btn-cart:hover{
            transition: 0.3s !important;
            background-color: #FFA200 !important;
        }
        nav{
            background-color: white;
            box-shadow: 0px 0px 10px black;
        }
        nav li a{
            color:black;
            transition: 0.1s;
        }
        nav li a:hover{
            background-color: rgba(0,0,0,0) !important;
            color:#F2D70A;
            transition: 0.1s;
        }
        nav li a:focus{
            background-color: rgba(0,0,0,0) !important;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar" style='background-color:black;'></span>
                    <span class="icon-bar" style='background-color:black;'></span>
                    <span class="icon-bar" style='background-color:black;'></span>
                </button>
                <a class="navbar-brand" href="#header" style='padding-top:0px;'>
                    <img src="img/logo-7.png" class='img-responsive hidden-xs'>
                    <img src="img/logo-30.png" style='margin-top:10px;' class='img-responsive hidden-lg hidden-md hidden-sm'>
                </a>
            </div>

            <div class="collapse navbar-collapse lnk" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li style='text-align:center;'><a class='h-index' href="#header">ГЛАВНАЯ</a></li>
                    <li style='text-align:center;'><a class='h-index' href="#about">О КОМПАНИИ</a></li>
                    <li style='text-align:center;'><a class='h-index' href="#review">ОТЗЫВЫ</a></li>
                    <li style='text-align:center;'><a class='h-index' href="catalog.php">КАТАЛОГ</a></li>
                    <li><button onclick="window.location.href='cart.php'" class="btn-cart" type="button">Корзина <span class="badge" id='cartQuantity'><?php if(isset($_SESSION['cart'])) echo count($_SESSION['cart']); else echo '0';?></span></button></li>
                </ul>
            </div>
        </div>
    </nav>
    <?php include_once('sn.html');?>
    <?php include_once('header.php');?>

    <section id='about'>
    <hr>
        <div class='container'>
            <div class='row'>
                <center>
                    <div class='col-md-12 col-sm-12 col-xs-12'>
                        <h1>О компании</h1>
                    </div>
                    <div class='col-md-10 col-md-offset-1 col-sm-8 col-sm-offset-2 col-xs-12 content-text'>
                    <hr>
                        <p>
                            В отделе вас ждут стильная обувь и модная одежда, а так же очаровательные аксессуары, которые дополнят ваш уникальный образ! Ассортимент порадует современных парней и девушек!<br> 
                            В наши услуги входит оперативный сервис по приобретению товаров с торговых интернет площадок Китая, Европы и многих других стран, ищем товар по вашим фото и ссылкам!
                        </p>
                        <!-- <p>
                           <b>BYOTHEA</b> – итальянская профессиональная косметическая линия вдохновлённая природой, предназначенная для косметологов. Бренд натуральной косметики BYOTHEA, который призван подчеркивать красоту представительниц прекрасного пола и совершенствовать ее. В ассортименте марки есть средства для решения самых разнообразных эстетических проблем, поэтому вам будет несложно сделать правильный выбор. Профессиональные средства подходят для применения в салонах красоты и домашних условиях, что поможет вам комплексно ухаживать за кожей лица и тела.
                        </p>
                        <hr>
                        <p>
                            В состав препаратов не входят химические компоненты и агрессивные вещества, которые могут вызвать негативные реакции организма.. 
                            Препараты для ухода и лечения изготавливаются на основе натурального экологически чистого сырья, вы не найдете в их составе искусственных красителей, загустителей, ГМО, SLS и других химических веществ, которые могут спровоцировать появление аллергии или раздражения. 
                            Студия красоты Сании Ильясовой является официальным представителем Byothea в Алматы. Наши косметологи с радостью подберут Вам правильный уход!
                        </p> -->
                    </div>
                </center>
            </div>
        </div>
    </section>

    <section id='review'>
        <div class='img-box'>
            <img src="img/bg-2.jpg" class='img-responsive'>
        </div>
        <div class='cover'></div>
        <div class='container'>
            <div class='row'>
                <div>
                    
                </div>
            </div>
        </div>
    </section>

    <?php include_once 'footer.php'; ?>

    <script type="text/javascript" src="js/less.min.js"></script>
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.min.js"></script>
   <!--  <script src='js/story-box.min.js'></script>
    <script src='js/story-box-uncompressed.js'></script> -->

	<script src='js/scripts.js'></script>
    <script src='js/placeholdem.min.js'></script>
    <script src="rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
    <script src="rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
    <script src='js/waypoints.min.js'></script>
    <script src='js/slick.min.js'></script>

    <script src="js/slick.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            var h = $("nav").height();
            console.log(h);
            $("#header").css({'margin-top':''+h+'px'});
        });
    </script>

</body>
</html>