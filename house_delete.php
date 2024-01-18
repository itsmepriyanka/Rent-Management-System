<?php
if(is_numeric($_GET['id'])){
    $id=$_GET['id'];
}
else{
    header('location:houses.php?msg=1');
}
include 'db_connect.php';
$sql="DELETE FROM `houses` where id=$id";
$_REQUEST=$conn->query($sql);
if($conn->affected_rows==1){
    header('location:houses.php?msg=2');
}
else{
    header('location:houses.php?msg=3');
}
?>