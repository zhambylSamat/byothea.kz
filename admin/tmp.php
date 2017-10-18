<div class='col-md-12 col-sm-12 col-xs-12'>
					<table class='table-hover table-bordered' style='width: 100%; margin-top:5%; margin-bottom:20%;'>
						<?php
							foreach ($result as $readrow) {
							 	echo "<tr style='text-align:center;'><td><img style='width:50%;' src='../".$readrow['img']."'></td><td>".$readrow['name']."</td><td>".$readrow['price']."</td><td>".$readrow['quantity']."</td><td><a href='../description.php?pid=".$readrow['id']."' targer='_blank' class='btn btn-success'>Подробнее</a><br><a href='products.php?edit=".$readrow['id']."' class='btn btn-warning'>Изменить</a><br><form onsubmit='return confirmd()' action='admin_crud.php' method='post'><input type='hidden' name='deleteProduct' value='".$readrow['id']."'><input type='submit' class='btn btn-danger' name='delete' value='Удалить'></form></td></tr>";
							 } 
						?>
					</table>
				</div>