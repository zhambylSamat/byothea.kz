<?php
echo $item_num = substr(uniqid('I', true), 0, 10);
$a = $b = 'abc';
echo $a." - ".$b;
if(isset($_POST['dt2'])){
	echo $_POST['dt2'];
}
?>
<form method='post' action="test.php">
	<input type="date" name="dt">
	<label>Pattern YYYY-MM-DD</label>
	<input type="text" name="dt2" pattern='[0-9]{4}-[0-9]{2}-[0-9]{2}'>
	<input type="submit" name="">
</form>