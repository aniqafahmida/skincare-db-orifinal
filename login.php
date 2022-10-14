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



<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div id="box">
        <form method= "POST" action="">
           <div style="font-size:20px; margin: 10px;">Login</div>
           <label for="email">email</label>
           <input type="text" name="email" ><br><br>
           <label for="password">Password</label>
           <input type="password" name="password" ><br><br>

           <input type="submit" value="Login"><br><br>
           <a href="signup.php">Click to Sign Up</a><br><br>
        </form>
    </div>
</body>
</html> -->

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login and Register in our skincare </title>
    <link rel="stylesheet" type="text/css" href="bootstrap4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="font-awesome/fontawesome-all.min.js"></script>
</head>
<body  class="bg-dark">
<div class="container h-100">
  
    <hr>
    <div class="row h-100 mt-5 justify-content-center align-items-center">
        <div class="col-md-5 mt-5 pt-2 pb-5 align-self-center border bg-light">
            <?php
                if(isset($_SESSION['error'])){
                    echo "
                        <div class='alert alert-danger text-center'>
                            <i class='fas fa-exclamation-triangle'></i> ".$_SESSION['error']."
                        </div>
                    ";
 
                    //unset error
                    unset($_SESSION['error']);
                }
 
                if(isset($_SESSION['success'])){
                    echo "
                        <div class='alert alert-success text-center'>
                            <i class='fas fa-check-circle'></i> ".$_SESSION['success']."
                        </div>
                    ";
 
                    //unset success
                    unset($_SESSION['success']);
                }
            ?>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Log in your account</h5>
                    <hr>
                    <form method="POST" action="login.php">
                        <div class="form-group row">
                              <label for="email" class="col-3 col-form-label">Email</label>
                              <div class="col-9">
                                <input class="form-control" type="email" id="email" name="email" value="<?php echo (isset($_SESSION['email'])) ? $_SESSION['email'] : ''; unset($_SESSION['email']) ?>" placeholder="input email" >
                              </div>
                        </div>
                        <div class="form-group row">
                              <label for="password" class="col-3 col-form-label">Password</label>
                              <div class="col-9">
                                <input class="form-control" type="password" id="password" name="password" value="<?php echo (isset($_SESSION['password'])) ? $_SESSION['password'] : ''; ?>" placeholder="input password" >
                              </div>
                        </div>
                    <hr>
                    <div>
                        <button type="submit" class="btn btn-primary" name="submit"><i class="fas fa-sign-in-alt"></i> Login</button>
                        <a href="signup.php">Register a new account</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
 


<?php

 //check if login form is submitted
 if(isset($_POST['submit'])){
    //assign variables to post values
    $email = $_POST['email'];
    $password = $_POST['password'];


      //get the user with email
      $stmt = $db->prepare('SELECT * FROM users WHERE email = :email');
 
      try{
          $stmt->execute(['email' => $email]);

          //check if email exist
          if($stmt->rowCount() > 0){
              //get the row
              $user = $stmt->fetch();

              //validate inputted password with $user password
              if(password_verify($password, $user['password'])){
                  //action after a successful login
                  //for now just message a successful login
                 $_SESSION['success'] = 'User verification successful';
                 unset($user['password']);
					$_SESSION = $user;
					header('location:index.php');
					exit();
                  
              }
              else{
               // header('location:index.php');
                  //return the values to the user
                  $_SESSION['email'] = $email;
                  $_SESSION['password'] = $password;

                  $_SESSION['error'] = 'Incorrect password';
              }

          }
          else{
              //return the values to the user
              $_SESSION['email'] = $email;
              $_SESSION['password'] = $password;

              $_SESSION['error'] = 'No account associated with the email';
          }

      }
      catch(PDOException $e){
          $_SESSION['error'] = $e->getMessage();
      }

  }
  else{
      $_SESSION['error'] = 'Fill up login form first';
  }

  //header('location: index.php');
 




















//    if(isset($_POST['submit']))
//    {
//        if(isset($_POST['email'],$_POST['password']) && !empty($_POST['email']) && !empty($_POST['password']))
//        {
//         $email = trim($_POST['email']);
// 		$password = trim($_POST['password']);
//         if(filter_var($email, FILTER_VALIDATE_EMAIL)) // validate email
// 		{
//             $sql = "select * from users where email = :email ";
// 			$handle = $db->prepare($sql);
// 			$params = ['email'=>$email];
// 			$handle->execute($params);

//         }
//        }

//    }   
?>