<?php
session_start();

if (!$_SESSION['id']) {
   header("location: logout.php");
   exit;
}

include "functions/connection.php";
include "functions/get_user.php";
$row = getUser($_SESSION['id']);

function uploadPhoto($imageName)
{
   $id = $_SESSION['id'];

   $sql = "UPDATE users SET photo = '$imageName' WHERE id = $id";

   $conn = connection();

   // Destination - where to store the image / directory
   $destination = "img/" . basename($imageName);

   if ($conn->query($sql)) {
      if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
         header("refresh: 0");
      } else {
         die("Error moving the photo: " . $conn->error);
      }
   } else {
      die("Error uploading photo: " . $conn->error);
   }
}

if (isset($_POST['btnUpdatePhoto'])) {
   $imageName = $_FILES['image']['name'];

   uploadPhoto($imageName);
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
   <title>Profile</title>
</head>

<body>
   <?php include "main_menu.php"; ?>
   <main class="container my-5">
      <div class="row">
         <div class="col-md-3">
            <div class="card">
               <div class="card-img-top">
                  <img src="img/<?= $row['photo'] ?>" alt="Profile photo" width="100%">
               </div>
               <div class="card-body">
                  <form action="" method="post" enctype="multipart/form-data">

                     <div class="custom-file mb-2">
                        <label for="image" class="custom-file-label">Choose photo</label>
                        <input type="file" name="image" id="image" class="custom-file-input">
                     </div>

                     <button type="submit" class="btn btn-outline-secondary btn-sm btn-block" name="btnUpdatePhoto">Update</button>

                  </form>

                  <div class="mt-5">
                     <p class="lead font-weight-bold mb-0">
                        <?= $_SESSION['username']; ?>
                     </p>
                     <span class="lead">
                        <?= $_SESSION['name']; ?>
                     </span>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-9 bg-secondary"></div>
      </div>
   </main>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>

</html>