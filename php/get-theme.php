<?php
include_once "database.php";

// Retrieves the current theme of the user
$sql_query_theme = "SELECT theme FROM users WHERE unique_user_id = ?";

try {
     $stmt = $conn->prepare($sql_query_theme);
     $stmt->bind_param("i", $_SESSION["unique_id"]);
     $stmt->execute();

     $theme_result = $stmt->get_result();

     $theme_row = $theme_result->fetch_assoc();
}
catch(mysqli_sql_exception $e) {
     echo $e;
}