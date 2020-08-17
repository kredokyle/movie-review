<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
   <!-- BRAND -->
   <a href="#" class="navbar-brand">
      <h1 class="h5 mb-0">The Movie Geek</h1>
   </a>
   <!-- BUTTON -->
   <button class="navbar-toggler" data-toggle="collapse" data-target="#mainMenu">
      <span class="navbar-toggler-icon"></span>
   </button>
   <!-- COLLAPSIBLE LIST -->
   <div class="collapse navbar-collapse" id="mainMenu">
      <!-- left list -->
      <ul class="navbar-nav mr-auto">
         <li class="nav-item">
            <a href="add_review.php" class="nav-link">Reviews</a>
         </li>
         <li class="nav-item">
            <a href="movies.php" class="nav-link">Movies</a>
         </li>
         <li class="nav-item">
            <a href="users.php" class="nav-link">Users</a>
         </li>
      </ul>
      <!-- right list -->
      <ul class="navbar-nav">
         <li class="nav-item">
            <a href="profile.php" class="nav-link">
               <?= $_SESSION['name']; ?>
            </a>
         </li>
         <li class="nav-item">
            <a href="logout.php" class="nav-link text-danger">Log out</a>
         </li>
      </ul>
   </div>
</nav>