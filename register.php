<?php 
include("nav.php");
 ?>
 <?php 
 if (isset($_POST['btn_save'])){
  include('register_engine.php');   
   
    if(count($err)==0){
      require_once 'db_connect.php';
      $sql="INSERT INTO `tenants`(name, email, password,contact, address, id_type, id_photo) VALUES ('$full_name', '$email', '$password','$phone_no','$address','$id_type','$path')";
    if($conn->query($sql)===TRUE){
			header("location:tenant_login.php");
	} 
  }
}
 
  
 ?>

<div class="container">
  <h3 style="font-weight: bold; text-align: center;">Tenant Register</h3><hr><br>
  <form method="POST" action="" enctype="multipart/form-data" onclick="return Validate()" novalidate>
    <div class="form-group">
      <label>Full Name:</label>
      <input type="text" class="form-control" id="full_name" placeholder="Enter Full Name" name="full_name" required>
      <?php
          if(isset($err['full_name'])){?>
          <span style="color: red;"><?php echo $err['full_name'] ?></span>
      <?php } ?>
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email" required>
      <?php
          if(isset($err['email'])){?>
          <span style="color: red;"><?php echo $err['email'] ?></span>
      <?php } ?>
    </div>
    <div class="form-group">
      <label for="password1">Password:</label>
      <input type="password" class="form-control" id="password1" placeholder="Enter Password" name="password" required>
      <?php
          if(isset($err['password'])){?>
          <span style="color: red;"><?php echo $err['password'] ?></span>
      <?php } ?>
    </div>
    <div class="form-group">
      <label for="password2">Confirm Password:</label>
      <input type="password" class="form-control" id="password2" placeholder="Enter Password Again" required>
    </div>
    <div class="form-group">
      <label for="phone_no">Phone No.:</label>
      <input type="text" class="form-control" id="phone_no" placeholder="Enter Phone No." name="phone_no" required>
       <?php
          if(isset($err['phone_no'])){?>
          <span style="color: red;"><?php echo $err['phone_no'] ?></span>
      <?php } ?>
       </div>
    <div class="form-group">
      <label for="address">Address:</label>
      <input type="text" class="form-control" id="address" placeholder="Enter Address" name="address" required>
       <?php
          if(isset($err['address'])){?>
          <span style="color: red;"><?php echo $err['address'] ?></span>
      <?php } ?>
    </div>
    <div class="form-group">
      <label for="id_type">Type of ID:</label>
      <select class="form-control" name="id_type" required>
        <option>Citizenship</option>
        <option>Driving Licence</option>
      </select>
      <?php
          if(isset($err['id_type'])){?>
          <span style="color: red;"><?php echo $err['id_type'] ?></span>
      <?php } ?>
    </div>
    <div class="form-group">
      <label for="card_photo">Upload your Selected Card:</label>
      <input type="file" class="form-control" placeholder="Upload id photo" name="id_photo" accept="tenant_photos/*" onchange="preview_image(event)">
    </div>
    <div class="form-group">
      <label>Your selected File:</label><br>
      <img src="" id="output_image" height="200px">
    </div>
    <hr>
    <button id="submit" name="btn_save" type="submit" class="btn btn-primary btn-block" style="background-color: #6e0cd6">Register</button><br>
  </form>
</div>
<style>
  form{
    
   margin-left: 370px;
  }
  .form-control,.btn{
    width: 60%;
    
  }
 </style>

<script type='text/javascript'>
        function preview_image(event)
        {
            var reader = new FileReader();
            reader.onload = function()
            {
                var output = document.getElementById('output_image');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
