<?php
	include_once '../conn.php';
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$conn->exec("set names utf8");
	if(!isset($_SESSION['user_id'])){
		header("location:index.php");
	}
	if(isset($_GET['edit'])){
		try {
			$stmt = $conn->prepare("SELECT * FROM items WHERE id = :id");
			$stmt->bindParam(':id',$pid,PDO::PARAM_STR);
			$pid = $_GET['edit'];
			$stmt->execute();
			$readrow2 = $stmt->fetch(PDO::FETCH_ASSOC);	
		} catch (Exception $e) {
			echo "Error: " . $e->getMessage();
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
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
	<head>
		<div class='container'>
			<div class='row'>
				<center>
					<a href="../catalog.php" class='pull-left btn btn-success btn-sm'>Каталог</a>
					<?php
						if($_SESSION['manipulation']==1){
					?>
					<a href="order.php" class='btn btn-primary btn-sm'>Заказы</a>
					<?php }?>
					<a href="logout.php" class='pull-right btn btn-danger btn-sm'>Выйти</a>
					<h1>
						<?php
							echo $_SESSION['user_name']." ".$_SESSION['user_surname'];
						?>
					</h1>
				</center>
			</div>
		</div>
	</head>
	<section>
		<div class='container'>
			<div class='row'>
				<div class='col-md-12 col-sm-12 col-xs-12'>
					<?php if(isset($_GET['send']) && $_GET['send']=='success'){?>
					<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Запрос успешно завершен!</strong>
					</div>
					<?php }
						if(isset($_GET[md5('edited')]) && $_GET[md5('edited')]=='y'){
					?>
					<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Запрос успешно изменен!</strong>
					</div>
					<?php
					} if(isset($_GET[md5('rowdeleted')]) && $_GET[md5('rowdeleted')]=='y'){
					?>
					<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Выбранный вами товар удален!</strong>
					</div>
					<?php } if(isset($_GET[md5('rowdeleted')]) && $_GET[md5('rowdeleted')]=='a'){
					?>
					<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Удален!</strong>
					</div>
					<?php } if(isset($_GET['img']) && $_GET['img']==md5('false')){?>
						<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>Ошибка! Файл не будет добавлен в каталог для клиенов! </strong>Выбранная вами изображения не загружена. Пожалуйста повторите еще раз или обратитесь к техническому отделу!
						</div>
					<?php } if(isset($_GET['img']) && $_GET['img']==md5('exist')){?>
						<div class="alert alert-warning alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>Выбранная вами изображения уже существует!</strong>
						</div>
					<?php } if(isset($_GET['img']) && $_GET['img']==md5('wrong_format')){?>
						<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>Ошибка! Файл не будет добавлен в каталог для клиенов! </strong>Пожалуйста выбрите правильный вариант изображения. (Все доступные форматы : <b>.jpg</b>, <b>.jpeg</b>, <b>.png, <b>.gif</b>)
						</div>
					<?php }?>
				</div>
				<?php
					if($_SESSION['manipulation']==1){
				?>
				<div class='col-md-12 col-sm-12 col-xs-12'>
					<center>
						<?php
								try {
								    $stmt = $conn->prepare("SELECT * FROM admin WHERE access = 0");
								    $stmt2 = $conn->prepare("SELECT * FROM admin WHERE access = 1 AND aid != :aid order by manipulation desc");
								    $stmt2->bindParam(':aid', $aid, PDO::PARAM_STR);
								    $aid = $_SESSION['user_id'];
								    $stmt2->execute();
								    $stmt->execute();
								 
								    $result = $stmt->fetchAll();
								    $count = $stmt->rowCount();
								    $result2 = $stmt2->fetchAll();
								    $count2 = $stmt2->rowCount();
								  } 
								  catch (Exception $e) {
								    echo "Error: " . $e->getMessage();
								  }
							
						?>
						<h4>Запрос(ы) на доступ администратора <button class='btn btn-default' id='not' style='cursor:pointer;'><?php echo $count;?></button></h4>
						<div id='notifications' class=''>
							<table>
								<?php
									foreach ($result as $readrow) {
										echo "<tr><td>".$readrow['name']."</td><td>".$readrow['surname']."</td><td>".$readrow['email']."</td><td>".$readrow['phone']."</td><td><form method='post' action='admin_crud.php'><input type='hidden' name='hid' value='".$readrow['aid']."'><input type='submit' name='allow' class='btn btn-warning' value='Разрешить'></form><form onsubmit = 'return confirmd()' action='admin_crud.php' method='post'><input type='submit' name='delete_from_admin' class='btn btn-danger btn-xs' value='Удалить'><input type='hidden' value='".$readrow['aid']."' name='delete_from_admin_hid'></form></td></tr>";
									}
								?>
							</table>
						</div>
						<h3>
							Все администраторы <button class='btn btn-default' id='usr' style='cursor:pointer;'><?php echo $count2;?></button>
						</h3>
						<div id='allUsers' class=''>
							<table>
								<?php
									foreach ($result2 as $readrow) {
										$acc1 = 'Полный доступ';
										$acc12 = 'allPermission';
										$acc2 = '';
										if($readrow['manipulation']==1) {
											$acc1 = 'Ограниченный доступ';
											$acc12 = 'onePermission';
										}
										if($readrow['head']==1) $acc2 = 'disabled="disabled"';
										echo "<tr><td>".$readrow['name']."</td><td>".$readrow['surname']."</td><td>".$readrow['email']."</td><td>".$readrow['phone']."</td><td><form method='post' action='admin_crud.php'><input type='hidden' name='hid' value='".$readrow['aid']."'><input type='submit' name='".$acc12."' class='btn btn-success' ".$acc2." value='".$acc1."'></form></td><td><form method='post' action='admin_crud.php'><input type='hidden' name='hid' value='".$readrow['aid']."'><input type='submit' name='deny' class='btn btn-danger' ".$acc2." value='Убрать из списка админов'></form></td></tr>";
									}
								?>
							</table>
						</div>
					</center>
				</div>
				<?php
					}
				?>
				<div class='col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12'>
					<center  style='margin-top:25%;'><h1>Добавить или изменить</h1></center>
					<form autocomplete="off" method="post" action='admin_crud.php' enctype="multipart/form-data">
						<div class="form-group">
							<label for="name">Наименование товара</label>
							<input type="text" class="form-control" name="name" placeholder="Наименование товара" value='<?php if(isset($_GET["edit"])) echo $readrow2["name"];?>' required='Обязательно для заполнение'>
						</div>
						<div class="form-group">
						    <label for="fileImg" style="<?php if(isset($_GET['edit'])) echo 'color:red;';?>">Изображение товара <?php if(isset($_GET['edit'])) echo 'уже выбрано. Вы можете изменит изображение нажав на кнопку <b>"Выберите файл"</b>'?></label>
						    <?php if(isset($_GET['edit'])){ ?><input type="hidden" name="edit_img" value='<?php echo $readrow2["img"];?>'><?php }?>
						    <input type="file" id="fileImg" name='img' <?php if(!isset($_GET['edit'])){ ?>required='Обязательно для заполнение'<?php }?>>
						    <p class="help-block" style="<?php if(isset($_GET['edit'])) echo 'color:red;';?>">Выберите соответствующую картинку</p>
  						</div>
						<div class="form-group">
							<label for="description">Описание товара</label>
							<textarea rows="10" cols="50" class="form-control" id='description' name="description" placeholder="Описание товара" required='Обязательно для заполнение'><?php if(isset($_GET["edit"])) echo $readrow2["description"];?></textarea>
						</div>
						<div class="form-group">
							<label for="quantity">Количество товара на складе</label>
							<input type="number" min="0" class="form-control" id='quantity' name="quantity" placeholder="Количество товара" value='<?php if(isset($_GET["edit"])) echo $readrow2["quantity"]; else echo "1"?>' required='Обязательно для заполнение'>
						</div>
						<div class="form-group">
							<label for="price">Цена за 1шт.</label>
							<input type="number" min="1" class="form-control" id='price' name="price" placeholder="Цена" value='<?php if(isset($_GET["edit"])) echo $readrow2["price"];?>' required='Обязательно для заполнение'>
						</div>
						<?php if(!isset($_GET['edit'])){ ?><button type="submit" name='addProduct' class="btn btn-success">Отправить запрос</button><?php } ?>
						<?php if(isset($_GET['edit'])){ ?>
								<input type="hidden" name="editHid" value='<?php echo $readrow2["id"]?>'>
								<button type="submit" name='editProduct' class="btn btn-primary">Изменить</button>
								<a href='products.php' class="btn btn-danger">Отмена</a>
						<?php } ?>
						<input class='btn btn-warning btn-xs' type="reset">
					</form>
				</div>
				<?php 
					try {
						$stmt = $conn->prepare("SELECT * FROM items");
						$stmt->execute(); 
					    $result = $stmt->fetchAll();
					    $count = $stmt->rowCount();
					    if($count>0){
				?>
			</div>
			<div class='row' style='padding:10% 0;'>
				<!-- <div class='col-md-12 col-sm-12 col-xs-12'>
					<select name='sort' class='pull-right'>
                        <option value='default'>Сортировка</option>
                        <option value='new'>Новейшее</option>
                        <option value='cheepToExpensive'>Цена (низкая -> высокая)</option>
                        <option value='expensiveToCheep'>Цена (высокая -> низкая)</option>
                        <option value='beginToLast'>Название А-Я</option>
                        <option value='lastToBegin'>Название Я-А</option>
                    </select>
				</div> -->
				<div class='col-md-12 col-sm-12 col-xs-12'>
					<center><h3 style='color:red;'>*Товары без изображении не будут доступны клиентам*</h3></center>
				</div>
				<?php foreach ($result as $readrow) {?>
				<div class='col-md-3 col-sm-3 col-xs-6' style='border:1px solid #bbb;'>
					<center>
						<?php
							
							 	echo "<img style='height:250px;' src='../products/".$readrow['img']."'><h3 style='height:50px; font-size:20px;'>".$readrow['name']."</h3><hr><h4 style='display:inline-block;'>₸".$readrow['price']."</h4> ------ <h4 style='display:inline-block;'>".$readrow['quantity']." шт.</h4><hr><div><a href='../description.php?pid=".$readrow['id']."&nav&footer' targer='_blank' class='btn btn-success btn-sm'>Подробнее</a><br><a href='products.php?edit=".$readrow['id']."' class='btn btn-warning btn-sm'>Изменить</a><form onsubmit='return confirmd()' action='admin_crud.php' method='post'><input type='hidden' name='deleteProduct' value='".$readrow['id']."'><input type='submit' class='btn btn-danger btn-sm' name='delete' value='Удалить'></form></div>";
							 
						?>
					</center>
				</div>
				<?php } ?>
				<?php 
					}
					}
					catch (Exception $e) {
				    	echo "Error: " . $e->getMessage();
				  	}	
				?>
			</div>
		</div>
	</section>


	<script type="text/javascript" src="../js/less.min.js"></script>
    <script src="../js/jquery-1.11.1.min.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/bootstrap.min.js"></script>

    <script type="text/javascript">
    	$(document).ready(function(){
    		$("#not").on('click',function(){
    			if($("#notifications").css('display')=='none'){
    				$("#notifications").css({'display':'block'});
    			}
    			else{
    				$("#notifications").css({'display':'none'});
    			}
    		});

    		$("#usr").on('click',function(){
    			if($("#allUsers").css('display')=='none'){
    				$("#allUsers").css({'display':'block'});
    			}
    			else{
    				$("#allUsers").css({'display':'none'});
    			}
    		});
    	});

    	function confirmd(){
    		var r = confirm("Вы уверены, что хотите удалить этот объект?");
    		return r;
    	}
    </script>
</body>
</html>