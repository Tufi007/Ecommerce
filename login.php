<?php
include("connection.php");
session_start();
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql= "SELECT * FROM `users` WHERE username='$username' and password='$password'";
    $query= mysqli_query($conn,$sql);
    if($query->num_rows === 1){
        $rows= mysqli_fetch_assoc($query);
        if($rows['username']===$username && $rows['password']===$password){
            echo"logged in  </br>
             heloo <b>$username</b>";
            $_SESSION['username']=$rows['username'];
            $_SESSION['id']=$rows['id'];
            header('location:shop.php');

        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>

<body>
    <form action="<?php $_SERVER = ['php_self'] ?>" method="post">
        <label for="username">username:</label><input type="text" name="username" id="username" onkeyup="checkuser(this.value)"><br>
        <label for="password"> password:</label><input type="password" name="password" id="password" onkeypress="checkpass(this.value)"><br>
        <input type="submit" name="submit" value="user-login">
        <input type="submit" name="submit" formaction="shopadmin.php" value="admin-login">

    </form>
</body>
<script src="logvalidate.js"></script>

</html>