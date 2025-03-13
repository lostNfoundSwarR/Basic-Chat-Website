<?php
if(empty($_SESSION["unique_id"])) {
     header("Location: registration.php");
     exit();
}

include_once "database.php";

$unique_id = $_SESSION["unique_id"];

// Loads the information about the current user
$sql_query = "SELECT * FROM users WHERE unique_user_id = ?";

$stmt = $conn->prepare($sql_query);
$stmt->bind_param("i", $unique_id);
$stmt->execute();

$result = $stmt->get_result();

$row =  $result->fetch_assoc();

$username = $row["username"];

$img = (is_null($row["img"])) ? "default.jpg" : $row["img"];