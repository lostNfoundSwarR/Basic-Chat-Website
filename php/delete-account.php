<?php
session_start();

include_once "database.php";

// Deletes the user account
$sql_query = "DELETE FROM users WHERE unique_user_id = ?";

try {
     $stmt = $conn->prepare($sql_query);
     $stmt->bind_param("i", $_SESSION["unique_id"]);
     $stmt->execute();
}
catch(mysqli_sql_exception $e) {
     echo $e;
}

session_destroy();