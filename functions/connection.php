<?php
function connection()
{
   $serverName = "localhost";
   $username = "root";
   $passw = ""; // root for MAC
   $dbName = "movie_review";

   // Create a connection
   // $conn is used to connect to DB
   $conn = new mysqli($serverName, $username, $passw, $dbName);
  
   // Check connection
   if ($conn->connect_error) {
      // error
      die("Connection failed: " . $conn->connect_error);
      // die() will terminate the current script and show a message
   } else {
      // no error
      // echo "Connected successfully.";
      return $conn;
   }
}