<?php
	session_start();
	if(isset($_SESSION['user_id'])){
		header("location:products.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
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
					<?php if(isset($_GET['request']) && $_GET['request']=='ok'){?>
					<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Регистрация успешно завершено!</strong> Дождитесь пока главный администратор подтвердит ваш запрос!
					</div>
					<?php }?>
					<?php if(isset($_GET['login']) && $_GET['login']=='fail'){?>
					<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Ошибка!</strong><br> Возможно одно из следующих:<br> 1. Вы ввели неверные данные. <br>2. Вы еще не зарегистрированы.<br>3. Главный администратор еще не одобрил вашу регистрацию.
					</div>
					<?php }?>
				</div>
				<div class='col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12'>
					<form style='margin-top:25%;' method="post" action='admin_crud.php'>
						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" class="form-control" id="email" name='email' placeholder="Email">
						</div>
						<div class="form-group">
							<label for="password">Пароль</label>
							<input type="password" class="form-control" id="password" name='password' placeholder="Ввидите пароль">
						</div>
						<button type="submit" name='login' class="btn btn-default">Отправить</button>
						<a href="admin_registration.php" class='pull-right'>Регистрация нового админа</a>
					</form>
					<center>
						<a href="../catalog.php" class='btn btn-success'>Каталог</a>
					</center>
				</div>
			</div>
		</div>
	</section>


	<script type="text/javascript" src="../js/less.min.js"></script>
    <script src="../js/jquery-1.11.1.min.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>