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
<form action="new.php" method="post">
  <input class="btn" type="submit" name="submit" value="Submit">
</form> 



<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content=
    "width=device-width, initial-scale=1.0">   
</head>
 
<body>
    <?php

$sql = "select image from product";
    
      $result = $db->query($sql);

      $bati = $result->fetchAll();
      foreach ($bati as $output) {

      
      ?>
          <tr>
              <td>
                  <?php 
                  echo $output['0'];
                  ?>
              </td>
              <td>
              <?php 
                  echo $output[''];
                  ?>
              </td>
              <td>
              <?php 
                  echo $output[''];
                  ?>
              </td>
              <td>
              <?php 
                  echo $output[''];
                  ?>
              </td>
              <td>
              <?php 
                  echo $output[''];
                  ?>
              </td>
              <br>
    <?php 


}


        ?>
             
  
</body>
 
</html>


<?php






// $skin_type = $_POST['skin-type'];
// $skin_problem = $_POST['skin-problem'];
// $country = $_POST['country'];
// $treatment = $_POST['treatment'];

      $my_SQL = "SELECT country from `product` ";
      
      
      $my_table = $db->query($my_SQL);
    

      $my_object = $my_table->fetchAll();
     
      

      foreach( $my_object as $rows) {
        
        ?>
    
         
          <option> <?php echo $rows[0];?> </option>
    

          
        <?php 
        }
       
        $_SQL = "SELECT treatment from `product` ";
      
      
        $_table = $db->query($_SQL);
      
  
        $_object = $_table->fetchAll();
       
        
  
        foreach( $_object as $rows) {
          
          ?>
      
           
            <option> <?php echo $rows[0];?> </option>
      
  
            
          <?php 
          }
      
   ?>
   </select>
  <br>

  <?php 
#the folder where the images are saved 
$target = "images/";
$image = (isset($_POST['image']));

$query = ("SELECT id ,image FROM product");
$image_show= $db->prepare($query);
$image_show->execute();
while($record =$image_show->fetch(PDO::FETCH_ASSOC)) {
#this is the Tannery  operator to replace a pic when an id do not have one
$photo = ($record['image']== null)? "me.png":$record['image'];
#display image 
//echo '<img src="'.$target.$photo.'">';
//echo $record['id'];
}
?>



 <div class="display">
        <?php
        if (isset($_POST["submit"]))
        {
            $country = $_POST['country'];
           
            foreach ($db->query("SELECT image FROM product WHERE country = '$country'") as $row)
            {
                $imageURL = 'images/' . $row["image"]; ?>
                <img src="<?php echo $imageURL; ?>" alt="" />
        <?php
            }
        }
        ?>
         <?php
        if (isset($_POST["submit"]))
        {  // $product_name = $_POST['product_name'];
           // $skin_type = $_POST['skin-type'];
           // $skin_problem = $_POST['skin-problem'];
           $country = $_POST['country'];
            foreach ($db->query("SELECT product_name FROM product WHERE country = '$country'") as $row)
            {    
                ?>
                <h4><?php echo $row['product_name']; ?></h4>
                <p><button>purchase link</button></p>
        <?php
            }
        }
        ?>
   
    </div>