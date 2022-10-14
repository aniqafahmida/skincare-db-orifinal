<?php
session_start();

$dbname = "skincaredb";
$dbuser = "root";
$dbpass = "";
$dbhost = "localhost:3366";



try{
  $db = new PDO("mysql:host=".$dbhost.";dbname=$dbname", $dbuser, $dbpass);
  // // set the PDO error mode to exception
   $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
  exit();
}


?>
<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>Skin Care</title>
    <meta charset="utf-8">
</head>

<body>
    <div class="header">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="upload.php">Upload</a></li>
        </ul>
    </div>
</body>
</html>


<?php
//include 'header.php';
if (isset($_POST["upload"]))
{
    $product_name = $_POST['product_name'];
    $skin_type = $_POST['skin_type'];
    $treatment = $_POST['treatment'];
    $country = $_POST['country'];
    $image = $_FILES['image']['name'];
    $targetFilePath = "images/" . $image;
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

    if (in_array(pathinfo($targetFilePath, PATHINFO_EXTENSION), $allowTypes))
    {
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath))
        {
            $insert = $db->query("INSERT INTO product (product_name, skin_type, treatment, country, image) VALUES ('$product_name', '$skin_type', '$treatment', '$country', '$image')");
        }
    }
    else
    {
        echo "File Type Not Supported";
    }
}
?>

<body>
    <div class="upload-form">
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <div>
                <label>Product Name: </label>
                <input type="text" name="product_name">
            </div>
            <br>
            <div>
                <label>Skin Type: </label>
                <input type="text" name="skin_type">
            </div>
            <br>
            <div>
                <label>Treatment: </label>
                <input type="text" name="treatment">
            </div>
            <br>
            <div>
                <label>Country: </label>
                <input type="text" name="country">
            </div>
            <br>
            <div>
                <label>Image: </label>
                <input type="file" name="image">
            </div>
            <br>
            <div>
                <input type="submit" name="upload" value="Upload">
            </div>
        </form>
    </div>
</body>
</html>