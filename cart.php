<?php include_once 'conn.php'; ?>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Online Catalogue</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="story-box/animate.css" rel="stylesheet" type="text/css"> 
	<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
	<link href="story-box/animate.css" rel="stylesheet" type="text/css"> 
	<link href="story-box/story-box-zen.css" rel="stylesheet" type="text/css"> 
	<style type="text/less">
		
	</style>
	<link rel="stylesheet/less" type='text/css' href="css/style.less">
	<link rel="stylesheet/less" type='text/css' href="css/style-cart.less">
</head>
<body>
	<?php include_once 'navbar.php'; ?>
	<div class='contaier' style='margin-top:3%'>
		<div class='row' style='margin-left:0; margin-right:0;'>
			<div class='col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3'>
				<div class='page-header'>
					<center><h2>Моя корзина (<?php if(isset($_SESSION['cart'])) echo count($_SESSION['cart']); else echo '0';?>)</h2></center>
					<?php 
					if(isset($_GET['action']) && $_GET['action']=='removed')
						echo "<div class='alert alert-success alert-dismissible' role='alert' id='myAlert'>
			     			<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
					        <span aria-hidden='true'>&times;</span>
					      </button>
					      Выбранный вами товар (".$_GET['name'].") <b>удалено!</b>.
					    </div>";
					else if(isset($_GET['action']) && $_GET['action']=='updated')
						echo "<div class='alert alert-success alert-dismissible' role='alert' id='myAlert'>
			     			<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
					        <span aria-hidden='true'>&times;</span>
					      </button>
					      Выбранный вами товар (".$_GET['name'].") <b>успешно обновлен! </b> .
					    </div>";
					else if(isset($_GET['action']) && $_GET['action']=='removed')
						echo "<div class='alert alert-warning alert-dismissible' role='alert' id='myAlert'>
			     			<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
					        <span aria-hidden='true'>&times;</span>
					      </button>
					      Выбранный вами товар (".$_GET['name'].") <b>удалено! </b> .
					    </div>";
				?>
				</div>
				<?php 
					$totalPrice = 0.0; 
					$a = 0;
					if(!isset($_SESSION['cart'])) echo "<center><h3>Выбранных товаров нет</h3></center>";
					if(isset($_SESSION['cart'])){
					foreach ($_SESSION['cart'] as $key => $value) {
					$a++;
					$result = explode('!', $value);
					$totalPrice += (float)$result[3]*(float)$result[4];
				 ?>
				<table style='margin-top:3%'>
					<tr class='itemCart bord'>
						<td class='imgCart hidden-xs'><a href="description?pid=<?php echo $result[0];?>"><img src="products/<?php echo $result[2];?>"></a></td>
						<td class='nameCart'><a href="description?pid=<?php echo $result[0];?>"><?php echo $result[1];?></a><p class='priceCart'>₸ <?php echo $result[3];?></p></td>
						<td class='bord configCart'>
							<form action='update_cart.php?id=<?php echo $result[0]?>&name=<?php echo $result[1]?>&price=<?php echo $result[3]?>&image=<?php echo $result[2]?>&maxQuantity=<?php echo $result[5]?>&item_num=<?php echo $result[6]?>' method='post'>
								<div class='grid'>
									<input type='number' name='quantity' autocomplete='off' class='number' min="1" max="<?php echo $result[5];?>" value='<?php echo $result[4];?>'>
								</div>
								<button type='submit' class='update'><center>Обновить</center></button>
							</form>
							<div class='remove' onclick="location.href = 'remove_from_cart.php?id=<?php echo $result[0]?>&name=<?php echo $result[1]?>'"><center><span class="glyphicon glyphicon-trash" aria-hidden="true"> Удалить</span></center></div>
							<div class='total'>₸ <?php echo (float)$result[3]*(float)$result[4];?></div>
						</td>
					</tr>
				</table>
				<?php }
					if($a==0) echo "<center><h3>Ваша корзина пуста.</h3></center>";
				 }?>
			</div>
			<div class='col-md-8 col-md-offset-2 col-sm-12 col-xs-12'>
				<table class='count hidden-xs'>
					<tr>
						<!-- <td class='subtotal countTd'><p>Промежуточный итог<p><p id='subtotal'>₸ <?php echo number_format(($totalPrice-$totalPrice*0.06), 2, '.', '');?></p></td>
						<td class='taxes countTd'><p>Налог (12%)</p><p id='taxes'>₸ <?php echo number_format(($totalPrice*0.12), 2, '.', '');?></p></td> -->
						<td class='totalRm countTd'><div class='pull-right'><p>Итог</p><p id='total'>₸ <?php echo number_format($totalPrice, 2, '.', '');?></p></div></td>
						<td class='checkout countTd'><button class='pull-right' onclick="window.location.href='<?php if($a==0) echo '#'; else echo 'checkout.php';?>'" >Оформить заказ</button></td>
					</tr>
				</table>
				<table class='count hidden-lg hidden-md hidden-sm'>
					<!-- <tr>
						<td class='subtotal countTd'><p>Промежуточный итог<p><p id='subtotal'>₸ <?php echo number_format(($totalPrice-$totalPrice*0.06), 2, '.', '');?></p></td>
						<td class='taxes countTd'><p>Налог (12%)</p><p id='taxes'>₸ <?php echo number_format(($totalPrice*0.12), 2, '.', '');?></p></td>
					</tr> -->
					<tr>
						<td class='totalRm countTd'><p>Итог</p><p id='total'>₸ <?php echo number_format($totalPrice, 2, '.', '');?></p></td>
						<td class='checkout countTd'><button onclick="window.location.href='<?php if($a==0) echo '#'; else echo 'checkout.php';?>'">Оформить заказ</button></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<?php include_once 'footer.php'; ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/less.min.js"></script>
    <script src="story-box/story-box.min.js"></script>
    <script type="text/javascript">
    	$(document).ready(function(){
		    $(".countTd").hover(function(){
		        $('.countTd p:first-child').css({"color":"#686868"});
		        }, function(){
        			$('.countTd p:first-child').css({"color":"#BEC4C8"});
		    });
		});
    	
    </script>
</body>
</html>