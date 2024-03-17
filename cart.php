<?php
session_start();
// $userid = $_SESSION['id'];

include("connection.php");
if (isset($_SESSION['id']) && isset($_SESSION['username'])) {
    $userid = $_SESSION['id'];
}
if (!isset($_SESSION['id']) && !isset($_SESSION['username'])) {
    $userid = '';
}
?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>cart</title>
    </head>

    <body>

        <table>
            <tr>
                <th>item</th>
                <th>itemname</th>
                <th>unit</th>
                <th>total</th>
            </tr>
            <?php
            $s = "SELECT * FROM `usercart` WHERE userid='$userid' ";
            $checkuser = $conn->query($s);
            if ($checkuser->num_rows > 0) {
                while ($r = mysqli_fetch_assoc($checkuser)) { ?>

                    <tr>
                        <td><?php echo $r['userid'] ?></td>
                        <td><?php echo $r['item'] ?></td>
                        <td><?php echo $r['units'] ?></td>
                        <td><?php echo $r['total'] ?></td>
                    </tr>


                <?php } ?>
        </table><?php
            } else { ?>
        <h1>you dont have anything in cart</h1>
<?php }
        
?>


    </body>

    </html><?php

            if (isset($_POST['id']) || isset($_POST['usid'])) {

                $userid = $_POST['usid'];
                $id = $_POST['id'];
                echo "<script> console.log('<?php echo $userid;?>')</script>";
                $c = "SELECT `username` FROM `users` WHERE id=$userid ";
                $ch = mysqli_query($conn, $c);
                if ($ch->num_rows === 1) {
                    while ($g = mysqli_fetch_assoc($ch)) {
                        $username = $g['username'];
                    }
                }
                $checkitem = "SELECT * FROM `product` WHERE id=$id";
                $run = $conn->query($checkitem);
                if ($run->num_rows === 1) {
                    while ($rows = mysqli_fetch_assoc($run)) {
                        $item = $rows['name'];
                        $price = $rows['priceofitem'];
                    }
                }
                $sql = "SELECT* FROM `usercart` WHERE id='$id' AND userid='$userid'";
                $result = $conn->query($sql);
                if ($result->num_rows === 1) {
                    $e = mysqli_fetch_assoc($result);
                    $newunit = $e['units'] + 1;


                    $netprice = $newunit * $price;
                    $sql1 = "UPDATE `usercart` SET units= $newunit ,total=$netprice  where id=$id AND userid='$userid'";

                    $result1 = $conn->query($sql1);
                    header('location:shop.php');
                } elseif ($result->num_rows === 0) {
                    echo $id = $_POST['id'];
                    $sql2 = "INSERT INTO `usercart`(`id`,`item`,`units`,`userid`,`username`,`total`) VALUES('$id','$item',1,'$userid','$username','$price')";
                    $result = $conn->query($sql2);
                    if ($result) {
                        echo "<script> 
            window.location.href='shop.php';
            </script>";
                    }
                }
            }

            ?>