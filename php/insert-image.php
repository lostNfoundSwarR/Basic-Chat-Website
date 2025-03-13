<?php
include_once "database.php";

$type = "image";

$outgoing_msg_id = mysqli_real_escape_string($conn, $_POST["outgoing-msg-id"]);
$incoming_msg_id = mysqli_real_escape_string($conn, $_POST["incoming-msg-id"]);

$img_file = $_FILES["img"];

if($img_file["error"] == 0) {
     // Gets the information about the image fileA
     $img_path_info = pathinfo($img_file["name"]);
     $img_base_name = $img_path_info["filename"];
     $img_ext = strtolower($img_path_info["extension"]);

     // RegEX to filter the image name
     $reg_ex = "/[^a-zA-Z0-9._-]/";

     // Sanitizes the name
     $sanitized_name = preg_replace($reg_ex, "_", $img_base_name);

     if(empty($sanitized_name)) {
          echo "Error: Invalid file name";
          exit();
     }

     $file_name = trim($sanitized_name);
     $tmp_name = $img_file["tmp_name"];

     if(strlen($file_name > 20)) {
          $file_name = "IMG" . substr($file_name, 0, 20);
     }

     // Generates a unique file name
     $file_name .= time() . "." . $img_ext;

     if(move_uploaded_file($tmp_name, "images/" . $file_name)) {
          echo "File moved successfully";
     }
     else {
          echo "Error: File wasn't moved";
     }

     // Inserts the message information
     $sql_query = "INSERT INTO messages(msg, incoming_id, outgoing_id, msg_type)
                   VALUES(?, ?, ?, ?)";

     try {
          $stmt = $conn->prepare($sql_query);
          $stmt->bind_param("siis", $file_name, $incoming_msg_id, $outgoing_msg_id, $type);
          $stmt->execute();
     }
     catch(mysqli_sql_exception $e) {
          echo $e;
     }
}
else {
     echo "Error: Something went wrong";
}