<?php 
require_once 'db_connect.php';
$id=$_GET['id'];
echo $id;
echo $sql="update houses set availability=0 where id=$id";
$c=$conn->query($sql);
if($c){
    header('location:tenant_dasboard.php?booked=1');
}
?>