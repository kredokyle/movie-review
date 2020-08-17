<?php

include "functions/connection.php";
include "functions/get_user.php";

// $_GET['id'] is from users.php; edit_user.php?id=4
$row = getUser($_GET['id']);

function updateUser($firstName, $lastName, $username){
   $id = $_GET['id'];

   /** SQL **/
   $sql = "UPDATE users SET first_name = '$firstName', last_name = '$lastName', username = '$username' WHERE id = $id";

   /** Connection **/
   $conn = connection();

   /** Execution **/
   if($conn->query($sql)){
      header("location: users.php");
      exit;
   }else{
      die("Error updating user: " . $conn->error);
   }
}

if(isset($_POST['btnSave'])){
   $firstName = $_POST['firstName'];
   $lastName = $_POST['lastName'];
   $username = $_POST['username'];

   updateUser($firstName, $lastName, $username);
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
   <title>Edit User</title>
</head>

<body>

   <main>
      <form action="" method="post">
         <div class="card w-25 mx-auto my-5">
            <div class="card-header">
               <h1 class="card-title h4 mb-0">Edit User</h1>
            </div>
            <div class="card-body">
               <label for="firstName" class="small">First Name</label>
               <input type="text" name="firstName" id="firstName" value="<?= $row['first_name'] ?>" class="form-control mb-2">

               <label for="lastName" class="small">Last Name</label>
               <input type="text" name="lastName" id="lastName" value="<?= $row['last_name'] ?>" class="form-control mb-2">

               <label for="username" class="small">Username</label>
               <input type="text" name="username" id="username" value="<?= $row['username'] ?>" class="form-control mb-5">

               <a href="users.php" class="btn btn-secondary">Cancel</a>
               <button type="submit" class="btn btn-warning px-5" name="btnSave">Save</button>
            </div>
         </div>
      </form>
   </main>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>

</html>