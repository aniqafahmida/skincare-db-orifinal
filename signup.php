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
        <form method= "POST" action="signup.php">
           <div style="font-size:20px; margin: 10px;">Sign Up</div>
           <label for="name">user_name</label>
           <input type="text" name="user_name"><br><br>
           <label for="email">email</label>
           <input type="email" name="email" ><br><br>
           <label for="password">Password</label>
           <input type="password" name="password"><br><br>
          
           <input type="submit" name = "submit" value="Sign Up"><br><br>
           <a href="login.php">Click to Login</a><br><br>
        </form>
    </div>
</body>
</html>  -->
<!doctype html>
<html>
<head>
<script defer src="script.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
 
</head>
<body class="bg-dark">
 
<div class="container h-100">
	<div class="row h-100 mt-5 justify-content-center align-items-center">
		<div class="col-md-5 mt-3 pt-2 pb-5 align-self-center border bg-light">
			<h1 class="mx-auto w-25" >Register</h1>
			<?php 
				if(isset($errors) && count($errors) > 0)
				{
					foreach($errors as $error_msg)
					{
						echo '<div class="alert alert-danger">'.$error_msg.'</div>';
					}
                }
                
                if(isset($success))
                {
                    
                    echo '<div class="alert alert-success">'.$success.'</div>';
                }
			?>
			<form method="POST" action="signup.php">
                <div class="form-group">
					<label for="email">First Name:</label>
					<input type="text" name="first_name" placeholder="Enter First Name" class="form-control" value="<?php echo ($valFirstName??'')?>">
				</div>
                <div class="form-group">
					<label for="email">Last Name:</label>
					<input type="text" name="last_name" placeholder="Enter Last Name" class="form-control" value="<?php echo ($valLastName??'')?>">
				</div>
 
                <div class="form-group">
					<label for="email">Email:</label>
					<input type="text" name="email" placeholder="Enter Email" class="form-control" value="<?php echo ($valEmail??'')?>">
				</div>
				<div class="form-group">
				<label for="email">Password:</label>
					<input type="password"  placeholder="Enter Password" id="password" name="password"  value="" onkeyup="return checkInput()" class="form-control" value="<?php echo ($valPassword??'')?>">
                    <div id="errror">
                <p id="upper">atleast one upper char</p>
                <p id="lower">atleast one lower char</p>
                <p id="num">atleast one number </p>
                <p id="special">atleast one special char</p>
                <p id="length"> atleast 8 char</p>
                 </div>
				</div>
 
				<button type="submit" name="submit" class="btn btn-primary">Submit</button>
				<p class="pt-2"> Back to <a href="login.php">Login</a></p>
				
			</form>
		</div>
	</div>
</div>
</body>
</html>
 

<?php 

if(isset($_POST['submit']))

{  
  if(isset($_POST['first_name'],$_POST['last_name'],$_POST['email'],$_POST['password']) && !empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['email']) && !empty($_POST['password'])) {

    $firstName = trim($_POST['first_name']);
    $lastName = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $password = password_hash($password, PASSWORD_DEFAULT);
  }

// validate email
  if(filter_var($email, FILTER_VALIDATE_EMAIL))
  {
          $sql = 'select * from users where email = :email';
          $stmt = $db->prepare($sql);
          $p = ['email'=>$email];
          $stmt->execute($p);
          
          if($stmt->rowCount() == 0)
          {
              $sql = "insert into users (first_name, last_name, email, `password`) values(:fname,:lname,:email,:pass)";
          
              try{
                  $handle = $db->prepare($sql);
                  $params = [
                      ':fname'=>$firstName,
                      ':lname'=>$lastName,
                      ':email'=>$email,
                      ':pass'=>$password
                     
                  ];
                  
                  $handle->execute($params);
                  
                  $success = 'User has been created successfully';
                  
              }
              catch(PDOException $e){
                  $errors[] = $e->getMessage();
              }
          }
          else
          {
              $valFirstName = $firstName;
              $valLastName = $lastName;
              $valEmail = '';
              $valPassword = $password;

              $errors[] = 'Email address already registered';
          }
      }
      else
      {
          $errors[] = "Email address is not valid";
      }
  }
  else
  {
      if(!isset($_POST['first_name']) || empty($_POST['first_name']))
      {
          $errors[] = 'First name is required';
      }
      else
      {
          $valFirstName = $_POST['first_name'];
      }
      if(!isset($_POST['last_name']) || empty($_POST['last_name']))
      {
          $errors[] = 'Last name is required';
      }
      else
      {
          $valLastName = $_POST['last_name'];
      }

      if(!isset($_POST['email']) || empty($_POST['email']))
      {
          $errors[] = 'Email is required';
      }
      else
      {
          $valEmail = $_POST['email'];
      }

      if(!isset($_POST['password']) || empty($_POST['password']))
      {
          $errors[] = 'Password is required';
      }
      else
      {
          $valPassword = $_POST['password'];
      }
      
     }


?>

