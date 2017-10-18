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
					<div id='alert'>
						
					</div>
				</div>
				<div class='col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12'>
					<form onsubmit="return checkEmail()" style='margin-top:25%;' autocomplete="off" method="post" action='admin_crud.php'>
						<div class="form-group">
							<label for="name">Имя</label>
							<input type="text" class="form-control" name="name" placeholder="Имя" required='Обязательно для заполнение'>
						</div>
						<div class="form-group">
							<label for="surname">Фамилия</label>
							<input type="text" class="form-control" name="surname" placeholder="Фамилия" required='Обязательно для заполнение'>
						</div>
						<div class="form-group">
							<label for="phone">Номер сотового телефона (Проверьте перед отправкой*)</label>
							<input type="text" class="form-control" name="phone" placeholder="Номер телефона" required='Обязательно для заполнение'>
						</div>
						<div class="form-group">
							<label for="email">Email (Проверьте перед отправкой*)</label>
							<input type="email" class="form-control" id='email' name="email" placeholder="Email" required='Обязательно для заполнение'>
						</div>
						<div class="form-group">
							<label for="password">Пароль</label>
							<input type="password" class="form-control" id='password' name="password" placeholder="Новый пароль" required='Обязательно для заполнение'>
						</div>
						<div class="form-group">
							<label for="confirm-password">Повтор пароля</label>
							<input type="password" onkeyup="check()" class="form-control" id="confirm-password" placeholder="Введите заново" required='Обязательно для заполнение'>
							<p id='alert-err' class='pass-active'>Пароли не совпадают*</p>
						</div>
						<button type="submit" name='registr' class="btn btn-default">Отправить запрос</button>
						<a href="index.php" class='pull-right'>Войти</a>
					</form>
				</div>
			</div>
		</div>
	</section>


	<script type="text/javascript" src="../js/less.min.js"></script>
    <script src="../js/jquery-1.11.1.min.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script type="text/javascript">
    	torf = false;
    	function check(){
    		var pass1 = document.getElementById('password').value;
    		var pass2 = document.getElementById('confirm-password').value;
    		if(pass1 == pass2){
    			console.log('asdf');
    			$("#alert-err").removeClass("pass-error").addClass("pass-active");
                $("#password").removeClass("pass-error-input");
                $("#confirm-password").removeClass("pass-error-input");
    			torf = true;	
    		}
    		else{
    			$(function(){
	                $("#alert-err").removeClass("pass-active").addClass("pass-error");
	                $("#password").addClass("pass-error-input");
	                $("#confirm-password").addClass("pass-error-input");
	            });
	            console.log("err");
    			torf = false;
    		}
    	}
    	function checkEmail(){
			var xmlhttp;
			var str = document.getElementById("email").value;
			if (window.XMLHttpRequest){
		    	xmlhttp=new XMLHttpRequest(); // code for IE7+, Firefox, Chrome, Opera, Safari
		    	}
		    else{
		    	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); // code for IE6, IE5
		    }

			xmlhttp.onreadystatechange=function(){
				if (xmlhttp.readyState==4 && xmlhttp.status==200){
			    	if(xmlhttp.responseText!=""){
			    		document.getElementById("alert").innerHTML=xmlhttp.responseText;
			    		torf = false;
			    		window.scrollTo(0, 0);
			    	}
			    	else torf = true;
			    }
		  	}
			xmlhttp.open("GET","ajax.php?em="+str,false);
			xmlhttp.send();

			if(torf == true) {
				return true;
			}
			else{
				return false;
			}
    	}
    </script>
</body>
</html>