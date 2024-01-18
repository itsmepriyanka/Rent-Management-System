<?php
session_start();
if(!isset($_SESSION['admin_email'])){
  header('location:owner_login.php?err=1');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>House Rental Management System</title>
  <style>
    body {
    margin: 0;
    padding: 0;
  }
  
  .navbar {
    margin-top: 60px;
    height: 100vmax;
    width: 17vmax;
    background-color: grey;
    color: #fff;
    position: fixed;
  }
  
  .navbar a {
    display: block;
    padding: 15px;
    color: #fff;
    text-decoration: none;
  }
  
  .navbar a:hover {
    background-color: aliceblue;
    color: black;
  }
  .navbar a.active {
      background-color: #421e95;
    }
.body{
  margin:0;
  background-color:rgb(170, 169, 169);
  height: 740px;
}
.head{  
  font-size: 1.7vmax;
  color: black;
  padding: 15px 25px;
  background-color: grey;
  width: 100%;
  position: fixed;
}
.head span{
  margin-left:950px;
  font-size: 15px;
}
.head span a{
  color: wheat;
  text-decoration: none;
}
table{
  font-size: 18px;            
  margin-left: 25px;
  border-collapse: collapse;
  border: rgb(124, 120, 120) solid;         
        }
table tr th{
  padding: 10px 5px 10px 5px;
  border: rgb(124, 120, 120) solid;
}
.navbar li{
  list-style: none;
}
.active_link{
  background-color: black;
}
  </style>
</head>


<body> 
    <div class="head">House Rental Management System<span><a href="logout.php">Logout</a></span></div>
  <div class="navbar">
    <?php 
    $sn= explode('/',$_SERVER['SCRIPT_NAME']);
    $page=$sn[count($sn)-1];
    ?>
    <li class="<?php echo ($page=='dashboard.php')?'active_link':'';?>"><a href="dashboard.php"><i class="fa fa-tachometer"></i> Dashboard</a></li>
    <li class="<?php echo ($page=='houseType.php')?'active_link':'';?>"><a href="houseType.php"><i class="fa fa-th-list"></i> House Type</a></li>
    <li class="<?php echo ($page=='houses.php')?'active_link':'';?>"><a href="houses.php"><i class="fa fa-home"></i> Houses</a></li>
    <li class="<?php echo ($page=='tenant.php')?'active_link':'';?>"><a href="tenant.php"><i class="fa fa-users"></i> Tenants</a></li>
    <li class="<?php echo ($page=='Payment.php')?'active_link':'';?>"><a href="Payment.php"><i class="fa fa-file"></i> Payments</a></li>
    <li class="<?php echo ($page=='bookings.php')?'active_link':'';?>"><a href="bookings.php"><i class="fa fa-list-alt"></i> Booking details</a></li>
  </div>
</body>
<script>
  
</script>

</html>