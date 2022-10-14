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
<?php
$id = "";
$fname = "";
$lname = "";
$email = "";


if(isset($_POST['Find'])) { 
// id to search
$id = $_POST['id'];
    
// mysql search query
$pdoQuery = "SELECT * FROM users WHERE id = :id";

$pdoResult = $db->prepare($pdoQuery);

//set your id to the query id
$pdoExec = $pdoResult->execute(array(":id"=>$id));

if($pdoExec)
{
       // if id exist 
       // show data in inputs
   if($pdoResult->rowCount()>0)
   {
       foreach($pdoResult as $row)
       {
           $id = $row['id'];
           $fname = $row['first_name'];
           $lname = $row['last_name'];
           $email = $row['email'];
       }
   }
       // if the id not exist
       // show a message and clear inputs
   else{
       echo 'No Data With This ID';
   }
}else{
   echo 'ERROR Data Not Inserted';
}

}
?>

<!DOCTYPE html>

<html>

    <head>

        <title> SEARCH PRODUCT USING PDO </title>

        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

    </head>

    <body>

        <form action="product.php" method="post">

            ID To Search : <input type="text" name="id" value="<?php echo $id;?>"><br><br>

            First Name : <input type="text" name="fname" value="<?php echo $fname;?>"><br><br>

            Last Name : <input type="text" name="lname" value="<?php echo $lname;?>"><br><br>

           email : <input type="text" name="age" value="<?php echo $email;?>"><br><br>

            <input type="submit" name="Find" value="Find Data">

        </form>
    
    </body>

</html>


