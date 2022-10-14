<?php 
  session_start();
  
    if(!$_SESSION['id']){
        header('location:login.php');
    }
 
?>
 
 
 
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
      
    </div>
</body>
</html> -->




<?php include 'header.php'; ?>

<body >
    <div class="container">
   
        <form action="index.php" method="post">
        
            <label>Choose Your Skin Type:</label>
            
            <select class="dropdown" name="skin-type" id="skin-type">
                <option>Select an Option</option>
                <?php foreach ($db->query("SELECT DISTINCT skin_type FROM product") as $row) { ?>
                    <option><?php echo $row['skin_type']; ?></option>
                <?php } ?>
            </select>
            <br><br>
            <label>Choose your skin concern:</label>
            <select class="dropdown" name="skin-problem" id="skin-problem">
                <option>Select an Option</option>
                <?php foreach ($db->query("SELECT DISTINCT treatment FROM product") as $row) { ?>
                    <option><?php echo $row['treatment']; ?></option>
                <?php } ?>
            
            </select>
           <br> <br>
          
       
            <input class="btn" type="submit" name="submit" value="Submit">
        </form>

        <div class="display" style="border: 1px solid black;">
        <?php
            if (isset($_POST["submit"]))
            {
                $skin_type = $_POST['skin-type'];
                $skin_problem = $_POST['skin-problem'];
                $selectSQL = "SELECT * FROM product WHERE skin_type = '$skin_type' AND treatment = '$skin_problem'";
                $result = $db->query($selectSQL);
                $table = $result->fetchAll();
                $productCount = $result->rowCount();
                if ($productCount == 0){
                    ?>
                    <h4><?php echo 'NO PRODUCTS FOUND'; ?></h4>
                    <?php
                } else{
                        foreach ($table as $row)
                    {
                        $imageURL = 'images/' . $row[5];
            ?>
                <div class='items'>
                    <img src="<?php echo $imageURL; ?>" alt=""/>
                    <br><button>purchase link</button>
                    <h4><?php echo $row['product_name']; ?></h4>
                    <!-- <button>purchase link</button> -->
                </div>       
            <?php
                    }
                }
                
            }
        ?>
   
    </div>
        
    </div>



    <div class="footer">


    </div>

</body>
</html>