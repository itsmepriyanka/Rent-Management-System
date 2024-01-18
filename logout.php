<?php 
session_start();
session_destroy();
header('location:tenant_login.php');
?>