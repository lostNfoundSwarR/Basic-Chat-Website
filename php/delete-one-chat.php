<?php
session_start();

include_once "database.php";

$username = mysqli_real_escape_string($conn, filter_input(
                                       INPUT_POST, "username",
                                      FILTER_SANITIZE_SPECIAL_CHARS     
));

$unique_user_id = $_SESSION["unique_id"];

// Deletes a single chat history
$sql_query = "SELECT unique_user_id FROM users WHERE username = ? AND unique_user_id != ?";

try {
     $stmt = $conn->prepare($sql_query);
     $stmt->bind_param("si", $username, $unique_user_id);
     $stmt->execute();

     $result = $stmt->get_result();

     if($result->num_rows > 0) {
          $row = $result->fetch_assoc();

          $sql_query = "DELETE FROM messages WHERE incoming_id = ? AND outgoing_id = ?";

          $stmt = $conn->prepare($sql_query);
          $stmt->bind_param("ii", $row["unique_user_id"], $unique_user_id);
          $stmt->execute();

          echo "Deleted Successfully";
     }
     else {
          echo "No user found";
     }
}
catch(mysqli_sql_exception $e) {
     echo $e;
}