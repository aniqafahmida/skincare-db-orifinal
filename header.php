
<?php


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
    <link rel="stylesheet" href="style.css">
  


</head>


 
 
  <nav class="navbar">
    <div class="brand-title">Skincare page</div>
   <div class="navbar-link">
   <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="upload.php">Upload</a></li>
            <li> <a href="logout.php?logout=true">Logout</a></li>
            <li><a class="button" href="country.php">choose country</a></li>
            <li><a class="button" href="all.php">only country!</a></li>
        </ul>
       
   </div>
   
  </nav>
 
  <header id = "showcase">
  <div ><h1>Welcome To Skincare <?php echo ucfirst($_SESSION['first_name']); ?></h1></div>
  
    </div>
    </header> 

</html>



