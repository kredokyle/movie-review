<?php
include "functions/connection.php";

function createUser($firstName, $lastName, $username, $passw)
{
   $passw = password_hash($passw, PASSWORD_DEFAULT);

   /** SQL **/
   $sql = "INSERT INTO users (first_name, last_name, username, passw) VALUES ('$firstName', '$lastName', '$username', '$passw')";

   /** Connection **/
   $conn = connection();

   /** Execution **/
   if ($conn->query($sql)) {
      // successful
      header("location: login.php"); // redirect to login page
      exit; // terminate the current script
   } else {
      // fail
      die("Error adding new user: " . $conn->error);
   }
}

if (isset($_POST['btnSignUp'])) {
   $firstName = $_POST['firstName'];
   $lastName = $_POST['lastName'];
   $username = strtolower($_POST['username']);
   $passw = $_POST['passw'];
   $confPassw = $_POST['confPassw'];

   // Check if Password and Confirm Password are equal.
   if ($passw == $confPassw) {
      createUser($firstName, $lastName, $username, $passw);
   } else {
      echo "<p class='text-danger'>
               Password and Confirm Password do not match.
            </p>";
   }
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
   <title>Sign Up</title>
</head>

<body>

   <main>
      <form action="" method="post">
         <div class="card w-25 mx-auto my-5">
            <div class="card-header bg-success text-light">
               <h1 class="h4 card-title mb-0">Sign Up</h1>
            </div>
            <div class="card-body">
               <label for="firstName" class="small">First Name</label>
               <input type="text" name="firstName" id="firstName" class="form-control mb-2">

               <label for="lastName" class="small">Last Name</label>
               <input type="text" name="lastName" id="lastName" class="form-control mb-2">

               <label for="username" class="small">Username</label>
               <input type="text" name="username" id="username" class="form-control mb-2" required>

               <label for="passw" class="small">Password</label>
               <input type="password" name="passw" id="passw" class="form-control mb-2" required>

               <label for="confPassw" class="small">Confirm Password</label>
               <input type="password" name="confPassw" id="confPassw" class="form-control mb-5">

               <small><a href="../movie_review">Log in</a></small>
               <button type="submit" class="btn btn-success btn-sm float-right" name="btnSignUp">Sign me up!</button>
            </div>
         </div>
      </form>
   </main>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>

</html>