<?php
include "functions/connection.php";

function login($username, $passw){
   /** SQL - check if the username exists **/
   $sql = "SELECT * FROM users WHERE username = '$username'";

   /** Connection **/
   $conn = connection();

   /** Execution **/
   $result = $conn->query($sql);

   if($result->num_rows == 1){   // username exists / there is 1 match
      $row = $result->fetch_assoc(); // $row - associative array
      if(password_verify($passw, $row['passw'])){
         // Session will only start once the username and password are verified.
         session_start();

         $_SESSION['id'] = $row['id'];
         $_SESSION['username'] = $row['username'];
         $_SESSION['name'] = $row['first_name'] . " " . $row['last_name']; // "Jake Bay"

         // Login password and database password match
         header("location: users.php");
         exit;
      } else {
         echo "<p class='text-danger'>
               Incorrect password.
               </p>
         ";
      }
   } else {
      echo "<p class='text-danger'>
            Username not found.
            </p>
      ";
   }
}

if(isset($_POST['btnLogin'])){
   $username = $_POST['username'];
   $passw = $_POST['passw'];

   login($username, $passw);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <meta name="Description" content="Enter your description here" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
   <link rel="stylesheet" href="assets/css/style.css">
   <title>Welcome to The Movie Geek</title>
</head>

<body>

   <form action="" method="post">
      <div class="card w-25 mx-auto my-5">
         <div class="card-header bg-primary text-light">
            <h1 class="card-title h4 mb-0">Log in</h1>
         </div>
         <div class="card-body">
            <label for="username" class="small">Username</label>
            <input type="text" name="username" id="username" class="form-control mb-2" autofocus required>

            <label for="passw" class="small">Password</label>
            <input type="password" name="passw" id="passw" class="form-control mb-5" required>

            <small><a href="sign_up.php">Create Account</a></small>
            <button type="submit" name="btnLogin" class="btn btn-primary btn-block mt-2">Login</button>
         </div>
      </div>
   </form>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>

</html>