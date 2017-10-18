<?php
	include_once 'conn.php';
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$conn->exec("set names utf8");
	if(!isset($_GET['pid'])){
		header("location:index.php");
	}
	else{
		try {
			$stmt = $conn->prepare("SELECT * FROM items WHERE id = :pid");
	     
		    $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);

		    $pid =  $_GET['pid'];
		     
		    $stmt->execute();
		    $readrow = $stmt->fetch(PDO::FETCH_ASSOC);		
		} catch (Exception $e) {
			echo "Error: " . $e->getMessage();
		}
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

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <link rel="stylesheet" href="css/bootstrap-theme.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet/less" type='text/css' href="css/style.less">


</head>

<body>
<?php
    if(!isset($_GET['nav'])) 
        include_once 'navbar.php'; 
?>
	<section id='content' style='padding:30px 0;'>
		<div class='container'>
			<div class='row'>
				<div class='col-md-6 col-sm-6 col-xs-12'>
					<img style='border:1px solid #aaa;' class='img-responsive' src="products/<?php echo $readrow['img'];?>">
				</div>
				<div class='col-md-6 col-sm-6 col-xs-12'>
					<h2><?php echo $readrow['name']?></h2>
					<span>₸<?php echo $readrow['price']?></span>
					<span class='pull-right'><?php echo $readrow['quantity']?> шт.</span>
					<hr>
					<h3>Description</h3>
					<p><?php echo $readrow['description'];?></p>
				</div>
				<center><a href="javascript:history.back()" class='btn btn-primary'>Назад</a></center>
			</div>
		</div>
	</section>
<?php
    if(!isset($_GET['footer']))
        include_once 'footer.php'; 
?>

	<script type="text/javascript" src="js/less.min.js"></script>
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script type="text/javascript">
    	$(document).ready(function(){
            var h = $("nav").height();
            console.log(h);
            $("#content").css({'margin-top':''+h+'px'});
        });
    </script>
</body>
</html>