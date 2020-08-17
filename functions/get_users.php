<?php
function getUsers(){
   $sql = "SELECT * FROM users";

   $conn = connection();

   if($result = $conn->query($sql)){
      return $result;
   }else{
      die("Error retrieving users: " . $conn->error);
   }
}