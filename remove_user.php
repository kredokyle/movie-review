<?php
session_start();

if (!$_SESSION['id']) {
   header("location: logout.php");
   exit;
} else {
   include "functions/connection.php";
   deleteUser($_GET['id']);
}

function deleteUser($id){
   /** SQL **/
   $sql = "DELETE FROM users WHERE id = $id";

   /** Connection **/
   $conn = connection();
   
   /** Execution **/
   if($conn->query($sql)){
      header("location: users.php");
      exit;
   } else {
      die("Error deleting user: " . $conn->error);
   }
}