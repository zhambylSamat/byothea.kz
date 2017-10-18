<header id='header'>
    <div class='cover'>
        <div class='container-fluid'>
            <div class='row'>
                <div class='col-md-12 col-sm-12 col-xs-12' style="position: relative; z-index: 100; top:0; left:0; height: 0;">
                    <?php if(isset($_GET['checkout']) && $_GET['checkout']=='ok'){?>
                    <center><div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Заявка оформлена!</strong> Дождитесь пока менеджер свяжется с вами!
                    </div></center>
                    <?php }?>
                    <?php if(isset($_GET['fail'])){?>
                    <center><div class="alert alert-warning alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>К сожалению товары указанные ниже уже продано до вас. Извините за неудобство. Пожалуйста позвоните менеджеру.</strong><br>
                        <?php echo $_GET['fail'];?> 
                    </div></center>
                    <?php }?>
                </div>
            </div>
            <div class='row'>
                <center>
                    <div class='box-h'>
                        <h3 style='color:black; font-weight: bold;'>Стильная обувь и модная одежда, а так же очаровательные аксессуары</h3>
                        <!-- <h4 class='headline'>Магазин профессиональной косметики</h4> -->
                        <!-- <img class='logo' src="img/logo-byothea.png"> -->
                        <!-- <h3>"Красота требует не жертв, а профессионального ухода"</h3> -->
                        <!-- <a href="https://www.instagram.com/byothea_almaty/" target="_blank"><img src="img/insta.png" target='_blank'></a><a href="#"><img src="img/fb.png"></a> -->
                    </div>
                </center>
            </div>
        </div>
    </div>
</header>