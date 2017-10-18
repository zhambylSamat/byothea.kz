
<style type="text/css">
	/*#searchId{
		border-color:#111111;
		background-color:#222222;
		color:white;
		transition:0.3s;
	}
	#searchId:hover{
		background-color:white;
		color:black;
		transition:0.3s;
	}
	#searchId:focus{
		background-color:white;
		color:black;
	}
	#searchBtn{
		border-color:#111111;
	}*/
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
		background-color: rgba(255,255,255,0) !important;
		color:#F2D70A;
		transition: 0.1s;
	}
</style>
<nav class="navbar navbar-fixed-top">
  	<div class="container">
	    <div class="navbar-header">
		    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		      	<span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar" style='background-color: black;'></span>
		        <span class="icon-bar" style='background-color: black;'></span>
		        <span class="icon-bar" style='background-color: black;'></span>
		    </button>
		    <a class="navbar-brand" href="index.php" style='padding-top:0px;'>
		    	<img src="img/logo-7.png" class='img-responsive hidden-xs'>
                <img src="img/logo-30.png" style='margin-top:10px;' class='img-responsive hidden-lg hidden-md hidden-sm'>
		    </a>
	    </div>

	    <div class="collapse navbar-collapse lnk" id="bs-example-navbar-collapse-1">
	      	<ul class="nav navbar-nav navbar-right">
	        	<li style='text-align: center;'><a class='h-index' href="index.php">ГЛАВНАЯ</a></li>
	        	<li style='text-align: center;'><a class='h-index' href="index.php#about">О КОМПАНИИ</a></li>
	        	<li style='text-align: center;'><a class='h-index' href="index.php#services">УСЛУГИ</a></li>
	        	<li style='text-align: center;'><a class='h-index' href="catalog.php">КАТАЛОГ</a></li>
	        	<li style='text-align: center;'><button onclick="window.location.href='cart.php'" class="btn-cart" type="button">Корзина <span class="badge" id='cartQuantity'><?php if(isset($_SESSION['cart'])) echo count($_SESSION['cart']); else echo '0';?></span></button></li>
	      	</ul>
	    </div>
  	</div>
</nav>

