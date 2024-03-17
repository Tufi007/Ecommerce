<?php
include("connection.php");
if (  isset($_POST['submit'])  && $_SERVER['REQUEST_METHOD']=='POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql= "INSERT INTO users (username,password) VALUE ('$username','$password')";
    $query= $conn->query($sql);
    if ($query) {
        echo"succes";
        header('location:login.php');
        $_POST['username']="";
        $_POST['password']="";
    }else{
        echo"mnot posssible";
    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <legend>registration
        <form method="post" action="<?php $_SERVER = ["PHP_SELF"] ?>" autocomplete="off">
            <label for="username">username:</label><input type="text" name="username" id="username" onkeyup="checkuser(this.value)"><br>
            <label for="password"> password:</label><input type="password" name="password" id="password" onkeypress="checkpass(this)"><br>
            <input type="submit" name="submit" value="register">
        </form>
    </legend>
</body>
<script src="regvalidate.js"></script>

</html>