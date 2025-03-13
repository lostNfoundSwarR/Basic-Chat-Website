<?php
session_start();

include_once "database.php";

$sender_id = $_SESSION["unique_id"];
$receiver_id = $_POST["user-id"];

// Deletes the requests if its canceleled by the sender
$sql_query = "DELETE FROM requests WHERE sender_id = ? AND receiver_id = ?";

try {
     $stmt = $conn->prepare($sql_query);
     $stmt->bind_param("ii", $sender_id, $receiver_id);
     $stmt->execute();
}
catch(mysqli_sql_exception $e) {
     echo $e;
}