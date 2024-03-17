<?php
include('connection.php');
session_start();
if (!empty($_POST['p'])) {
    $p = $_POST['p'];
    echo $p;
    $sql = "DELETE FROM `product` WHERE id=$p";
    $run = $conn->query($sql);
}
if (isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM `adminpage` WHERE adminname='$username' AND password='$password'";
    $res = $conn->query($sql);
    if ($res->num_rows === 1) {
        $r = mysqli_fetch_assoc($res);
        $_SESSION['id'] = $r['id'];
?>




        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>adminpage</title>
            <link rel="stylesheet" href="adminpage.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
        </head>

        <body>
            <div class="main">
                <div class="head">
                    <h2>hi:<?php echo $username; ?></h2>
                    <li>logout</li>
                    <a href="addproduct.php">
                        <li>ADD NEW PRODUCT</li>
                    </a>
                </div>
                <div class="body">
                    <table id="main">
                        <tr>
                            <th>PRODUCT ID</th>
                            <th>PRODUCT IMAGE</th>
                            <th>NAME</th>
                            <th>PRICE</th>
                            <th>INFO</th>
                            <th>ADDITIONAL</th>
                            <th>TOTAL</th>
                            <th>EDIT THE ITEM</th>
                        </tr>
                        <?php
                        $sql = "SELECT * FROM `product`";
                        $res = $conn->query($sql);
                        if ($res->num_rows > 0) {
                            while ($row = mysqli_fetch_assoc($res)) { ?>
                                <tr id="<?php echo $row['id']; ?>">
                                    <td><?php echo $row['id']; ?></td>
                                    <td><img src="<?php echo $row['productimage']; ?>"></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['priceofitem']; ?></td>
                                    <td><?php echo $row['info']; ?></td>
                                    <td><?php echo $row['additional']; ?></td>
                                    <td><?php echo $row['total']; ?></td>
                                    <td><button onclick="del(<?php echo $row['id']; ?>);">Delete Item</button></td>
                                </tr>

                        <?php
                            }
                        } else {
                            echo "nothing in shop";
                        }
                        ?>
                    </table>
                </div>
                <div class="foot"></div>
            </div>
        </body>
        <script>
            function del(x) {
                console.log(x);

                


                console.log(x);
                del1(x);
                del2(x);


            }

            function del1(x) {
                event.preventDefault();
                $.ajax({
                    url: 'shopadmin.php',
                    type: 'POST',
                    dataType: "text",
                    data: {
                        p: x,
                    },

                })
            }

            function del2(x) {
                let child = document.getElementById('main').children[0].children.namedItem(x);
                let parent = document.getElementById('main').children[0];
                console.log(child);
                parent.removeChild(child);
            }
        </script>

        </html>

<?php
    } else {
        echo 'wrong details';
    }
} else {
    echo "try again";
}
?>