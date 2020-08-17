<?php
session_start();

if (!$_SESSION['id']) {
   header("location: logout.php");
   exit;
}

include "functions/connection.php";

function getReviews(){
   $sql = "SELECT movies.movie_title AS movie_title, reviews.review_content AS content, users.username AS author
            FROM movies
            INNER JOIN reviews
            ON movies.id = reviews.movie_id
            INNER JOIN users
            ON reviews.user_id = users.id";
   
   $conn = connection();

   if($result = $conn->query($sql)){
      return $result;
   } else {
      die("Error retrieving reviews: " . $conn->error);
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
   <title>View Reviews</title>
</head>

<body>
   <?php include "main_menu.php"; ?>
   <main class="container my-5">
      <table class="table table-bordered table-striped">
         <thead class="thead-light">
            <tr>
               <th>Movie Title</th>
               <th>Review</th>
               <th>Author</th>
            </tr>
         </thead>
         <tbody>
         <?php
         $result = getReviews();
         if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
               ?>
               <tr>
                  <td><?= $row['movie_title'] ?></td>
                  <td><?= $row['content'] ?></td>
                  <td><?= $row['author'] ?></td>
               </tr>
               <?php
            }
         } else {
         ?>
            <tr>
               <td colspan="3" class="text-center">
                  <p class="lead font-italic font-weight-bold mb-0">No reviews found.</p>
               </td>
            </tr>
         <?php
         }
         ?>
         </tbody>
      </table>
   </main>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>

</html>