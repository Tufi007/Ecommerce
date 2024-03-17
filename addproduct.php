<?php
include("connection.php");
session_start();
if (isset($_SESSION['id'])) { ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>addproduct</title>
    </head>

    <body>
        <form action="addproduct.php" method="post" enctype="multipart/form-data">
            <label for="image">upload the image of product:</label><input type="file" name="image" id="image"><br>
            <label for="name">Product name:</label><input type="text" name="name" id="name"><br>
            <label for="price">Price of product:</label><input type="number" name="price" id="price"><br>
            <label for="info">INFO about product:</label><input type="text" name="info" id="info"><br>
            <label for="additional">More about product:</label><textarea name="additional" id="additional" cols="30" rows="10"></textarea><br>
            <label for="total">Total units available:</label><input type="number" name="total" id="total"><br>
            <input type="submit" name="submit1" value="addproduct"><br>
        </form>
    </body>

    </html>
<?php
}
if (isset($_POST['submit1'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $info = $_POST['info'];
    $additional = $_POST['additional'];
    $total = $_POST['total'];
    $file = $_FILES["image"];
    $filename = $file['name'];
    $folder = $file['tmp_name'];
    $destination = "images/" . $filename;
    move_uploaded_file($folder, $destination);
    print_r($filename);
    print_r($folder);

    $sql = "INSERT INTO `product`( productimage, name, priceofitem, info, additional, total) VALUES ('$destination','$name',$price,'$info','$additional',$total)";
    $run=$conn->query($sql);
    if($run){
    echo "helooooooooooooooooooooo";
} else {
    echo "ieurfhviwerufvhiruvhrieuh";
}}

?>