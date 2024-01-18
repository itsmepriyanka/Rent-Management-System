
<?php 

$conn = new mysqli('localhost','root','','Rentalhouse');

if($conn->connect_error!=0){
	die('Database connection error:'.$conn->connect_error);
}

 ?>