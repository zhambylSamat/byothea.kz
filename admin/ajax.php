<?php
include_once '../conn.php';
$total_record = 0;
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
  // Prepare the SQL statement
  $stmt = $conn->prepare("SELECT * FROM admin WHERE email=:em");
	$stmt->bindParam(':em', $email, PDO::PARAM_STR);
	$email = $_GET['em'];
  $stmt->execute();
  $categories = $stmt->fetch();
}
catch(PDOException $e)
{
  echo "Error: " . $e->getMessage();
}
 	if($categories['email']!='') {echo "<div class='alert alert-danger alert-dismissible' role='alert' id='myAlert'>
			      <button type='button' class='close' data-dismiss='alert' aria-label='Close' onclick='text()'>
			        <span aria-hidden='true'>&times;</span>
			      </button>
			      <strong>Ошибка!</strong> Администратор с таким именем (".$_GET['em'].") уже сушествует.</div>";
		}
?>