<?php
session_start();
include('connection.php');

$sql = 'SELECT `id`,`productimage`,`name`,`priceofitem`,`info`FROM `product` ORDER BY id ASC';
$result = $conn->query($sql);


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
    <title>shop</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <!-- <meta http-equiv="refresh" content="2"> -->
    <script src="https://kit.fontawesome.com/c006bbf3f8.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="shop.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kalam:wght@300&display=swap" rel="stylesheet">


</head>

<body>
    <div class="main">
        <div class="header">
            <h1 class="first">MY</h1>
            <h1 class="second">STORE</h1>
        </div>
        <div class="links">
            <ul class="headerlinks">
                <li class=""><a href="#">home</a></li>
                <li class=""><a href="#">products</a></li>
                <li class=""><a href="login.php">login</a></li>
                <li class=""><a href="#">account</a></li>
                <li id="cart"><a>cart</a></li>
                <li class=""><a href="#">favourite</a></li>
                <li class=""><a href="logout.php">logout</a></li>
            </ul>
        </div>
        <div class="intro">
            <div class="left-intro">
                <h2>WE PROVIDE THE BEST PRODUCTS</h2>
                <button class="explore" name='explore'>
                    <bold>explore</bold>
                </button>
            </div>

        </div>
        <div class="body">
            <?php
            if ($result->num_rows > 0) {
                while ($rows = mysqli_fetch_assoc($result)) {

                    // print_r($rows);
                    $id = $rows["id"];
                    $productimage = $rows['productimage'];
                    $name = $rows["name"];
                    $priceofitem = $rows["priceofitem"];
                    $info = $rows["info"]; ?><form id="<?php echo $id; ?>">
                        <div class="product"><img src='<?php echo $productimage; ?>' alt="product1">
                            <div class="insideproduct">
                                <div>
                                    <input type="hidden" name="name" id="name" value="<?php echo $name; ?>">
                                    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                                    <p class="name" id="name"><?php echo $name; ?></p>
                                    <p class="info" id="info"><?php echo $info; ?></p>
                                </div>
                                <div class="buttonside">
                                    <p class="price"><?php echo $priceofitem . "$"; ?></p>
                                    <button id="btn" onclick="check(<?php echo $id; ?>)" class="addtocart" style="background-color: whitesmoke; "><i class="fa-sharp fa-solid fa-cart-plus "></i></button>
                                </div>
                            </div>
                        </div>

                    </form> <?php }
                    } ?>
        </div>
        <!-- <div class="footer">
            <div class="footmain"></div>
            <div class="h">
                <ul class="he">
                    <li>facebook</li>
                    <li>insta</li>
                    <li>twitter</li>
                    <li>email</li>
                    <li>about</li>
                </ul>
            </div>
        </div> -->
        <footer class="footer">
    <div class="footer-content">
      <div class="footer-section">
        <h3>Categories</h3>
        <ul>
          <li><a href="#">Electronics</a></li>
          <li><a href="#">Fashion</a></li>
          <li><a href="#">Home &amp; Furniture</a></li>
          <li><a href="#">Books</a></li>
          <li><a href="#">Sports &amp; Outdoors</a></li>
        </ul>
      </div>
      <div class="footer-section">
        <h3>Information</h3>
        <ul>
          <li><a href="#">About Us</a></li>
          <li><a href="#">Contact Us</a></li>
          <li><a href="#">Privacy Policy</a></li>
          <li><a href="#">Terms &amp; Conditions</a></li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <p>&copy; 2023 Your eCommerce Website. All rights reserved.</p>
    </div>
  </footer>
    </div>
    </div>
</body>
<script>
    let userid = "<?php echo $userid; ?>";

 
    let targetli = document.getElementsByClassName("headerlinks").item(0).children.namedItem('cart').children[0];

    // targetli.addEventListener('click',(e)=>{
    //     console.log(e.target.style="outline:none");
    // })
    let c = targetli.addEventListener('click', (e) => {

        let i = e.target.innerText;
        if (userid === '') {
            alert("need to log in first");

        } else {
            window.location.assign('cart.php');
        }
        console.log(i);
    });


    function check(z) {
        let x = z;
        event.preventDefault();
        if (userid !== '') {
            // event.preventDefault();
            let form = document.forms.namedItem(x);
            let n = form.elements['id'].value;
            $.ajax({
                url: 'cart.php',
                type: 'POST',
                dataType: ("Content-type", "application/x-www-form-urlencoded"),
                data: {
                    usid: userid,
                    id: n
                },
                success: function abc(result, status) {
                    console.log(result);
                    console.log(status);
                },
            })
            console.log('got here');

            console.log(userid);

        } else {
            alert("login first");
        }

    }
</script>

</html>