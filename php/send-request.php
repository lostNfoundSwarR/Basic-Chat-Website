<?php
session_start();

include_once "database.php";

$sender_id = $_SESSION["unique_id"];
$receiver_id = $_POST["user-id"];

// Inserts the request in the request list/table
$sql_query = "INSERT INTO requests(sender_id, receiver_id)
              VALUES(?, ?)";

try {
     $stmt = $conn->prepare($sql_query);
     $stmt->bind_param("ii", $sender_id, $receiver_id);
     $stmt->execute();
}
catch(mysqli_sql_exception $e) {
     echo $e;
}