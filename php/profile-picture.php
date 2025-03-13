<?php
session_start();

include_once "database.php";

$unique_user_id = $_SESSION["unique_id"];

$img_file = $_FILES["image-file"];

if($img_file["error"] == 0) {
     // Gets file information
     $img_path_info = pathinfo($img_file["name"]);
     $img_base_name = $img_path_info["filename"];
     $img_ext = strtolower($img_path_info["extension"]);

     // RegEX to sanitize the file name
     $reg_ex = "/[^a-zA-Z0-9._-]/";

     // Sanitizes the file name
     $sanitized_name = preg_replace($reg_ex, "_", $img_base_name);

     if(empty($sanitized_name)) {
          echo "Error: Invalid file name";
          exit();
     }

     $file_name = trim($sanitized_name);
     $tmp_name = $img_file["tmp_name"];

     if(strlen($file_name > 20)) {
          $file_name = substr($file_name, 0, 20);
     }

     // Generates a unique file name
     $file_name .= time() . "." . $img_ext;

     if(move_uploaded_file($tmp_name, "images/" . $file_name)) {
          echo "File moved successfully";
     }
     else {
          echo "Error: File wasn't moved";
     }

     // Updates the user image
     $sql_query = "UPDATE users SET img = ? WHERE unique_user_id = ?";

     try {     
          $stmt = $conn->prepare($sql_query);
          $stmt->bind_param("si", $file_name, $unique_user_id);
          $stmt->execute();
     }
     catch(mysqli_sql_exception $e) {
          echo $e;
     }
}
else {
     echo "Error: Something went wrong";
}