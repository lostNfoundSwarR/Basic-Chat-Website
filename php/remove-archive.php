<?php
session_start();

include_once "database.php";

$username = mysqli_real_escape_string($conn, filter_input(
                                        INPUT_POST, "username",
                                        FILTER_SANITIZE_SPECIAL_CHARS     
));

$unique_user_id = $_SESSION["unique_id"];

// Queries the specific arhive
$sql_query = "SELECT unique_user_id FROM users WHERE username = ?
             AND unique_user_id != ? AND
             unique_user_id IN
             (SELECT friend_id FROM friends WHERE unique_id = ?)";

try {
     $stmt = $conn->prepare($sql_query);
     $stmt->bind_param("sii", $username, $unique_user_id, $unique_user_id);
     $stmt->execute();

     $result = $stmt->get_result();

     // If it exists, deletes it
     if($result->num_rows == 1) {
          $row = $result->fetch_assoc();

          $sql_query = "DELETE FROM archives WHERE
                        archived_unique_id = ? AND unique_user_id = ?";

          $stmt = $conn->prepare($sql_query);
          $stmt->bind_param("ii", $row["unique_user_id"], $unique_user_id);
          $stmt->execute();

          echo "Removed Archive";
          exit();
     }
     else {
          echo "User doesn't exist";
          exit();
     }
}
catch(mysqli_sql_exception $e) {
     echo $e;
}