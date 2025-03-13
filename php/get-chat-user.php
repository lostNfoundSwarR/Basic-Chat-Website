<?php
include_once "database.php";

$receiver_unique_id = $_GET["user_id"];

// Gets the public data/information about the receiving user
$sql_query = "SELECT * FROM users WHERE unique_user_id = ?";

try {
     $stmt = $conn->prepare($sql_query);
     $stmt->bind_param("i", $receiver_unique_id);
     $stmt->execute();

     $result = $stmt->get_result();

     $row = $result->fetch_assoc();

     $img = (is_null($row["img"])) ? "default.jpg" : $row["img"];
}
catch(mysqli_sql_exception $e) {
     echo "Something went wrong";
}
