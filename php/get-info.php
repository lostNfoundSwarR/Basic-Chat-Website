<?php
include_once "database.php";

$unique_id = $_SESSION["unique_id"];

// Gets the personal user information (self information)
$sql_query = "SELECT * FROM users WHERE unique_user_id = ?";

try {
     $stmt = $conn->prepare($sql_query);
     $stmt->bind_param("i", $unique_id);
     $stmt->execute();

     $result = $stmt->get_result();

     $row =  $result->fetch_assoc();

     $username = $row["username"];

     $img = (is_null($row["img"])) ? "default.jpg" : $row["img"];

     // Gets the count of friends
     $sql_query = "SELECT COUNT(user_id) AS 'count' FROM friends
                   WHERE friend_id = ? OR unique_id = ?";

     $stmt = $conn->prepare($sql_query);
     $stmt->bind_param("ii", $_SESSION["unique_id"], $_SESSION["unique_id"]);
     $stmt->execute();

     $result = $stmt->get_result();

     $row_count = $result->fetch_assoc();
}
catch(mysqli_sql_exception $e) {
     echo $e;
}