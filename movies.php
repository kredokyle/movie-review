<?php
session_start();

if (!$_SESSION['id']) {
   header("location: logout.php");
   exit;
}

include "functions/connection.php";

function createMovie($movieTitle)
{
   /** SQL **/
   $sql = "INSERT INTO movies (movie_title) VALUES ('$movieTitle')";

   /** Connection **/
   $conn = connection();

   /** Execution **/
   if ($conn->query($sql)) {
      header("refresh: 0");
   } else {
      die("Error adding movie: " . $conn->error);
   }
}

if (isset($_POST['btnAdd'])) {
   $movieTitle = $_POST['movieTitle'];

   createMovie($movieTitle);
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
   <title>Movies</title>
</head>

<body>
   <?php include "main_menu.php"; ?>
   <main>
      <form action="" method="post">
         <div class="card w-25 mx-auto my-5">
            <div class="card-header">
               <h2 class="h3 card-title mb-0">Add New Movie</h2>
            </div>
            <div class="card-body">
               <input type="text" name="movieTitle" id="movieTitle" class="form-control mb-5" required>
               <button type="submit" name="btnAdd" class="btn btn-primary btn-sm btn-block">Add</button>
            </div>
         </div>
      </form>
   </main>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>

</html>