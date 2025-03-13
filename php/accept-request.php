<?php
session_start();

include_once "database.php";

$unique_id = $_SESSION["unique_id"];
$friend_id = $_POST["user-id"];

// Inserts the user into the friends table/list after request is accepted
$sql_query = "INSERT INTO friends(unique_id, friend_id)
              VALUES(?, ?)";

try {
     $stmt = $conn->prepare($sql_query);
     $stmt->bind_param("ii", $unique_id, $friend_id);
     $stmt->execute();
}
catch(mysqli_sql_exception $e) {
     echo $e;
}