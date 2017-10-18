<?php if(substr($_SERVER['REQUEST_URI'],0,20) == '/kosmetika/index.php' || $_SERVER['REQUEST_URI']=='/kosmetika/'){?>
			<form class='navbar-form navbar-right' action='index.php' method='post'>
				<div class='input-group' style='width:250px'>
			    	<input type="text" class="form-control" placeholder="Search for..." name='find' autocomplete='off' id='searchId' <?php if(isset($_SESSION['search']) && $_SESSION['search']=='true') echo "value=".$_SESSION['orderBy'];?>>
			    	<span class="input-group-btn">
			        	<button class="btn btn-default" id='searchBtn' type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Search</button>
			      	</span>
			  	</div>
		    </form>
		    <?php }?>