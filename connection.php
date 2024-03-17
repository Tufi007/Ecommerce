<?php
$conn= mysqli_connect('localhost','root','','products');
if ($conn) {
    echo"<script>console.log('succes');</script>";
}
else{
    echo mysqli_connect_error();
}
?>