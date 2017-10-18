<?php
    include_once 'conn.php';
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec("set names utf8");
    try {
        $stmt = $conn->prepare("SELECT * FROM items WHERE img != ''");
         
        $stmt->execute();
        $result = $stmt->fetchAll();     
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>Онлайн магазин</title>
<!-- Byothea – итальянская профессиональная косметическая линия -->

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
    <?php include_once('sn.html');?>
    <?php include_once('header.php');?>
    <section id='content'>
        <div class='container'>
            <div class='row'> 
                <center> 
                    <div class='col-md-12 col-sm-12 col-xs-12'>
                        <?php if(isset($_GET['checkout']) && $_GET['checkout']=='ok'){?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Ваша заявка оформлено!</strong> Дождитесь пока менеджер вам позвонит!
                        </div>
                        <?php }?>
                    </div> 
                    <div class='col-md-12 col-sm-12 col-xs-12 headline'>
                        <!-- <h1>Итальянская косметика <u>BYOTHEA</u></h1><br> -->
                    </div>
                    <div class='col-md-12 col-sm-12 col-xs-12 sorting' style='position: relative;'>
                        <!-- <div class='pull-right'>
                            <select name='sort'>
                                <option value='default'>Сортировка</option>
                                <option value='new'>Новейшее</option>
                                <option value='cheepToExpensive'>Цена (низкая -> высокая)</option>
                                <option value='expensiveToCheep'>Цена (высокая -> низкая)</option>
                                <option value='beginToLast'>Название А-Я</option>
                                <option value='lastToBegin'>Название Я-А</option>
                            </select>
                        </div> -->
                    </div>
                </center>
            </div>
            <div class='row products'>
                <?php foreach ($result as $readrow) {
                 ?>
                <div id='box' class='col-md-3 col-sm-3 col-xs-6 box'>
                    <div class='block cover'>
                        <center>
                            <a href="description.php?pid=<?php echo $readrow['id'];?>" target='_blank'><img class='img' src="products/<?php echo $readrow['img'];?>" alt='Крем для рук: 100 мл.'></a>
                            <hr>
                            <div class='caption'>
                                <a href="description.php?pid=<?php echo $readrow['id'];?>" target='_blank'><h4 class='title'><?php echo $readrow['name']?></h4></a>
                                <hr>
                                <span style='padding-left:10px; padding-right:10px;' class='price'><b>₸<?php echo $readrow['price']?></b></span>
                                <?php if($readrow['quantity']>0){?>
                                    <span style='padding-left:10px; padding-right:10px;' class='quantity'><b>Осталось: <?php echo $readrow['quantity']?> шт.</b></span>
                                <?php } else {?>
                                    <span style='padding-left:10px; padding-right:10px;' class='quantity'><b style='color:#D9534F;'>Нет в наличии</b></span>
                                <?php }?>
                            </div> 
                            <button class='btn btn-danger <?php if(!isset($_SESSION['cart'][$readrow['id']])) echo "hide"; else echo "shw"?>' id='done<?php echo $readrow["id"]?>' style='margin:5%;' disabled="disabled">Добавлено</button>
                            <button class='btn btn-success <?php if(isset($_SESSION['cart'][$readrow['id']])) echo "hide"; else echo "shw"?>' id='cart<?php echo $readrow["id"]?>' style='margin:5%;' <?php if($readrow['quantity']==0) echo 'disabled="disabled"';?> <?php echo "onclick= \"return addToCart('".$readrow['id']."','".$readrow['name']."','".$readrow['price']."','".$readrow['img']."','".$readrow['quantity']."','".$readrow['item_num']."')\"";?> >Добавить в корзину</button> 
                                  
                        </center>
                    </div>
                </div>
                <?php }?>
            </div>
        </div>
    </section>
    <a href="#header">
        <div class='scrolTop' id='sctp'>
        </div>
    </a>
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
    <script src='js/slick.min.js'></script>

    <script src="js/slick.js" type="text/javascript" charset="utf-8"></script>

    <!-- <script src="http://maps.api.2gis.ru/2.0/loader.js?pkg=full"></script> -->

    <!-- <script src="https://api-maps.yandex.ru/2.1/?lang=en_US" type="text/javascript"></script> -->
    <!-- <script type="text/javascript">
        var map;

        DG.then(function () {
            map = DG.map('map', {
                center: [43.248406864926544,76.906635761261],
                zoom: 16
            });

            DG.marker([43.248406864926544,76.906635761261]).addTo(map).bindPopup('ул. Карасай батыра 152,уг.ул. Нурмакова , БЦ Карасай');
        });
    </script> -->
    <!-- <script type="text/javascript">
    ymaps.ready(init);
    var myMap;

    function init(){     
        myMap = new ymaps.Map("map", {
            center: [43.23, 76.96],
            zoom: 13
        });
        myPlacemark = new ymaps.Placemark([43.21, 76.96], { hintContent: 'Алматы', balloonContent: 'Казахстан' });
        myMap.geoObjects.add(myPlacemark);
    }
</script> -->
    <script type="text/javascript">
        $(document).ready(function(){
            var h = $("nav").height();
            console.log(h);
            $("#header").css({'margin-top':''+h+'px'});

            $(window).on('load',function(){
                var w = $(window).width();
                if(w<=380){
                    $('.box').removeClass('col-xs-6').addClass('col-xs-10 col-xs-offset-1');
                    $("#content .products .box .block .title").css({'height':"auto", 'padding-top':'0px','padding-bottom':'0px'});
                }
                else{
                    $('.box').removeClass('col-xs-12').addClass('col-xs-6');   
                }
            });

            $(window).resize(function(){
                var w = $(window).width();
                if(w<=380){
                    $('.box').removeClass('col-xs-6').addClass('col-xs-10 col-xs-offset-1');
                    $("#content .products .box .block .title").css({'height':"auto", 'padding-top':'0px','padding-bottom':'0px'});
                }
                else{
                    $('.box').removeClass('col-xs-12').addClass('col-xs-6');   
                }
            });
        });

        function addToCart(id,name,price,img,quantity,item_num){
            var xmlhttp;
     
            if (window.XMLHttpRequest)
              {
                xmlhttp=new XMLHttpRequest();
              }
            else
              {
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
              }
         
            xmlhttp.onreadystatechange=function()
              {
                if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    $(function(){
                        $('#cart'+id).removeClass('shw').addClass('hide');
                        $('#done'+id).removeClass('hide').addClass('shw');
                        var q = parseInt($("#cartQuantity").html());
                        $("#cartQuantity").html(q+1);
                        console.log(q);
                    });
                }
              }
            xmlhttp.open("GET",'add-to-cart.php?id='+id+'&name='+name+'&price='+price+'&image='+img+'&maxQuantity='+quantity+'&item_num='+item_num,true);
            xmlhttp.send();
        }

        $(document).scroll(function() {
            var y = $(this).scrollTop();
          
          console.log(y);
          if (y > 500) {
            $('.navbar').addClass("scrolled");
            $('.scrolTop').css("display","block");
          } else {
            $('.scrolTop').css("display","none");
          }
        });
    </script>

</body>
</html>