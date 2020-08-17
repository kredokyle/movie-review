<?php
session_start();

if(!$_SESSION['id']){
   header("location: logout.php");
   exit;
}

include "functions/connection.php";
include "functions/get_users.php";
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
   <title>Users</title>
</head>

<body>
   <?php include "main_menu.php"; ?>
   <main class="my-5">
      <div class="container">
         <h2 class="text-muted h5">User List</h2>

         <table class="table table-hover">
            <thead class="thead-light">
               <tr>
                  <th>#</th>
                  <th>FIRST NAME</th>
                  <th>LAST NAME</th>
                  <th>USERNAME</th>
                  <th></th> <!-- for the action buttons -->
               </tr>
            </thead>
            <tbody>
               <?php
               $result = getUsers();
               while ($row = $result->fetch_assoc()) {
               ?>
                  <tr>
                     <td><?= $row['id']; ?></td> <!-- < ? echo is the same as < ?= -->
                     <td><?= $row['first_name'] ?></td>
                     <td><?= $row['last_name'] ?></td>
                     <td><?= $row['username'] ?></td>
                     <td>
                        <a href="edit_user.php?id=<?= $row['id'] ?>" class="btn btn-outline-secondary btn-sm">Edit</a>
                        <a href="remove_user.php?id=<?= $row['id'] ?>" class="btn btn-outline-danger btn-sm">Remove</a>
                     </td>
                  </tr>
               <?php
               }
               ?>
            </tbody>
         </table>
      </div>
   </main>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>

</html>