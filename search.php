
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
  
$id = "";
$first_name = "";
$last_name = "";
$email = "";

if(isset($_POST['Find'])) {
    $first_name = $_POST['first_name'];
    $query = "select * from users where $first_name = :first_name";
    $result = $db->prepare($query);
    $record=$result->execute();
    if($record) {
        if($result->rowCount() > 0)
        {
            foreach($result as $row) {
               
            }
        }
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
    <form method="POST">
    Enter product : <input type="text" name="first_name">
   <input type="submit" name="Find" value="find product" >
   <hr/>
<table>
    <tr>
        <td> <b> <?php echo $id ?></b></td>
        <td> <b> <?php echo $first_name ?></b></td>
        <td> <b> <?php echo $last_name ?></b></td>
        <td> <b> <?php echo $email ?></b></td>
    </tr>
</table>
    </form>
 

</body>
</html>