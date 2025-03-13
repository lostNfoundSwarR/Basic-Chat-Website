<?php
session_start();

include_once "database.php";

$receiver_id = $_SESSION["unique_id"];
$sender_id = $_POST["user-id"];

//Deletes the requests if its declined by the receiver
$sql_query = "DELETE FROM requests WHERE receiver_id = ? AND sender_id = ?";

try {
     $stmt = $conn->prepare($sql_query);
     $stmt->bind_param("ii",$receiver_id, $sender_id);
     $stmt->execute();
}
catch(mysqli_sql_exception $e) {
     echo $e;
}