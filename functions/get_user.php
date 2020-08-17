<?php
function getUser($id){
   /** SQL **/
   $sql = "SELECT * FROM users WHERE id = $id";

   /** Connection **/
   $conn = connection();

   /** Execution **/
   if($result = $conn->query($sql)){
      return $result->fetch_assoc(); // return the record in an associative array
      // This will be received by $row in edit_user.php
   } else {
      die("Error retrieving user: " . $conn->error);
   }
}
?>