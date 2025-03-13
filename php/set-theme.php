<?php
session_start();

include_once "database.php";

$theme_value = mysqli_escape_string($conn, filter_input(
                                             INPUT_POST, "options",
                                             FILTER_SANITIZE_SPECIAL_CHARS
));  

// Updates the theme
$sql_query = "UPDATE users SET theme = ? WHERE unique_user_id = ?";

try {
     $stmt = $conn->prepare($sql_query);
     $stmt->bind_param("si", $theme_value, $_SESSION["unique_id"]);
     $stmt->execute();

     echo $theme_value;
     exit;     
}
catch(mysqli_sql_exception $e) {
     echo $e;
}