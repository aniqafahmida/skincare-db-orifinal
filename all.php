<?php 
  session_start(); 
  ?>

<?php include 'header.php'; ?>
<body>
<div class="container">
<form action="all.php" method="post">

            <label>Choose Your country Type:</label>
            <select class="dropdown" name="country" id="country">
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
</body>
</html>



