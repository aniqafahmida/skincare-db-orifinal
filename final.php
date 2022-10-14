<?php
session_start();



?>


<?php include 'header.php'; ?>

<body>
    <div class="container">
        <form action="final.php" method="post">

            <label>Choose Your Skin Type:</label>
            <select class="dropdown"  name="skin-type" id="skin-type">
                <option>Select an Option</option>
                <?php foreach ($db->query("SELECT DISTINCT skin_type FROM product") as $row) { ?>
                    <option><?php echo $row['skin_type']; ?></option>
                <?php } ?>
            </select>
            <br><br>
            <label>Choose your skin concern:</label>
            <select class="dropdown"  name="skin-problem" id="skin-problem">
                <option>Select an Option</option>
                <?php foreach ($db->query("SELECT DISTINCT treatment FROM product") as $row) { ?>
                    <option><?php echo $row['treatment']; ?></option>
                <?php } ?>
            </select>
            <br><br>
            
      <label>Choose Your preferred country:</label>
          <select class="dropdown"  name="country" id="country">
          <option>Select an Option</option>
           <?php foreach ($db->query("SELECT DISTINCT country FROM product") as $row) { ?>
            <option><?php echo $row['country']; ?></option>
        <?php } ?>
</select>
<br><br>     
            <input class="btn" type="submit" name="submit" value="Submit">
        </form>

    </div>

    <div class="display">
        <?php
        if (isset($_POST["submit"]))
        {
            $skin_type = $_POST['skin-type'];
            $skin_problem = $_POST['skin-problem'];
            $country = $_POST['country'];
            foreach ($db->query("SELECT * FROM product WHERE skin_type = '$skin_type' AND treatment = '$skin_problem' AND country = '$country'") as $row)
            {
                ?>
                <tr>  
                <div class="mydisplay"> 
           <?php 
            ?>  <?php  echo $row['product_name']; ?>
             <img src=" <?php  echo "images".$row['image']; ?> " width='200' height='200'>
              <p><button>purchase link</button></p>
    
             
               
                
        <?php

           ?>
                   
                </tr>
                <?php

            
            }
        }
        ?>
        
   
    </div>

</body>
</html>

<?php  
?>

    </div>
    
 
