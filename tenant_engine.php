<?php 

$tenant_id='';
$full_name='';
$email='';
$password='';
$phone_no='';
$address='';
$id_type='';
$id_photo='';

$db = new mysqli('localhost','root','','rentalhouse');

if($db->connect_error){
	echo "Error connecting database";
}

if(isset($_POST['btn_save'])){
	tenant_register();
}

function tenant_register(){
	if(isset($_FILES['id_photo']))
	{
$id_photo='tenant_photos/'.$_FILES['id_photo']['name'];

if(!empty($_FILES['id_photo'])){
    $path = "tenant_photos/";
    $path=$path. basename($_FILES['id_photo']['name']);
        if(move_uploaded_file($_FILES['id_photo']['tmp_name'], $path))
        {
            echo"The file ". basename($_FILES['id_photo']['name']). " has been uploaded";
        }

        else{
            echo "There was an error uploading the file, please try again!";
        }
}

	}
	global $tenant_id,$full_name,$email,$password,$phone_no,$address,$id_type,$id_photo,$db;
	// $tenant_id=validate($_POST['tenant_id']);
	$full_name=validate($_POST['full_name']);
	$email=validate($_POST['email']);
	$password=validate($_POST['password']);
	$phone_no=validate($_POST['phone_no']);
	$address=validate($_POST['address']);
	$id_type=validate($_POST['id_type']);
	$id_photo=$_POST['id_photo'];
	$password = $password; // Encrypt password
		$sql = "INSERT INTO tenants(name,email,password,contact,address,id_type,id_photo) VALUES('$full_name','$email','$password','$phone_no','$address','$id_type','$path')";
		if($db->query($sql)===TRUE){
			header("location:tenant_login.php");
	}
}




function validate($data){
	$data = trim($data);
	$data = stripcslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}



 ?>