<?php
session_start();

include_once "database.php";

// Deletes  all the chat history
$sql_query = "DELETE FROM messages WHERE outgoing_id = ?";

try {
     $stmt = $conn->prepare($sql_query);
     $stmt->bind_param("i", $_SESSION["unique_id"]);
     $stmt->execute();

     echo "Deleted Successfully";
}
catch(mysqli_sql_exception $e) {
     echo $e;
}