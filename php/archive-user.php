<?php
session_start();

include_once "database.php";

$username = mysqli_real_escape_string($conn, filter_input(
                                             INPUT_POST, "username",
                                             FILTER_SANITIZE_SPECIAL_CHARS     
));

$unique_user_id = $_SESSION["unique_id"];

$sql_query = "SELECT unique_user_id FROM users WHERE username = ?
              AND unique_user_id != ? AND
              (unique_user_id IN
              (SELECT friend_id FROM friends WHERE unique_id = ?) OR
              unique_user_id IN (SELECT unique_id FROM friends WHERE friend_id = ?))";

try {
     $stmt = $conn->prepare($sql_query);
     $stmt->bind_param("siiii", $username, $unique_user_id, $unique_user_id, $unique_user_id, $unique_user_id);
     $stmt->execute();

     $result = $stmt->get_result();

     if($result->num_rows == 1) {
          $row = $result->fetch_assoc();

          // Checks if the user already exists within the table or not
          $sql_query = "SELECT archived_unique_id FROM archives
                        WHERE unique_user_id = ? AND archived_unique_id = ?";

          $stmt = $conn->prepare($sql_query);
          $stmt->bind_param("iiii",$unique_user_id, $row["unique_user_id"]);
          $stmt->execute();

          $result = $stmt->get_result();

          if($result->num_rows == 0) {
               // If not, inserts them into the table
               $sql_query = "INSERT INTO archives(unique_user_id, archived_unique_id)
                             VALUES(?, ?)";

               $stmt = $conn->prepare($sql_query);
               $stmt->bind_param("ii",$unique_user_id, $row["unique_user_id"]);
               $stmt->execute();

               echo "Archive Successful";
               exit();
          }
          else {
               echo "User is already archived";
               exit();
          }
     }
     else {
          echo "No user found";
          exit();
     }
}
catch(mysqli_sql_exception $e) {
     echo $e;
}
