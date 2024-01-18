<?php 
 if (isset($_POST['btn_save'])){
  $err=[];
  if(isset($_POST['full_name']) && !empty($_POST['full_name']) && trim($_POST['full_name'])){
    $full_name = $_POST['full_name'];
  }else{
    $err['full_name']= "Please enter name";
  } 
  if(isset($_POST['email']) && !empty($_POST['email']) && trim($_POST['email'])){
      $email = $_POST['email'];
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $err['email'] = "Please enter a valid email address";
    }
    }else{
      $err['email']= "Please enter email";
    } 
  if(isset($_POST['password']) && !empty($_POST['password']) && trim($_POST['password'])){
      $password = $_POST['password'];
    }else{
      $err['password']= "Please enter password";
    } 
    if(isset($_POST['phone_no']) && !empty($_POST['phone_no']) && trim($_POST['phone_no'])){
      $phone_no = $_POST['phone_no'];
      if (!preg_match("/^(98|97)\d{8}$/", $phone_no)) {
        $err['phone_no'] = "Please enter a valid 10-digit phone number starting with '98' or '97'";
    }
    }else{
      $err['phone_no']= "Please enter Phone number";
    }  
    if(isset($_POST['address']) && !empty($_POST['address']) && trim($_POST['address'])){
      $address = $_POST['address'];
    }else{
      $err['address']= "Please enter address";
    } 
    if(isset($_POST['id_type']) && !empty($_POST['id_type']) && trim($_POST['id_type'])){
      $id_type = $_POST['id_type'];
    }else{
      $err['id_type']= "Please choose Id Type";
    } 
    if(isset($_FILES['id_photo']))
      {
         $id_photo='tenant_photos/'.$_FILES['id_photo']['name'];
  
     if(!empty($_FILES['id_photo'])){
      $path = "tenant_photos/";
      $path=$path. basename($_FILES['id_photo']['name']);
          if(move_uploaded_file($_FILES['id_photo']['tmp_name'], $path))
          {
              // echo"The file ". basename($_FILES['id_photo']['name']). " has been uploaded";
          }
  
          else{
              // echo "There was an error uploading the file, please try again!";
          }
        }
  
      }
}
?>