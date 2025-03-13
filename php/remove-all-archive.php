<?php
session_start();

include_once "database.php";

// Queries the archives
$sql_query = "SELECT * FROM archives WHERE unique_user_id = ?";

try {
     $stmt = $conn->prepare($sql_query);
     $stmt->bind_param("i", $_SESSION["unique_id"]);
     $stmt->execute();

     $result = $stmt->get_result();

     // If its not empty, makes it empty/Deletes the archives
     if($result->num_rows > 0) {
          $sql_query = "DELETE FROM archives WHERE unique_user_id = ?";

          $stmt = $conn->prepare($sql_query);
          $stmt->bind_param("i", $_SESSION["unique_id"]);
          $stmt->execute();

          echo "Successful removed all archives";
     }
     else {
          echo "No archives exist";
     }
}
catch(mysqli_sql_exception $e) {
     echo $e;
}