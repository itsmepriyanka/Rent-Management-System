
<?php 
include("nav.php"); 

session_start();
if (isset($_SESSION["tenant_id"]) && !empty($_SESSION["tenant_id"])) {
  header('location: tenant_dasboard.php');
  exit;
}
?>
 <?php
 if (isset($_POST['btnLogin'])){
  $err=[];
  if(isset($_POST['email']) && !empty($_POST['email']) && trim($_POST['email'])){
    $email = $_POST['email'];
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $err['email']="Please enter valid email";
    }
  }else{
    $err['email']= "Please enter email";
  }
  if(isset($_POST['password']) && !empty($_POST['password']) && trim($_POST['password'])){
    $password = $_POST['password'];

  }else{
    $err['password']= "Please enter password";
  }
  if(count($err)==0){
    require_once 'db_connect.php';
    $sql="SELECT * FROM tenants WHERE email='$email' AND password='$password'";
   $result=$conn->query($sql);
   if($result->num_rows==1){
    $row= $result->fetch_assoc();
    session_start();
    $_SESSION['tenant_id']=$row['id'];
    $_SESSION['tenant_name']=$row['name'];
    $_SESSION['tenant_contact']=$row['contact'];
    $_SESSION['tenant_email']=$row['email'];

  if(isset($_POST['remember'])){
    setcookie('tenant_id',$row['id'],time()+3*24*60*60);
    setcookie('tenant_name',$row['name'],time()+3*24*60*60);
    setcookie('tenant_email',$row['email'],time()+3*24*60*60);
    setcookie('tenant_contact',$row['contact'],time()+3*24*60*60);
  }

    header('location:tenant_dasboard.php');
   }
   else{
    $msg='Incorrect Email/Password or not registered.';
   }
  }
 }
 ?>
 <style>
  form{
    
   margin-left: 370px;
  }
  .form-control,.btn{
    width: 50%;
    
  }
 </style>

<div class="container">
  <h3 style="font-weight: bold; text-align: center;">Tenant Login</h3><hr><br>
  <?php if(isset($msg)){ ?>
    <p style="color: red; font-size: 20px; font-family:cursive"><?php echo $msg ?></p>
  <?php } ?>  

  <?php if(isset($_GET['err']) && $_GET['err']==1){ ?>
    <p style="color: red; font-size: 20px; font-family:cursive">Please login to continue</p>
  <?php } ?>
  <br>
  <form method="POST" action="">
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="text" class="form-control" id="email" placeholder="Enter email" name="email" value="<?php echo isset($email)?$email:' '?>">
      <?php
         if(isset($err['email'])){?>
        <span style="color: red;"><?php echo $err['email'] ?></span>
      <?php } ?>
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
      <?php
         if(isset($err['password'])){?>
        <span style="color: red;"><?php echo $err['password'] ?></span>
      <?php } ?>
    </div>
    <div class="form-group">
      <a href="forgot-password-tenant.php">Forgot Password ? </a> 
    </div>
    <input type="checkbox" id="remember" name="remember" value="remember" style="margin:0 15px 5px 0">Remember me<br>
    <input type="submit" id="submit" name="btnLogin" class="btn btn-primary" value="Login" style="background-color: #6e0cd6">
  </form>
</div>