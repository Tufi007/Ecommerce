<?php
include('connection.php');session_start();
$_SESSION['id']='';
session_unset();
session_destroy();
header('location:shop.php');
?>