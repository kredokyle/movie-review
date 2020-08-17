<?php
session_start();

if (!$_SESSION['id']) {
   header("location: logout.php");
   exit;
}

include "functions/connection.php";

function getMovies()
{
   /** SQL **/
   $sql = "SELECT * FROM movies";

   /** Connection **/
   $conn = connection();

   /** Execution **/
   if ($result = $conn->query($sql)) {
      return $result;
   } else {
      die("Error retrieving movies: " . $conn->error);
   }
}

function createReview($user_id, $movie_id, $content)
{
   $sql = "INSERT INTO reviews (review_content, `user_id`, movie_id) VALUES ('$content', $user_id, $movie_id)";

   $conn = connection();

   if ($conn->query($sql)) {
      header("location: view_reviews.php");
      exit;
   } else {
      die("Error saving your review: " . $conn->error);
   }
}

if (isset($_POST['btnPost'])) {
   $user_id = $_SESSION['id'];
   $movie_id = $_POST['movie'];
   $content = $_POST['content'];
   createReview($user_id, $movie_id, $content);
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
   <title>Add Review</title>
</head>

<body>
   <?php include "main_menu.php"; ?>

   <main class="my-5">
      <!-- BUTTON - View -->
      <div class="w-50 mx-auto mb-3">
         <a href="view_reviews.php" class="btn btn-outline-primary btn-sm">View Reviews</a>
      </div>

      <!-- FORM -->
      <form action="" method="post">
         <div class="card w-50 mx-auto">
            <div class="card-header">
               <h2 class="h3 mb-0 card-title">Create Review</h2>
            </div>
            <div class="card-body">
               <select name="movie" class="form-control mb-2" required>
                  <option value="">Select Movie Title</option>
                  <?php
                  $result = getMovies();
                  while ($row = $result->fetch_assoc()) {
                     echo "<option value=" . $row['id'] . ">" . $row['movie_title'] . "</option>";
                  }
                  ?>
               </select>

               <textarea name="content" cols="30" rows="10" class="form-control mb-5" required placeholder="Enter your review here"></textarea>

               <button type="submit" class="btn btn-primary btn-sm btn-block" name="btnPost">Post</button>
            </div>
         </div>
      </form>
   </main>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>

</html>