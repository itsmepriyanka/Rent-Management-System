
<!--   

// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// } -->

<!-- // $tid = $_SESSION("tenant_id");

// Retrieve longitude and latitude data from your table (replace 'your_table' with your actual table name)
// $sql = " SELECT * FROM `tenants` where id = '$tid'";
// $result = $conn->query($sql);

// if($result){
//     $row = $result->fetch_assoc();
// } -->




<?php
session_start();
require_once 'db_connect.php';
if(!isset($_SESSION['tenant_email'])){
  header('location:tenant_login.php?err=1');
}


$tid =  $_SESSION['tenant_id'];

$sql = "select * from tenants where id = '$tid' ";

$result = $conn->query($sql);



if($result){
    $row = $result->fetch_assoc();
   


}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.dashboard-container {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}
.profile-link,
.logout-link {
    margin-left: 10px;
    text-decoration: none;
    color: whitesmoke;
}
.content {
    margin-top: 20px;
}
h2,
h3 {
    margin-bottom: 10px;
}
.house-gallery {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}
.house-card {
    margin: 10px;
    padding: 10px;
    width: 300px;
    border: 1px solid #ccc;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}
img,#photo{
  font-size: 30px;
  margin-left: 480px;
    width: 20%;
    height: 20%;
    object-fit: cover;
}
.house-details {
    margin-top: 20px;
}
#map {
    height: 400px;
    width: 100%;
    margin-top: 20px;
}
.btnDisabled{
    pointer-events: none;
    opacity: 0.3;
}


.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 300px;
  margin: auto;
  text-align: center;
  font-family: arial;
}

.title {
  color: grey;
  font-size: 18px;
}

button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}

a {
  text-decoration: none;
  font-size: 22px;
  color: black;
}

button:hover, a:hover {
  opacity: 0.7;
}
.profile__container{
    display: flex;
    align-items: center;
    justify-content: center;
    gap:20px    

}
</style>
</head>
<body>

<?php
   include('nav_tenant.php');
   ?>
<div class="dashboard-container">

  <div class="content"><h2 style="text-align:center; padding:5px; ">User Profile </h2>

<div class="card profile__container">

  
  <div>
    <h1>Name: <?php echo $row["name"] ?></h1>
    <p class="title">Address:  <?php echo  $row['address'] ?></p>
    <p> Email: <?php echo $row['email'] ?></p>
    <div style="margin: 24px 0;">
      <a href="#"><i class="fa fa-dribbble"></i></a> 
      <a href="#"><i class="fa fa-twitter"></i></a>  
      <a href="#"><i class="fa fa-linkedin"></i></a>  
      <a href="#"><i class="fa fa-facebook"></i></a> 
    </div>
    
  </div>

</div></div>
<div>
  <p id="photo">ID Photo</p>
<img src="<?php echo $row['id_photo']?>" alt="user">


</div>
       
</div>



</body>
</html>
